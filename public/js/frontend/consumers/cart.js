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
/******/ 	return __webpack_require__(__webpack_require__.s = 10);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['cart'],
  data: function data() {
    return {};
  },
  methods: {
    quantityOnInput: function quantityOnInput(e) {
      var value = e.target.value.trim();
      var Int = /^[1-9]\d*$|^$/;
      if (Int.test(value)) {
        // 是整數
        if (value <= 0 || value > 999) {
          // 小於等於0 或 大於 999  都是不合格的
          this.cart.quantity = 1;
        }
      } else {
        // 不是整數
        this.cart.quantity = 1;
      }
      this.calculateSubTotal(this, e.target);
    },
    calculateSubTotal: _.debounce(function (vm, input) {
      var url = $('#UpdateProductQtyURL').text();
      $('input.quantity').attr('disabled', true);
      axios.post(url, {
        _method: 'PATCH',
        product_id: vm.cart.product.id,
        quantity: vm.cart.quantity
      }).then(function (response) {
        $('input.quantity').attr('disabled', false);
        if (response.data.overflowMsg != '') {
          // 發生商品庫存不足夠
          $.showWarningModal(response.data.overflowMsg);
          vm.cart.quantity = response.data.realQty;
        }
        vm.cart.subtotal = Math.round(vm.cart.product.retailPrice * vm.cart.quantity);
        vm.calculateTotal();
      })["catch"](function (error) {
        console.log('從購物車更新商品購買數量時發生錯誤。');
        $.showErrorModal(error);
        vm.cart.quantity = 1;
        vm.cart.subtotal = Math.round(vm.cart.product.retailPrice * vm.cart.quantity);
        vm.calculateTotal();
      });
    }, 500),
    calculateTotal: function calculateTotal() {
      this.$emit('calculate-total');
    },
    removeItem: function removeItem(e) {
      var _this = this;
      Swal.fire({
        title: '注意！',
        text: '您確定要從購物車刪除此商品嗎?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '確認',
        cancelButtonText: '取消'
      }).then(function (result) {
        if (result.value) {
          _this.$emit('remove-item', {
            index: _this.cart.index
          });
        }
      });
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['carts', 'status'],
  data: function data() {
    return {};
  },
  methods: {
    calculateTotal: function calculateTotal(e) {
      this.status.totalcount = 0;
      this.status.totalprice = 0;
      for (var $i = 0; $i < this.carts.length; $i++) {
        this.status.totalcount += parseInt(this.carts[$i].quantity);
        this.status.totalprice += parseInt(this.carts[$i].subtotal);
      }
      this.status.totalprice = Math.round(this.status.totalprice);
    },
    removeItem: function removeItem(payload) {
      var _this = this;
      var url = $('#RemoveProductURL').text();
      axios.post(url, {
        _method: 'DELETE',
        product_id: this.carts[payload.index].product.id
      }).then(function (response) {
        $.showSuccessModal(response.data.message);
        _this.carts.splice(payload.index, 1);
        for (var $i = 0; $i < _this.carts.length; $i++) {
          _this.carts[$i].index = $i;
        }
        _this.calculateTotal();
      })["catch"](function (error) {
        console.log('從購物車刪除商品時發生錯誤。');
        $.showErrorModal(error);
      });
    },
    checkout: function checkout(e) {
      var _this2 = this;
      Swal.fire({
        title: '注意！',
        text: '您確定是否要結帳?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '確認',
        cancelButtonText: '取消'
      }).then(function (result) {
        if (result.value) {
          _this2.submitCheckOutData();
        }
      });
    },
    submitCheckOutData: function submitCheckOutData() {
      $.showLoadingModal();
      var url = $('#CheckOutURL').text();
      axios.post(url, {
        carts: this.carts
      }).then(function (response) {
        console.log(response.data);
        $.showSuccessModal(response.data.message);
      })["catch"](function (error) {
        console.log('結帳時發生錯誤。');
        $.showErrorModal(error);
      });
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=template&id=9fda0fe8&":
/*!*******************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=template&id=9fda0fe8& ***!
  \*******************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "cart-row"
  }, [_c("div", {
    staticClass: "cart-cell w-15 p-3 cart-pic"
  }, [_c("img", {
    attrs: {
      src: _vm.cart.product.coverImage,
      alt: "",
      width: "100%"
    }
  })]), _vm._v(" "), _c("div", {
    staticClass: "cart-cell w-85 p-3 cart-spec"
  }, [_c("div", {
    staticClass: "cart-cell w-35"
  }, [_c("a", {
    staticClass: "product-link",
    attrs: {
      href: _vm.cart.product.showURL
    }
  }, [_vm._v("\r\n                " + _vm._s(_vm.cart.product.name) + "\r\n            ")])]), _vm._v(" "), _c("div", {
    staticClass: "cart-cell w-15"
  }, [_vm._v("$" + _vm._s(_vm.cart.product.retailPrice))]), _vm._v(" "), _c("div", {
    staticClass: "cart-cell w-20"
  }, [_c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.cart.quantity,
      expression: "cart.quantity"
    }],
    staticClass: "form-control text-center quantity",
    attrs: {
      type: "text",
      name: "quantity[]"
    },
    domProps: {
      value: _vm.cart.quantity
    },
    on: {
      input: [function ($event) {
        if ($event.target.composing) return;
        _vm.$set(_vm.cart, "quantity", $event.target.value);
      }, _vm.quantityOnInput]
    }
  })]), _vm._v(" "), _c("div", {
    staticClass: "cart-cell w-15"
  }, [_vm._v("$" + _vm._s(_vm.cart.subtotal))]), _vm._v(" "), _c("div", {
    staticClass: "cart-cell w-15"
  }, [_c("button", {
    staticClass: "btn btn-md btn-danger",
    on: {
      click: _vm.removeItem
    }
  }, [_c("i", {
    staticClass: "far fa-trash-alt"
  })])])])]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=template&id=f970bd00&":
/*!*********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=template&id=f970bd00& ***!
  \*********************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "cart-table"
  }, [_vm._m(0), _vm._v(" "), _vm._l(_vm.carts, function (cart) {
    return _c("cart-row", {
      key: cart.product.id,
      attrs: {
        cart: cart
      },
      on: {
        "calculate-total": _vm.calculateTotal,
        "remove-item": _vm.removeItem
      }
    });
  }), _vm._v(" "), _vm.carts.length == 0 ? _c("div", {
    staticClass: "cart-row"
  }, [_vm._m(1)]) : _vm._e(), _vm._v(" "), _c("div", {
    staticClass: "cart-footer"
  }, [_c("div", {
    staticClass: "cart-cell w-70 status-cell"
  }, [_vm._v("\r\n            購買總金額（" + _vm._s(_vm.status.totalcount) + "個商品）："), _c("span", {
    staticClass: "total-price"
  }, [_vm._v("$" + _vm._s(_vm.status.totalprice))])]), _vm._v(" "), _c("div", {
    staticClass: "cart-cell w-30"
  }, [_c("button", {
    staticClass: "btn btn-md btn-checkout",
    attrs: {
      type: "button",
      disabled: _vm.carts.length == 0
    },
    on: {
      click: _vm.checkout
    }
  }, [_vm._v("送出訂單")])])])], 2);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "cart-header"
  }, [_c("div", {
    staticClass: "cart-cell w-45"
  }, [_vm._v("商品")]), _vm._v(" "), _c("div", {
    staticClass: "cart-cell w-15"
  }, [_vm._v("單價")]), _vm._v(" "), _c("div", {
    staticClass: "cart-cell w-15"
  }, [_vm._v("數量")]), _vm._v(" "), _c("div", {
    staticClass: "cart-cell w-15"
  }, [_vm._v("小計")]), _vm._v(" "), _c("div", {
    staticClass: "cart-cell w-10"
  }, [_vm._v("操作")])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "cart-cell w-100 h-80"
  }, [_c("h3", {
    staticClass: "mb-0"
  }, [_vm._v("購物車尚未有任何商品，趕快到商品列表逛逛吧！")])]);
}];
render._withStripped = true;


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

function normalizeComponent(
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */,
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options =
    typeof scriptExports === 'function' ? scriptExports.options : scriptExports

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
  if (moduleIdentifier) {
    // server build
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
      ? function () {
          injectStyles.call(
            this,
            (options.functional ? this.parent : this).$root.$options.shadowRoot
          )
        }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection(h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing ? [].concat(existing, hook) : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components/Frontend/Carts/CartRow.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/Frontend/Carts/CartRow.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CartRow_vue_vue_type_template_id_9fda0fe8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CartRow.vue?vue&type=template&id=9fda0fe8& */ "./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=template&id=9fda0fe8&");
/* harmony import */ var _CartRow_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CartRow.vue?vue&type=script&lang=js& */ "./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CartRow_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CartRow_vue_vue_type_template_id_9fda0fe8___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CartRow_vue_vue_type_template_id_9fda0fe8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Frontend/Carts/CartRow.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CartRow_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CartRow.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CartRow_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=template&id=9fda0fe8&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=template&id=9fda0fe8& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_CartRow_vue_vue_type_template_id_9fda0fe8___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CartRow.vue?vue&type=template&id=9fda0fe8& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Carts/CartRow.vue?vue&type=template&id=9fda0fe8&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_CartRow_vue_vue_type_template_id_9fda0fe8___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_CartRow_vue_vue_type_template_id_9fda0fe8___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Frontend/Carts/CartTable.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/Frontend/Carts/CartTable.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CartTable_vue_vue_type_template_id_f970bd00___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CartTable.vue?vue&type=template&id=f970bd00& */ "./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=template&id=f970bd00&");
/* harmony import */ var _CartTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CartTable.vue?vue&type=script&lang=js& */ "./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CartTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CartTable_vue_vue_type_template_id_f970bd00___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CartTable_vue_vue_type_template_id_f970bd00___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Frontend/Carts/CartTable.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CartTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CartTable.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CartTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=template&id=f970bd00&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=template&id=f970bd00& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_CartTable_vue_vue_type_template_id_f970bd00___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../../node_modules/vue-loader/lib??vue-loader-options!./CartTable.vue?vue&type=template&id=f970bd00& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Frontend/Carts/CartTable.vue?vue&type=template&id=f970bd00&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_CartTable_vue_vue_type_template_id_f970bd00___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_CartTable_vue_vue_type_template_id_f970bd00___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/frontend/consumers/cart.js":
/*!*************************************************!*\
  !*** ./resources/js/frontend/consumers/cart.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('cart-table', __webpack_require__(/*! ./../../components/Frontend/Carts/CartTable.vue */ "./resources/js/components/Frontend/Carts/CartTable.vue")["default"]);
Vue.component('cart-row', __webpack_require__(/*! ./../../components/Frontend/Carts/CartRow.vue */ "./resources/js/components/Frontend/Carts/CartRow.vue")["default"]);
var app = new Vue({
  el: '#cart',
  data: function data() {
    return {
      products: [],
      carts: [],
      status: {
        totalcount: 0,
        totalprice: 0
      }
    };
  },
  methods: {
    getCart: function getCart() {
      var _this = this;
      var url = $('#CartGetOneURL').text();
      axios.get(url).then(function (response) {
        _this.products = response.data.products;
        for (var $i = 0; $i < _this.products.length; $i++) {
          _this.carts.push({
            index: _this.carts.length,
            product: {
              id: _this.products[$i].id,
              coverImage: _this.products[$i].coverImage,
              name: _this.products[$i].name,
              retailPrice: _this.products[$i].retailPrice,
              showURL: _this.products[$i].showURL,
              maxQty: _this.products[$i].quantity <= 999 ? _this.products[$i].quantity : 999
            },
            quantity: _this.products[$i].pivot.quantity,
            subtotal: Math.round(_this.products[$i].pivot.subTotal)
          });
          _this.status.totalcount += _this.products[$i].pivot.quantity;
          _this.status.totalprice += _this.products[$i].pivot.subTotal;
        }
        _this.status.totalprice = Math.round(_this.status.totalprice);
        $.closeModal();
      })["catch"](function (error) {
        console.log('抓取購物車資料時錯誤。');
        $.showErrorModal(error);
      });
    }
  },
  created: function created() {},
  mounted: function mounted() {
    this.getCart();
  }
});

/***/ }),

/***/ 10:
/*!*******************************************************!*\
  !*** multi ./resources/js/frontend/consumers/cart.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\frontend\consumers\cart.js */"./resources/js/frontend/consumers/cart.js");


/***/ })

/******/ });