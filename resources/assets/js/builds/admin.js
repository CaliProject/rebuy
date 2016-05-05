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

    $(".edit-btn").each(function () {
        var _this2 = this;

        $(this).on('click', function (ev) {
            ev.preventDefault();

            window.location.href = $($(_this2).parents("table")[0]).attr('action-url') + '/' + $($(_this2).parents("tr")[0]).attr('data-id');

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
            onImageUpload: function onImageUpload(files) {}
        }
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
