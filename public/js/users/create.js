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
/******/ 	return __webpack_require__(__webpack_require__.s = 22);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Users/UserCreateForm.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Users/UserCreateForm.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['jobTitles'],
  data: function data() {
    return {
      UsersIndexURL: $('#UsersIndexURL').text(),
      UsersStoreURL: $('#UsersStoreURL').text()
    };
  },
  methods: {
    userCreateForm: function userCreateForm(e) {
      var url = this.UsersStoreURL;
      var data = $(e.target).serializeObject();
      $.showLoadingModal();
      axios.post(url, data).then(function (response) {
        $.showSuccessModal(response.data.message, response.data.url);
      })["catch"](function (error) {
        console.error('新增員工時發生錯誤，錯誤訊息：' + error);
        $.showErrorModal(error);
      });
    }
  },
  mounted: function mounted() {
    // 地址
    $('#address_twzipcode').twzipcode({
      'readonly': false
    });

    // 生日
    $("#birthday").datepicker({
      dateFormat: 'yy-mm-dd',
      changeYear: true,
      changeMonth: true,
      yearRange: "-80:+0",
      maxDate: '-15y'
    });
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Users/UserCreateForm.vue?vue&type=template&id=130490fd&":
/*!*****************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Users/UserCreateForm.vue?vue&type=template&id=130490fd& ***!
  \*****************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "col-md-10"
  }, [_c("form", {
    attrs: {
      method: "POST",
      id: "user_create_form",
      action: "#"
    },
    on: {
      submit: function submit($event) {
        $event.preventDefault();
        return _vm.userCreateForm.apply(null, arguments);
      }
    }
  }, [_c("div", {
    staticClass: "row"
  }, [_vm._m(0), _vm._v(" "), _vm._m(1), _vm._v(" "), _vm._m(2), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_vm._m(3), _vm._v(" "), _c("select", {
    staticClass: "form-control",
    attrs: {
      name: "jobTitle",
      id: "jobTitle",
      required: ""
    }
  }, _vm._l(_vm.jobTitles, function (jobTitle) {
    return _c("option", {
      key: jobTitle.id,
      domProps: {
        value: jobTitle.id
      }
    }, [_vm._v(_vm._s(jobTitle.name))]);
  }), 0)])])]), _vm._v(" "), _vm._m(4), _vm._v(" "), _vm._m(5), _vm._v(" "), _vm._m(6), _vm._v(" "), _c("div", {
    staticClass: "form-group row justify-content-center"
  }, [_c("div", {
    staticClass: "col-md-8"
  }, [_c("button", {
    staticClass: "btn btn-block btn-primary",
    attrs: {
      type: "submit"
    }
  }, [_vm._v("\r\n                        確認新增\r\n                    ")]), _vm._v(" "), _c("a", {
    staticClass: "btn btn-block btn-danger",
    attrs: {
      href: _vm.UsersIndexURL
    }
  }, [_vm._v("\r\n                        返回列表\r\n                    ")])])])])])]);
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
      "for": "name"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("姓名\r\n                        ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "name",
      name: "name",
      type: "text",
      value: "",
      required: "",
      autocomplete: "off",
      autofocus: ""
    }
  })])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "email"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("信箱")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "email",
      name: "email",
      type: "email",
      value: "",
      required: "",
      autocomplete: "off"
    }
  })])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "col-md-2"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "gender"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("性別")]), _vm._v(" "), _c("select", {
    staticClass: "form-control",
    attrs: {
      name: "gender",
      id: "gender",
      required: ""
    }
  }, [_c("option", {
    attrs: {
      value: "0"
    }
  }, [_vm._v("小姐")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("先生")])])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("label", {
    attrs: {
      "for": "jobTitle"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("職稱")]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "account"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("帳號")]), _vm._v(" "), _c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "account",
      name: "account",
      type: "text",
      value: "",
      required: "",
      autocomplete: "off"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "password"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("密碼")]), _vm._v(" "), _c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "password",
      name: "password",
      type: "password",
      value: "",
      required: "",
      autocomplete: "off"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "password_confirmation"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("密碼確認")]), _vm._v(" "), _c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "password_confirmation",
      name: "password_confirmation",
      type: "password",
      value: "",
      required: "",
      autocomplete: "off"
    }
  })])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "tel"
    }
  }, [_vm._v("電話")]), _vm._v(" "), _c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "tel",
      name: "tel",
      type: "text",
      value: "",
      placeholder: "例：0412345678",
      autocomplete: "off"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "phone"
    }
  }, [_vm._v("手機")]), _vm._v(" "), _c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "phone",
      name: "phone",
      type: "text",
      value: "",
      placeholder: "例：0912345678",
      autocomplete: "off"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "birthday"
    }
  }, [_vm._v("生日")]), _vm._v(" "), _c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "birthday",
      name: "birthday",
      type: "text",
      value: "",
      autocomplete: "off"
    }
  })])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "comment"
    }
  }, [_vm._v("備註內容")]), _vm._v(" "), _c("textarea", {
    staticClass: "form-control",
    attrs: {
      name: "comment",
      id: "comment",
      rows: "3"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-8"
  }, [_c("div", {
    staticClass: "form-group",
    attrs: {
      id: "address_twzipcode"
    }
  }, [_c("label", [_vm._v("地址")]), _vm._v(" "), _c("div", {
    staticClass: "row mb-2"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "county",
      "data-style": "form-control",
      "data-name": "address_county",
      "data-value": ""
    }
  })]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "district",
      "data-style": "form-control",
      "data-name": "address_district",
      "data-value": ""
    }
  })]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "zipcode",
      "data-style": "form-control",
      "data-name": "address_zipcode",
      "data-value": ""
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("input", {
    staticClass: "form-control",
    attrs: {
      id: "address_others",
      type: "text",
      name: "address_others",
      value: "",
      autocomplete: "off"
    }
  })])])])])]);
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

/***/ "./resources/js/components/Users/UserCreateForm.vue":
/*!**********************************************************!*\
  !*** ./resources/js/components/Users/UserCreateForm.vue ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _UserCreateForm_vue_vue_type_template_id_130490fd___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./UserCreateForm.vue?vue&type=template&id=130490fd& */ "./resources/js/components/Users/UserCreateForm.vue?vue&type=template&id=130490fd&");
/* harmony import */ var _UserCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./UserCreateForm.vue?vue&type=script&lang=js& */ "./resources/js/components/Users/UserCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _UserCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _UserCreateForm_vue_vue_type_template_id_130490fd___WEBPACK_IMPORTED_MODULE_0__["render"],
  _UserCreateForm_vue_vue_type_template_id_130490fd___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Users/UserCreateForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Users/UserCreateForm.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/Users/UserCreateForm.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UserCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./UserCreateForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Users/UserCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UserCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Users/UserCreateForm.vue?vue&type=template&id=130490fd&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/components/Users/UserCreateForm.vue?vue&type=template&id=130490fd& ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_UserCreateForm_vue_vue_type_template_id_130490fd___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./UserCreateForm.vue?vue&type=template&id=130490fd& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Users/UserCreateForm.vue?vue&type=template&id=130490fd&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_UserCreateForm_vue_vue_type_template_id_130490fd___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_UserCreateForm_vue_vue_type_template_id_130490fd___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/users/create.js":
/*!**************************************!*\
  !*** ./resources/js/users/create.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('user-create-form', __webpack_require__(/*! ./../components/Users/UserCreateForm.vue */ "./resources/js/components/Users/UserCreateForm.vue")["default"]);
var app = new Vue({
  el: '#user',
  data: function data() {
    return {
      jobTitles: []
    };
  },
  methods: {},
  created: function created() {
    var _this = this;
    $.showLoadingModal();
    var GetJobTitleListURL = $('#GetJobTitleListURL').text();
    axios.get(GetJobTitleListURL).then(function (response) {
      _this.jobTitles = response.data.jobTitles;

      // 刪除最後一個 編號:4 Admin 職位
      _this.jobTitles.splice(3, 1);
      $.closeModal();
    })["catch"](function (error) {
      console.error('抓取職稱清單時發生錯誤，原因：' + error);
      $.showErrorModal(error);
    });
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ 22:
/*!********************************************!*\
  !*** multi ./resources/js/users/create.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\users\create.js */"./resources/js/users/create.js");


/***/ })

/******/ });