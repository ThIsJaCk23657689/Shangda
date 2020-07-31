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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/frontend/products/index.js":
/*!*************************************************!*\
  !*** ./resources/js/frontend/products/index.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
var contnet = new Vue({
  el: '#app',
  methods: {},
  created: function created() {},
  mounted: function mounted() {
    // Lift card and show stats on Mouseover
    $('#product-card').hover(function () {
      $(this).addClass('animate');
      $('div.carouselNext, div.carouselPrev').addClass('visible');
    }, function () {
      $(this).removeClass('animate');
      $('div.carouselNext, div.carouselPrev').removeClass('visible');
    }); // Flip card to the back side

    $('#view_details').click(function () {
      $('div.carouselNext, div.carouselPrev').removeClass('visible');
      $('#product-card').addClass('flip-10');
      setTimeout(function () {
        $('#product-card').removeClass('flip-10').addClass('flip90').find('div.shadow').show().fadeTo(80, 1, function () {
          $('#product-front, #product-front div.shadow').hide();
        });
      }, 50);
      setTimeout(function () {
        $('#product-card').removeClass('flip90').addClass('flip190');
        $('#product-back').show().find('div.shadow').show().fadeTo(90, 0);
        setTimeout(function () {
          $('#product-card').removeClass('flip190').addClass('flip180').find('div.shadow').hide();
          setTimeout(function () {
            $('#product-card').css('transition', '100ms ease-out');
            $('#cx, #cy').addClass('s1');
            setTimeout(function () {
              $('#cx, #cy').addClass('s2');
            }, 100);
            setTimeout(function () {
              $('#cx, #cy').addClass('s3');
            }, 200);
            $('div.carouselNext, div.carouselPrev').addClass('visible');
          }, 100);
        }, 100);
      }, 150);
    }); // Flip card back to the front side

    $('#flip-back').click(function () {
      $('#product-card').removeClass('flip180').addClass('flip190');
      setTimeout(function () {
        $('#product-card').removeClass('flip190').addClass('flip90');
        $('#product-back div.shadow').css('opacity', 0).fadeTo(100, 1, function () {
          $('#product-back, #product-back div.shadow').hide();
          $('#product-front, #product-front div.shadow').show();
        });
      }, 50);
      setTimeout(function () {
        $('#product-card').removeClass('flip90').addClass('flip-10');
        $('#product-front div.shadow').show().fadeTo(100, 0);
        setTimeout(function () {
          $('#product-front div.shadow').hide();
          $('#product-card').removeClass('flip-10').css('transition', '100ms ease-out');
          $('#cx, #cy').removeClass('s1 s2 s3');
        }, 100);
      }, 150);
    });
    /* ----  Image Gallery Carousel   ---- */

    var carousel = $('#carousel ul');
    var carouselSlideWidth = 335;
    var carouselWidth = 0;
    var isAnimating = false; // building the width of the casousel

    $('#carousel li').each(function () {
      carouselWidth += carouselSlideWidth;
    });
    $(carousel).css('width', carouselWidth); // Load Next Image

    $('div.carouselNext').on('click', function () {
      var currentLeft = Math.abs(parseInt($(carousel).css("left")));
      var newLeft = currentLeft + carouselSlideWidth;

      if (newLeft == carouselWidth || isAnimating === true) {
        return;
      }

      $('#carousel ul').css({
        'left': "-" + newLeft + "px",
        "transition": "300ms ease-out"
      });
      isAnimating = true;
      setTimeout(function () {
        isAnimating = false;
      }, 300);
    }); // Load Previous Image

    $('div.carouselPrev').on('click', function () {
      var currentLeft = Math.abs(parseInt($(carousel).css("left")));
      var newLeft = currentLeft - carouselSlideWidth;

      if (newLeft < 0 || isAnimating === true) {
        return;
      }

      $('#carousel ul').css({
        'left': "-" + newLeft + "px",
        "transition": "300ms ease-out"
      });
      isAnimating = true;
      setTimeout(function () {
        isAnimating = false;
      }, 300);
    });
  }
});

/***/ }),

/***/ 3:
/*!*******************************************************!*\
  !*** multi ./resources/js/frontend/products/index.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\frontend\products\index.js */"./resources/js/frontend/products/index.js");


/***/ })

/******/ });