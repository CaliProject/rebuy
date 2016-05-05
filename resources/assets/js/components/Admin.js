export default class Admin {
    showWarningAlert(messages, callback) {
        swal({
            title: messages.title,
            text: messages.text,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: messages.confirm,
            cancelButtonText: messages.cancel,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm)
                callback();
        });
    }
    
    static sharedInstance() {
        return new Admin();
    }
}