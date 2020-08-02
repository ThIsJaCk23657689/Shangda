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

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['consumers', 'discounts'],
  mounted: function mounted() {
    console.log('ProductDiscounts.vue mounted.');
  },
  data: function data() {
    return {
      current_consumer: [],
      discountsIndex: $('#discountsIndex').html()
    };
  },
  methods: {
    // 新增原物料到商品成分表
    addDiscount: function addDiscount() {
      var consumer_id = $('#consumer_id').val();

      if (consumer_id == 0) {
        alert("請先選擇顧客!");
      } else {
        this.$emit('refresh-consumers', {
          id: consumer_id - 1,
          type: 'add'
        });

        if (this.current_consumer.length != 0) {
          this.discounts.push({
            count: this.discounts.length,
            consumer: {
              id: this.current_consumer.id,
              shownID: this.current_consumer.shownID,
              name: this.current_consumer.name,
              taxID: this.current_consumer.taxID,
              inCharge1: this.current_consumer.inCharge1,
              tel1: this.current_consumer.tel1
            },
            relativePrice: 0,
            absolutePirce: parseFloat($('#retailPrice').val())
          });
        } else {
          alert('請選擇顧客');
        }
      }
    },
    // 刪除原物料成分
    deleteDiscount: function deleteDiscount(id) {
      this.discounts.splice(id, 1);
      this.$emit('refresh-consumer', {
        id: $('#consumerID_' + (id + 1)).val(),
        type: 'deleted'
      });
    },
    // 計算絕對價格
    calculateAbsolutePirce: function calculateAbsolutePirce(id) {
      var costprice = parseFloat($('#totalCost').val());
      var retailPrice = parseFloat($('#retailPrice').val());
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
      var costprice = parseFloat($('#totalCost').val());
      var retailPrice = parseFloat($('#retailPrice').val());
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
    getConsumerData: function getConsumerData() {
      var _this = this;

      var consumer_id = $('#consumer_id').val();

      if (consumer_id != 0) {
        var getConsumerInfo = $('#getConsumerInfo').html();
        $('#addConsumerBtn').attr('disabled', true);
        axios.post(getConsumerInfo, {
          id: consumer_id
        }).then(function (response) {
          _this.current_consumer = response.data;
          $('#addConsumerBtn').attr('disabled', false);
        });
      } else {
        alert('請選擇顧客');
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=template&id=3fed3b0b&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=template&id=3fed3b0b& ***!
  \*****************************************************************************************************************************************************************************************************************************/
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
    _c("div", { staticClass: "col-md-10" }, [
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-6 mb-2" }, [
          _c(
            "select",
            {
              staticClass: "form-control",
              attrs: { id: "consumer_id" },
              on: { change: _vm.getConsumerData }
            },
            [
              _c("option", { attrs: { value: "0" } }, [_vm._v("請選擇...")]),
              _vm._v(" "),
              _vm._l(_vm.consumers, function(data) {
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
              attrs: { id: "addConsumerBtn", type: "button" },
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
                    _c("td", [_vm._v(_vm._s(discount.consumer.shownID))]),
                    _vm._v(" "),
                    _c("td", [
                      _vm._v(
                        "\r\n                            " +
                          _vm._s(discount.consumer.name) +
                          "\r\n                            "
                      ),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          name: "discounts[" + (index + 1) + "][consumer_id]"
                        },
                        domProps: { value: discount.consumer.id }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(discount.consumer.taxID))]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(discount.consumer.inCharge1))]),
                    _vm._v(" "),
                    _c("td", [_vm._v(_vm._s(discount.consumer.tel1))]),
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
        _c("th", [_vm._v("顧客名稱")]),
        _vm._v(" "),
        _c("th", [_vm._v("統編")]),
        _vm._v(" "),
        _c("th", [_vm._v("負責人")]),
        _vm._v(" "),
        _c("th", [_vm._v("電話")]),
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

/***/ "./resources/js/components/Discounts/ProductDiscounts.vue":
/*!****************************************************************!*\
  !*** ./resources/js/components/Discounts/ProductDiscounts.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductDiscounts_vue_vue_type_template_id_3fed3b0b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductDiscounts.vue?vue&type=template&id=3fed3b0b& */ "./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=template&id=3fed3b0b&");
/* harmony import */ var _ProductDiscounts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProductDiscounts.vue?vue&type=script&lang=js& */ "./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProductDiscounts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProductDiscounts_vue_vue_type_template_id_3fed3b0b___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProductDiscounts_vue_vue_type_template_id_3fed3b0b___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Discounts/ProductDiscounts.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDiscounts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductDiscounts.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDiscounts_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=template&id=3fed3b0b&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=template&id=3fed3b0b& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDiscounts_vue_vue_type_template_id_3fed3b0b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductDiscounts.vue?vue&type=template&id=3fed3b0b& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Discounts/ProductDiscounts.vue?vue&type=template&id=3fed3b0b&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDiscounts_vue_vue_type_template_id_3fed3b0b___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductDiscounts_vue_vue_type_template_id_3fed3b0b___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/discounts/edit-product.js":
/*!************************************************!*\
  !*** ./resources/js/discounts/edit-product.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('product-discounts', __webpack_require__(/*! ./../components/Discounts/ProductDiscounts.vue */ "./resources/js/components/Discounts/ProductDiscounts.vue")["default"]);
var app = new Vue({
  el: '#discounts',
  data: function data() {
    return {
      consumers: [],
      all_consumers: [],
      consumers_disabled: [],
      original_discounts: [],
      this_product_retailPrice: 0,
      discounts: []
    };
  },
  methods: {
    // 更新客戶清單
    refreshConsumers: function refreshConsumers(data) {
      this.consumers = this.all_consumers;

      if (data.type == 'add') {
        this.consumers_disabled.push({
          id: this.consumers[data.id].id,
          name: this.consumers[data.id].name
        });
      } else {
        var index;

        for (var i = 0; i < this.consumers_disabled.length; i++) {
          if (this.consumers_disabled[i].id == data.id) {
            index = i;
            break;
          }
        }

        this.consumers_disabled.splice(index, 1);
      }

      this.consumers = [];

      for (var _i = 0; _i < this.all_consumers.length; _i++) {
        var canAdd = true;

        for (var j = 0; j < this.consumers_disabled.length; j++) {
          if (this.all_consumers[_i].id == this.consumers_disabled[j].id) {
            canAdd = false;
          }
        }

        if (canAdd) {
          this.consumers.push(this.all_consumers[_i]);
        }
      }
    }
  },
  created: function created() {
    var _this = this;

    // 取得所有顧客列表(id與name)
    var getConsumersName = $('#getConsumersName').html();
    axios.get(getConsumersName).then(function (response) {
      _this.consumers = response.data;
      _this.all_consumers = _this.consumers;
    }); // 取得折扣資料

    var getDiscountsList = $('#getDiscountsList').html();
    axios.get(getDiscountsList).then(function (response) {
      _this.original_discounts = response.data.discounts;
      _this.this_product_retailPrice = response.data.retailPrice; // 將　original_discounts　內的資料加入到　discounts　中

      for (var i = 0; i < _this.original_discounts.length; i++) {
        _this.refreshConsumers({
          id: _this.original_discounts[i].id - 1,
          type: 'add'
        });

        _this.discounts.push({
          count: _this.discounts.length,
          consumer: {
            id: _this.original_discounts[i].id,
            shownID: _this.original_discounts[i].shownID,
            name: _this.original_discounts[i].name,
            taxID: _this.original_discounts[i].taxID,
            inCharge1: _this.original_discounts[i].inCharge1,
            tel1: _this.original_discounts[i].tel1
          },
          relativePrice: _this.original_discounts[i].pivot.price,
          absolutePirce: Math.round((_this.this_product_retailPrice - _this.original_discounts[i].pivot.price) * 1000) / 1000
        });
      }
    });
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ 20:
/*!******************************************************!*\
  !*** multi ./resources/js/discounts/edit-product.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\discounts\edit-product.js */"./resources/js/discounts/edit-product.js");


/***/ })

/******/ });