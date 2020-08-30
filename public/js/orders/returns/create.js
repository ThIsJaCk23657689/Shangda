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
/******/ 	return __webpack_require__(__webpack_require__.s = 27);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['consumers', 'current_comsumer', 'products'],
  mounted: function mounted() {
    console.log('ReturnCreareForm.vue mounted.'); // 設定 訂單日期為今天 和 其他欄位 為預設。

    var myDate = new Date();
    var date = myDate.getFullYear() + '-' + ('0' + (myDate.getMonth() + 1)).slice(-2) + '-' + ('0' + myDate.getDate()).slice(-2);
    $("#created_at").val(date);
    $("#expectPay_at").val(date);
    $("#expectDeliver_at").val(date);
    $('#shownID').val($('#getSalesOrderShownID').html()); // 顯示此訂單建立者名稱

    $('#creator').val($('#getAuthName').html()); // 訂單細項 表單程式碼

    $('#SalesOrderDetailForm').submit(function (e) {
      e.preventDefault();
      var url = $('#createSalesOrderDetail').html();
      var data = $(this).serialize();
      axios.post(url, data).then(function (response) {
        console.log(response.data.messenge);
        alert('新增退貨單成功！');
        history.go(-1);
      })["catch"](function (error) {
        console.error('新增退貨單細項時發生錯誤，錯誤訊息：' + error);
        alert('新增退貨單細項時發生錯誤，錯誤訊息：' + error);
        $('#LoadingModal').modal('hide');
      });
    });
  },
  data: function data() {
    return {
      total_price: 0,
      getSalesOrderIndex: $('#getSalesOrderIndex').html()
    };
  },
  methods: {
    showTotalPrice: function showTotalPrice(total_price) {
      this.total_price = total_price;
    },
    changeTax: function changeTax() {
      this.$refs.salesdetail.calculateTotalPrice(); // 呼叫子元件裡的toggleFood方法
    },
    getConsumerData: function getConsumerData() {
      var consumer_id = $('#consumer_id').val();

      if (consumer_id != 0) {
        this.$emit('get-consumer-data', {
          id: consumer_id
        });
      } else {
        alert('請先選擇顧客!');
      }
    },
    createReturnOrder: function createReturnOrder() {
      // 新建進貨單
      // 1. 先創建 SalesOrder
      var url = $('#createSalesOrder').text();
      var data = $('#ReturnOrderCreateForm').serialize();
      $('#LoadingModal').modal('show');
      axios.post(url, data).then(function (response) {
        console.log(response);
        $('#salesOrderID').val(response.data.salesOrder_id); // 2. 建立 SalesOrderDetail

        $('#SalesOrderDetailForm').submit();
      })["catch"](function (error) {
        console.error('新增退貨單時發生錯誤，錯誤訊息：' + error);
        alert('新增退貨單時發生錯誤，錯誤訊息：' + error);
        $('#LoadingModal').modal('hide');
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnDetail.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/ReturnDetail.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
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
  props: ['products'],
  mounted: function mounted() {
    console.log('ReturnDetail.vue mounted.');
  },
  data: function data() {
    return {
      details: [],
      current_product: [],
      total_price: 0
    };
  },
  methods: {
    // 新增原物料細項
    addDetail: function addDetail() {
      if (this.current_product.length != 0) {
        this.details.push({
          count: this.details.length,
          product: {
            id: this.current_product.id,
            name: this.current_product.name,
            internationalNum: this.current_product.internationalNum,
            unitPrice: this.current_product.retailPrice,
            qty_per_pack: this.current_product.qty_per_pack,
            showUnit: this.current_product.showUnit
          },
          pieces: 0,
          quantity: 0,
          discount: 1,
          subTotal: 0,
          comment: null
        });
      } else {
        alert('請選擇商品');
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
      this.details[id - 1].product.unitPrice = unitPrice;
      this.details[id - 1].discount = discount;
      this.details[id - 1].subTotal = subTotal;
      this.calculateTotalPrice();
    },
    calculateTotalPrice: function calculateTotalPrice() {
      this.total_price = 0;

      for (var i = 1; i <= this.details.length; i++) {
        var qty = this.details[i - 1].quantity;
        var unitPrice = this.details[i - 1].product.unitPrice;
        var discount = this.details[i - 1].discount;
        var subTotal = Math.round(unitPrice * qty * discount * 10000) / 10000;
        this.total_price = this.total_price + subTotal;
      }

      $('#totalPrice').val(this.total_price);
      var taxType = $('#taxType').val();
      var tax = taxType == "1" ? Math.round(this.total_price * 0.05 * 10000) / 10000 : 0;
      $('#taxPrice').val(tax);
      this.total_price = Math.round((this.total_price + tax) * 10000) / 10000;
      this.$emit('showTotalPrice', this.total_price); // console.log(this.total_price);
    },
    calculateQty: function calculateQty(id, type) {
      var qty_per_pack = $('#qty_per_pack_' + id).val();

      if (type == 'p') {
        var pcs = $('#pcs_' + id).val();
        $('#qty_' + id).val(pcs * qty_per_pack);
        this.details[id - 1].pieces = pcs;
      } else if (type == 'q') {
        var qty = $('#qty_' + id).val();
        $('#pcs_' + id).val(qty / qty_per_pack);
        this.details[id - 1].pieces = qty / qty_per_pack;
      }
    },
    updateComment: function updateComment(id) {
      var comment = $('#comment_' + id).val();
      this.details[id - 1].comment = comment;
    },
    // 取得商品資料
    getProductData: function getProductData() {
      var _this = this;

      var product_id = $('#product_id').val();

      if (product_id != 0) {
        var getProductInfo = $('#getProductInfo').html();
        $('#addDetailBtn').attr('disabled', true);
        axios.post(getProductInfo, {
          id: product_id
        }).then(function (response) {
          _this.current_product = response.data;
          $('#addDetailBtn').attr('disabled', false);
        });
      } else {
        alert('請選擇商品');
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=template&id=5df0e4c2&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=template&id=5df0e4c2& ***!
  \**************************************************************************************************************************************************************************************************************************/
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
    _c("div", { staticClass: "col-md-11" }, [
      _c(
        "form",
        {
          attrs: { id: "ReturnOrderCreateForm", method: "POST", action: "#" },
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.createReturnOrder($event)
            }
          }
        },
        [
          _c("input", {
            attrs: { type: "hidden", name: "status", value: "2" }
          }),
          _vm._v(" "),
          _c("input", {
            attrs: { type: "hidden", name: "confirmStatus", value: "1" }
          }),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-md-12" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _vm._m(0),
                    _vm._v(" "),
                    _c(
                      "select",
                      {
                        staticClass: "form-control",
                        attrs: { id: "consumer_id", name: "consumer_id" },
                        on: { change: _vm.getConsumerData }
                      },
                      [
                        _c("option", { attrs: { value: "0" } }, [
                          _vm._v("請選擇...")
                        ]),
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
                  ])
                ])
              ])
            ]),
            _vm._v(" "),
            _vm._m(1),
            _vm._v(" "),
            _vm._m(2),
            _vm._v(" "),
            _vm._m(3)
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-md-4" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("label", { attrs: { for: "show_shortName" } }, [
                      _vm._v("顧客簡稱")
                    ]),
                    _vm._v(" "),
                    _c("input", {
                      staticClass: "form-control",
                      attrs: {
                        id: "show_shortName",
                        type: "text",
                        readonly: ""
                      },
                      domProps: {
                        value: _vm.current_comsumer.shortName || "無"
                      }
                    })
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-4" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("label", { attrs: { for: "show_act" } }, [
                      _vm._v("帳號")
                    ]),
                    _vm._v(" "),
                    _c("input", {
                      staticClass: "form-control",
                      attrs: { id: "show_act", type: "text", readonly: "" },
                      domProps: { value: _vm.current_comsumer.act || "無" }
                    })
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-4" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("label", { attrs: { for: "show_taxID" } }, [
                      _vm._v("統一編號")
                    ]),
                    _vm._v(" "),
                    _c("input", {
                      staticClass: "form-control",
                      attrs: { id: "show_taxID", type: "text", readonly: "" },
                      domProps: { value: _vm.current_comsumer.taxID || "無" }
                    })
                  ])
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row" }, [
                _c("div", { staticClass: "col-md-4" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("label", { attrs: { for: "show_settlement" } }, [
                      _vm._v("結算方式")
                    ]),
                    _vm._v(" "),
                    _c("input", {
                      staticClass: "form-control mb-2",
                      attrs: {
                        id: "show_settlement",
                        type: "text",
                        readonly: ""
                      },
                      domProps: {
                        value: _vm.current_comsumer.settlement || "無"
                      }
                    })
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-4" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("label", { attrs: { for: "show_uncheckedAmount" } }, [
                      _vm._v("未沖帳金額")
                    ]),
                    _vm._v(" "),
                    _c("input", {
                      staticClass: "form-control",
                      attrs: {
                        id: "show_uncheckedAmount",
                        type: "text",
                        readonly: ""
                      },
                      domProps: {
                        value: _vm.current_comsumer.uncheckedAmount || "0"
                      }
                    })
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-4" }, [
                  _c("div", { staticClass: "form-group" }, [
                    _c("label", { attrs: { for: "show_totalConsumption" } }, [
                      _vm._v("總消費額")
                    ]),
                    _vm._v(" "),
                    _c("input", {
                      staticClass: "form-control",
                      attrs: {
                        id: "show_totalConsumption",
                        type: "text",
                        readonly: ""
                      },
                      domProps: {
                        value: _vm.current_comsumer.totalConsumption || "0"
                      }
                    })
                  ])
                ])
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-6" }, [
              _c(
                "div",
                { staticClass: "form-group", staticStyle: { height: "72%" } },
                [
                  _c("label", { attrs: { for: "show_consumer_comment" } }, [
                    _vm._v("顧客備註")
                  ]),
                  _vm._v(" "),
                  _c("textarea", {
                    staticClass: "form-control",
                    staticStyle: { height: "100%" },
                    attrs: {
                      id: "show_consumer_comment",
                      type: "text",
                      readonly: ""
                    },
                    domProps: { value: _vm.current_comsumer.comment || "無" }
                  })
                ]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-4" }, [
              _c("div", { staticClass: "form-group" }, [
                _c("label", { attrs: { for: "show_companyAddress" } }, [
                  _vm._v("公司地址")
                ]),
                _vm._v(" "),
                _c("input", {
                  staticClass: "form-control",
                  attrs: {
                    id: "show_companyAddress",
                    type: "text",
                    readonly: ""
                  },
                  domProps: {
                    value: _vm.current_comsumer.companyAddress || "無"
                  }
                })
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-4" }, [
              _c("div", { staticClass: "form-group" }, [
                _c("label", { attrs: { for: "show_deliveryAddress" } }, [
                  _vm._v("送貨地址")
                ]),
                _vm._v(" "),
                _c("input", {
                  staticClass: "form-control",
                  attrs: {
                    id: "show_deliveryAddress",
                    type: "text",
                    readonly: ""
                  },
                  domProps: {
                    value: _vm.current_comsumer.deliveryAddress || "無"
                  }
                })
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-4" }, [
              _c("div", { staticClass: "form-group" }, [
                _c("label", { attrs: { for: "show_invoiceAddress" } }, [
                  _vm._v("發票地址")
                ]),
                _vm._v(" "),
                _c("input", {
                  staticClass: "form-control",
                  attrs: {
                    id: "show_invoiceAddress",
                    type: "text",
                    readonly: ""
                  },
                  domProps: {
                    value: _vm.current_comsumer.invoiceAddress || "無"
                  }
                })
              ])
            ])
          ]),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          _c("div", { staticClass: "row" }, [
            _c("div", { staticClass: "col-md-6" }, [
              _c("div", { staticClass: "form-group" }, [
                _vm._m(4),
                _vm._v(" "),
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
            ]),
            _vm._v(" "),
            _vm._m(5)
          ]),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          _c("return-detail", {
            ref: "returndetail",
            attrs: { products: _vm.products },
            on: { showTotalPrice: _vm.showTotalPrice }
          }),
          _vm._v(" "),
          _c("div", { staticClass: "row mb-2" }, [
            _vm._m(6),
            _vm._v(" "),
            _vm._m(7),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-4" }, [
              _c("div", { staticClass: "form-group" }, [
                _c("label", { attrs: { for: "totalTaxPrice" } }, [
                  _vm._v("總額")
                ]),
                _vm._v(" "),
                _c("input", {
                  staticClass: "form-control",
                  attrs: {
                    id: "totalTaxPrice",
                    name: "totalTaxPrice",
                    type: "text",
                    required: "",
                    readonly: ""
                  },
                  domProps: { value: _vm.total_price || "0" }
                })
              ])
            ])
          ]),
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
                  attrs: { href: _vm.getSalesOrderIndex }
                },
                [
                  _vm._v(
                    "\r\n                        返回退貨單首頁\r\n                    "
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
    return _c("label", { attrs: { for: "consumer_id" } }, [
      _c("span", { staticClass: "text-danger mr-2" }, [_vm._v("*")]),
      _vm._v("顧客名稱\r\n                                ")
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-2" }, [
      _c("div", { staticClass: "form-group" }, [
        _c("label", { attrs: { for: "shownID" } }, [_vm._v("退貨單編號")]),
        _vm._v(" "),
        _c("input", {
          staticClass: "form-control",
          attrs: { id: "shownID", name: "shownID", type: "text", readonly: "" }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-2" }, [
      _c("div", { staticClass: "form-group" }, [
        _c("label", { attrs: { for: "created_at" } }, [_vm._v("訂單建立日期")]),
        _vm._v(" "),
        _c("input", {
          staticClass: "form-control",
          attrs: { id: "created_at", type: "text", readonly: "" }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-2" }, [
      _c("div", { staticClass: "form-group" }, [
        _c("label", { attrs: { for: "creator" } }, [_vm._v("建立者")]),
        _vm._v(" "),
        _c("input", {
          staticClass: "form-control",
          attrs: { id: "creator", type: "text", readonly: "" }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", { attrs: { for: "taxType" } }, [
      _c("span", { staticClass: "text-danger mr-2" }, [_vm._v("*")]),
      _vm._v("稅別\r\n                        ")
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-6" }, [
      _c("div", { staticClass: "form-group", staticStyle: { height: "72%" } }, [
        _c("label", { attrs: { for: "comment" } }, [_vm._v("訂單備註")]),
        _vm._v(" "),
        _c("textarea", {
          staticClass: "form-control",
          staticStyle: { height: "100%" },
          attrs: { id: "comment", name: "comment", type: "text" }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-4" }, [
      _c("div", { staticClass: "form-group" }, [
        _c("label", { attrs: { for: "totalPrice" } }, [_vm._v("退貨額")]),
        _vm._v(" "),
        _c("input", {
          staticClass: "form-control",
          attrs: {
            id: "totalPrice",
            type: "text",
            value: "0",
            required: "",
            readonly: ""
          }
        })
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-4" }, [
      _c("div", { staticClass: "form-group" }, [
        _c("label", { attrs: { for: "taxPrice" } }, [_vm._v("稅額")]),
        _vm._v(" "),
        _c("input", {
          staticClass: "form-control",
          attrs: {
            id: "taxPrice",
            type: "text",
            value: "0",
            required: "",
            readonly: ""
          }
        })
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnDetail.vue?vue&type=template&id=19c16d10&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/ReturnDetail.vue?vue&type=template&id=19c16d10& ***!
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
  return _c("div", { staticClass: "row justify-content-center" }, [
    _c("div", { staticClass: "col-md-12" }, [
      _c(
        "form",
        { attrs: { id: "SalesOrderDetailForm", method: "POST", action: "#" } },
        [
          _c("input", {
            attrs: {
              type: "hidden",
              id: "salesOrderID",
              name: "salesOrder_id",
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
                  attrs: { id: "product_id" },
                  on: { change: _vm.getProductData }
                },
                [
                  _c("option", { attrs: { value: "0" } }, [
                    _vm._v("請選擇...")
                  ]),
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
                  attrs: { id: "addDetailBtn", type: "button" },
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
                    _c("td", { staticStyle: { width: "4%" } }, [
                      _vm._v(_vm._s(index + 1))
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "20%" } }, [
                      _vm._v(
                        "\r\n                            " +
                          _vm._s(detail.product.name) +
                          "\r\n                            "
                      ),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          name: "details[" + (index + 1) + "][product_id]"
                        },
                        domProps: { value: detail.product.id }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "10%" } }, [
                      _vm._v(
                        "\r\n                            " +
                          _vm._s(detail.product.internationalNum) +
                          "\r\n                        "
                      )
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "20%" } }, [
                      _c("input", {
                        staticClass: "form-control",
                        staticStyle: { width: "30%", display: "inline-block" },
                        attrs: {
                          id: "pcs_" + (index + 1),
                          type: "text",
                          name: "details[" + (index + 1) + "][pieces]"
                        },
                        domProps: { value: detail.pieces },
                        on: {
                          change: function($event) {
                            _vm.calculateQty(index + 1, "p")
                            _vm.calculateSubtotal(index + 1)
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("span", { staticClass: "mr-2" }, [_vm._v("件")]),
                      _vm._v(" "),
                      _c("input", {
                        staticClass: "form-control",
                        staticStyle: { width: "30%", display: "inline-block" },
                        attrs: {
                          id: "qty_" + (index + 1),
                          type: "text",
                          name: "details[" + (index + 1) + "][quantity]"
                        },
                        domProps: { value: detail.quantity },
                        on: {
                          change: function($event) {
                            _vm.calculateQty(index + 1, "q")
                            _vm.calculateSubtotal(index + 1)
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("span", [_vm._v(_vm._s(detail.product.showUnit))]),
                      _vm._v(" "),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          id: "qty_per_pack_" + (index + 1)
                        },
                        domProps: { value: detail.product.qty_per_pack }
                      })
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
                        domProps: { value: detail.product.unitPrice },
                        on: {
                          change: function($event) {
                            return _vm.calculateSubtotal(index + 1)
                          }
                        }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", { staticStyle: { width: "8%" } }, [
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
                    _c("td", { staticStyle: { width: "8%" } }, [
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
        _c("th", [_vm._v("商品")]),
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

/***/ "./resources/js/components/Orders/ReturnCreateForm.vue":
/*!*************************************************************!*\
  !*** ./resources/js/components/Orders/ReturnCreateForm.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ReturnCreateForm_vue_vue_type_template_id_5df0e4c2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ReturnCreateForm.vue?vue&type=template&id=5df0e4c2& */ "./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=template&id=5df0e4c2&");
/* harmony import */ var _ReturnCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ReturnCreateForm.vue?vue&type=script&lang=js& */ "./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ReturnCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ReturnCreateForm_vue_vue_type_template_id_5df0e4c2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ReturnCreateForm_vue_vue_type_template_id_5df0e4c2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Orders/ReturnCreateForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ReturnCreateForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=template&id=5df0e4c2&":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=template&id=5df0e4c2& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnCreateForm_vue_vue_type_template_id_5df0e4c2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ReturnCreateForm.vue?vue&type=template&id=5df0e4c2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnCreateForm.vue?vue&type=template&id=5df0e4c2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnCreateForm_vue_vue_type_template_id_5df0e4c2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnCreateForm_vue_vue_type_template_id_5df0e4c2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Orders/ReturnDetail.vue":
/*!*********************************************************!*\
  !*** ./resources/js/components/Orders/ReturnDetail.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ReturnDetail_vue_vue_type_template_id_19c16d10___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ReturnDetail.vue?vue&type=template&id=19c16d10& */ "./resources/js/components/Orders/ReturnDetail.vue?vue&type=template&id=19c16d10&");
/* harmony import */ var _ReturnDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ReturnDetail.vue?vue&type=script&lang=js& */ "./resources/js/components/Orders/ReturnDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ReturnDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ReturnDetail_vue_vue_type_template_id_19c16d10___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ReturnDetail_vue_vue_type_template_id_19c16d10___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Orders/ReturnDetail.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Orders/ReturnDetail.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/Orders/ReturnDetail.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ReturnDetail.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Orders/ReturnDetail.vue?vue&type=template&id=19c16d10&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/Orders/ReturnDetail.vue?vue&type=template&id=19c16d10& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnDetail_vue_vue_type_template_id_19c16d10___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ReturnDetail.vue?vue&type=template&id=19c16d10& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnDetail.vue?vue&type=template&id=19c16d10&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnDetail_vue_vue_type_template_id_19c16d10___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnDetail_vue_vue_type_template_id_19c16d10___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/orders/returns/create.js":
/*!***********************************************!*\
  !*** ./resources/js/orders/returns/create.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('return-create-form', __webpack_require__(/*! ./../../components/Orders/ReturnCreateForm.vue */ "./resources/js/components/Orders/ReturnCreateForm.vue")["default"]);
Vue.component('return-detail', __webpack_require__(/*! ./../../components/Orders/ReturnDetail.vue */ "./resources/js/components/Orders/ReturnDetail.vue")["default"]);
var app = new Vue({
  el: '#returns',
  data: function data() {
    return {
      consumers: [],
      current_consumer: [],
      products: []
    };
  },
  methods: {
    getConsumerData: function getConsumerData(id) {
      var _this = this;

      var getConsumerInfo = $('#getConsumerInfo').html();
      axios.post(getConsumerInfo, id).then(function (response) {
        console.log(response);
        _this.current_consumer = response.data;

        if (_this.current_consumer.monthlyCheckDate == 0) {
          _this.current_consumer.settlement = '當日結算';
        } else {
          _this.current_consumer.settlement = '每個月' + _this.current_consumer.monthlyCheckDate + '號結算';
        }
      });
    }
  },
  created: function created() {
    var _this2 = this;

    var getConsumersName = $('#getConsumersName').html();
    var getProductsName = $('#getProductsName').html();
    axios.get(getConsumersName).then(function (response) {
      _this2.consumers = response.data;
    });
    axios.get(getProductsName).then(function (response) {
      _this2.products = response.data;
    });
  }
});

/***/ }),

/***/ 27:
/*!*****************************************************!*\
  !*** multi ./resources/js/orders/returns/create.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\orders\returns\create.js */"./resources/js/orders/returns/create.js");


/***/ })

/******/ });