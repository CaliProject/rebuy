@push('scripts.footer')
<script>
    var template = '<div class="row"> <a href="#" class="del"><i class="icon-close"></i></a> <div class="col-sm-2"> <input type="text" class="form-control" name="meta_key[]"> </div> <div class="col-sm-10"> <input type="text" class="form-control col-sm-6" name="meta_val[]"> </div></div>';

    $(function () {
        @if($product->description != '' || old('description'))
        setTimeout(function () {
            $("[editor]").summernote("code", "{!! addslashes(old('description') ?: $product->description) !!}");
        }, 200);
        @endif

        $("a#add_meta").on('click', function (ev) {
            ev.preventDefault();

            $(template).appendTo($(".metas"));
            initEvents();
        });

        function initEvents() {
            $("a.del").each(function () {
                $(this).on('click', function (ev) {
                    ev.preventDefault();

                    $($(this).parents(".row")[0]).fadeOut();
                    setTimeout(function () {
                        $($(this).parents(".row")[0]).remove();
                    }.bind(this), 560);
                }.bind(this));
            });
        }

        $("form:has([editor])").on('submit', function (e) {
            e.preventDefault();
            var form = e.target;

            $("<textarea name='description' class='hidden'>" + $('[editor]').summernote('code') + "</textarea>").appendTo($(form));

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

        initEvents();
    });
</script>
@endpush