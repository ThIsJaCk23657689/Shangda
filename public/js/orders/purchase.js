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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=script&lang=js& ***!
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  mounted: function mounted() {
    console.log('CreateSupplierModal.vue mounted.');
    $('#copycompany1').click(function (e) {
      if ($(this).prop("checked")) {
        $('#deliveryAddress').val($('#companyAddress').val());
      } else {
        $('#deliveryAddress').val('');
      }
    });
    $('#copycompany2').click(function (e) {
      if ($(this).prop("checked")) {
        $('#invoiceAddress').val($('#companyAddress').val());
      } else {
        $('#invoiceAddress').val('');
      }
    });
  },
  data: function data() {
    return {};
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************/
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  props: ['suppliers', 'current_supplier'],
  mounted: function mounted() {
    console.log('PurchaseCreareForm.vue mounted.');
  },
  data: function data() {
    return {};
  },
  methods: {
    getSupplierData: function getSupplierData() {
      var supplier_id = $('#supplier_id').val();

      if (supplier_id != 0) {
        this.$emit('get-supplier-data', {
          id: supplier_id
        });
      } else {
        alert('請選擇廠商');
      }
    },
    createPurchaseOrder: function createPurchaseOrder() {
      var url = $('#createPurchaseOrder').html();
      var data = $('#PurchaseOrderCreateForm').serialize();
      axios.post(url, data).then(function (response) {
        console.log(response);
      })["catch"](function (error) {
        console.error('新增進貨單時發生錯誤，錯誤訊息：' + error);
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/OptionItem.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Partials/OptionItem.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['data'],
  mounted: function mounted() {
    console.log('OptionItem.vue mounted.');
  },
  data: function data() {
    return {};
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=template&id=b4627df2&":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=template&id=b4627df2& ***!
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
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "modal fade bd-example-modal-lg",
        attrs: {
          id: "CreateSupplierModal",
          tabindex: "-1",
          role: "dialog",
          "aria-labelledby": "CreateSupplierModalLabel",
          "aria-hidden": "true"
        }
      },
      [
        _c(
          "div",
          { staticClass: "modal-dialog modal-lg", attrs: { role: "document" } },
          [
            _c("div", { staticClass: "modal-content" }, [
              _c("div", { staticClass: "modal-header" }, [
                _c(
                  "h5",
                  {
                    staticClass: "modal-title",
                    attrs: { id: "CreateSupplierModalLabel" }
                  },
                  [_vm._v("新增供應商")]
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
                  [
                    _c("span", { attrs: { "aria-hidden": "true" } }, [
                      _vm._v("×")
                    ])
                  ]
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "modal-body" }, [
                _c("div", { staticClass: "container-fluid" }, [
                  _c(
                    "form",
                    {
                      attrs: {
                        id: "CreateSupplierForm",
                        action: "#",
                        method: "POST"
                      }
                    },
                    [
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "name" }
                          },
                          [
                            _c("span", { staticClass: "text-danger" }, [
                              _vm._v("*")
                            ]),
                            _vm._v(
                              "\r\n                                供應商名稱\r\n                            "
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
                              autocomplete: "name",
                              autofocus: ""
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "shortName" }
                          },
                          [_vm._v("供應商簡稱")]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "shortName",
                              type: "text",
                              name: "shortName",
                              value: "",
                              autocomplete: "shortName"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "taxId" }
                          },
                          [_vm._v("統一編號")]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "taxId",
                              type: "text",
                              name: "taxId",
                              value: "",
                              autocomplete: "taxId"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "tel" }
                          },
                          [_vm._v("電話")]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "tel",
                              type: "text",
                              name: "tel",
                              value: "",
                              autocomplete: "tel"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "tax" }
                          },
                          [_vm._v("傳真")]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "tax",
                              type: "text",
                              name: "tax",
                              value: "",
                              autocomplete: "tax"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("hr"),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "inCharge1" }
                          },
                          [
                            _c("span", { staticClass: "text-danger" }, [
                              _vm._v("*")
                            ]),
                            _vm._v(
                              "\r\n                                負責人1 - 名稱\r\n                            "
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "inCharge1",
                              type: "text",
                              name: "inCharge1",
                              value: "",
                              autocomplete: "inCharge1"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "tel1" }
                          },
                          [
                            _c("span", { staticClass: "text-danger" }, [
                              _vm._v("*")
                            ]),
                            _vm._v(
                              "\r\n                                負責人1 - 電話\r\n                            "
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "tel1",
                              type: "text",
                              name: "tel1",
                              value: "",
                              autocomplete: "tel1"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "email1" }
                          },
                          [_vm._v("負責人1 - 信箱")]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "email1",
                              type: "email",
                              name: "email1",
                              value: "",
                              autocomplete: "email1"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("hr"),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "inCharge2" }
                          },
                          [_vm._v("負責人2 - 名稱")]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "inCharge2",
                              type: "text",
                              name: "inCharge2",
                              value: "",
                              autocomplete: "inCharge2"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "tel2" }
                          },
                          [_vm._v("負責人2 - 電話")]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "tel2",
                              type: "text",
                              name: "tel2",
                              value: "",
                              autocomplete: "tel2"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "email2" }
                          },
                          [_vm._v("負責人2 - 信箱")]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "email2",
                              type: "email",
                              name: "email2",
                              value: "",
                              autocomplete: "email2"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("hr"),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "companyAddress" }
                          },
                          [
                            _c("span", { staticClass: "text-danger" }, [
                              _vm._v("*")
                            ]),
                            _vm._v(
                              "\r\n                                公司地址\r\n                            "
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "companyAddress",
                              type: "text",
                              name: "companyAddress",
                              value: "",
                              autocomplete: "companyAddress",
                              required: ""
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "deliveryAddress" }
                          },
                          [
                            _c("span", { staticClass: "text-danger" }, [
                              _vm._v("*")
                            ]),
                            _vm._v(
                              "\r\n                                送貨地址\r\n                            "
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "deliveryAddress",
                              type: "text",
                              name: "deliveryAddress",
                              value: "",
                              autocomplete: "deliveryAddress",
                              required: ""
                            }
                          })
                        ]),
                        _vm._v(" "),
                        _c("div", { staticClass: "form-check" }, [
                          _c("input", {
                            staticClass: "form-check-input",
                            attrs: { type: "checkbox", id: "copycompany1" }
                          }),
                          _vm._v(" "),
                          _c(
                            "label",
                            {
                              staticClass: "form-check-label",
                              attrs: { for: "copycompany1" }
                            },
                            [_vm._v("同公司地址")]
                          )
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "invoiceAddress" }
                          },
                          [
                            _c("span", { staticClass: "text-danger" }, [
                              _vm._v("*")
                            ]),
                            _vm._v(
                              "\r\n                                發票地址\r\n                            "
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "invoiceAddress",
                              type: "text",
                              name: "invoiceAddress",
                              value: "",
                              required: "",
                              autocomplete: "invoiceAddress"
                            }
                          })
                        ]),
                        _vm._v(" "),
                        _c("div", { staticClass: "form-check" }, [
                          _c("input", {
                            staticClass: "form-check-input",
                            attrs: { type: "checkbox", id: "copycompany2" }
                          }),
                          _vm._v(" "),
                          _c(
                            "label",
                            {
                              staticClass: "form-check-label",
                              attrs: { for: "copycompany2" }
                            },
                            [_vm._v("同公司地址")]
                          )
                        ])
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "form-group row" }, [
                        _c(
                          "label",
                          {
                            staticClass:
                              "col-md-4 col-form-label text-md-right",
                            attrs: { for: "comment" }
                          },
                          [_vm._v("備註")]
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "col-md-6" }, [
                          _c("input", {
                            staticClass: "form-control",
                            attrs: {
                              id: "comment",
                              type: "text",
                              name: "comment",
                              value: "",
                              autocomplete: "comment"
                            }
                          })
                        ])
                      ]),
                      _vm._v(" "),
                      _c(
                        "div",
                        {
                          staticClass: "form-group row justify-content-center"
                        },
                        [
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
                                attrs: {
                                  type: "button",
                                  "data-dismiss": "modal"
                                }
                              },
                              [
                                _vm._v(
                                  "\r\n                                    取消\r\n                                "
                                )
                              ]
                            )
                          ])
                        ]
                      )
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
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=template&id=46ceb9f0&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=template&id=46ceb9f0& ***!
  \****************************************************************************************************************************************************************************************************************************/
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
      _c(
        "form",
        {
          attrs: { id: "PurchaseOrderCreateForm", method: "POST", action: "#" },
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.createPurchaseOrder($event)
            }
          }
        },
        [
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "form-group row" }, [
                _vm._m(0),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6 mb-2" }, [
                  _c(
                    "select",
                    {
                      staticClass: "form-control",
                      attrs: { id: "supplier_id", name: "supplier_id" },
                      on: { change: _vm.getSupplierData }
                    },
                    [
                      _c("option", { attrs: { value: "0" } }, [
                        _vm._v("請選擇...")
                      ]),
                      _vm._v(" "),
                      _vm._l(_vm.suppliers, function(data) {
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
                _vm._m(1)
              ])
            ])
          ]),
          _vm._v(" "),
          _c("create-supplier-modal"),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "form-group row" }, [
                _c(
                  "label",
                  {
                    staticClass: "col-md-3 col-form-label text-md-right",
                    attrs: { for: "showShortName" }
                  },
                  [_vm._v("供應商簡稱")]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6" }, [
                  _c("input", {
                    staticClass: "form-control",
                    attrs: { id: "showShortName", type: "text", disabled: "" },
                    domProps: { value: _vm.current_supplier.shortName }
                  })
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "form-group row" }, [
                _c(
                  "label",
                  {
                    staticClass: "col-md-3 col-form-label text-md-right",
                    attrs: { for: "showTaxId" }
                  },
                  [_vm._v("統一編號")]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6" }, [
                  _c("input", {
                    staticClass: "form-control",
                    attrs: { id: "showTaxId", type: "text", disabled: "" },
                    domProps: { value: _vm.current_supplier.taxId }
                  })
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "row" }, [
                _c(
                  "label",
                  {
                    staticClass: "col-md-3 col-form-label text-md-right",
                    attrs: { for: "showTel" }
                  },
                  [_vm._v("電話")]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6" }, [
                  _c("input", {
                    staticClass: "form-control",
                    attrs: { id: "showTel", type: "text", disabled: "" },
                    domProps: { value: _vm.current_supplier.tel }
                  })
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "row" }, [
                _c(
                  "label",
                  {
                    staticClass: "col-md-3 col-form-label text-md-right",
                    attrs: { for: "showTax" }
                  },
                  [_vm._v("傳真")]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6" }, [
                  _c("input", {
                    staticClass: "form-control",
                    attrs: { id: "showTax", type: "text", disabled: "" },
                    domProps: { value: _vm.current_supplier.tax }
                  })
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "form-group row" }, [
                _c(
                  "label",
                  {
                    staticClass: "col-md-3 col-form-label text-md-right",
                    attrs: { for: "showInCharge1" }
                  },
                  [
                    _vm._v(
                      "\r\n                            負責人1 - 名稱\r\n                        "
                    )
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6" }, [
                  _c("input", {
                    staticClass: "form-control",
                    attrs: { id: "showInCharge1", type: "text", disabled: "" },
                    domProps: { value: _vm.current_supplier.inCharge1 }
                  })
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "form-group row" }, [
                _c(
                  "label",
                  {
                    staticClass: "col-md-3 col-form-label text-md-right",
                    attrs: { for: "showTel1" }
                  },
                  [
                    _vm._v(
                      "\r\n                            負責人1 - 電話\r\n                        "
                    )
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6" }, [
                  _c("input", {
                    staticClass: "form-control",
                    attrs: { id: "showTel1", type: "text", disabled: "" },
                    domProps: { value: _vm.current_supplier.tel1 }
                  })
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "row" }, [
                _c(
                  "label",
                  {
                    staticClass: "col-md-3 col-form-label text-md-right",
                    attrs: { for: "showCompanyAddress" }
                  },
                  [
                    _vm._v(
                      "\r\n                            公司地址\r\n                        "
                    )
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-9" }, [
                  _c("input", {
                    staticClass: "form-control",
                    attrs: {
                      id: "showCompanyAddress",
                      type: "text",
                      disabled: ""
                    },
                    domProps: { value: _vm.current_supplier.companyAddress }
                  })
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          _vm._m(2),
          _vm._v(" "),
          _vm._m(3),
          _vm._v(" "),
          _c("input", {
            attrs: {
              type: "text",
              name: "totalPrice",
              id: "totalPrice",
              value: "0"
            }
          }),
          _vm._v(" "),
          _vm._m(4)
        ],
        1
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "label",
      {
        staticClass: "col-md-3 col-form-label text-md-right",
        attrs: { for: "supplier_id" }
      },
      [
        _c("span", { staticClass: "text-danger" }, [_vm._v("*")]),
        _vm._v(
          "\r\n                            供應商\r\n                        "
        )
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-3" }, [
      _c(
        "button",
        {
          staticClass: "btn btn-block btn-primary",
          attrs: {
            type: "button",
            "data-toggle": "modal",
            "data-target": "#CreateSupplierModal"
          }
        },
        [
          _vm._v(
            "\r\n                                新增供應商\r\n                            "
          )
        ]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-6" }, [
        _c("div", { staticClass: "form-group row" }, [
          _c(
            "label",
            {
              staticClass: "col-md-3 col-form-label text-md-right",
              attrs: { for: "expectReceived_at" }
            },
            [
              _vm._v(
                "\r\n                            預期到貨時間\r\n                        "
              )
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-6" }, [
            _c("input", {
              staticClass: "form-control",
              attrs: {
                id: "expectReceived_at",
                type: "date",
                name: "expectReceived_at",
                value: "",
                required: ""
              }
            })
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-6" }, [
        _c("div", { staticClass: "form-group row" }, [
          _c(
            "label",
            {
              staticClass: "col-md-3 col-form-label text-md-right",
              attrs: { for: "PurchaseComment" }
            },
            [
              _vm._v(
                "\r\n                            備註\r\n                        "
              )
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-6" }, [
            _c("input", {
              staticClass: "form-control",
              attrs: {
                id: "PurchaseComment",
                type: "text",
                name: "comment",
                value: ""
              }
            })
          ])
        ])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row" }, [
      _c("div", { staticClass: "col-md-6" }, [
        _c("div", { staticClass: "form-group row" }, [
          _c(
            "label",
            {
              staticClass: "col-md-3 col-form-label text-md-right",
              attrs: { for: "taxType" }
            },
            [
              _vm._v(
                "\r\n                            稅別\r\n                        "
              )
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-6" }, [
            _c(
              "select",
              {
                staticClass: "form-control",
                attrs: { name: "taxType", id: "taxType", required: "" }
              },
              [
                _c("option", { attrs: { value: "1" } }, [_vm._v("應稅")]),
                _vm._v(" "),
                _c("option", { attrs: { value: "2" } }, [
                  _vm._v("零稅 - 經海關")
                ]),
                _vm._v(" "),
                _c("option", { attrs: { value: "3" } }, [
                  _vm._v("零稅 - 非經海關")
                ]),
                _vm._v(" "),
                _c("option", { attrs: { value: "4" } }, [_vm._v("免稅")]),
                _vm._v(" "),
                _c("option", { attrs: { value: "5" } }, [_vm._v("未稅")])
              ]
            )
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "col-md-6" }, [
        _c("div", { staticClass: "form-group row" }, [
          _c(
            "label",
            {
              staticClass: "col-md-3 col-form-label text-md-right",
              attrs: { for: "invoiceType" }
            },
            [
              _vm._v(
                "\r\n                            發票類型\r\n                        "
              )
            ]
          ),
          _vm._v(" "),
          _c("div", { staticClass: "col-md-6" }, [
            _c(
              "select",
              {
                staticClass: "form-control",
                attrs: { name: "invoiceType", id: "invoiceType", required: "" }
              },
              [
                _c("option", { attrs: { value: "1" } }, [_vm._v("三聯式")]),
                _vm._v(" "),
                _c("option", { attrs: { value: "2" } }, [_vm._v("二聯式")]),
                _vm._v(" "),
                _c("option", { attrs: { value: "3" } }, [
                  _vm._v("三聯銷退折讓")
                ]),
                _vm._v(" "),
                _c("option", { attrs: { value: "4" } }, [
                  _vm._v("二聯銷退折讓")
                ]),
                _vm._v(" "),
                _c("option", { attrs: { value: "5" } }, [
                  _vm._v("三聯式收銀機")
                ]),
                _vm._v(" "),
                _c("option", { attrs: { value: "6" } }, [_vm._v("免用發票")])
              ]
            )
          ])
        ])
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
              "\r\n                        確認新增\r\n                    "
            )
          ]
        ),
        _vm._v(" "),
        _c(
          "a",
          { staticClass: "btn btn-block btn-danger", attrs: { href: "#" } },
          [
            _vm._v(
              "\r\n                        返回上一頁\r\n                    "
            )
          ]
        )
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/OptionItem.vue?vue&type=template&id=e395406c&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Partials/OptionItem.vue?vue&type=template&id=e395406c& ***!
  \**********************************************************************************************************************************************************************************************************************/
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
  return _c("option", { domProps: { value: _vm.data.id } }, [
    _vm._v(_vm._s(_vm.data.name))
  ])
}
var staticRenderFns = []
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

/***/ "./resources/js/components/Modals/CreateSupplierModal.vue":
/*!****************************************************************!*\
  !*** ./resources/js/components/Modals/CreateSupplierModal.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CreateSupplierModal_vue_vue_type_template_id_b4627df2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CreateSupplierModal.vue?vue&type=template&id=b4627df2& */ "./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=template&id=b4627df2&");
/* harmony import */ var _CreateSupplierModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CreateSupplierModal.vue?vue&type=script&lang=js& */ "./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CreateSupplierModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CreateSupplierModal_vue_vue_type_template_id_b4627df2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CreateSupplierModal_vue_vue_type_template_id_b4627df2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Modals/CreateSupplierModal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CreateSupplierModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./CreateSupplierModal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CreateSupplierModal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=template&id=b4627df2&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=template&id=b4627df2& ***!
  \***********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CreateSupplierModal_vue_vue_type_template_id_b4627df2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./CreateSupplierModal.vue?vue&type=template&id=b4627df2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Modals/CreateSupplierModal.vue?vue&type=template&id=b4627df2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CreateSupplierModal_vue_vue_type_template_id_b4627df2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CreateSupplierModal_vue_vue_type_template_id_b4627df2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Orders/PurchaseCreateForm.vue":
/*!***************************************************************!*\
  !*** ./resources/js/components/Orders/PurchaseCreateForm.vue ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PurchaseCreateForm_vue_vue_type_template_id_46ceb9f0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PurchaseCreateForm.vue?vue&type=template&id=46ceb9f0& */ "./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=template&id=46ceb9f0&");
/* harmony import */ var _PurchaseCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PurchaseCreateForm.vue?vue&type=script&lang=js& */ "./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PurchaseCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PurchaseCreateForm_vue_vue_type_template_id_46ceb9f0___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PurchaseCreateForm_vue_vue_type_template_id_46ceb9f0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Orders/PurchaseCreateForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchaseCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./PurchaseCreateForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchaseCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=template&id=46ceb9f0&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=template&id=46ceb9f0& ***!
  \**********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchaseCreateForm_vue_vue_type_template_id_46ceb9f0___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./PurchaseCreateForm.vue?vue&type=template&id=46ceb9f0& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/PurchaseCreateForm.vue?vue&type=template&id=46ceb9f0&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchaseCreateForm_vue_vue_type_template_id_46ceb9f0___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchaseCreateForm_vue_vue_type_template_id_46ceb9f0___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Partials/OptionItem.vue":
/*!*********************************************************!*\
  !*** ./resources/js/components/Partials/OptionItem.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _OptionItem_vue_vue_type_template_id_e395406c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OptionItem.vue?vue&type=template&id=e395406c& */ "./resources/js/components/Partials/OptionItem.vue?vue&type=template&id=e395406c&");
/* harmony import */ var _OptionItem_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./OptionItem.vue?vue&type=script&lang=js& */ "./resources/js/components/Partials/OptionItem.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _OptionItem_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _OptionItem_vue_vue_type_template_id_e395406c___WEBPACK_IMPORTED_MODULE_0__["render"],
  _OptionItem_vue_vue_type_template_id_e395406c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Partials/OptionItem.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Partials/OptionItem.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/Partials/OptionItem.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OptionItem_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./OptionItem.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/OptionItem.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OptionItem_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Partials/OptionItem.vue?vue&type=template&id=e395406c&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/Partials/OptionItem.vue?vue&type=template&id=e395406c& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OptionItem_vue_vue_type_template_id_e395406c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./OptionItem.vue?vue&type=template&id=e395406c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/OptionItem.vue?vue&type=template&id=e395406c&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OptionItem_vue_vue_type_template_id_e395406c___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_OptionItem_vue_vue_type_template_id_e395406c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/orders/purchase.js":
/*!*****************************************!*\
  !*** ./resources/js/orders/purchase.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('purchase-create-form', __webpack_require__(/*! ./../components/Orders/PurchaseCreateForm.vue */ "./resources/js/components/Orders/PurchaseCreateForm.vue")["default"]);
Vue.component('option-item', __webpack_require__(/*! ./../components/Partials/OptionItem.vue */ "./resources/js/components/Partials/OptionItem.vue")["default"]);
Vue.component('create-supplier-modal', __webpack_require__(/*! ./../components/Modals/CreateSupplierModal.vue */ "./resources/js/components/Modals/CreateSupplierModal.vue")["default"]);
var app = new Vue({
  el: '#purchase',
  data: function data() {
    return {
      suppliers: [],
      current_supplier: [],
      form_error: []
    };
  },
  methods: {
    getSupplierData: function getSupplierData(id) {
      var _this = this;

      var apiSupplierGetInfo = $('#apiSupplierGetInfo').html();
      axios.post(apiSupplierGetInfo, id).then(function (response) {
        console.log(response);
        _this.current_supplier = response.data;
      });
    }
  },
  created: function created() {
    var _this2 = this;

    var apiSupplierShowName = $('#apiSupplierShowName').html();
    axios.get(apiSupplierShowName).then(function (response) {
      _this2.suppliers = response.data;
    });
  }
});

/***/ }),

/***/ 2:
/*!***********************************************!*\
  !*** multi ./resources/js/orders/purchase.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\orders\purchase.js */"./resources/js/orders/purchase.js");


/***/ })

/******/ });