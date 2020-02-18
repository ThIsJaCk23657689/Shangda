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
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  props: ['suppliers', 'current_supplier', 'materials'],
  mounted: function mounted() {
    console.log('PurchaseCreareForm.vue mounted.');
    $("#expectReceived_at").datepicker({
      changeYear: true,
      changeMonth: true,
      maxDate: new Date(),
      dateFormat: 'yy-mm-dd'
    }); // 訂單細項 表單程式碼

    $('#PurchaseOrderDetailForm').submit(function (e) {
      e.preventDefault();
      var url = $('#createPurchaseOrderDetail').html();
      var data = $(this).serialize();
      axios.post(url, data).then(function (response) {
        console.log(response.data.messenge);
        alert('新增進貨單成功！');
        history.go(-1);
      })["catch"](function (error) {
        console.error('新增進貨單細項時發生錯誤，錯誤訊息：' + error);
        alert('新增進貨單細項時發生錯誤，錯誤訊息：' + error);
        $('#LoadingModal').modal('hide');
      });
    });
  },
  data: function data() {
    return {
      total_price: 0,
      getPurchaseOrderIndex: $('#getPurchaseOrderIndex').html()
    };
  },
  methods: {
    showTotalPrice: function showTotalPrice(total_price) {
      this.total_price = total_price;
    },
    changeTax: function changeTax() {
      this.$refs.purchasedetail.calculateTotalPrice(); // 呼叫子元件裡的toggleFood方法 
    },
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
      // 新建進貨單
      // 1. 先創建 PurchaseOrder
      var url = $('#createPurchaseOrder').html();
      var data = $('#PurchaseOrderCreateForm').serialize();
      $('#LoadingModal').modal('show');
      axios.post(url, data).then(function (response) {
        $('#purchaseOrderID').val(response.data.purchaseOrder_id); // 2. 建立 PurchaseOrderDetail

        $('#PurchaseOrderDetailForm').submit();
      })["catch"](function (error) {
        console.error('新增進貨單時發生錯誤，錯誤訊息：' + error);
        alert('新增進貨單時發生錯誤，錯誤訊息：' + error);
        $('#LoadingModal').modal('hide');
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/PurchaseDetail.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/PurchaseDetail.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['materials'],
  mounted: function mounted() {
    console.log('PurchaseDetail.vue mounted.');
  },
  data: function data() {
    return {
      details: [],
      current_material: [],
      total_price: 0
    };
  },
  methods: {
    // 新增原物料細項
    addDetail: function addDetail() {
      if (this.current_material.length != 0) {
        this.details.push({
          count: this.details.length,
          material: {
            id: this.current_material.id,
            name: this.current_material.name,
            internationalNum: this.current_material.internationalNum,
            unitPrice: this.current_material.unitPrice,
            unit: this.current_material.unit
          },
          quantity: 0,
          discount: 1,
          subTotal: 0,
          comment: null
        });
      } else {
        alert('請選擇原物料');
      }
    },
    // 刪除原物料細項
    deleteDetail: function deleteDetail(id) {
      this.details.splice(id, 1);

      if (this.details.length != 0) {
        this.calculateSubtotal(1);
      }

      this.calculateTotalPrice();
    },
    calculateSubtotal: function calculateSubtotal(id) {
      var qty = $('#qty_' + id).val();
      var unitPrice = $('#unitPrice_' + id).val();
      var discount = $('#discount_' + id).val();
      var subTotal = Math.round(unitPrice * qty * discount * 10000) / 10000;
      $('#subtotal_' + id).html(subTotal);
      this.details[id - 1].quantity = qty;
      this.details[id - 1].material.unitPrice = unitPrice;
      this.details[id - 1].discount = discount;
      this.details[id - 1].subTotal = subTotal;
      this.calculateTotalPrice();
    },
    calculateTotalPrice: function calculateTotalPrice() {
      this.total_price = 0;

      for (var i = 1; i <= this.details.length; i++) {
        var qty = this.details[i - 1].quantity;
        var unitPrice = this.details[i - 1].material.unitPrice;
        var discount = this.details[i - 1].discount;
        var subTotal = Math.round(unitPrice * qty * discount * 10000) / 10000;
        this.total_price = this.total_price + subTotal;
      }

      $('#beforePrice').val(this.total_price);
      var taxType = $('#taxType').val();
      var tax = taxType == "1" ? Math.round(this.total_price * 0.05 * 10000) / 10000 : 0;
      $('#tax_price').val(tax);
      this.total_price = Math.round((this.total_price + tax) * 10000) / 10000;
      this.$emit('showTotalPrice', this.total_price); // console.log(this.total_price);
    },
    updateComment: function updateComment(id) {
      var comment = $('#comment_' + id).val();
      this.details[id - 1].comment = comment;
    },
    getMaterialData: function getMaterialData() {
      var _this = this;

      var material_id = $('#material_id').val();

      if (material_id != 0) {
        var getMeterialInfo = $('#getMeterialInfo').html();
        axios.post(getMeterialInfo, {
          id: material_id
        }).then(function (response) {
          _this.current_material = response.data; // console.log(response);
        });
      } else {
        alert('請選擇原物料');
      }
    }
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
          _c("div", { staticClass: "row" }, [
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
                      attrs: { name: "taxType", id: "taxType", required: "" },
                      on: { change: _vm.changeTax }
                    },
                    [
                      _c("option", { attrs: { value: "1" } }, [_vm._v("應稅")]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "2" } }, [_vm._v("未稅")]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "3" } }, [_vm._v("免稅")]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "4" } }, [
                        _vm._v("零稅 - 經海關")
                      ]),
                      _vm._v(" "),
                      _c("option", { attrs: { value: "5" } }, [
                        _vm._v("零稅 - 非經海關")
                      ])
                    ]
                  )
                ])
              ])
            ]),
            _vm._v(" "),
            _vm._m(3)
          ]),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          _c("input", {
            staticClass: "form-control",
            attrs: { id: "totalPrice", name: "totalPrice", type: "hidden" },
            domProps: { value: _vm.total_price }
          }),
          _vm._v(" "),
          _c("purchase-detail", {
            ref: "purchasedetail",
            attrs: { materials: _vm.materials },
            on: { showTotalPrice: _vm.showTotalPrice }
          }),
          _vm._v(" "),
          _c("div", { staticClass: "row mb-2" }, [
            _vm._m(4),
            _vm._v(" "),
            _vm._m(5),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-4" }, [
              _c("div", { staticClass: "row" }, [
                _c(
                  "label",
                  {
                    staticClass: "col-md-2 col-form-label text-md-right",
                    attrs: { for: "totalPrice" }
                  },
                  [_vm._v("總額")]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-6" }, [
                  _c("input", {
                    staticClass: "form-control",
                    attrs: { id: "showTotalPrice", type: "text", disabled: "" },
                    domProps: { value: _vm.total_price }
                  })
                ])
              ])
            ])
          ]),
          _vm._v(" "),
          _c("hr"),
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
                    "\r\n                        確認新增\r\n                    "
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "a",
                {
                  staticClass: "btn btn-block btn-danger",
                  attrs: { href: _vm.getPurchaseOrderIndex }
                },
                [
                  _vm._v(
                    "\r\n                        返回進貨單首頁\r\n                    "
                  )
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c("loading-modal")
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
                name: "expectReceived_at",
                type: "text",
                value: "",
                autocomplete: "off",
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
    return _c("div", { staticClass: "col-md-6" }, [
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
              _c("option", { attrs: { value: "3" } }, [_vm._v("三聯銷退折讓")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "4" } }, [_vm._v("二聯銷退折讓")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "5" } }, [_vm._v("三聯式收銀機")]),
              _vm._v(" "),
              _c("option", { attrs: { value: "6" } }, [_vm._v("免用發票")])
            ]
          )
        ])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-4" }, [
      _c("div", { staticClass: "row" }, [
        _c(
          "label",
          {
            staticClass: "col-md-3 col-form-label text-md-right",
            attrs: { for: "beforePrice" }
          },
          [_vm._v("銷售額")]
        ),
        _vm._v(" "),
        _c("div", { staticClass: "col-md-6" }, [
          _c("input", {
            staticClass: "form-control",
            attrs: { id: "beforePrice", type: "text", value: "", disabled: "" }
          })
        ])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-4" }, [
      _c("div", { staticClass: "row" }, [
        _c(
          "label",
          {
            staticClass: "col-md-2 col-form-label text-md-right",
            attrs: { for: "tax_price" }
          },
          [_vm._v("稅額")]
        ),
        _vm._v(" "),
        _c("div", { staticClass: "col-md-6" }, [
          _c("input", {
            staticClass: "form-control",
            attrs: { id: "tax_price", type: "text", value: "", disabled: "" }
          })
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/PurchaseDetail.vue?vue&type=template&id=a3352c3e&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/PurchaseDetail.vue?vue&type=template&id=a3352c3e& ***!
  \************************************************************************************************************************************************************************************************************************/
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
          attrs: { id: "PurchaseOrderDetailForm", method: "POST", action: "#" }
        },
        [
          _c("input", {
            attrs: {
              type: "hidden",
              id: "purchaseOrderID",
              name: "purchaseOrder_id",
              value: ""
            }
          }),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-6 mb-2" }, [
              _c(
                "select",
                {
                  staticClass: "form-control",
                  attrs: { id: "material_id" },
                  on: { change: _vm.getMaterialData }
                },
                [
                  _c("option", { attrs: { value: "0" } }, [
                    _vm._v("請選擇...")
                  ]),
                  _vm._v(" "),
                  _vm._l(_vm.materials, function(data) {
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
                  attrs: { type: "button" },
                  on: { click: _vm.addDetail }
                },
                [_vm._v("新增至細項")]
              )
            ])
          ]),
          _vm._v(" "),
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
                _vm._l(_vm.details, function(detail, index) {
                  return _c("tr", { key: index }, [
                    _c("td", { staticStyle: { width: "5%" } }, [
                      _vm._v(_vm._s(index + 1))
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "20%" } }, [
                      _vm._v(
                        "\r\n                            " +
                          _vm._s(detail.material.name) +
                          "\r\n                            "
                      ),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          name: "details[" + (index + 1) + "][material_id]"
                        },
                        domProps: { value: detail.material.id }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "10%" } }, [
                      _vm._v(
                        "\r\n                            " +
                          _vm._s(detail.material.internationalNum) +
                          "\r\n                        "
                      )
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "15%" } }, [
                      _c("input", {
                        staticClass: "form-control mr-2",
                        staticStyle: { width: "60%", display: "inline-block" },
                        attrs: {
                          id: "qty_" + (index + 1),
                          type: "text",
                          name: "details[" + (index + 1) + "][quantity]"
                        },
                        domProps: { value: detail.quantity },
                        on: {
                          change: function($event) {
                            return _vm.calculateSubtotal(index + 1)
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("span", [
                        _vm._v(
                          _vm._s(detail.material.unit == 1 ? "公斤" : "公噸")
                        )
                      ])
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "10%" } }, [
                      _c("input", {
                        staticClass: "form-control",
                        attrs: {
                          id: "unitPrice_" + (index + 1),
                          type: "text",
                          name: "details[" + (index + 1) + "][price]"
                        },
                        domProps: { value: detail.material.unitPrice },
                        on: {
                          change: function($event) {
                            return _vm.calculateSubtotal(index + 1)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "10%" } }, [
                      _c("input", {
                        staticClass: "form-control",
                        attrs: {
                          id: "discount_" + (index + 1),
                          type: "text",
                          name: "details[" + (index + 1) + "][discount]"
                        },
                        domProps: { value: detail.discount },
                        on: {
                          change: function($event) {
                            return _vm.calculateSubtotal(index + 1)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "10%" } }, [
                      _c("input", {
                        staticClass: "form-control",
                        attrs: {
                          id: "subtotal_" + (index + 1),
                          type: "text",
                          disabled: ""
                        },
                        domProps: { value: detail.subTotal }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "15%" } }, [
                      _c("input", {
                        staticClass: "form-control",
                        attrs: {
                          id: "comment_" + (index + 1),
                          type: "text",
                          name: "details[" + (index + 1) + "][comment]"
                        },
                        domProps: { value: detail.comment },
                        on: {
                          change: function($event) {
                            return _vm.updateComment(index + 1)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "5%" } }, [
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-md btn-danger",
                          attrs: { type: "button" },
                          on: {
                            click: function($event) {
                              return _vm.deleteDetail(index)
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
          )
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
        _c("th", [_vm._v("原物料")]),
        _vm._v(" "),
        _c("th", [_vm._v("國際條碼")]),
        _vm._v(" "),
        _c("th", [_vm._v("數量")]),
        _vm._v(" "),
        _c("th", [_vm._v("單價")]),
        _vm._v(" "),
        _c("th", [_vm._v("折數")]),
        _vm._v(" "),
        _c("th", [_vm._v("小計")]),
        _vm._v(" "),
        _c("th", [_vm._v("備註")]),
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

/***/ "./resources/js/components/Orders/PurchaseDetail.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/Orders/PurchaseDetail.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PurchaseDetail_vue_vue_type_template_id_a3352c3e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PurchaseDetail.vue?vue&type=template&id=a3352c3e& */ "./resources/js/components/Orders/PurchaseDetail.vue?vue&type=template&id=a3352c3e&");
/* harmony import */ var _PurchaseDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PurchaseDetail.vue?vue&type=script&lang=js& */ "./resources/js/components/Orders/PurchaseDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PurchaseDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PurchaseDetail_vue_vue_type_template_id_a3352c3e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PurchaseDetail_vue_vue_type_template_id_a3352c3e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Orders/PurchaseDetail.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Orders/PurchaseDetail.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/Orders/PurchaseDetail.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchaseDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./PurchaseDetail.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/PurchaseDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchaseDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Orders/PurchaseDetail.vue?vue&type=template&id=a3352c3e&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/Orders/PurchaseDetail.vue?vue&type=template&id=a3352c3e& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchaseDetail_vue_vue_type_template_id_a3352c3e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./PurchaseDetail.vue?vue&type=template&id=a3352c3e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/PurchaseDetail.vue?vue&type=template&id=a3352c3e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchaseDetail_vue_vue_type_template_id_a3352c3e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PurchaseDetail_vue_vue_type_template_id_a3352c3e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/orders/purchase/create.js":
/*!************************************************!*\
  !*** ./resources/js/orders/purchase/create.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('purchase-create-form', __webpack_require__(/*! ./../../components/Orders/PurchaseCreateForm.vue */ "./resources/js/components/Orders/PurchaseCreateForm.vue")["default"]);
Vue.component('purchase-detail', __webpack_require__(/*! ./../../components/Orders/PurchaseDetail.vue */ "./resources/js/components/Orders/PurchaseDetail.vue")["default"]);
Vue.component('create-supplier-modal', __webpack_require__(/*! ./../../components/Modals/CreateSupplierModal.vue */ "./resources/js/components/Modals/CreateSupplierModal.vue")["default"]);
var app = new Vue({
  el: '#purchase',
  data: function data() {
    return {
      suppliers: [],
      current_supplier: [],
      materials: [],
      form_error: []
    };
  },
  methods: {
    getSupplierData: function getSupplierData(id) {
      var _this = this;

      var getSupplierInfo = $('#getSupplierInfo').html();
      axios.post(getSupplierInfo, id).then(function (response) {
        console.log(response);
        _this.current_supplier = response.data;
      });
    }
  },
  created: function created() {
    var _this2 = this;

    var getSuppliersName = $('#getSuppliersName').html();
    var getMeterialsName = $('#getMeterialsName').html();
    axios.get(getSuppliersName).then(function (response) {
      _this2.suppliers = response.data;
    });
    axios.get(getMeterialsName).then(function (response) {
      _this2.materials = response.data;
    }); // $.fn.serializeObject = function()
    // {
    //     var o = {};
    //     var a = this.serializeArray();
    //     $.each(a, function() {
    //         if (o[this.name] !== undefined) {
    //             if (!o[this.name].push) {
    //                 o[this.name] = [o[this.name]];
    //             }
    //             o[this.name].push(this.value || '');
    //         } else {
    //             o[this.name] = this.value || '';
    //         }
    //     });
    //     return o;
    // };
  }
});

/***/ }),

/***/ 8:
/*!******************************************************!*\
  !*** multi ./resources/js/orders/purchase/create.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\orders\purchase\create.js */"./resources/js/orders/purchase/create.js");


/***/ })

/******/ });