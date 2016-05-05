import Admin from "./components/Admin";

const admin = new Admin.sharedInstance();

$(() => {

    var targetId = 0;

    $(".delete-btn").each(function () {
        $(this).on('click', (ev) => {
            ev.preventDefault();
            admin.showWarningAlert({
                title: '确定该删除操作?',
                text: '删除后将无法撤销',
                confirm: '我确认!',
                cancel: '手贱了'
            }, () => {
                targetId = $($(this).parents("tr")[0]).attr('data-id');
                let url = $($(this).parents("table")[0]).attr('action-url') + '/' + targetId;
                deleteRecord(url, 'DELETE');
            });

            return false;
        }); 
    });

    $(".edit-btn").each(function () {
        $(this).on('click', (ev) => {
            ev.preventDefault();

            window.location.href = $($(this).parents("table")[0]).attr('action-url') + '/' + $($(this).parents("tr")[0]).attr('data-id');

            return false;
        });
    });

    function deleteRecord(url, type, ids, action) {
        $.ajax({
            url: url,
            type: type,
            data: ids ? {
                _token: $("meta[name=_token]").attr('content'),
                userIDs: ids,
                action: action
            } : {_token: $("meta[name=_token]").attr('content')},
            dataType: 'json',
            success: (data) => {
                if (data.status != 'error') {
                    swal({
                        title: data.message,
                        timer: 1050,
                        type: 'success',
                        showConfirmButton: false
                    });
                    $(`tr[data-id=${targetId}]`).fadeOut();
                    setTimeout(() => $(`tr[data-id=${targetId}]`).remove(), 500);
                } else {
                    toastr.error(data.message);
                }
            },
            error: (err) => {
                toastr.error(err.responseText);
            }
        });
    }

    $("[editor]").summernote({
        lang: 'zh-CN',
        callbacks: {
            onImageUpload: (files) => {

            }
        }
    });
});