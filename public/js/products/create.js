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
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/products/create.js":
/*!*****************************************!*\
  !*** ./resources/js/products/create.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  $('#picture').change(function () {
    var input = $(this)[0];
    readURL(input);
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      $('#preview-upload').fadeIn();
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#previewImg-upload').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#fundamentalPrice').change(function () {
    $.isFloatOrInt($(this));
    caluatedRetailPrice();
  });
  $('#materialCoefficient1').change(function () {
    $.isFloatOrInt($(this));
    caluatedRetailPrice();
  });
  $('#materialCoefficient2').change(function () {
    $.isFloatOrInt($(this));
    caluatedRetailPrice();
  });
  $('#materialCoefficient3').change(function () {
    $.isFloatOrInt($(this));
    caluatedRetailPrice();
  });
  $('#materialCoefficient4').change(function () {
    $.isFloatOrInt($(this));
    caluatedRetailPrice();
  });
  $('#materialCoefficient5').change(function () {
    $.isFloatOrInt($(this));
    caluatedRetailPrice();
  });

  function caluatedRetailPrice() {
    var fp = parseFloat($('#fundamentalPrice').val());
    var mc1 = parseFloat($('#materialCoefficient1').val());
    var mc2 = parseFloat($('#materialCoefficient2').val());
    var mc3 = parseFloat($('#materialCoefficient3').val());
    var mc4 = parseFloat($('#materialCoefficient4').val());
    var mc5 = parseFloat($('#materialCoefficient5').val());
    var mp1 = parseFloat($('#material_1').html());
    var mp2 = parseFloat($('#material_2').html());
    var mp3 = parseFloat($('#material_3').html());
    var mp4 = parseFloat($('#material_4').html());
    var mp5 = parseFloat($('#material_5').html());
    var rp = fp + mc1 * mp1 + mc2 * mp2 + mc3 * mp3 + mc4 * mp4 + mc5 * mp5;
    $('#retailPrice').val(rp);
  }

  function genereateProductName() {
    // 取得商品規格 (例如：兩斤、半斤、四兩)
    var specification = $('#specification').val(); // 取得商品顏色或花樣 (例如：黑、紅白、白花)

    var color = $('#color').val(); // 取得商品重量（例如：5 6 7 10 10.5 11 12，單位：兩）
    // 如果該重量值不是空值或是0，就外加括號，反之就都不顯示於商品名稱內。

    var weight = $('#weight').val();

    if (weight != '' && weight != null && weight != 0) {
      weight = ' (' + weight + ')';
    } else {
      weight = '';
    } // 取得商品慣用單位


    var unit = $('#unit').val(); // 取得每件數量

    var qty_per_pack = $('#qty_per_pack').val();

    if (unit == 'kg') {
      qty_per_pack = qty_per_pack + 'KG';
    } // 取得商品類別名稱。


    var product_category_name = $('#category_id :selected').text();
    var pack_unit = '1 * ';

    if (product_category_name == '耐熱袋' && unit == 'package') {
      pack_unit = '1P * ';
    } else if (unit == 'roll') {
      pack_unit = '5P * ';
    }

    $('#name').val(color + product_category_name + specification + ' ' + pack_unit + qty_per_pack + weight);
  }

  $('#ManualNamed').click(function () {
    var result = $(this).prop('checked');

    if (result) {
      $('#name').attr('readonly', false);
    } else {
      $('#name').attr('readonly', true);
      genereateProductName();
    }
  });
  $('#specification').change(function () {
    if (!$('#ManualNamed').prop('checked')) {
      genereateProductName();
    }
  });
  $('#color').change(function () {
    if (!$('#ManualNamed').prop('checked')) {
      genereateProductName();
    }
  });
  $('#weight').change(function () {
    if (!$('#ManualNamed').prop('checked')) {
      genereateProductName();
    }
  });
  $('#qty_per_pack').change(function () {
    if (!$('#ManualNamed').prop('checked')) {
      genereateProductName();
    }
  });
  $('#weight').change(function () {
    if (!$('#ManualNamed').prop('checked')) {
      genereateProductName();
    }
  });
  $('#category_id').change(function () {
    if (!$('#ManualNamed').prop('checked')) {
      genereateProductName();
    }
  });
  $('#unit').change(function () {
    if (!$('#ManualNamed').prop('checked')) {
      genereateProductName();
    }
  });
});

/***/ }),

/***/ 7:
/*!***********************************************!*\
  !*** multi ./resources/js/products/create.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\products\create.js */"./resources/js/products/create.js");


/***/ })

/******/ });