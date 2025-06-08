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
/******/ 	return __webpack_require__(__webpack_require__.s = 35);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/BillingIndexList.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/BillingIndexList.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['consumers'],
  mounted: function mounted() {
    $("#start_at").datepicker({
      changeYear: true,
      changeMonth: true,
      dateFormat: 'yy-mm-dd'
    });
    $("#end_at").datepicker({
      changeYear: true,
      changeMonth: true,
      dateFormat: 'yy-mm-dd'
    });

    // 設定 訂單日期為今天 和 其他欄位 為預設。
    var myDate = new Date();
    var defaultStartDate = myDate.getFullYear() + '-' + ('0' + myDate.getMonth()).slice(-2) + '-' + ('0' + myDate.getDate()).slice(-2);
    var defaultEndDate = myDate.getFullYear() + '-' + ('0' + (myDate.getMonth() + 1)).slice(-2) + '-' + ('0' + myDate.getDate()).slice(-2);
    $("#start_at").val(defaultStartDate);
    $("#end_at").val(defaultEndDate);
  },
  data: function data() {
    return {
      current_consumer: {}
    };
  },
  methods: {
    generatePDF: function generatePDF() {
      var pdfURLString = $('#getBillingPDF').html();
      var consumer_id = $('#consumer_id').val();
      var start_at = $('#start_at').val();
      var end_at = $('#end_at').val();
      var show_detail = $('#show_detail').prop('checked');
      if (consumer_id == 0) {
        alert('請先選擇顧客');
        console.error('請先選擇顧客');
        return;
      }
      if (start_at == '' || end_at == '') {
        alert('請先選擇顧客');
        console.error('請選擇請款時間區段');
        return;
      }
      var url = "".concat(pdfURLString, "/").concat(consumer_id, "/").concat(start_at, "/").concat(end_at, "/").concat(show_detail);
      window.open(url, '_blank');
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/BillingIndexList.vue?vue&type=template&id=1dcbfe44&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/BillingIndexList.vue?vue&type=template&id=1dcbfe44&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "row justify-content-center"
  }, [_c("div", {
    staticClass: "col-md-11"
  }, [_c("form", {
    attrs: {
      id: "SalesOrderCreateForm",
      method: "POST",
      action: "#"
    }
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "consumer_id"
    }
  }, [_vm._v("顧客名稱")]), _vm._v(" "), _c("select", {
    staticClass: "form-control",
    attrs: {
      id: "consumer_id",
      name: "consumer_id"
    }
  }, [_c("option", {
    attrs: {
      value: "0"
    }
  }, [_vm._v("請選擇...")]), _vm._v(" "), _vm._l(_vm.consumers, function (consumer) {
    return _c("option", {
      domProps: {
        value: consumer.id
      }
    }, [_vm._v(_vm._s(consumer.name))]);
  })], 2)])])])]), _vm._v(" "), _vm._m(0), _vm._v(" "), _vm._m(1), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "text-white"
  }, [_vm._v("_")]), _vm._v(" "), _c("button", {
    staticClass: "btn btn-block btn-primary",
    attrs: {
      type: "button"
    },
    on: {
      click: _vm.generatePDF
    }
  }, [_vm._v("\r\n                            列印請款單\r\n                        ")])])])]), _vm._v(" "), _vm._m(2)])])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "start_at"
    }
  }, [_vm._v("起始時間")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "start_at",
      name: "start_at",
      type: "text",
      required: ""
    }
  })])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "end_at"
    }
  }, [_vm._v("截止時間")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "end_at",
      name: "end_at",
      type: "text",
      required: ""
    }
  })])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    staticClass: "custom-control custom-switch"
  }, [_c("input", {
    staticClass: "custom-control-input",
    attrs: {
      type: "checkbox",
      name: "showDetail",
      id: "show_detail",
      value: "1",
      checked: ""
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "custom-control-label",
    attrs: {
      "for": "show_detail"
    }
  }, [_c("small", [_vm._v("是否顯示商品細項")])])])])])])]);
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

/***/ "./resources/js/components/Orders/BillingIndexList.vue":
/*!*************************************************************!*\
  !*** ./resources/js/components/Orders/BillingIndexList.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _BillingIndexList_vue_vue_type_template_id_1dcbfe44_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./BillingIndexList.vue?vue&type=template&id=1dcbfe44&scoped=true& */ "./resources/js/components/Orders/BillingIndexList.vue?vue&type=template&id=1dcbfe44&scoped=true&");
/* harmony import */ var _BillingIndexList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./BillingIndexList.vue?vue&type=script&lang=js& */ "./resources/js/components/Orders/BillingIndexList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _BillingIndexList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _BillingIndexList_vue_vue_type_template_id_1dcbfe44_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _BillingIndexList_vue_vue_type_template_id_1dcbfe44_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1dcbfe44",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Orders/BillingIndexList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Orders/BillingIndexList.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/Orders/BillingIndexList.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BillingIndexList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./BillingIndexList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/BillingIndexList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_BillingIndexList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Orders/BillingIndexList.vue?vue&type=template&id=1dcbfe44&scoped=true&":
/*!********************************************************************************************************!*\
  !*** ./resources/js/components/Orders/BillingIndexList.vue?vue&type=template&id=1dcbfe44&scoped=true& ***!
  \********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_BillingIndexList_vue_vue_type_template_id_1dcbfe44_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./BillingIndexList.vue?vue&type=template&id=1dcbfe44&scoped=true& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/BillingIndexList.vue?vue&type=template&id=1dcbfe44&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_BillingIndexList_vue_vue_type_template_id_1dcbfe44_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_BillingIndexList_vue_vue_type_template_id_1dcbfe44_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/orders/billing/index.js":
/*!**********************************************!*\
  !*** ./resources/js/orders/billing/index.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('billing-index-list', __webpack_require__(/*! ./../../components/Orders/BillingIndexList.vue */ "./resources/js/components/Orders/BillingIndexList.vue")["default"]);
var app = new Vue({
  el: '#billing',
  data: function data() {
    return {
      consumers: []
    };
  },
  methods: {
    getConsumerData: function getConsumerData(id) {
      var _this = this;
      var getConsumerInfo = $('#getConsumerInfo').html();
      $.showLoadingModal();
      axios.post(getConsumerInfo, id).then(function (response) {
        $.closeModal();
        _this.current_consumer = response.data;
        if (_this.current_consumer.monthlyCheckDate == 0) {
          _this.current_consumer.settlement = '當日結算';
        } else {
          _this.current_consumer.settlement = '每個月' + _this.current_consumer.monthlyCheckDate + '號結算';
        }
      })["catch"](function (error) {
        $.showErrorModal(error);
        console.error('抓取顧客資料失敗，錯誤：' + error);
      });
    }
  },
  created: function created() {
    var _this2 = this;
    var getConsumersName = $('#getConsumersName').html();
    $.showLoadingModal();
    axios.get(getConsumersName).then(function (response) {
      $.closeModal();
      _this2.consumers = response.data;
    })["catch"](function (error) {
      $.showErrorModal(error);
      console.error('抓取顧客名稱列表失敗，錯誤：' + error);
    });
  }
});

/***/ }),

/***/ 35:
/*!****************************************************!*\
  !*** multi ./resources/js/orders/billing/index.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\orders\billing\index.js */"./resources/js/orders/billing/index.js");


/***/ })

/******/ });