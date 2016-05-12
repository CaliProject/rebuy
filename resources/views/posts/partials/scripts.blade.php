<script>
    $(function () {
        var $reply_area = $('#reply-textarea'),
                $parent_id = 0,
                $_token = "{{ csrf_token() }}",
                $is_submitting = false,
                $submit_button = $('a#reply-submit'),
                $current_page = 1,
                $is_loading = false,
                $loading_text = "点击加载更多...";

        $($reply_area).each(function () {
            $(this).bind('DOMNodeInserted', function (e) {
                if ($(e.target).hasClass('textarea')) {
                    $reply_area.attr('data-placeholder', '');
                }
            });

            $(this).keydown(function (e) {
                if ((event.ctrlKey || event.metaKey) && e.which == 13) {
                    event.preventDefault();
                    $('a#reply-submit').trigger('click');
                }
            });
        });

        $("#post-like-btn:not(.liked)").on('click', function (ev) {
            var $btn = ev.target;

            $.ajax({
                url: "{{ url()->current() }}",
                type: 'PATCH',
                data: {_token:$_token},
                success: function (data) {
                    if (data.status == 'success') {
                        $($btn).addClass('liked');
                        $($btn).html("<i class='fa fa-thumbs-up'></i>&nbsp;点赞 (" + data.likes + ")");
                        $($btn).off('click');
                    }
                }
            });
        });

        function initEvents() {
            // Like buttons
            $('a#like-button').each(function () {
                var parentItem = $(this).parents(".comment-item")[0],
                        commentID = $(parentItem).attr('data-id'),
                        commentLikes = $(this).html();

                $(this).click(function () {
                    if (!$(this).hasClass('liked')) {
                        // Like this
                        var el = $(this);

                        $.ajax({
                            url: "{{ url('comments/like') }}/" + commentID,
                            data: {_token: $_token},
                            dataType: "json",
                            type: "PUT",
                            success: function (data) {
                                if (data.status == "success") {
                                    // Succeeded
                                    commentLikes++;
                                    el.html(commentLikes).addClass('liked');
                                } else {
                                    showGenieMessage(data.message);
                                }
                            }
                        });
                    }
                });
            });

            // Reply buttons
            $('a#reply-button').each(function () {
                $(this).click(function () {
                    // Reply this
                    var parentItem = $(this).parents(".comment-item")[0],
                            parentNode = $(this).parents(".details")[0],
                            commentID = $(parentItem).attr('data-id');

                    $parent_id = commentID;
                    $(".comment-actions").appendTo($(parentNode)).addClass("replying");
                });
            });

            $('a#cancel-reply').each(function () {
                $(this).click(function () {
                    $(".comment-actions").prependTo($(".comments-wrap")).removeClass("replying");
                    $parent_id = 0;
                });
            });
        }

        // Load more comments
        $('a#load-more-button').click(function () {
            var $load_more = $("a#load-more-button");
            $load_more.html('<i class="fa fa-spin fa-spinner"></i>"');

            if (!$is_loading) {
                $is_loading = true;
                $.ajax({
                    url: "{{ url()->current() . '/comments' }}/" + $current_page,
                    data: {_token: $_token},
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        $is_loading = false;
                        $load_more.html($loading_text);
                        if (data.html == "") {
                            $($load_more).remove();
                        }
                        $(data.html).appendTo($('ul.comments-list')[0]);
                        $current_page++;

                        initEvents();
                    }
                });
            }
        });

        $submit_button.on('click', function () {
            submitComment();
        });

        function submitComment() {
            if ($is_submitting) {
                return false;
            }
            // Submit comment
            $content = $reply_area.html();

            if ($content.trim() == "") {
                return false;
            }

            $is_submitting = true;
            $($submit_button).addClass('disabled');

            $.ajax({
                url: "{{ url()->current() . '/comment' }}",
                data: {_token: $_token, content: $content, origin: $parent_id},
                dataType: "json",
                type: "POST",
                success: function (data) {
                    $is_submitting = false;
                    $submit_button.removeClass('disabled');
                    if (data.status == "error") {
                        swal({title:data.message, type:"error",timer: 1500,showConfirmButton: false});
                    } else {
                        toastr.success(data.message);
                        addComment($parent_id, data.html);
                    }
                }
            });
        }

        function addComment($parent_id, $html) {
            $no_reulst = $('.comments-list h3');
            if (!$parent_id) {
                if ($no_reulst != null) {
                    $no_reulst.remove();
                }
                $($html).appendTo($('.comments-list')[0]).fadeIn();
            } else {
                var selector = '.comment-item[data-id=' + $parent_id + ']';
                $html = "<ul class=\"comments-list\">" + $html + "</ul>";
                $($html).appendTo($(selector)[0]).fadeIn();

                $('a#cancel-reply').trigger('click');
            }
            $reply_area.html('');
            initEvents();
        }

        initEvents();
    });
</script>