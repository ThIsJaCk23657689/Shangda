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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['currentPage', 'totalPage'],
  data: function data() {
    return {};
  },
  methods: {
    range: function range(start, end) {
      var result = [];

      for (var i = start; i <= end; i++) {
        result.push(i);
      }

      return result;
    },
    chagePage: function chagePage(e) {
      var value = parseInt($(e.target).text());
      this.$emit('chage-page', value);
    },
    nextPage: function nextPage() {
      this.$emit('chage-page', this.currentPage + 1);
    },
    prevPage: function prevPage() {
      this.$emit('chage-page', this.currentPage - 1);
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['product'],
  data: function data() {
    return {
      carouselSlideWidth: 335,
      isAnimating: false,
      carouselWidth: 0
    };
  },
  methods: {
    flipToFront: function flipToFront(e) {
      var $this_product_card = $(e.target).parents('.product-card');
      $this_product_card.find('div.carouselNext, div.carouselPrev').removeClass('visible');
      $this_product_card.addClass('flip-10');
      setTimeout(function () {
        $this_product_card.removeClass('flip-10').addClass('flip90').find('div.shadow').show().fadeTo(80, 1, function () {
          $this_product_card.find('.product-front, .product-front div.shadow').hide();
        });
      }, 50);
      setTimeout(function () {
        $this_product_card.removeClass('flip90').addClass('flip190');
        $this_product_card.find('.product-back').show().find('div.shadow').show().fadeTo(90, 0);
        setTimeout(function () {
          $this_product_card.removeClass('flip190').addClass('flip180').find('div.shadow').hide();
          setTimeout(function () {
            $this_product_card.css('transition', '100ms ease-out');
            $this_product_card.find('.cx, .cy').addClass('s1');
            setTimeout(function () {
              $this_product_card.find('.cx, .cy').addClass('s2');
            }, 100);
            setTimeout(function () {
              $this_product_card.find('.cx, .cy').addClass('s3');
            }, 200);
            $this_product_card.find('div.carouselNext, div.carouselPrev').addClass('visible');
          }, 100);
        }, 100);
      }, 150);
    },
    flipToBack: function flipToBack(e) {
      var $this_product_card = $(e.target).parents('.product-card');
      $this_product_card.removeClass('flip180').addClass('flip190');
      setTimeout(function () {
        $this_product_card.removeClass('flip190').addClass('flip90');
        $this_product_card.find('.product-back div.shadow').css('opacity', 0).fadeTo(100, 1, function () {
          $this_product_card.find('.product-back, .product-back div.shadow').hide();
          $this_product_card.find('.product-front, .product-front div.shadow').show();
        });
      }, 50);
      setTimeout(function () {
        $this_product_card.removeClass('flip90').addClass('flip-10');
        $this_product_card.find('.product-front div.shadow').show().fadeTo(100, 0);
        setTimeout(function () {
          $this_product_card.find('.product-front div.shadow').hide();
          $this_product_card.removeClass('flip-10').css('transition', '100ms ease-out');
          $this_product_card.find('.cx, .cy').removeClass('s1 s2 s3');
        }, 100);
      }, 150);
    },
    loadPrevImages: function loadPrevImages(e) {
      var vm = this;
      var $carousel = $(e.target).parents('.carousel');
      var currentLeft = Math.abs(parseInt($($carousel).find('ul').css('left')));
      var newLeft = currentLeft - this.carouselSlideWidth;

      if (newLeft < 0 || this.isAnimating === true) {
        return;
      }

      $carousel.find('ul').css({
        'left': '-' + newLeft + 'px',
        'transition': '300ms ease-out'
      });
      this.isAnimating = true;
      setTimeout(function () {
        vm.isAnimating = false;
      }, 300);
    },
    loadNextImages: function loadNextImages(e) {
      var vm = this;
      var $carousel = $(e.target).parents('.carousel');
      var currentLeft = Math.abs(parseInt($($carousel).find('ul').css('left')));
      var newLeft = currentLeft + this.carouselSlideWidth;
      var carouselWidth = $carousel.find('ul').width();

      if (newLeft > carouselWidth - this.carouselSlideWidth || this.isAnimating === true) {
        return;
      }

      $carousel.find('ul').css({
        'left': '-' + newLeft + 'px',
        'transition': '300ms ease-out'
      });
      this.isAnimating = true;
      setTimeout(function () {
        vm.isAnimating = false;
      }, 300);
    },
    zoomIn: function zoomIn(e) {
      $(e.target).addClass('animate');
      $(e.target).find('div.carouselNext, div.carouselPrev').addClass('visible');
    },
    zoomOut: function zoomOut(e) {
      $(e.target).removeClass('animate');
      $(e.target).find('div.carouselNext, div.carouselPrev').removeClass('visible');
    },
    addProductToCart: function addProductToCart(e) {
      $.showLoadingModal();
      var $product_id = $(e.currentTarget).next().text();
      var AddProductToCartURL = $('#AddProductToCartURL').text();
      axios.post(AddProductToCartURL, {
        product_id: $product_id
      }).then(function (response) {
        $.showSuccessModal(response.data.message);
      })["catch"](function (error) {
        console.error('把商品加入購物車時發生錯誤！原因為：' + error);

        if (error.response.data.message == '請先登入！') {
          $.showWarningModal(error.response.data.message, $('#ConsumerLoginURL').text(), '確認');
        } else {
          $.showErrorModal(error);
        }
      });
    }
  },
  created: function created() {},
  mounted: function mounted() {
    /* ----  Image Gallery Carousel   ---- */
    var vm = this;
    var carousel = $($(this.$el).find('.carousel ul'));
    carousel.children('li').each(function () {
      vm.carouselWidth += vm.carouselSlideWidth;
    });
    carousel.css('width', this.carouselWidth);
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['products'],
  data: function data() {
    return {};
  },
  methods: {},
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['filter'],
  data: function data() {
    return {};
  },
  methods: {
    changeType: function changeType() {
      this.$emit('refresh-product', 1);
    },
    search: function search() {
      this.$emit('refresh-product', 1);
    },
    changeOrder: function changeOrder() {
      this.$emit('refresh-product');
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Modals/ContactForm.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Modals/ContactForm.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: [],
  data: function data() {
    return {};
  },
  methods: {
    CreateContact: function CreateContact(e) {
      $.showLoadingModal();
      var url = $('#ContactStoreURL').text();
      var data = $(e.target).serializeObject();
      axios.post(url, data).then(function (response) {
        console.log(response.data);
        $.showSuccessModal(response.data.message);
      })["catch"](function (error) {
        console.log('留下聯絡資訊時發生錯誤。');
        $.showErrorModal(error);
      });
    }
  },
  created: function created() {},
  mounted: function mounted() {
    $('#CreateContact').on('show.bs.modal', function (e) {
      var id = $(e.relatedTarget).data('id');
      $('#product_id').val(id);
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=template&id=9a6ae0d6&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=template&id=9a6ae0d6& ***!
  \************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "row" }, [
    _c("div", { staticClass: "content-paginate-container" }, [
      _vm.totalPage <= 7
        ? _c(
            "ul",
            { staticClass: "content-paginate" },
            [
              _c("li", [
                _vm.currentPage > 1
                  ? _c("span", { on: { click: _vm.prevPage } }, [
                      _c("i", {
                        staticClass: "fa fa-angle-left",
                        attrs: { "aria-hidden": "true" }
                      })
                    ])
                  : _vm._e()
              ]),
              _vm._v(" "),
              _vm._l(_vm.totalPage, function(n) {
                return _c("li", { key: n }, [
                  n == _vm.currentPage
                    ? _c("span", { staticClass: "activated" }, [
                        _vm._v(_vm._s(n))
                      ])
                    : _c("span", { on: { click: _vm.chagePage } }, [
                        _vm._v(_vm._s(n))
                      ])
                ])
              }),
              _vm._v(" "),
              _c("li", [
                _vm.currentPage != _vm.totalPage && _vm.totalPage > 0
                  ? _c("span", { on: { click: _vm.nextPage } }, [
                      _c("i", {
                        staticClass: "fa fa-angle-right",
                        attrs: { "aria-hidden": "true" }
                      })
                    ])
                  : _vm._e()
              ])
            ],
            2
          )
        : _vm._e(),
      _vm._v(" "),
      _vm.totalPage > 7
        ? _c("ul", { staticClass: "content-paginate" }, [
            _c("li", [
              _vm.currentPage != 1
                ? _c("span", { on: { click: _vm.prevPage } }, [
                    _c("i", {
                      staticClass: "fa fa-angle-left",
                      attrs: { "aria-hidden": "true" }
                    })
                  ])
                : _vm._e()
            ]),
            _vm._v(" "),
            _vm.currentPage <= 4
              ? _c(
                  "div",
                  { staticClass: "d-inline" },
                  _vm._l(5, function(n) {
                    return _c("li", { key: n }, [
                      n == _vm.currentPage
                        ? _c("span", { staticClass: "activated" }, [
                            _vm._v(_vm._s(n))
                          ])
                        : _c("span", { on: { click: _vm.chagePage } }, [
                            _vm._v(_vm._s(n))
                          ])
                    ])
                  }),
                  0
                )
              : _vm.currentPage > _vm.totalPage - 4
              ? _c(
                  "div",
                  { staticClass: "d-inline" },
                  _vm._l(3, function(n) {
                    return _c("li", { key: n }, [
                      n == _vm.currentPage
                        ? _c("span", { staticClass: "activated" }, [
                            _vm._v(_vm._s(n))
                          ])
                        : _c("span", { on: { click: _vm.chagePage } }, [
                            _vm._v(_vm._s(n))
                          ])
                    ])
                  }),
                  0
                )
              : _c(
                  "div",
                  { staticClass: "d-inline" },
                  _vm._l(2, function(n) {
                    return _c("li", { key: n }, [
                      n == _vm.currentPage
                        ? _c("span", { staticClass: "activated" }, [
                            _vm._v(_vm._s(n))
                          ])
                        : _c("span", { on: { click: _vm.chagePage } }, [
                            _vm._v(_vm._s(n))
                          ])
                    ])
                  }),
                  0
                ),
            _vm._v(" "),
            _c("li", { staticClass: "disabled" }, [_vm._v("...")]),
            _vm._v(" "),
            _vm.currentPage > 4 && _vm.currentPage < _vm.totalPage - 3
              ? _c(
                  "div",
                  { staticClass: "d-inline" },
                  [
                    _vm._l(
                      _vm.range(_vm.currentPage - 1, _vm.currentPage + 1),
                      function(n) {
                        return _c("li", { key: n }, [
                          n == _vm.currentPage
                            ? _c("span", { staticClass: "activated" }, [
                                _vm._v(_vm._s(n))
                              ])
                            : _c("span", { on: { click: _vm.chagePage } }, [
                                _vm._v(_vm._s(n))
                              ])
                        ])
                      }
                    ),
                    _vm._v(" "),
                    _c("li", { staticClass: "disabled" }, [_vm._v("...")])
                  ],
                  2
                )
              : _vm._e(),
            _vm._v(" "),
            _vm.currentPage > _vm.totalPage - 4
              ? _c(
                  "div",
                  { staticClass: "d-inline" },
                  _vm._l(_vm.range(_vm.totalPage - 4, _vm.totalPage), function(
                    n
                  ) {
                    return _c("li", { key: n }, [
                      n == _vm.currentPage
                        ? _c("span", { staticClass: "activated" }, [
                            _vm._v(_vm._s(n))
                          ])
                        : _c("span", { on: { click: _vm.chagePage } }, [
                            _vm._v(_vm._s(n))
                          ])
                    ])
                  }),
                  0
                )
              : _vm.currentPage <= 4
              ? _c(
                  "div",
                  { staticClass: "d-inline" },
                  _vm._l(_vm.range(_vm.totalPage - 2, _vm.totalPage), function(
                    n
                  ) {
                    return _c("li", { key: n }, [
                      n == _vm.currentPage
                        ? _c("span", { staticClass: "activated" }, [
                            _vm._v(_vm._s(n))
                          ])
                        : _c("span", { on: { click: _vm.chagePage } }, [
                            _vm._v(_vm._s(n))
                          ])
                    ])
                  }),
                  0
                )
              : _c(
                  "div",
                  { staticClass: "d-inline" },
                  _vm._l(_vm.range(_vm.totalPage - 1, _vm.totalPage), function(
                    n
                  ) {
                    return _c("li", { key: n }, [
                      n == _vm.currentPage
                        ? _c("span", { staticClass: "activated" }, [
                            _vm._v(_vm._s(n))
                          ])
                        : _c("span", { on: { click: _vm.chagePage } }, [
                            _vm._v(_vm._s(n))
                          ])
                    ])
                  }),
                  0
                ),
            _vm._v(" "),
            _c("li", [
              _vm.currentPage != _vm.totalPage && _vm.totalPage > 0
                ? _c("span", { on: { click: _vm.nextPage } }, [
                    _c("i", {
                      staticClass: "fa fa-angle-right",
                      attrs: { "aria-hidden": "true" }
                    })
                  ])
                : _vm._e()
            ])
          ])
        : _vm._e()
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=template&id=525cf576&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=template&id=525cf576& ***!
  \********************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "make-3D-space" }, [
    _c(
      "div",
      {
        staticClass: "product-card",
        on: { mouseenter: _vm.zoomIn, mouseleave: _vm.zoomOut }
      },
      [
        _c("div", { staticClass: "product-front" }, [
          _c("div", { staticClass: "shadow" }),
          _vm._v(" "),
          _c("img", { attrs: { src: _vm.product.coverImage, alt: "" } }),
          _vm._v(" "),
          _c("div", { staticClass: "image_overlay" }),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "view_details", on: { click: _vm.flipToFront } },
            [_vm._v("查看圖片")]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "stats" }, [
            _c("div", { staticClass: "stats-container" }, [
              _vm.product.showPrice == 1
                ? _c("div", { staticClass: "product_price-container" }, [
                    _c("span", { staticClass: "product_price" }, [
                      _vm._v(_vm._s("$" + _vm.product.retailPrice))
                    ]),
                    _vm._v(" "),
                    _c(
                      "button",
                      {
                        staticClass: "cart-button",
                        on: { click: _vm.addProductToCart }
                      },
                      [_c("i", { staticClass: "fas fa-shopping-cart" })]
                    ),
                    _vm._v(" "),
                    _c("span", { staticClass: "d-none" }, [
                      _vm._v(_vm._s(_vm.product.id))
                    ])
                  ])
                : _c(
                    "button",
                    {
                      staticClass: "product_ask_price",
                      attrs: {
                        type: "button",
                        "data-toggle": "modal",
                        "data-target": "#CreateContact",
                        "data-id": _vm.product.id
                      }
                    },
                    [
                      _c("i", { staticClass: "fas fa-comments-dollar mr-1" }),
                      _vm._v(
                        "\n                        詢問價錢\n                    "
                      )
                    ]
                  ),
              _vm._v(" "),
              _c("span", { staticClass: "product_name" }, [
                _vm._v(_vm._s(_vm.product.name))
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "product-options" }, [
                _c("strong", [_vm._v("類別")]),
                _vm._v(" "),
                _c("span", [_vm._v(_vm._s(_vm.product.category.name))])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "readmore-container" }, [
                _c(
                  "a",
                  {
                    staticClass: "readmore",
                    attrs: { href: _vm.product.showURL }
                  },
                  [
                    _vm._v(
                      "\n                            了解更多 >>\n                        "
                    )
                  ]
                )
              ])
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "product-back" }, [
          _c("div", { staticClass: "shadow" }),
          _vm._v(" "),
          _c("div", { staticClass: "carousel" }, [
            _c(
              "ul",
              [
                _vm._l(_vm.product.pictures, function(picture) {
                  return _c("li", { key: picture.index }, [
                    _c("img", { attrs: { src: picture.url, alt: "" } })
                  ])
                }),
                _vm._v(" "),
                _vm.product.pictures.length == 0
                  ? _c("li", [
                      _c("img", {
                        attrs: { src: _vm.product.coverImage, alt: "" }
                      })
                    ])
                  : _vm._e()
              ],
              2
            ),
            _vm._v(" "),
            _c("div", { staticClass: "arrows-perspective" }, [
              _c(
                "div",
                {
                  staticClass: "carouselPrev",
                  on: { click: _vm.loadPrevImages }
                },
                [
                  _c("div", { staticClass: "y" }),
                  _vm._v(" "),
                  _c("div", { staticClass: "x" })
                ]
              ),
              _vm._v(" "),
              _c(
                "div",
                {
                  staticClass: "carouselNext",
                  on: { click: _vm.loadNextImages }
                },
                [
                  _c("div", { staticClass: "y" }),
                  _vm._v(" "),
                  _c("div", { staticClass: "x" })
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "flip-back", on: { click: _vm.flipToBack } },
            [
              _c("div", { staticClass: "cy" }),
              _vm._v(" "),
              _c("div", { staticClass: "cx" })
            ]
          )
        ])
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=template&id=506090ea&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=template&id=506090ea& ***!
  \*************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "row product-list" },
    [
      _vm._l(_vm.products, function(product) {
        return _c("product-card", {
          key: product.id,
          attrs: { product: product }
        })
      }),
      _vm._v(" "),
      _vm.products.length == 0
        ? _c("span", { staticClass: "not-found-message" }, [
            _vm._v(
              "\r\n        很抱歉，無法找到您所查詢的資料，請重新查詢謝謝。\r\n    "
            )
          ])
        : _vm._e()
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=template&id=2ad7d344&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=template&id=2ad7d344& ***!
  \**********************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "row filter-row" }, [
    _c("div", { staticClass: "col-md-3 col-6 d-flex" }, [
      _c("div", { staticClass: "filter-dropbox-container" }, [
        _c(
          "select",
          {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.filter.type,
                expression: "filter.type"
              }
            ],
            staticClass: "form-control filter-dropbox",
            attrs: { id: "filter-column", name: "column" },
            on: {
              change: [
                function($event) {
                  var $$selectedVal = Array.prototype.filter
                    .call($event.target.options, function(o) {
                      return o.selected
                    })
                    .map(function(o) {
                      var val = "_value" in o ? o._value : o.value
                      return val
                    })
                  _vm.$set(
                    _vm.filter,
                    "type",
                    $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                  )
                },
                _vm.changeType
              ]
            }
          },
          [
            _c("option", { attrs: { value: "0" } }, [_vm._v("依條件")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "1" } }, [_vm._v("商品名稱")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "2" } }, [_vm._v("規格")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "3" } }, [_vm._v("顏色")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "0" } }, [_vm._v("全部搜尋")])
          ]
        )
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "col-md-6 col-12 d-flex search-div" }, [
      _c("div", { staticClass: "filter-search" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.filter.keyword,
              expression: "filter.keyword"
            }
          ],
          staticClass: "form-control search-input",
          attrs: {
            type: "text",
            id: "search-input",
            name: "keyword",
            placeholder: "請輸入商品等關鍵字"
          },
          domProps: { value: _vm.filter.keyword },
          on: {
            keypress: function($event) {
              if (
                !$event.type.indexOf("key") &&
                _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
              ) {
                return null
              }
              return _vm.search($event)
            },
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.$set(_vm.filter, "keyword", $event.target.value)
            }
          }
        }),
        _vm._v(" "),
        _c(
          "a",
          {
            staticClass: "search-button",
            attrs: { href: "#" },
            on: {
              click: function($event) {
                $event.preventDefault()
                return _vm.search($event)
              }
            }
          },
          [_vm._v("\r\n                搜尋\r\n            ")]
        )
      ])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "col-md-3 col-6 d-flex order-2" }, [
      _c(
        "select",
        {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.filter.order,
              expression: "filter.order"
            }
          ],
          staticClass: "form-control filter-dropbox",
          attrs: { id: "filter-order", name: "order" },
          on: {
            change: [
              function($event) {
                var $$selectedVal = Array.prototype.filter
                  .call($event.target.options, function(o) {
                    return o.selected
                  })
                  .map(function(o) {
                    var val = "_value" in o ? o._value : o.value
                    return val
                  })
                _vm.$set(
                  _vm.filter,
                  "order",
                  $event.target.multiple ? $$selectedVal : $$selectedVal[0]
                )
              },
              _vm.changeOrder
            ]
          }
        },
        [
          _c("option", { attrs: { value: "0" } }, [_vm._v("排序方式")]),
          _vm._v(" "),
          _c("option", { attrs: { value: "1" } }, [_vm._v("最新 -> 最舊")]),
          _vm._v(" "),
          _c("option", { attrs: { value: "2" } }, [_vm._v("最舊 -> 最新")]),
          _vm._v(" "),
          _c("option", { attrs: { value: "3" } }, [_vm._v("價錢高 -> 價錢低")]),
          _vm._v(" "),
          _c("option", { attrs: { value: "4" } }, [_vm._v("價錢低 -> 價錢高")])
        ]
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "search-icon" }, [
      _c("i", { staticClass: "fas fa-search" })
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Modals/ContactForm.vue?vue&type=template&id=315cc034&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Modals/ContactForm.vue?vue&type=template&id=315cc034& ***!
  \*********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "modal fade bd-example-modal-lg",
      attrs: {
        id: "CreateContact",
        tabindex: "-1",
        role: "dialog",
        "aria-labelledby": "CreateContactLabel",
        "aria-hidden": "true"
      }
    },
    [
      _c(
        "div",
        { staticClass: "modal-dialog modal-lg", attrs: { role: "document" } },
        [
          _c("div", { staticClass: "modal-content" }, [
            _vm._m(0),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _c("div", { staticClass: "container-fluid" }, [
                _c(
                  "form",
                  {
                    attrs: {
                      id: "CreateContactForm",
                      action: "#",
                      method: "POST"
                    },
                    on: {
                      submit: function($event) {
                        $event.preventDefault()
                        return _vm.CreateContact($event)
                      }
                    }
                  },
                  [
                    _c("input", {
                      staticClass: "form-control",
                      attrs: {
                        type: "hidden",
                        id: "product_id",
                        name: "product_id",
                        value: ""
                      }
                    }),
                    _vm._v(" "),
                    _vm._m(1),
                    _vm._v(" "),
                    _vm._m(2),
                    _vm._v(" "),
                    _vm._m(3),
                    _vm._v(" "),
                    _vm._m(4),
                    _vm._v(" "),
                    _vm._m(5),
                    _vm._v(" "),
                    _vm._m(6),
                    _vm._v(" "),
                    _vm._m(7)
                  ]
                )
              ])
            ])
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header" }, [
      _c(
        "h5",
        { staticClass: "modal-title", attrs: { id: "CreateContactLabel" } },
        [_vm._v("聯絡資訊")]
      ),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "close",
          attrs: {
            type: "button",
            "data-dismiss": "modal",
            "aria-label": "Close"
          }
        },
        [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("×")])]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group row" }, [
      _c(
        "label",
        {
          staticClass: "col-md-4 col-form-label text-md-right",
          attrs: { for: "name" }
        },
        [
          _c("span", { staticClass: "text-danger" }, [_vm._v("*")]),
          _vm._v(
            "\r\n                                名稱\r\n                            "
          )
        ]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-6" }, [
        _c("input", {
          staticClass: "form-control",
          attrs: {
            id: "name",
            type: "text",
            name: "name",
            value: "",
            required: "",
            autofocus: ""
          }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group row" }, [
      _c(
        "label",
        {
          staticClass: "col-md-4 col-form-label text-md-right",
          attrs: { for: "gender" }
        },
        [
          _c("span", { staticClass: "text-danger" }, [_vm._v("*")]),
          _vm._v(
            "\r\n                                性別\r\n                            "
          )
        ]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-6" }, [
        _c(
          "select",
          {
            staticClass: "form-control",
            attrs: { id: "gender", name: "gender", required: "" }
          },
          [
            _c("option", { attrs: { value: "0" } }, [_vm._v("小姐")]),
            _vm._v(" "),
            _c("option", { attrs: { value: "1" } }, [_vm._v("先生")])
          ]
        )
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group row" }, [
      _c(
        "label",
        {
          staticClass: "col-md-4 col-form-label text-md-right",
          attrs: { for: "phone" }
        },
        [
          _c("span", { staticClass: "text-danger" }, [_vm._v("*")]),
          _vm._v("電話\r\n                            ")
        ]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-6" }, [
        _c("input", {
          staticClass: "form-control",
          attrs: {
            id: "phone",
            type: "text",
            name: "phone",
            value: "",
            required: ""
          }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group row" }, [
      _c(
        "label",
        {
          staticClass: "col-md-4 col-form-label text-md-right",
          attrs: { for: "email" }
        },
        [_vm._v("信箱")]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-6" }, [
        _c("input", {
          staticClass: "form-control",
          attrs: { id: "email", type: "email", name: "email", value: "" }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group row" }, [
      _c(
        "label",
        {
          staticClass: "col-md-4 col-form-label text-md-right",
          attrs: { for: "lineID" }
        },
        [_vm._v("Line ID")]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-6" }, [
        _c("input", {
          staticClass: "form-control",
          attrs: { id: "lineID", type: "text", name: "lineID", value: "" }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group row" }, [
      _c(
        "label",
        {
          staticClass: "col-md-4 col-form-label text-md-right",
          attrs: { for: "comment" }
        },
        [
          _vm._v(
            "\r\n                                留言\r\n                            "
          )
        ]
      ),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-6" }, [
        _c("textarea", {
          staticClass: "form-control",
          attrs: {
            id: "comment",
            name: "comment",
            cols: "30",
            rows: "5",
            placeholder: "範例：您好，我對您們的產品極有興趣。"
          }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "form-group row justify-content-center" }, [
      _c("div", { staticClass: "col-md-8" }, [
        _c(
          "button",
          {
            staticClass: "btn btn-block btn-primary",
            attrs: { type: "submit" }
          },
          [
            _vm._v(
              "\r\n                                    確認新增\r\n                                "
            )
          ]
        ),
        _vm._v(" "),
        _c(
          "button",
          {
            staticClass: "btn btn-block btn-danger",
            attrs: { type: "button", "data-dismiss": "modal" }
          },
          [
            _vm._v(
              "\r\n                                    取消\r\n                                "
            )
          ]
        )
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components/Frontend/Partials/ContentPaginate.vue":
/*!***********************************************************************!*\
  !*** ./resources/js/components/Frontend/Partials/ContentPaginate.vue ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ContentPaginate_vue_vue_type_template_id_9a6ae0d6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ContentPaginate.vue?vue&type=template&id=9a6ae0d6& */ "./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=template&id=9a6ae0d6&");
/* harmony import */ var _ContentPaginate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ContentPaginate.vue?vue&type=script&lang=js& */ "./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ContentPaginate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ContentPaginate_vue_vue_type_template_id_9a6ae0d6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ContentPaginate_vue_vue_type_template_id_9a6ae0d6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Frontend/Partials/ContentPaginate.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=script&lang=js&":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ContentPaginate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ContentPaginate.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ContentPaginate_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=template&id=9a6ae0d6&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=template&id=9a6ae0d6& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContentPaginate_vue_vue_type_template_id_9a6ae0d6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ContentPaginate.vue?vue&type=template&id=9a6ae0d6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Partials/ContentPaginate.vue?vue&type=template&id=9a6ae0d6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContentPaginate_vue_vue_type_template_id_9a6ae0d6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContentPaginate_vue_vue_type_template_id_9a6ae0d6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Frontend/Products/ProductCard.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/components/Frontend/Products/ProductCard.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductCard_vue_vue_type_template_id_525cf576___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductCard.vue?vue&type=template&id=525cf576& */ "./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=template&id=525cf576&");
/* harmony import */ var _ProductCard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProductCard.vue?vue&type=script&lang=js& */ "./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProductCard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProductCard_vue_vue_type_template_id_525cf576___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProductCard_vue_vue_type_template_id_525cf576___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Frontend/Products/ProductCard.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductCard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductCard.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductCard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=template&id=525cf576&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=template&id=525cf576& ***!
  \**************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductCard_vue_vue_type_template_id_525cf576___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductCard.vue?vue&type=template&id=525cf576& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductCard.vue?vue&type=template&id=525cf576&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductCard_vue_vue_type_template_id_525cf576___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductCard_vue_vue_type_template_id_525cf576___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Frontend/Products/ProductContainer.vue":
/*!************************************************************************!*\
  !*** ./resources/js/components/Frontend/Products/ProductContainer.vue ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductContainer_vue_vue_type_template_id_506090ea___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductContainer.vue?vue&type=template&id=506090ea& */ "./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=template&id=506090ea&");
/* harmony import */ var _ProductContainer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProductContainer.vue?vue&type=script&lang=js& */ "./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProductContainer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProductContainer_vue_vue_type_template_id_506090ea___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProductContainer_vue_vue_type_template_id_506090ea___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Frontend/Products/ProductContainer.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductContainer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductContainer.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductContainer_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=template&id=506090ea&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=template&id=506090ea& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductContainer_vue_vue_type_template_id_506090ea___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductContainer.vue?vue&type=template&id=506090ea& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductContainer.vue?vue&type=template&id=506090ea&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductContainer_vue_vue_type_template_id_506090ea___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductContainer_vue_vue_type_template_id_506090ea___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Frontend/Products/ProductFilter.vue":
/*!*********************************************************************!*\
  !*** ./resources/js/components/Frontend/Products/ProductFilter.vue ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductFilter_vue_vue_type_template_id_2ad7d344___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductFilter.vue?vue&type=template&id=2ad7d344& */ "./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=template&id=2ad7d344&");
/* harmony import */ var _ProductFilter_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProductFilter.vue?vue&type=script&lang=js& */ "./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProductFilter_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProductFilter_vue_vue_type_template_id_2ad7d344___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProductFilter_vue_vue_type_template_id_2ad7d344___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Frontend/Products/ProductFilter.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductFilter_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductFilter.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductFilter_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=template&id=2ad7d344&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=template&id=2ad7d344& ***!
  \****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductFilter_vue_vue_type_template_id_2ad7d344___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductFilter.vue?vue&type=template&id=2ad7d344& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Products/ProductFilter.vue?vue&type=template&id=2ad7d344&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductFilter_vue_vue_type_template_id_2ad7d344___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductFilter_vue_vue_type_template_id_2ad7d344___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Modals/ContactForm.vue":
/*!********************************************************!*\
  !*** ./resources/js/components/Modals/ContactForm.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ContactForm_vue_vue_type_template_id_315cc034___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ContactForm.vue?vue&type=template&id=315cc034& */ "./resources/js/components/Modals/ContactForm.vue?vue&type=template&id=315cc034&");
/* harmony import */ var _ContactForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ContactForm.vue?vue&type=script&lang=js& */ "./resources/js/components/Modals/ContactForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ContactForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ContactForm_vue_vue_type_template_id_315cc034___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ContactForm_vue_vue_type_template_id_315cc034___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Modals/ContactForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Modals/ContactForm.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/Modals/ContactForm.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ContactForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ContactForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Modals/ContactForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ContactForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Modals/ContactForm.vue?vue&type=template&id=315cc034&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/Modals/ContactForm.vue?vue&type=template&id=315cc034& ***!
  \***************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContactForm_vue_vue_type_template_id_315cc034___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ContactForm.vue?vue&type=template&id=315cc034& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Modals/ContactForm.vue?vue&type=template&id=315cc034&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContactForm_vue_vue_type_template_id_315cc034___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContactForm_vue_vue_type_template_id_315cc034___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/frontend/products/index.js":
/*!*************************************************!*\
  !*** ./resources/js/frontend/products/index.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('product-filter', __webpack_require__(/*! ../../components/Frontend/Products/ProductFilter.vue */ "./resources/js/components/Frontend/Products/ProductFilter.vue")["default"]);
Vue.component('product-container', __webpack_require__(/*! ../../components/Frontend/Products/ProductContainer.vue */ "./resources/js/components/Frontend/Products/ProductContainer.vue")["default"]);
Vue.component('product-card', __webpack_require__(/*! ../../components/Frontend/Products/ProductCard.vue */ "./resources/js/components/Frontend/Products/ProductCard.vue")["default"]);
Vue.component('content-paginate', __webpack_require__(/*! ../../components/Frontend/Partials/ContentPaginate.vue */ "./resources/js/components/Frontend/Partials/ContentPaginate.vue")["default"]);
Vue.component('contact-form', __webpack_require__(/*! ../../components/Modals/ContactForm.vue */ "./resources/js/components/Modals/ContactForm.vue")["default"]);
var contnet = new Vue({
  el: '#product',
  data: function data() {
    return {
      products: [],
      filter: {
        type: 0,
        keyword: '',
        order: 0
      },
      totalcount: 0,
      currentPage: 1,
      totalPage: 0
    };
  },
  methods: {
    getProducts: function getProducts() {
      var _this = this;

      var firstPage = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      $.showLoadingModal();

      if (firstPage == 1 || this.currentPage == 0) {
        this.currentPage = 1;
      }

      var url = $('#GetProductsList').text();
      axios.post(url, {
        skip: (this.currentPage - 1) * 21,
        type: this.filter.type,
        keywords: this.filter.keyword,
        orderBy: this.filter.order,
        firstPage: firstPage,
        status: 1
      }).then(function (response) {
        _this.products = response.data.products;
        _this.totalcount = response.data.totalcount;
        _this.totalPage = Math.ceil(_this.totalcount / 21);

        if (_this.totalcount == 0) {
          _this.currentPage = 0;
        }

        $.closeModal();
      })["catch"](function (error) {
        console.log('抓取商品資料時錯誤。');
        $.showErrorModal(error);
      });
    },
    refreshProduct: function refreshProduct(firstPage) {
      this.getProducts(firstPage);
      this.goBackToTop();
    },
    goBackToTop: function goBackToTop() {
      $('html, body').animate({
        scrollTop: 440
      }, 500);
    },
    chagePage: function chagePage(value) {
      this.currentPage = value;
      this.getProducts();
      this.goBackToTop();
    }
  },
  created: function created() {
    this.getProducts();
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ 4:
/*!*******************************************************!*\
  !*** multi ./resources/js/frontend/products/index.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\frontend\products\index.js */"./resources/js/frontend/products/index.js");


/***/ })

/******/ });