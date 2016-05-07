(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
"use strict";

var _Admin = require("./components/Admin");

var _Admin2 = _interopRequireDefault(_Admin);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var admin = new _Admin2.default.sharedInstance();

$(function () {

    var targetId = 0;

    $(".delete-btn").each(function () {
        var _this = this;

        $(this).on('click', function (ev) {
            ev.preventDefault();
            admin.showWarningAlert({
                title: '确定该删除操作?',
                text: '删除后将无法撤销',
                confirm: '我确认!',
                cancel: '手贱了'
            }, function () {
                targetId = $($(_this).parents("tr")[0]).attr('data-id');
                var url = $($(_this).parents("table")[0]).attr('action-url') + '/' + targetId;
                deleteRecord(url, 'DELETE');
            });

            return false;
        });
    });

    $(".confirm-button.delete").each(function () {
        var _this2 = this;

        $(this).on('click', function (ev) {
            ev.preventDefault();
            var redirect = $(_this2).attr('redirect');

            admin.showWarningAlert({
                title: '确定该删除操作?',
                text: '删除后将无法撤销',
                confirm: '我确认!',
                cancel: '手贱了'
            }, function () {
                deleteRecord(window.location.href, 'DELETE', null, null, function () {
                    setTimeout(function () {
                        return window.location.href = redirect;
                    }, 500);
                });
            });

            return false;
        });
    });

    $(".edit-btn").each(function () {
        var _this3 = this;

        $(this).on('click', function (ev) {
            ev.preventDefault();

            window.location.href = $($(_this3).parents("table")[0]).attr('action-url') + '/' + $($(_this3).parents("tr")[0]).attr('data-id');

            return false;
        });
    });

    function deleteRecord(url, type, ids, action, callback) {
        $.ajax({
            url: url,
            type: type,
            data: ids ? {
                _token: $("meta[name=_token]").attr('content'),
                userIDs: ids,
                action: action
            } : { _token: $("meta[name=_token]").attr('content') },
            dataType: 'json',
            success: function success(data) {
                if (data.status != 'error') {
                    swal({
                        title: data.message,
                        timer: 1050,
                        type: 'success',
                        showConfirmButton: false
                    });
                    $("tr[data-id=" + targetId + "]").fadeOut();
                    setTimeout(function () {
                        return $("tr[data-id=" + targetId + "]").remove();
                    }, 500);
                    if (callback) {
                        callback();
                    }
                } else {
                    toastr.error(data.message);
                }
            },
            error: function error(err) {
                toastr.error(err.responseText);
            }
        });
    }

    $("[editor]").summernote({
        lang: 'zh-CN',
        callbacks: {
            onImageUpload: function onImageUpload(files) {
                if (files.length) {
                    $(files).each(function () {
                        var $data = new FormData();
                        $data.append('image', this);

                        $.ajax({
                            url: '/upload',
                            type: 'POST',
                            dataType: 'json',
                            data: $data,
                            enctype: 'multipart/form-data',
                            processData: false,
                            contentType: false,
                            success: function success(data) {
                                if (data.status != 'error') $("[editor]").summernote('insertImage', data.url);else toastr.error(data.message);
                            },
                            error: function error(er) {
                                toastr.error(er.responseText);
                            }
                        });
                    });
                }
            }
        }
    });

    $("form:not(.editor):not([role=search])").on('submit', function (e) {
        e.preventDefault();
        var form = e.target,
            data = $(form).serialize();

        $.ajax({
            url: form.action,
            type: $($(form).find("input[name=_method]")[0]).val(),
            data: data,
            dataType: 'json',
            success: function success(data) {
                if (typeof data.redirect == 'undefined') {
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
            error: function error(_error) {
                if (_error.status === 422) {
                    var errors = JSON.parse(_error.responseText);

                    var _loop = function _loop(er) {
                        var sel = "[name=" + er + "]",
                            groupEl = $($(form).find(sel)[0]).parents('.form-group')[0];
                        // Add error class to the form-group
                        $(groupEl).addClass('has-error shaky');
                        setTimeout(function () {
                            return $(groupEl).removeClass('has-error shaky');
                        }, 8000);

                        $(sel).focus();
                        toastr.error("<h5>" + errors[er][0] + "</h5>");
                    };

                    for (var er in errors) {
                        _loop(er);
                    }
                } else {
                    toastr.error(_error.responseText);
                }
            },
            complete: function complete() {
                $($(form).find("input[name=body]")[0]).remove();
            }
        });
    });
});

},{"./components/Admin":2}],2:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var Admin = function () {
    function Admin() {
        _classCallCheck(this, Admin);
    }

    _createClass(Admin, [{
        key: "showWarningAlert",
        value: function showWarningAlert(messages, callback) {
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
                if (isConfirm) callback();
            });
        }
    }], [{
        key: "sharedInstance",
        value: function sharedInstance() {
            return new Admin();
        }
    }]);

    return Admin;
}();

exports.default = Admin;

},{}]},{},[1]);

//# sourceMappingURL=admin.js.map
