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
/******/ 	return __webpack_require__(__webpack_require__.s = 20);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['products', 'discounts'],
  mounted: function mounted() {
    console.log('ConsumerDiscounts.vue mounted.');
  },
  data: function data() {
    return {
      current_product: [],
      discountsIndex: $('#discountsIndex').html()
    };
  },
  methods: {
    // 新增原物料到商品成分表
    addDiscount: function addDiscount() {
      var product_id = $('#product_id').val();

      if (product_id == 0) {
        alert("請先選擇商品!");
      } else {
        this.$emit('refresh-products', {
          id: product_id - 1,
          type: 'add'
        });

        if (this.current_product.length != 0) {
          this.discounts.push({
            count: this.discounts.length,
            product: {
              id: this.current_product.id,
              shownID: this.current_product.shownID,
              name: this.current_product.name,
              costprice: Math.round(this.current_product.costprice * 1000) / 1000,
              profit: Math.round(this.current_product.profit * 1000) / 1000,
              retailPrice: Math.round(this.current_product.retailPrice * 1000) / 1000,
              showUnit: this.current_product.showUnit
            },
            relativePrice: 0,
            absolutePirce: this.current_product.retailPrice
          });
        } else {
          alert('請選擇商品');
        }
      }
    },
    // 刪除原物料成分
    deleteDiscount: function deleteDiscount(id) {
      this.discounts.splice(id, 1);
      this.$emit('refresh-product', {
        id: $('#productID_' + (id + 1)).val(),
        type: 'deleted'
      });
    },
    // 計算絕對價格
    calculateAbsolutePirce: function calculateAbsolutePirce(id) {
      var costprice = parseFloat($('#costprice_' + id).val());
      var retailPrice = parseFloat($('#retailPrice_' + id).val());
      var relativePrice = parseFloat(Math.round($('#relativePrice_' + id).val() * 1000) / 1000);
      var absolutePirce = parseFloat(Math.round((retailPrice - relativePrice) * 1000) / 1000);

      if (absolutePirce < costprice) {
        alert('折扣價已低於成本價，這麼做會開始虧錢，無法這樣使用。');
        relativePrice = 0;
        absolutePirce = retailPrice;
        $('#relativePrice_' + id).val(0);
        $('#absolutePirce_' + id).val(absolutePirce);
      }

      this.discounts[id - 1].relativePrice = relativePrice;
      this.discounts[id - 1].absolutePirce = absolutePirce;
    },
    // 計算相對價格
    calculateRelativePrice: function calculateRelativePrice(id) {
      var costprice = parseFloat($('#costprice_' + id).val());
      var retailPrice = parseFloat($('#retailPrice_' + id).val());
      var absolutePirce = parseFloat(Math.round($('#absolutePirce_' + id).val() * 1000) / 1000);
      var relativePrice = parseFloat(Math.round((retailPrice - absolutePirce) * 1000) / 1000);

      if (absolutePirce < costprice) {
        alert('折扣價已低於成本價，這麼做會開始虧錢，無法這樣使用。');
        relativePrice = 0;
        absolutePirce = retailPrice;
        $('#relativePrice_' + id).val(0);
        $('#absolutePirce_' + id).val(absolutePirce);
      }

      this.discounts[id - 1].relativePrice = relativePrice;
      this.discounts[id - 1].absolutePirce = absolutePirce;
    },
    // 取得商品資料
    getProductData: function getProductData() {
      var _this = this;

      var product_id = $('#product_id').val();

      if (product_id != 0) {
        var getProductInfo = $('#getProductInfo').html();
        $('#addProductBtn').attr('disabled', true);
        axios.post(getProductInfo, {
          id: product_id
        }).then(function (response) {
          // console.log(response);
          _this.current_product = response.data;
          $('#addProductBtn').attr('disabled', false);
        });
      } else {
        alert('請選擇商品');
      }
    },
    // 發送編輯折扣表單
    submitEditDisCountsForm: function submitEditDisCountsForm() {
      if (this.discounts.length == 0) {
        alert('請先新增折扣商品!');
      } else {
        var url = $('#editDiscountsForm').attr('action');
        var data = $('#editDiscountsForm').serialize(); // $('#LoadingModal').modal('show');

        axios.post(url, data).then(function (response) {
          console.log(response);
          alert(response.data.msg);
        })["catch"](function (error) {
          console.error('編輯折扣時發生錯誤，錯誤訊息：' + error);
          alert('編輯折扣時發生錯誤，錯誤訊息：' + error); // $('#LoadingModal').modal('hide');
        });
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=template&id=7625e3c4&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=template&id=7625e3c4& ***!
  \******************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "row justify-content-center" }, [
    _c("div", { staticClass: "col-md-12" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-6 mb-2" }, [
          _c(
            "select",
            {
              staticClass: "form-control",
              attrs: { id: "product_id" },
              on: { change: _vm.getProductData }
            },
            [
              _c("option", { attrs: { value: "0" } }, [_vm._v("請選擇...")]),
              _vm._v(" "),
              _vm._l(_vm.products, function(data) {
                return _c("option-item", {
                  key: data.id,
                  attrs: { data: data }
                })
              })
            ],
            2
          )
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "col-md-6" }, [
          _c(
            "button",
            {
              staticClass: "btn btn-md btn-success",
              attrs: { id: "addProductBtn", type: "button" },
              on: { click: _vm.addDiscount }
            },
            [_vm._v("新增折扣")]
          )
        ])
      ]),
      _vm._v(" "),
      _c(
        "form",
        {
          attrs: { id: "editDiscountsForm", method: "POST", action: "#" },
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.submitEditDisCountsForm($event)
            }
          }
        },
        [
          _c(
            "table",
            {
              staticClass: "table table-bordered",
              attrs: { width: "100%", cellspacing: "0" }
            },
            [
              _vm._m(0),
              _vm._v(" "),
              _c(
                "tbody",
                _vm._l(_vm.discounts, function(discount, index) {
                  return _c("tr", { key: index }, [
                    _c("td", [_vm._v(_vm._s(discount.product.shownID))]),
                    _vm._v(" "),
                    _c("td", [
                      _vm._v(
                        "\r\n                            " +
                          _vm._s(discount.product.name) +
                          "\r\n                            "
                      ),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          name: "discounts[" + (index + 1) + "][product_id]"
                        },
                        domProps: { value: discount.product.id }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        staticClass: "form-control mr-2",
                        staticStyle: { width: "50%", display: "inline-block" },
                        attrs: {
                          id: "costprice_" + (index + 1),
                          type: "text",
                          disabled: ""
                        },
                        domProps: { value: discount.product.costprice }
                      }),
                      _vm._v(" "),
                      _c("span", [
                        _vm._v(" 元 / " + _vm._s(discount.product.showUnit))
                      ])
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        staticClass: "form-control mr-2",
                        staticStyle: { width: "50%", display: "inline-block" },
                        attrs: {
                          id: "retailPrice_" + (index + 1),
                          type: "text",
                          disabled: ""
                        },
                        domProps: { value: discount.product.retailPrice }
                      }),
                      _vm._v(" "),
                      _c("span", [
                        _vm._v(" 元 / " + _vm._s(discount.product.showUnit))
                      ])
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        staticClass: "form-control",
                        attrs: {
                          id: "relativePrice_" + (index + 1),
                          type: "text",
                          name: "discounts[" + (index + 1) + "][relativePrice]"
                        },
                        domProps: { value: discount.relativePrice },
                        on: {
                          change: function($event) {
                            return _vm.calculateAbsolutePirce(index + 1)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        staticClass: "form-control",
                        attrs: {
                          id: "absolutePirce_" + (index + 1),
                          type: "text",
                          name: "discounts[" + (index + 1) + "][absolutePirce]"
                        },
                        domProps: { value: discount.absolutePirce },
                        on: {
                          change: function($event) {
                            return _vm.calculateRelativePrice(index + 1)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-md btn-danger",
                          attrs: { type: "button" },
                          on: {
                            click: function($event) {
                              return _vm.deleteDiscount(index)
                            }
                          }
                        },
                        [_c("i", { staticClass: "far fa-trash-alt" })]
                      )
                    ])
                  ])
                }),
                0
              )
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "form-group row justify-content-center" }, [
            _c("div", { staticClass: "col-md-8" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-block btn-primary",
                  attrs: { type: "submit" }
                },
                [
                  _vm._v(
                    "\r\n                        確認儲存\r\n                    "
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "a",
                {
                  staticClass: "btn btn-block btn-danger",
                  attrs: { href: _vm.discountsIndex }
                },
                [
                  _vm._v(
                    "\r\n                        返回列表\r\n                    "
                  )
                ]
              )
            ])
          ])
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
    return _c("thead", [
      _c("tr", [
        _c("th", [_vm._v("編號")]),
        _vm._v(" "),
        _c("th", [_vm._v("商品名稱")]),
        _vm._v(" "),
        _c("th", [_vm._v("成本價")]),
        _vm._v(" "),
        _c("th", [_vm._v("零售價")]),
        _vm._v(" "),
        _c("th", [_vm._v("相對價格")]),
        _vm._v(" "),
        _c("th", [_vm._v("絕對價格")]),
        _vm._v(" "),
        _c("th", [_vm._v("操作")])
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

/***/ "./resources/js/components/Discounts/ConsumerDiscounts.vue":
/*!*****************************************************************!*\
  !*** ./resources/js/components/Discounts/ConsumerDiscounts.vue ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ConsumerDiscounts_vue_vue_type_template_id_7625e3c4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ConsumerDiscounts.vue?vue&type=template&id=7625e3c4& */ "./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=template&id=7625e3c4&");
/* harmony import */ var _ConsumerDiscounts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ConsumerDiscounts.vue?vue&type=script&lang=js& */ "./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ConsumerDiscounts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ConsumerDiscounts_vue_vue_type_template_id_7625e3c4___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ConsumerDiscounts_vue_vue_type_template_id_7625e3c4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Discounts/ConsumerDiscounts.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsumerDiscounts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConsumerDiscounts.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsumerDiscounts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=template&id=7625e3c4&":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=template&id=7625e3c4& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsumerDiscounts_vue_vue_type_template_id_7625e3c4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConsumerDiscounts.vue?vue&type=template&id=7625e3c4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Discounts/ConsumerDiscounts.vue?vue&type=template&id=7625e3c4&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsumerDiscounts_vue_vue_type_template_id_7625e3c4___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsumerDiscounts_vue_vue_type_template_id_7625e3c4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/discounts/edit-consumer.js":
/*!*************************************************!*\
  !*** ./resources/js/discounts/edit-consumer.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('consumer-discounts', __webpack_require__(/*! ./../components/Discounts/ConsumerDiscounts.vue */ "./resources/js/components/Discounts/ConsumerDiscounts.vue")["default"]);
var app = new Vue({
  el: '#discounts',
  data: function data() {
    return {
      products: [],
      all_products: [],
      products_disabled: [],
      original_discounts: [],
      discounts: []
    };
  },
  methods: {
    // 更新商品清單
    refreshProducts: function refreshProducts(data) {
      this.products = this.all_products;

      if (data.type == 'add') {
        this.products_disabled.push({
          id: this.products[data.id].id,
          name: this.products[data.id].name
        });
      } else {
        var index;

        for (var i = 0; i < this.products_disabled.length; i++) {
          if (this.products_disabled[i].id == data.id) {
            index = i;
            break;
          }
        }

        this.products_disabled.splice(index, 1);
      }

      this.products = [];

      for (var _i = 0; _i < this.all_products.length; _i++) {
        var canAdd = true;

        for (var j = 0; j < this.products_disabled.length; j++) {
          if (this.all_products[_i].id == this.products_disabled[j].id) {
            canAdd = false;
          }
        }

        if (canAdd) {
          this.products.push(this.all_products[_i]);
        }
      }
    }
  },
  created: function created() {
    var _this = this;

    // 取得所有商品列表(id與name)
    var getProductsName = $('#getProductsName').html();
    axios.get(getProductsName).then(function (response) {
      _this.products = response.data;
      _this.all_products = _this.products;
    }); // 取得折扣資料

    var getDiscountsList = $('#getDiscountsList').html();
    axios.get(getDiscountsList).then(function (response) {
      _this.original_discounts = response.data.discounts; // 將　original_discounts　內的資料加入到　discounts　中

      for (var i = 0; i < _this.original_discounts.length; i++) {
        _this.refreshProducts({
          id: _this.original_discounts[i].id - 1,
          type: 'add'
        });

        _this.discounts.push({
          count: _this.discounts.length,
          product: {
            id: _this.original_discounts[i].id,
            shownID: _this.original_discounts[i].shownID,
            name: _this.original_discounts[i].name,
            costprice: Math.round(_this.original_discounts[i].costprice * 1000) / 1000,
            profit: Math.round(_this.original_discounts[i].profit * 1000) / 1000,
            retailPrice: Math.round(_this.original_discounts[i].retailPrice * 1000) / 1000,
            showUnit: _this.original_discounts[i].showUnit
          },
          relativePrice: _this.original_discounts[i].pivot.price,
          absolutePirce: Math.round((_this.original_discounts[i].retailPrice - _this.original_discounts[i].pivot.price) * 1000) / 1000
        });
      }
    });
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ 20:
/*!*******************************************************!*\
  !*** multi ./resources/js/discounts/edit-consumer.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\discounts\edit-consumer.js */"./resources/js/discounts/edit-consumer.js");


/***/ })

/******/ });