import Paginate from 'vuejs-paginate';
import Swal from 'sweetalert2';
import Cropper from 'cropperjs';
import DataTable from 'laravel-vue-datatable';
import VueRecaptcha from 'vue-recaptcha';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./../../node_modules/jquery-cropper/dist/jquery-cropper')

window.Vue = require('vue');
window.Swal = Swal;
window.Cropper = Cropper;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('option-item', require('./components/Partials/OptionItem.vue').default);
Vue.component('loading-modal', require('./components/Modals/LoadingModal.vue').default);
Vue.component('paginate', Paginate);
Vue.component('vue-recaptcha', VueRecaptcha);
Vue.use(DataTable);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const navbar = new Vue({
    el: '#app',
    methods: {
        easyPeasyParallax() {
            let scrollPos = $(document).scrollTop();
            let targetOpacity;
            let start_point = 220;
            let end_point = 440;

            if (scrollPos >= end_point) {
                targetOpacity = 1;
            } else {
                targetOpacity = 0;
            }

            (scrollPos < end_point && scrollPos > start_point) ? targetOpacity = (scrollPos - 220) / 220: targetOpacity;

            $('nav.navbar').css({
                'background-color': 'rgba(0, 53, 119, ' + targetOpacity + ')'
            });
        }
    },
    created() {
        // ==================== Swal 函式操作 ====================
        $.showLoadingModal = function(message = '資料讀取中') {
            $('input').removeClass('is-invalid')
            Swal.fire({
                title: '請稍後',
                html: message,
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
        }

        $.showErrorModal = function(error) {
            let $container = $('<span></span>');
            let $type = false;
            if (error.response.data.errors != null) {
                let $key = Object.keys(error.response.data.errors);
                $key.forEach(function(item, index) {
                    $container.append(error.response.data.errors[item] + '<br />');
                    $('#' + item).addClass('is-invalid');
                });
                $type = true;
            }

            Swal.fire({
                title: 'Oops!發生錯誤',
                text: '原因：' + error.response.data.message,
                icon: 'error',
                allowOutsideClick: false,
                confirmButtonText: '確認',
                html: ($type) ? $container : null,
            });
        }

        $.showErrorModalWithoutError = function(message = '發生不明原因，請稍後再試。', url = '', buttonText = '返回列表') {
            if (url == '') {
                Swal.fire({
                    title: 'Oops!發生錯誤',
                    text: message,
                    icon: 'error',
                    allowOutsideClick: false,
                    confirmButtonText: '確認',
                });
            } else {
                Swal.fire({
                    title: 'Oops!發生錯誤',
                    text: message,
                    icon: 'error',
                    allowOutsideClick: false,
                    confirmButtonText: buttonText,
                }).then(result => {
                    if (result.value) {
                        window.location.href = url;
                    }
                });
            }
        }

        $.showWarningModal = function(message = '發生不明原因，此操作具有警告性，請聯絡系統工程師。', url = '', buttonText = '返回列表') {
            if (url == '') {
                Swal.fire({
                    title: '注意',
                    text: message,
                    icon: 'warning',
                    allowOutsideClick: false,
                    confirmButtonText: '確認',
                });
            } else {
                Swal.fire({
                    title: '注意',
                    text: message,
                    icon: 'warning',
                    allowOutsideClick: false,
                    confirmButtonText: buttonText,
                }).then(result => {
                    if (result.value) {
                        window.location.href = url;
                    }
                });
            }
        }

        $.showSuccessModal = function(message = '', url = '', buttonText = '返回列表') {
            if (url == '') {
                Swal.fire({
                    title: '恭喜成功',
                    text: message,
                    icon: 'success',
                    confirmButtonText: '確認',
                });
            } else {
                Swal.fire({
                    title: '恭喜成功',
                    text: message,
                    icon: 'success',
                    allowOutsideClick: false,
                    confirmButtonText: buttonText,
                }).then(result => {
                    if (result.value) {
                        window.location.href = url;
                    }
                });
            }
        }

        $.closeModal = function() {
            Swal.close();
        }
        // ==================== Swal 函式操作 ====================
    },
    mounted() {
        let vm = this;
        $(window).scroll(function() {
            vm.easyPeasyParallax();
        });
    }
});

$(function() {
    // 表單Object 格式化
    $.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    // input為$()所指向的input element。
    // 檢查value是否為小數點或數字，value可以是字串、整數、浮點數。
    $.isFloatOrInt = function(input) {
        let value = input.val();
        var float = /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
        if (float.test(value)) {
            return true;
        } else {
            $.showWarningModal("請輸入有效的整數或浮點數。");
            input.val(0);
            return false;
        }
    }

    $.datepicker.setDefaults($.datepicker.regional["zh-TW"]);

    $.isUrl = function(url) {
        var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
        return regexp.test(url);
    }

    $.formatDate = function(datetime) {
        let fulldate = new Date(datetime);
        let year = fulldate.getFullYear();
        let month = (fulldate.getMonth() + 1) >= 10 ? (fulldate.getMonth() + 1) : ("0" + (fulldate.getMonth() + 1));
        let date = fulldate.getDate() < 10 ? ("0" + fulldate.getDate()) : fulldate.getDate();
        return year + '-' + month + '-' + date;
    }
});
