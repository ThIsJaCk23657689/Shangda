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
/******/ 	return __webpack_require__(__webpack_require__.s = 36);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/ConsumersTable.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Consumers/ConsumersTable.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['consumers', 'rowsPerPage', 'pageNum', 'totalPage'],
  data: function data() {
    return {};
  },
  methods: {
    getConsumerList: function getConsumerList(pageNum) {
      this.$emit('update-consumer', pageNum);
    },
    changeStatus: function changeStatus(e) {
      var status = e.target.value;
      this.$emit('change-status', status);
    },
    changeOrder: function changeOrder(e) {
      var orderby = e.target.value;
      this.$emit('change-order', orderby);
    },
    changeKeywordsType: function changeKeywordsType(e) {
      var data = $(e.target).serializeObject();
      var keywords = data.keywords;
      var type = data.type;
      var category = data.category;
      var status = data.status;
      var orderby = data.orderby;
      this.$emit('change-keywords-type', keywords, type, status, category, orderby);
    },
    changeCategory: function changeCategory(e) {
      var category = e.target.value;
      this.$emit('change-category', category);
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/PaginateCustom.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Partials/PaginateCustom.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: {
    pageNum: {
      type: Number,
      "default": 1
    },
    totalPage: {
      type: Number
    }
  },
  data: function data() {
    return {
      currentPageNum: this.pageNum
    };
  },
  methods: {
    chagePage: function chagePage(num) {
      // this.pageNum = num;
      this.$emit('updatePage', num);
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/ConsumersTable.vue?vue&type=template&id=1aff15ae&":
/*!*********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Consumers/ConsumersTable.vue?vue&type=template&id=1aff15ae& ***!
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
  return _c("div", [_c("div", {
    staticClass: "card mb-3"
  }, [_vm._m(0), _vm._v(" "), _c("div", {
    staticClass: "card-body"
  }, [_c("div", {
    staticClass: "row justify-content-center"
  }, [_c("div", {
    staticClass: "col-md-12 justify-content-center"
  }, [_c("form", {
    attrs: {
      method: "GET",
      id: "search-by-keywords-form"
    },
    on: {
      submit: function submit($event) {
        $event.preventDefault();
        return _vm.changeKeywordsType.apply(null, arguments);
      }
    }
  }, [_c("div", {
    staticClass: "row mb-3 justify-content-center"
  }, [_c("div", {
    staticClass: "col-md-3"
  }, [_c("select", {
    staticClass: "form-control",
    attrs: {
      name: "status",
      id: "status"
    },
    on: {
      change: _vm.changeStatus
    }
  }, [_c("option", {
    attrs: {
      value: "0"
    }
  }, [_vm._v("所有狀態")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("已封鎖")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "2"
    }
  }, [_vm._v("未封鎖")])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("select", {
    staticClass: "form-control",
    attrs: {
      name: "category",
      id: "category"
    },
    on: {
      change: _vm.changeCategory
    }
  }, [_c("option", {
    attrs: {
      value: "0"
    }
  }, [_vm._v("所有類別")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("個人帳號")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "2"
    }
  }, [_vm._v("公司帳號")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "3"
    }
  }, [_vm._v("管理者創建")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "4"
    }
  }, [_vm._v("顧客創建")])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("select", {
    staticClass: "form-control",
    attrs: {
      name: "orderby",
      id: "orderby"
    },
    on: {
      change: _vm.changeOrder
    }
  }, [_c("option", {
    attrs: {
      value: "4"
    }
  }, [_vm._v("排序方式")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("建立日期(舊->新)")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "2"
    }
  }, [_vm._v("建立日期(新->舊)")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "3"
    }
  }, [_vm._v("更新日期(舊->新)")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "4",
      selected: ""
    }
  }, [_vm._v("更新日期(新->舊)")])])])]), _vm._v(" "), _vm._m(1)])])]), _vm._v(" "), _vm._m(2)]), _vm._v(" "), _c("div", {
    staticClass: "card-footer"
  }, [_c("paginate-custom", {
    attrs: {
      pageNum: _vm.pageNum,
      totalPage: _vm.totalPage
    },
    on: {
      updatePage: _vm.getConsumerList
    }
  })], 1)])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "card-header"
  }, [_c("i", {
    staticClass: "fas fa-table mr-2"
  }), _vm._v("顧客列表\r\n        ")]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row justify-content-center"
  }, [_c("div", {
    staticClass: "col-md-3"
  }, [_c("select", {
    staticClass: "form-control",
    attrs: {
      name: "type",
      id: "type"
    }
  }, [_c("option", {
    attrs: {
      value: "0"
    }
  }, [_vm._v("所有欄位")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("帳號")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "2"
    }
  }, [_vm._v("名稱")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "3"
    }
  }, [_vm._v("統編")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "4"
    }
  }, [_vm._v("聯絡人姓名")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "5"
    }
  }, [_vm._v("聯絡人電話")])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "keywords",
      name: "keywords",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "關鍵字搜尋..."
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("button", {
    staticClass: "btn btn-block btn-primary",
    attrs: {
      type: "submit"
    }
  }, [_vm._v("\r\n                                    確認\r\n                                ")])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "table-responsive"
  }, [_c("table", {
    staticClass: "table table-bordered",
    attrs: {
      id: "ConsumersDataTable",
      width: "100%",
      cellspacing: "0"
    }
  }, [_c("thead", [_c("tr", [_c("th", [_vm._v("編號")]), _vm._v(" "), _c("th", [_vm._v("帳號")]), _vm._v(" "), _c("th", [_vm._v("名稱")]), _vm._v(" "), _c("th", [_vm._v("統編")]), _vm._v(" "), _c("th", [_vm._v("聯絡人名稱")]), _vm._v(" "), _c("th", [_vm._v("聯絡人電話")]), _vm._v(" "), _c("th", [_vm._v("未沖帳總額")]), _vm._v(" "), _c("th", [_vm._v("操作")])])])])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/PaginateCustom.vue?vue&type=template&id=d182b72c&":
/*!********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Partials/PaginateCustom.vue?vue&type=template&id=d182b72c& ***!
  \********************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("paginate", {
    attrs: {
      value: _vm.pageNum,
      "page-count": _vm.totalPage,
      "click-handler": _vm.chagePage,
      "page-range": 5,
      "margin-pages": 2,
      "prev-text": "上一頁",
      "next-text": "下一頁",
      "container-class": "pagination justify-content-center",
      "page-class": "page-item",
      "page-link-class": "page-link",
      "prev-class": "page-item",
      "next-class": "page-item",
      "prev-link-class": "page-link",
      "next-link-class": "page-link",
      "active-class": "active"
    }
  });
};
var staticRenderFns = [];
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

/***/ "./resources/js/components/Consumers/ConsumersTable.vue":
/*!**************************************************************!*\
  !*** ./resources/js/components/Consumers/ConsumersTable.vue ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ConsumersTable_vue_vue_type_template_id_1aff15ae___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ConsumersTable.vue?vue&type=template&id=1aff15ae& */ "./resources/js/components/Consumers/ConsumersTable.vue?vue&type=template&id=1aff15ae&");
/* harmony import */ var _ConsumersTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ConsumersTable.vue?vue&type=script&lang=js& */ "./resources/js/components/Consumers/ConsumersTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ConsumersTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ConsumersTable_vue_vue_type_template_id_1aff15ae___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ConsumersTable_vue_vue_type_template_id_1aff15ae___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Consumers/ConsumersTable.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Consumers/ConsumersTable.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/Consumers/ConsumersTable.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsumersTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConsumersTable.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/ConsumersTable.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsumersTable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Consumers/ConsumersTable.vue?vue&type=template&id=1aff15ae&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/Consumers/ConsumersTable.vue?vue&type=template&id=1aff15ae& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsumersTable_vue_vue_type_template_id_1aff15ae___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConsumersTable.vue?vue&type=template&id=1aff15ae& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/ConsumersTable.vue?vue&type=template&id=1aff15ae&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsumersTable_vue_vue_type_template_id_1aff15ae___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ConsumersTable_vue_vue_type_template_id_1aff15ae___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Partials/PaginateCustom.vue":
/*!*************************************************************!*\
  !*** ./resources/js/components/Partials/PaginateCustom.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PaginateCustom_vue_vue_type_template_id_d182b72c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PaginateCustom.vue?vue&type=template&id=d182b72c& */ "./resources/js/components/Partials/PaginateCustom.vue?vue&type=template&id=d182b72c&");
/* harmony import */ var _PaginateCustom_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PaginateCustom.vue?vue&type=script&lang=js& */ "./resources/js/components/Partials/PaginateCustom.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PaginateCustom_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PaginateCustom_vue_vue_type_template_id_d182b72c___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PaginateCustom_vue_vue_type_template_id_d182b72c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Partials/PaginateCustom.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Partials/PaginateCustom.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/Partials/PaginateCustom.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PaginateCustom_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./PaginateCustom.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/PaginateCustom.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PaginateCustom_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Partials/PaginateCustom.vue?vue&type=template&id=d182b72c&":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/Partials/PaginateCustom.vue?vue&type=template&id=d182b72c& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_PaginateCustom_vue_vue_type_template_id_d182b72c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./PaginateCustom.vue?vue&type=template&id=d182b72c& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/PaginateCustom.vue?vue&type=template&id=d182b72c&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_PaginateCustom_vue_vue_type_template_id_d182b72c___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_PaginateCustom_vue_vue_type_template_id_d182b72c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/consumers/index.js":
/*!*****************************************!*\
  !*** ./resources/js/consumers/index.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('consumers-table', __webpack_require__(/*! ./../components/Consumers/ConsumersTable.vue */ "./resources/js/components/Consumers/ConsumersTable.vue")["default"]);
Vue.component('paginate-custom', __webpack_require__(/*! ./../components/Partials/PaginateCustom.vue */ "./resources/js/components/Partials/PaginateCustom.vue")["default"]);
var app = new Vue({
  el: '#consumer',
  data: function data() {
    return {
      rowsPerPage: 10,
      pageNum: 1,
      totalPage: 0,
      DataTotalCount: 0,
      consumers: [],
      status: 0,
      category: 14,
      type: 0,
      keywords: '',
      orderby: 2
    };
  },
  methods: {
    changeStatus: function changeStatus(status) {
      this.status = status;
      this.updateConsumer(this.pageNum, true);
    },
    changeOrder: function changeOrder(orderby) {
      this.orderby = orderby;
      this.updateConsumer(this.pageNum, true);
    },
    changeKeywordsType: function changeKeywordsType(keywords, type, status, category, orderby) {
      this.category = category;
      this.keywords = keywords;
      this.type = type;
      this.status = status;
      this.orderby = orderby;
      this.updateConsumer(this.pageNum, true);
    },
    changeCategory: function changeCategory(category) {
      this.category = category;
      this.updateConsumer(this.pageNum, true);
    },
    updateConsumer: function updateConsumer(pageNum, first_page) {
      var _this = this;
      if (first_page) {
        this.pageNum = 1;
      } else {
        this.pageNum = pageNum;
      }
      // console.log(first_page);

      var skip = (pageNum - 1) * this.rowsPerPage;
      var take = this.rowsPerPage;
      var status = this.status;
      var keywords = this.keywords;
      var type = this.type;
      var category = this.category;
      var orderby = this.orderby;
      var ConsumersGetList = $('#ConsumersGetList').html();
      $('.dataTables_processing', $('#ConsumersDataTable').closest('.dataTables_wrapper')).fadeIn();
      axios.get(ConsumersGetList, {
        params: {
          skip: skip,
          take: take,
          status: status,
          keywords: keywords,
          type: type,
          category: category,
          first_page: first_page,
          orderby: orderby
        }
      }).then(function (response) {
        _this.consumers = response.data.consumers;
        _this.DataTotalCount = response.data.DataTotalCount;
        _this.totalPage = Math.ceil(_this.DataTotalCount / _this.rowsPerPage);
        $('.dataTables_processing', $('#ConsumersDataTable').closest('.dataTables_wrapper')).fadeOut();
        $('#ConsumersDataTable').dataTable().fnClearTable();
        if (_this.consumers.length != 0) {
          $('#ConsumersDataTable').dataTable().fnAddData(_this.consumers);
        }
        _this.refreshDeleteBtn();
      })["catch"](function (error) {
        console.log("讀取顧客清單時發生錯誤！");
        console.log(error);
      });
    },
    refreshDeleteBtn: function refreshDeleteBtn() {
      var $vm = this;

      // 封鎖顧客
      $('.delete-btn').click(function (e) {
        var _this2 = this;
        e.preventDefault();
        Swal.fire({
          title: '注意！',
          text: '確定要封鎖此顧客嗎？',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '確認',
          cancelButtonText: '取消'
        }).then(function (result) {
          if (result.value) {
            $.showLoadingModal();
            var $url = $(_this2).next().html();
            axios.post($url, {
              _method: 'DELETE'
            }).then(function (response) {
              // console.log(response);
              $.showSuccessModal('封鎖成功！');
              $vm.updateConsumer($vm.pageNum, true);
            })["catch"](function (error) {
              $.showErrorModal(error);
            });
          }
        });
      });

      // 解除封鎖
      $('.unlock-btn').click(function (e) {
        var _this3 = this;
        e.preventDefault();
        Swal.fire({
          title: '注意！',
          text: '確定要解鎖此顧客嗎？',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '確認',
          cancelButtonText: '取消'
        }).then(function (result) {
          if (result.value) {
            $.showLoadingModal();
            var $url = $(_this3).next().html();
            axios.post($url, {
              _method: 'DELETE'
            }).then(function (response) {
              // console.log(response);
              $.showSuccessModal('解鎖成功！');
              $vm.updateConsumer($vm.pageNum, true);
            })["catch"](function (error) {
              $.showErrorModal(error);
            });
          }
        });
      });
    }
  },
  created: function created() {
    var _this4 = this;
    var ConsumersGetList = $('#ConsumersGetList').html();
    axios.get(ConsumersGetList).then(function (response) {
      _this4.DataTotalCount = response.data.DataTotalCount;
      _this4.totalPage = Math.ceil(_this4.DataTotalCount / _this4.rowsPerPage);
      _this4.consumers = response.data.consumers;
      $('#ConsumersDataTable').on('draw.dt', function () {
        // console.log('drawing a table');
      }).on('init.dt', function () {
        // console.log('intial a table');
      }).dataTable({
        data: _this4.consumers,
        columns: [{
          data: 'index'
        }, {
          data: 'account'
        }, {
          data: 'name'
        }, {
          data: 'taxID'
        }, {
          data: 'operator_name_1'
        }, {
          data: 'operator_tel_1'
        }, {
          data: 'uncheckedAmount'
        }, {
          data: 'action'
        }],
        lengthChange: false,
        searching: false,
        pageLength: _this4.rowsPerPage,
        info: false,
        paging: false,
        processing: true,
        "ordering": false
      });
      _this4.refreshDeleteBtn();
    });
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ 36:
/*!***********************************************!*\
  !*** multi ./resources/js/consumers/index.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\consumers\index.js */"./resources/js/consumers/index.js");


/***/ })

/******/ });