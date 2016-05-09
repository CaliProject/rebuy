@push('scripts.footer')
<script>
    $(function () {
        @if($post->body != '' || old('body'))
        setTimeout(function () {
            $("[editor]").summernote("code", "{!! addslashes(old('body') ?: $post->body) !!}");
        }, 200);
        @endif

        $("form:has([editor])").on('submit', function (e) {
            e.preventDefault();
            var form = e.target;

            $("<textarea name='body' class='hidden'>" + $('[editor]').summernote('code') + "</textarea>").appendTo($(form));

            var data = $(form).serialize();

            $.ajax({
                url: form.action,
                type: $($(form).find("input[name=_method]")[0]).val(),
                data: data,
                dataType: 'json',
                success: function (data) {
                    if (typeof(data.redirect) == 'undefined') {
                        if (data.status == 'success') {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                        return false;
                    } else {
                        window.location.href = data.redirect;
                        return false;
                    }
                },
                error: function (error) {
                    if (error.status === 422) {
                        var errors = JSON.parse(error.responseText);
                        for (var er in errors) {
                            var sel = '[name=' + er +']',
                                    groupEl = $($(form).find(sel)[0]).parents('.form-group')[0];
                            // Add error class to the form-group
                            $(groupEl).addClass('has-error shaky');
                            setTimeout(function () {
                                $(groupEl).removeClass('has-error shaky')
                            }, 8000);

                            $(sel).focus();
                            toastr.error('<h4>'+errors[er][0]+'</h4>');
                        }
                    } else {
                        toastr.error(error.responseText);
                    }
                },
                complete: function () {
                    $($(form).find("textarea[name=body]")[0]).remove();
                }
            });
        });
    });
</script>
@endpush