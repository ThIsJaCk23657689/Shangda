/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 25);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/orders/sales/index.js":
/*!********************************************!*\
  !*** ./resources/js/orders/sales/index.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $("#delivered_delivered_at").datepicker({
    dateFormat: 'yy-mm-dd',
    changeYear: true,
    changeMonth: true,
    maxDate: new Date()
  });
  $("#paid_paid_at").datepicker({
    dateFormat: 'yy-mm-dd',
    changeYear: true,
    changeMonth: true,
    maxDate: new Date()
  });
  var myDate = new Date();
  var date = myDate.getFullYear() + '-' + ('0' + (myDate.getMonth() + 1)).slice(-2) + '-' + ('0' + myDate.getDate()).slice(-2);
  $("#delivered_delivered_at").val(date);
  $("#paid_paid_at").val(date);
  $('.delivered-btn').click(function () {
    var salesID = $(this).data('id');
    var expectDeliveredAt = $(this).data('expectDeliveredAt');
    $("#delivered_sales_id").val(salesID);
    $("#delivered_expectDelivered_at").val(expectDeliveredAt);
  });
  $('.cancle-delivered-btn').click(function () {
    var _this = this;

    Swal.fire({
      title: '注意！',
      text: '您確定要取消出貨嗎？',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '確認',
      cancelButtonText: '取消'
    }).then(function (result) {
      if (result.value) {
        $(_this).next().submit();
      }
    });
  });
  $('.cancle-delivered-form').submit(function (e) {
    e.preventDefault();
    var $url = $(this).attr('action');
    var $data = $(this).serializeObject();
    $.showLoadingModal();
    axios.post($url, $data).then(function (response) {
      $.showSuccessModal(response.data.message, response.data.url);
    })["catch"](function (error) {
      $.showErrorModal(error);
      console.error('取消銷貨單出貨時間時發生錯誤，錯誤訊息：' + error);
    });
  });
  $('#DeliveredForm').submit(function (e) {
    e.preventDefault();
    var $url = $(this).attr('action');
    var $data = $(this).serializeObject();
    $.showLoadingModal();
    axios.post($url, $data).then(function (response) {
      // console.log(response.data);
      $.showSuccessModal(response.data.message, response.data.url);
      $('#DeliveredForm').modal('hide');
    })["catch"](function (error) {
      $.showErrorModal(error);
      console.error('修改銷貨單到貨時間時發生錯誤，錯誤訊息：' + error);
    });
  });
  $('.paid-btn').click(function () {
    var salesID = $(this).data('id');
    $("#paid_sales_id").val(salesID);
  });
  $('#PaidForm').submit(function (e) {
    e.preventDefault();
    var $url = $(this).attr('action');
    var $data = $(this).serializeObject();
    $.showLoadingModal();
    axios.post($url, $data).then(function (response) {
      // console.log(response.data);
      $.showSuccessModal(response.data.message, response.data.url);
      $('#PaidModal').modal('hide');
    })["catch"](function (error) {
      $.showErrorModal(error);
      console.error('確認進貨單付清時間時發生錯誤，錯誤訊息：' + error);
    });
  });
  $('.cancle-paid-btn').click(function () {
    var _this2 = this;

    Swal.fire({
      title: '注意！',
      text: '您確定要取消此銷貨單的付清狀態？',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '確認',
      cancelButtonText: '取消'
    }).then(function (result) {
      if (result.value) {
        $(_this2).next().submit();
      }
    });
  });
  $('.cancle-paid-form').submit(function (e) {
    e.preventDefault();
    var $url = $(this).attr('action');
    var $data = $(this).serializeObject();
    $.showLoadingModal();
    axios.post($url, $data).then(function (response) {
      $.showSuccessModal(response.data.message, response.data.url);
    })["catch"](function (error) {
      $.showErrorModal(error);
      console.error('確認或取消進貨單付清時發生錯誤，錯誤訊息：' + error);
    });
  });
});

/***/ }),

/***/ 25:
/*!**************************************************!*\
  !*** multi ./resources/js/orders/sales/index.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\orders\sales\index.js */"./resources/js/orders/sales/index.js");


/***/ })

/******/ });