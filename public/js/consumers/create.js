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
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/consumers/create.js":
/*!******************************************!*\
  !*** ./resources/js/consumers/create.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $('#individual_btn').click(function (e) {
    $('#individual_form').slideDown();
    $('#individual_btn').attr('disabled', true);
    $('#company_btn').attr('disabled', true);
    $('#step1').slideUp();
    $('#goback2step1').slideDown();
    $('#individual_act').focus();
  });
  $('#company_btn').click(function (e) {
    $('#company_form').slideDown();
    $('#individual_btn').attr('disabled', true);
    $('#company_btn').attr('disabled', true);
    $('#step1').slideUp();
    $('#goback2step1').slideDown();
  });
  $('#goback2step1_btn').click(function (e) {
    $('#individual_form').slideUp();
    $('#company_form').slideUp();
    $('#individual_btn').attr('disabled', false);
    $('#company_btn').attr('disabled', false);
    $('#step1').slideDown();
    $('#goback2step1').slideUp();
  });
  $("#individual_birthday").datepicker({
    dateFormat: 'yy-mm-dd',
    changeYear: true,
    changeMonth: true,
    yearRange: "-80:+0",
    maxDate: '-15y'
  });
  $('#individual_monthlyCheck').change(function (e) {
    if ($(this).prop("checked")) {
      $('#individual_monthlyCheckDate').val(0);
      $('#individual_monthlyCheckDate').attr('disabled', true);
    } else {
      $('#individual_monthlyCheckDate').val(0);
      $('#individual_monthlyCheckDate').attr('disabled', false);
    }
  });
  $('#company_monthlyCheck').change(function (e) {
    if ($(this).prop("checked")) {
      $('#company_monthlyCheckDate').val(0);
      $('#company_monthlyCheckDate').attr('disabled', true);
    } else {
      $('#company_monthlyCheckDate').val(0);
      $('#company_monthlyCheckDate').attr('disabled', false);
    }
  });
  $('#individual_address_twzipcode').twzipcode({
    'readonly': true
  });
  $('#company_address_twzipcode').twzipcode({
    'readonly': true
  });
  $('#company_deliveryAddress_twzipcode').twzipcode({
    'readonly': true
  });
  $('#individual_picture').change(function () {
    var input = $(this)[0];
    readURL(input, 'individual');
  });
  $('#company_picture').change(function () {
    var input = $(this)[0];
    readURL(input, 'company');
  });

  function readURL(input, type) {
    if (type == 'individual') {
      if (input.files && input.files[0]) {
        $('#individual_preview-upload').fadeIn();
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#individual_previewImg-upload').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    } else {
      if (input.files && input.files[0]) {
        $('#company_preview-upload').fadeIn();
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#company_previewImg-upload').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
  }

  $('input[name=individual_phone],input[name=individual_tel]').on('input', function () {
    // Set the required property of the other input to false if this input is not empty.
    $('input[name=individual_phone],input[name=individual_tel]').not(this).prop('required', !$(this).val().length);
  });
  $('input[name=company_operator_phone],input[name=company_operator_tel]').on('input', function () {
    // Set the required property of the other input to false if this input is not empty.
    $('input[name=company_operator_phone],input[name=company_operator_tel]').not(this).prop('required', !$(this).val().length);
  });
  $('#company_taxID').change(function (e) {
    $taxID = $(this).val();

    if ($taxID != "") {
      re = /^[0-9]{8}$/;

      if (re.test($taxID)) {
        $.ajax({
          url: 'http://localhost/Shangda/public/backend/consumers/taxID/' + $taxID + '/getData',
          type: 'GET',
          dataType: 'json',
          success: function success(response, textStatus) {
            console.log({
              response: response,
              textStatus: textStatus
            });
          },
          error: function error(XMLHttpRequest, textStatus, errorThrown) {
            console.log({
              XMLHttpRequest: XMLHttpRequest,
              textStatus: textStatus,
              errorThrown: errorThrown
            });
          }
        });
      } else {
        // 失敗
        alert('請輸入正確格式的統一編號。');
        $(this).val('');
      }
    }
  }); // $('#copycompany1').click(function (e) {
  //     if ($(this).prop("checked")) {
  //         $('#deliveryAddress').val($('#companyAddress').val());
  //     } else {
  //         $('#deliveryAddress').val('');
  //     }
  // });
  // $('#copycompany2').click(function (e) {
  //     if ($(this).prop("checked")) {
  //         $('#invoiceAddress').val($('#companyAddress').val());
  //     } else {
  //         $('#invoiceAddress').val('');
  //     }
  // });
});

/***/ }),

/***/ 11:
/*!************************************************!*\
  !*** multi ./resources/js/consumers/create.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\consumers\create.js */"./resources/js/consumers/create.js");


/***/ })

/******/ });