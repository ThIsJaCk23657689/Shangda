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
/******/ 	return __webpack_require__(__webpack_require__.s = 32);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['products', 'details', 'sales_order_id'],
  mounted: function mounted() {
    console.log('ReturnUpdateDetail.vue mounted.');
  },
  data: function data() {
    return {
      current_product: [],
      total_price: 0,
      current_search_type: '0',
      product_search_result: []
    };
  },
  methods: {
    hoverSearchProductItem: function hoverSearchProductItem(event, IsHovered) {
      if (IsHovered) {
        event.target.classList.add('SearchHover');
      } else {
        event.target.classList.remove('SearchHover');
      }
    },
    // 切換商品搜尋類別
    onChangeSearchType: function onChangeSearchType(event) {
      this.current_search_type = event.target.value;
    },
    // 搜尋商品編號
    searchProductID: function searchProductID(event) {
      var ProductID = event.target.value;
      if (ProductID === '') {
        this.product_search_result = [];
        return;
      }
      var regex = new RegExp(ProductID, 'i');
      this.product_search_result = this.products.filter(function (item) {
        return regex.test(item.shownID);
      });
    },
    searchPressEnterKey: function searchPressEnterKey(event) {
      var Text = event.target.value;
      if (Text === '') {
        this.product_search_result = [];
        return;
      }
      if (this.product_search_result.length !== 0) {
        this.selectSearchProduct(this.product_search_result[0].id);
      }
    },
    // 搜訊商品名稱
    searchProductName: function searchProductName(event) {
      var ProductName = event.target.value;
      if (ProductName === '') {
        this.product_search_result = [];
        return;
      }
      var regex = new RegExp(ProductName, 'i');
      this.product_search_result = this.products.filter(function (item) {
        return regex.test(item.name);
      });
    },
    selectSearchProduct: function selectSearchProduct(ProductID) {
      var _this = this;
      var getProductInfo = $('#getProductInfo').html();
      $.showLoadingModal();
      $('#addDetailBtn').attr('disabled', true);
      axios.post(getProductInfo, {
        id: ProductID
      }).then(function (response) {
        $.closeModal();
        _this.current_product = response.data;
        $('#addDetailBtn').attr('disabled', false);
        _this.addDetail();
      })["catch"](function (error) {
        $.showErrorModal(error);
        console.error('抓取商品資料失敗，錯誤：' + error);
      });
      if (this.current_search_type === '0') {
        $('#searchProductIDInput').val('').focus();
      } else {
        $('#searchProductNameInput').val('').focus();
      }
      this.product_search_result = [];
    },
    // 新增原物料細項
    addDetail: function addDetail() {
      if (this.current_product) {
        this.details.push({
          count: this.details.length,
          product: {
            id: this.current_product.id,
            shownID: this.current_product.shownID,
            name: this.current_product.name,
            internationalNum: this.current_product.internationalNum,
            unitPrice: this.current_product.retailPrice,
            qty_per_pack: this.current_product.qty_per_pack,
            showUnit: this.current_product.showUnit
          },
          pieces: 0,
          quantity: 0,
          price: this.current_product.retailPrice,
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
      this.details[id - 1].price = unitPrice;
      this.details[id - 1].discount = discount;
      this.details[id - 1].subTotal = subTotal;
      this.calculateTotalPrice();
    },
    calculateTotalPrice: function calculateTotalPrice() {
      this.total_price = 0;
      for (var i = 1; i <= this.details.length; i++) {
        var qty = this.details[i - 1].quantity;
        var unitPrice = this.details[i - 1].price;
        var discount = this.details[i - 1].discount;
        var subTotal = Math.round(unitPrice * qty * discount * 10000) / 10000;
        this.total_price = this.total_price + subTotal;
      }
      $('#beforePrice').val(this.total_price);
      var taxType = $('#taxType').val();
      var tax = taxType == "1" ? Math.round(this.total_price * 0.05 * 10000) / 10000 : 0;
      $('#taxPrice').val(tax);
      this.total_price = Math.round((this.total_price + tax) * 10000) / 10000;
      this.$emit('show-total-price', this.total_price);
      // console.log(this.total_price);
    },
    calculateQty: function calculateQty(id, type) {
      var qty_per_pack = $('#qty_per_pack_' + id).val();
      if (qty_per_pack === '0' || qty_per_pack === 0) {
        // 自動計算功能先關閉
        this.details[id - 1].pieces = 0;
        return;
      }
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
      var _this2 = this;
      var product_id = $('#product_id').val();
      if (product_id != 0) {
        var getProductInfo = $('#getProductInfo').html();
        $.showLoadingModal();
        $('#addDetailBtn').attr('disabled', true);
        axios.post(getProductInfo, {
          id: product_id
        }).then(function (response) {
          $.closeModal();
          _this2.current_product = response.data;
          $('#addDetailBtn').attr('disabled', false);
        })["catch"](function (error) {
          $.showErrorModal(error);
          console.error('抓取商品資料失敗，錯誤：' + error);
        });
      } else {
        alert('請選擇商品');
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['consumers', 'current_consumer', 'products', 'salesOrder', 'returnUrl'],
  data: function data() {
    return {
      total_price: 0
    };
  },
  methods: {
    getConsumerData: function getConsumerData() {
      var consumer_id = $('#consumer_id').val();
      if (consumer_id != 0) {
        this.$emit('get-consumer-data', {
          id: consumer_id
        });
      } else {
        $.showWarningModal('請選擇廠商');
        this.$emit('get-consumer-data', null);
      }
    },
    showTotalPrice: function showTotalPrice(total_price) {
      this.total_price = total_price;
    },
    changeTax: function changeTax() {
      this.$refs.returndetail.calculateTotalPrice();
    },
    updateSalesOrder: function updateSalesOrder(e) {
      var _this = this;
      // 檢查是否有新增原物料在進貨單內。
      if (this.salesOrder.details.length == 0) {
        $.showWarningModal('銷貨單必須至少要有一項產品銷貨。');
        return false;
      }

      // 1. 先創建 SalesOrder
      var url = $('#updateSalesOrder').text();
      var data = $(e.target).serialize();
      $.showLoadingModal();
      axios.patch(url, data).then(function (response) {
        // $('#salesOrderID').val(response.data.SalesOrderID);

        // 2. 編輯 SalesOrderDetail
        var detailURL = $('#updateSalesOrderDetail').text();
        var detailData = $('#SalesOrderDetailForm').serialize();
        axios.patch(detailURL, detailData).then(function (response) {
          $.showSuccessModal(response.data.message, _this.returnUrl);
        })["catch"](function (error) {
          console.error('更新銷貨單細項時發生錯誤，錯誤訊息：' + error);
          $.showErrorModal(error);
        });
      })["catch"](function (error) {
        console.error('更新銷貨單時發生錯誤，錯誤訊息：' + error);
        $.showErrorModal(error);
      });
    }
  },
  created: function created() {},
  mounted: function mounted() {
    $("#expectPay_at").datepicker({
      changeYear: true,
      changeMonth: true,
      dateFormat: 'yy-mm-dd'
    });
    $("#expectDeliver_at").datepicker({
      changeYear: true,
      changeMonth: true,
      dateFormat: 'yy-mm-dd'
    });
    $("#transaction_at").datepicker({
      changeYear: true,
      changeMonth: true,
      dateFormat: 'yy-mm-dd'
    });
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=template&id=0c7dfd0e&":
/*!**********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=template&id=0c7dfd0e& ***!
  \**********************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "col-md-12"
  }, [_c("form", {
    attrs: {
      id: "SalesOrderDetailForm",
      method: "POST",
      action: "#"
    }
  }, [_c("input", {
    attrs: {
      type: "hidden",
      id: "salesOrderID",
      name: "salesOrder_id"
    },
    domProps: {
      value: _vm.sales_order_id
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-3 mb-2"
  }, [_c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.current_search_type,
      expression: "current_search_type"
    }],
    staticClass: "form-control",
    attrs: {
      id: "product_search_type"
    },
    on: {
      change: [function ($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });
        _vm.current_search_type = $event.target.multiple ? $$selectedVal : $$selectedVal[0];
      }, _vm.onChangeSearchType]
    }
  }, [_c("option", {
    attrs: {
      value: "0"
    }
  }, [_vm._v("商品編號")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("商品名稱")])])]), _vm._v(" "), _vm.current_search_type === "0" ? _c("div", {
    staticClass: "col-md-3 mb-2"
  }, [_c("input", {
    staticClass: "form-control",
    attrs: {
      id: "searchProductIDInput",
      type: "text",
      placeholder: "請輸入商品編號..."
    },
    on: {
      input: _vm.searchProductID,
      keydown: function keydown($event) {
        if (!$event.type.indexOf("key") && _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")) return null;
        $event.preventDefault();
        return _vm.searchPressEnterKey.apply(null, arguments);
      }
    }
  }), _vm._v(" "), _vm.product_search_result.length !== 0 ? _c("div", {
    staticStyle: {
      border: "1px solid",
      "border-top": "none",
      position: "absolute",
      width: "90%",
      "z-index": "40"
    }
  }, [_c("ul", {
    staticClass: "m-0 px-0 py-2 flex flex-column",
    staticStyle: {
      "list-style": "none",
      "background-color": "#fafafa"
    }
  }, _vm._l(_vm.product_search_result, function (product, index) {
    return _c("li", {
      key: index,
      staticClass: "px-2",
      staticStyle: {
        cursor: "pointer"
      },
      on: {
        mouseover: function mouseover($event) {
          return _vm.hoverSearchProductItem($event, true);
        },
        mouseleave: function mouseleave($event) {
          return _vm.hoverSearchProductItem($event, false);
        },
        click: function click($event) {
          return _vm.selectSearchProduct(product.id);
        }
      }
    }, [_vm._v("\r\n                                " + _vm._s(product.shownID) + "\r\n                            ")]);
  }), 0)]) : _vm._e()]) : _c("div", {
    staticClass: "col-md-3 mb-2"
  }, [_c("input", {
    staticClass: "form-control",
    attrs: {
      id: "searchProductNameInput",
      type: "text",
      placeholder: "請輸入商品名稱..."
    },
    on: {
      input: _vm.searchProductName,
      keydown: function keydown($event) {
        if (!$event.type.indexOf("key") && _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")) return null;
        $event.preventDefault();
        return _vm.searchPressEnterKey.apply(null, arguments);
      }
    }
  }), _vm._v(" "), _vm.product_search_result.length !== 0 ? _c("div", {
    staticStyle: {
      border: "1px solid",
      "border-top": "none",
      position: "absolute",
      width: "90%",
      "z-index": "40"
    }
  }, [_c("ul", {
    staticClass: "m-0 px-0 py-2 flex flex-column",
    staticStyle: {
      "list-style": "none",
      "background-color": "#fafafa"
    }
  }, _vm._l(_vm.product_search_result, function (product, index) {
    return _c("li", {
      key: index,
      staticClass: "px-2",
      staticStyle: {
        cursor: "pointer"
      },
      on: {
        mouseover: function mouseover($event) {
          return _vm.hoverSearchProductItem($event, true);
        },
        mouseleave: function mouseleave($event) {
          return _vm.hoverSearchProductItem($event, false);
        },
        click: function click($event) {
          return _vm.selectSearchProduct(product.id);
        }
      }
    }, [_vm._v("\r\n                                " + _vm._s(product.name) + "\r\n                            ")]);
  }), 0)]) : _vm._e()])]), _vm._v(" "), _c("table", {
    staticClass: "table table-bordered",
    attrs: {
      width: "100%",
      cellspacing: "0"
    }
  }, [_vm._m(0), _vm._v(" "), _c("tbody", _vm._l(_vm.details, function (detail, index) {
    return _c("tr", {
      key: index
    }, [_c("td", {
      staticStyle: {
        width: "3%"
      }
    }, [_vm._v(_vm._s(index + 1))]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "18%"
      }
    }, [_vm._v("\r\n                            " + _vm._s(detail.product.shownID) + "\r\n                            "), _c("input", {
      attrs: {
        type: "hidden",
        name: "details[" + (index + 1) + "][product_id]"
      },
      domProps: {
        value: detail.product.id
      }
    })]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "18%"
      }
    }, [_vm._v("\r\n                            " + _vm._s(detail.product.name) + "\r\n                        ")]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "23%"
      }
    }, [_c("input", {
      attrs: {
        type: "hidden",
        id: "qty_per_pack_" + (index + 1)
      },
      domProps: {
        value: detail.product.qty_per_pack
      }
    }), _vm._v(" "), detail.product.qty_per_pack !== 0 ? _c("input", {
      staticClass: "form-control",
      staticStyle: {
        width: "40%",
        display: "inline-block"
      },
      attrs: {
        id: "pcs_" + (index + 1),
        type: "text",
        name: "details[" + (index + 1) + "][pieces]"
      },
      domProps: {
        value: detail.pieces
      },
      on: {
        change: function change($event) {
          _vm.calculateQty(index + 1, "p");
          _vm.calculateSubtotal(index + 1);
        }
      }
    }) : _c("input", {
      staticClass: "form-control",
      staticStyle: {
        width: "40%",
        display: "inline-block"
      },
      attrs: {
        disabled: "",
        id: "pcs_" + (index + 1),
        type: "text",
        name: "details[" + (index + 1) + "][pieces]"
      },
      domProps: {
        value: detail.pieces
      },
      on: {
        change: function change($event) {
          _vm.calculateQty(index + 1, "p");
          _vm.calculateSubtotal(index + 1);
        }
      }
    }), _vm._v(" "), _c("span", {
      staticClass: "mr-2"
    }, [_vm._v("件")]), _vm._v(" "), _c("input", {
      staticClass: "form-control",
      staticStyle: {
        width: "40%",
        display: "inline-block"
      },
      attrs: {
        id: "qty_" + (index + 1),
        type: "text",
        name: "details[" + (index + 1) + "][quantity]"
      },
      domProps: {
        value: detail.quantity
      },
      on: {
        change: function change($event) {
          _vm.calculateQty(index + 1, "q");
          _vm.calculateSubtotal(index + 1);
        }
      }
    }), _vm._v(" "), _c("span", [_vm._v(_vm._s(detail.product.showUnit))])]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "9%"
      }
    }, [_c("input", {
      staticClass: "form-control",
      attrs: {
        id: "unitPrice_" + (index + 1),
        type: "text",
        name: "details[" + (index + 1) + "][price]"
      },
      domProps: {
        value: detail.price
      },
      on: {
        change: function change($event) {
          return _vm.calculateSubtotal(index + 1);
        }
      }
    })]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "7%"
      }
    }, [_c("input", {
      staticClass: "form-control",
      attrs: {
        id: "discount_" + (index + 1),
        type: "text",
        name: "details[" + (index + 1) + "][discount]"
      },
      domProps: {
        value: detail.discount
      },
      on: {
        change: function change($event) {
          return _vm.calculateSubtotal(index + 1);
        }
      }
    })]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "10%"
      }
    }, [_c("input", {
      staticClass: "form-control",
      attrs: {
        id: "subtotal_" + (index + 1),
        type: "text",
        disabled: ""
      },
      domProps: {
        value: detail.subTotal
      }
    })]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "10%"
      }
    }, [_c("input", {
      staticClass: "form-control",
      attrs: {
        id: "comment_" + (index + 1),
        type: "text",
        name: "details[" + (index + 1) + "][comment]"
      },
      domProps: {
        value: detail.comment
      },
      on: {
        change: function change($event) {
          return _vm.updateComment(index + 1);
        }
      }
    })]), _vm._v(" "), _c("td", {
      staticStyle: {
        width: "5%"
      }
    }, [_c("button", {
      staticClass: "btn btn-md btn-danger",
      attrs: {
        type: "button"
      },
      on: {
        click: function click($event) {
          return _vm.deleteDetail(index);
        }
      }
    }, [_c("i", {
      staticClass: "far fa-trash-alt"
    })])])]);
  }), 0)])])])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("thead", [_c("tr", [_c("th", [_vm._v("編號")]), _vm._v(" "), _c("th", [_vm._v("商品編號")]), _vm._v(" "), _c("th", [_vm._v("商品名稱")]), _vm._v(" "), _c("th", [_vm._v("數量")]), _vm._v(" "), _c("th", [_vm._v("單價")]), _vm._v(" "), _c("th", [_vm._v("折數")]), _vm._v(" "), _c("th", [_vm._v("小計")]), _vm._v(" "), _c("th", [_vm._v("備註")]), _vm._v(" "), _c("th", [_vm._v("操作")])])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=template&id=524468ba&":
/*!*******************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=template&id=524468ba& ***!
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
    staticClass: "row justify-content-center"
  }, [_c("div", {
    staticClass: "col-md-11"
  }, [_c("form", {
    attrs: {
      id: "SalesOrderUpdateForm",
      method: "POST",
      action: "#"
    },
    on: {
      submit: function submit($event) {
        $event.preventDefault();
        return _vm.updateSalesOrder.apply(null, arguments);
      }
    }
  }, [_c("input", {
    attrs: {
      type: "hidden",
      name: "status",
      value: "1"
    }
  }), _vm._v(" "), _c("input", {
    attrs: {
      type: "hidden",
      name: "confirmStatus",
      value: "1"
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_vm._m(0), _vm._v(" "), _c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.salesOrder.consumer_id,
      expression: "salesOrder.consumer_id"
    }],
    staticClass: "form-control",
    attrs: {
      id: "consumer_id",
      name: "consumer_id"
    },
    on: {
      change: [function ($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });
        _vm.$set(_vm.salesOrder, "consumer_id", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }, _vm.getConsumerData]
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
  })], 2)])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-2"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "shownID"
    }
  }, [_vm._v("銷貨單編號")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.salesOrder.shown_id,
      expression: "salesOrder.shown_id"
    }],
    staticClass: "form-control",
    attrs: {
      id: "shownID",
      name: "shownID",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.salesOrder.shown_id
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.$set(_vm.salesOrder, "shown_id", $event.target.value);
      }
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-2"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_vm._m(1), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.salesOrder.transaction_at,
      expression: "salesOrder.transaction_at"
    }],
    staticClass: "form-control",
    attrs: {
      id: "transaction_at",
      name: "transaction_at",
      type: "text",
      required: ""
    },
    domProps: {
      value: _vm.salesOrder.transaction_at
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.$set(_vm.salesOrder, "transaction_at", $event.target.value);
      }
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-2"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "creator"
    }
  }, [_vm._v("建立者")]), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.salesOrder.creator,
      expression: "salesOrder.creator"
    }],
    staticClass: "form-control",
    attrs: {
      id: "creator",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.salesOrder.creator
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.$set(_vm.salesOrder, "creator", $event.target.value);
      }
    }
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "show_shortName"
    }
  }, [_vm._v("顧客簡稱")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "show_shortName",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.current_consumer.shortName || "無"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "show_act"
    }
  }, [_vm._v("帳號")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "show_act",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.current_consumer.account || "無"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "show_taxID"
    }
  }, [_vm._v("統一編號")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "show_taxID",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.current_consumer.taxID || "無"
    }
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "show_settlement"
    }
  }, [_vm._v("結算方式")]), _vm._v(" "), _c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "show_settlement",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.current_consumer.settlement || "無"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "show_uncheckedAmount"
    }
  }, [_vm._v("未沖帳金額")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "show_uncheckedAmount",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.current_consumer.uncheckedAmount || "0"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "show_totalConsumption"
    }
  }, [_vm._v("總消費額")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "show_totalConsumption",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.current_consumer.totalConsumption || "0"
    }
  })])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group",
    staticStyle: {
      height: "72%"
    }
  }, [_c("label", {
    attrs: {
      "for": "show_consumer_comment"
    }
  }, [_vm._v("顧客備註")]), _vm._v(" "), _c("textarea", {
    staticClass: "form-control",
    staticStyle: {
      height: "100%"
    },
    attrs: {
      id: "show_consumer_comment",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.current_consumer.comment || "無"
    }
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "show_companyAddress"
    }
  }, [_vm._v("地址")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "show_companyAddress",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.current_consumer.address || "無"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "show_deliveryAddress"
    }
  }, [_vm._v("送貨地址")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "show_deliveryAddress",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.current_consumer.deliveryAddress || "無"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "show_email"
    }
  }, [_vm._v("信箱")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "show_email",
      type: "text",
      readonly: ""
    },
    domProps: {
      value: _vm.current_consumer.email || "無"
    }
  })])])]), _vm._v(" "), _c("hr"), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_vm._m(2), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.salesOrder.expectPay_at,
      expression: "salesOrder.expectPay_at"
    }],
    staticClass: "form-control",
    attrs: {
      id: "expectPay_at",
      name: "expectPay_at",
      type: "text",
      required: ""
    },
    domProps: {
      value: _vm.salesOrder.expectPay_at
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.$set(_vm.salesOrder, "expectPay_at", $event.target.value);
      }
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_vm._m(3), _vm._v(" "), _c("input", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.salesOrder.expectDeliver_at,
      expression: "salesOrder.expectDeliver_at"
    }],
    staticClass: "form-control",
    attrs: {
      id: "expectDeliver_at",
      name: "expectDeliver_at",
      type: "text",
      required: ""
    },
    domProps: {
      value: _vm.salesOrder.expectDeliver_at
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.$set(_vm.salesOrder, "expectDeliver_at", $event.target.value);
      }
    }
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_vm._m(4), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_vm._m(5), _vm._v(" "), _c("select", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.salesOrder.taxType,
      expression: "salesOrder.taxType"
    }],
    staticClass: "form-control",
    attrs: {
      name: "taxType",
      id: "taxType",
      required: ""
    },
    on: {
      change: [function ($event) {
        var $$selectedVal = Array.prototype.filter.call($event.target.options, function (o) {
          return o.selected;
        }).map(function (o) {
          var val = "_value" in o ? o._value : o.value;
          return val;
        });
        _vm.$set(_vm.salesOrder, "taxType", $event.target.multiple ? $$selectedVal : $$selectedVal[0]);
      }, _vm.changeTax]
    }
  }, [_c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("應稅")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "2"
    }
  }, [_vm._v("未稅")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "3"
    }
  }, [_vm._v("免稅")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "4"
    }
  }, [_vm._v("零稅 - 經海關")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "5"
    }
  }, [_vm._v("零稅 - 非經海關")])])])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group",
    staticStyle: {
      height: "72%"
    }
  }, [_c("label", {
    attrs: {
      "for": "comment"
    }
  }, [_vm._v("訂單備註")]), _vm._v(" "), _c("textarea", {
    directives: [{
      name: "model",
      rawName: "v-model",
      value: _vm.salesOrder.comment,
      expression: "salesOrder.comment"
    }],
    staticClass: "form-control",
    staticStyle: {
      height: "100%"
    },
    attrs: {
      id: "comment",
      name: "comment",
      type: "text"
    },
    domProps: {
      value: _vm.salesOrder.comment
    },
    on: {
      input: function input($event) {
        if ($event.target.composing) return;
        _vm.$set(_vm.salesOrder, "comment", $event.target.value);
      }
    }
  })])])]), _vm._v(" "), _c("hr"), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "totalPrice",
      name: "totalPrice",
      type: "hidden"
    },
    domProps: {
      value: _vm.total_price
    }
  }), _vm._v(" "), _c("return-update-detail", {
    ref: "returndetail",
    attrs: {
      products: _vm.products,
      details: _vm.salesOrder.details,
      sales_order_id: _vm.salesOrder.id
    },
    on: {
      "show-total-price": _vm.showTotalPrice
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "row mb-2"
  }, [_vm._m(6), _vm._v(" "), _vm._m(7), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "totalTaxPrice"
    }
  }, [_vm._v("總額")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "totalTaxPrice",
      name: "totalTaxPrice",
      type: "text",
      required: "",
      readonly: ""
    },
    domProps: {
      value: _vm.total_price || "0"
    }
  })])])]), _vm._v(" "), _c("div", {
    staticClass: "form-group row justify-content-center"
  }, [_c("div", {
    staticClass: "col-md-8"
  }, [_c("button", {
    staticClass: "btn btn-block btn-primary",
    attrs: {
      type: "submit"
    }
  }, [_vm._v("\r\n                        確認修改\r\n                    ")]), _vm._v(" "), _c("a", {
    staticClass: "btn btn-block btn-danger",
    attrs: {
      href: _vm.returnUrl
    }
  }, [_vm._v("\r\n                        返回銷貨單首頁\r\n                    ")])])]), _vm._v(" "), _c("loading-modal")], 1)])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("label", {
    attrs: {
      "for": "consumer_id"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("顧客名稱\r\n                                ")]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("label", {
    attrs: {
      "for": "transaction_at"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("訂單日期\r\n                        ")]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("label", {
    attrs: {
      "for": "expectPay_at"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("預計付款日\r\n                                ")]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("label", {
    attrs: {
      "for": "expectDeliver_at"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("預計出貨日\r\n                                ")]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "invoiceType"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("發票類型\r\n                                ")]), _vm._v(" "), _c("select", {
    staticClass: "form-control",
    attrs: {
      name: "invoiceType",
      id: "invoiceType",
      required: ""
    }
  }, [_c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("三聯式")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "2"
    }
  }, [_vm._v("二聯式")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "3"
    }
  }, [_vm._v("三聯銷退折讓")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "4"
    }
  }, [_vm._v("二聯銷退折讓")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "5"
    }
  }, [_vm._v("三聯式收銀機")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "6"
    }
  }, [_vm._v("免用發票")])])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("label", {
    attrs: {
      "for": "taxType"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("稅別\r\n                                ")]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "beforePrice"
    }
  }, [_vm._v("銷貨額")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "beforePrice",
      type: "text",
      value: "0",
      required: "",
      readonly: ""
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
      "for": "taxPrice"
    }
  }, [_vm._v("稅額")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "taxPrice",
      type: "text",
      value: "0",
      required: "",
      readonly: ""
    }
  })])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--23-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--23-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.SearchHover {\r\n    color: #fff3cd;\r\n    background-color: #00BCD4;\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/lib/css-base.js":
/*!*************************************************!*\
  !*** ./node_modules/css-loader/lib/css-base.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--23-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--23-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--23-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--23-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/lib/addStyles.js":
/*!****************************************************!*\
  !*** ./node_modules/style-loader/lib/addStyles.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/

var stylesInDom = {};

var	memoize = function (fn) {
	var memo;

	return function () {
		if (typeof memo === "undefined") memo = fn.apply(this, arguments);
		return memo;
	};
};

var isOldIE = memoize(function () {
	// Test for IE <= 9 as proposed by Browserhacks
	// @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
	// Tests for existence of standard globals is to allow style-loader
	// to operate correctly into non-standard environments
	// @see https://github.com/webpack-contrib/style-loader/issues/177
	return window && document && document.all && !window.atob;
});

var getTarget = function (target, parent) {
  if (parent){
    return parent.querySelector(target);
  }
  return document.querySelector(target);
};

var getElement = (function (fn) {
	var memo = {};

	return function(target, parent) {
                // If passing function in options, then use it for resolve "head" element.
                // Useful for Shadow Root style i.e
                // {
                //   insertInto: function () { return document.querySelector("#foo").shadowRoot }
                // }
                if (typeof target === 'function') {
                        return target();
                }
                if (typeof memo[target] === "undefined") {
			var styleTarget = getTarget.call(this, target, parent);
			// Special case to return head of iframe instead of iframe itself
			if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
				try {
					// This will throw an exception if access to iframe is blocked
					// due to cross-origin restrictions
					styleTarget = styleTarget.contentDocument.head;
				} catch(e) {
					styleTarget = null;
				}
			}
			memo[target] = styleTarget;
		}
		return memo[target]
	};
})();

var singleton = null;
var	singletonCounter = 0;
var	stylesInsertedAtTop = [];

var	fixUrls = __webpack_require__(/*! ./urls */ "./node_modules/style-loader/lib/urls.js");

module.exports = function(list, options) {
	if (typeof DEBUG !== "undefined" && DEBUG) {
		if (typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
	}

	options = options || {};

	options.attrs = typeof options.attrs === "object" ? options.attrs : {};

	// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
	// tags it will allow on a page
	if (!options.singleton && typeof options.singleton !== "boolean") options.singleton = isOldIE();

	// By default, add <style> tags to the <head> element
        if (!options.insertInto) options.insertInto = "head";

	// By default, add <style> tags to the bottom of the target
	if (!options.insertAt) options.insertAt = "bottom";

	var styles = listToStyles(list, options);

	addStylesToDom(styles, options);

	return function update (newList) {
		var mayRemove = [];

		for (var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];

			domStyle.refs--;
			mayRemove.push(domStyle);
		}

		if(newList) {
			var newStyles = listToStyles(newList, options);
			addStylesToDom(newStyles, options);
		}

		for (var i = 0; i < mayRemove.length; i++) {
			var domStyle = mayRemove[i];

			if(domStyle.refs === 0) {
				for (var j = 0; j < domStyle.parts.length; j++) domStyle.parts[j]();

				delete stylesInDom[domStyle.id];
			}
		}
	};
};

function addStylesToDom (styles, options) {
	for (var i = 0; i < styles.length; i++) {
		var item = styles[i];
		var domStyle = stylesInDom[item.id];

		if(domStyle) {
			domStyle.refs++;

			for(var j = 0; j < domStyle.parts.length; j++) {
				domStyle.parts[j](item.parts[j]);
			}

			for(; j < item.parts.length; j++) {
				domStyle.parts.push(addStyle(item.parts[j], options));
			}
		} else {
			var parts = [];

			for(var j = 0; j < item.parts.length; j++) {
				parts.push(addStyle(item.parts[j], options));
			}

			stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
		}
	}
}

function listToStyles (list, options) {
	var styles = [];
	var newStyles = {};

	for (var i = 0; i < list.length; i++) {
		var item = list[i];
		var id = options.base ? item[0] + options.base : item[0];
		var css = item[1];
		var media = item[2];
		var sourceMap = item[3];
		var part = {css: css, media: media, sourceMap: sourceMap};

		if(!newStyles[id]) styles.push(newStyles[id] = {id: id, parts: [part]});
		else newStyles[id].parts.push(part);
	}

	return styles;
}

function insertStyleElement (options, style) {
	var target = getElement(options.insertInto)

	if (!target) {
		throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");
	}

	var lastStyleElementInsertedAtTop = stylesInsertedAtTop[stylesInsertedAtTop.length - 1];

	if (options.insertAt === "top") {
		if (!lastStyleElementInsertedAtTop) {
			target.insertBefore(style, target.firstChild);
		} else if (lastStyleElementInsertedAtTop.nextSibling) {
			target.insertBefore(style, lastStyleElementInsertedAtTop.nextSibling);
		} else {
			target.appendChild(style);
		}
		stylesInsertedAtTop.push(style);
	} else if (options.insertAt === "bottom") {
		target.appendChild(style);
	} else if (typeof options.insertAt === "object" && options.insertAt.before) {
		var nextSibling = getElement(options.insertAt.before, target);
		target.insertBefore(style, nextSibling);
	} else {
		throw new Error("[Style Loader]\n\n Invalid value for parameter 'insertAt' ('options.insertAt') found.\n Must be 'top', 'bottom', or Object.\n (https://github.com/webpack-contrib/style-loader#insertat)\n");
	}
}

function removeStyleElement (style) {
	if (style.parentNode === null) return false;
	style.parentNode.removeChild(style);

	var idx = stylesInsertedAtTop.indexOf(style);
	if(idx >= 0) {
		stylesInsertedAtTop.splice(idx, 1);
	}
}

function createStyleElement (options) {
	var style = document.createElement("style");

	if(options.attrs.type === undefined) {
		options.attrs.type = "text/css";
	}

	if(options.attrs.nonce === undefined) {
		var nonce = getNonce();
		if (nonce) {
			options.attrs.nonce = nonce;
		}
	}

	addAttrs(style, options.attrs);
	insertStyleElement(options, style);

	return style;
}

function createLinkElement (options) {
	var link = document.createElement("link");

	if(options.attrs.type === undefined) {
		options.attrs.type = "text/css";
	}
	options.attrs.rel = "stylesheet";

	addAttrs(link, options.attrs);
	insertStyleElement(options, link);

	return link;
}

function addAttrs (el, attrs) {
	Object.keys(attrs).forEach(function (key) {
		el.setAttribute(key, attrs[key]);
	});
}

function getNonce() {
	if (false) {}

	return __webpack_require__.nc;
}

function addStyle (obj, options) {
	var style, update, remove, result;

	// If a transform function was defined, run it on the css
	if (options.transform && obj.css) {
	    result = typeof options.transform === 'function'
		 ? options.transform(obj.css) 
		 : options.transform.default(obj.css);

	    if (result) {
	    	// If transform returns a value, use that instead of the original css.
	    	// This allows running runtime transformations on the css.
	    	obj.css = result;
	    } else {
	    	// If the transform function returns a falsy value, don't add this css.
	    	// This allows conditional loading of css
	    	return function() {
	    		// noop
	    	};
	    }
	}

	if (options.singleton) {
		var styleIndex = singletonCounter++;

		style = singleton || (singleton = createStyleElement(options));

		update = applyToSingletonTag.bind(null, style, styleIndex, false);
		remove = applyToSingletonTag.bind(null, style, styleIndex, true);

	} else if (
		obj.sourceMap &&
		typeof URL === "function" &&
		typeof URL.createObjectURL === "function" &&
		typeof URL.revokeObjectURL === "function" &&
		typeof Blob === "function" &&
		typeof btoa === "function"
	) {
		style = createLinkElement(options);
		update = updateLink.bind(null, style, options);
		remove = function () {
			removeStyleElement(style);

			if(style.href) URL.revokeObjectURL(style.href);
		};
	} else {
		style = createStyleElement(options);
		update = applyToTag.bind(null, style);
		remove = function () {
			removeStyleElement(style);
		};
	}

	update(obj);

	return function updateStyle (newObj) {
		if (newObj) {
			if (
				newObj.css === obj.css &&
				newObj.media === obj.media &&
				newObj.sourceMap === obj.sourceMap
			) {
				return;
			}

			update(obj = newObj);
		} else {
			remove();
		}
	};
}

var replaceText = (function () {
	var textStore = [];

	return function (index, replacement) {
		textStore[index] = replacement;

		return textStore.filter(Boolean).join('\n');
	};
})();

function applyToSingletonTag (style, index, remove, obj) {
	var css = remove ? "" : obj.css;

	if (style.styleSheet) {
		style.styleSheet.cssText = replaceText(index, css);
	} else {
		var cssNode = document.createTextNode(css);
		var childNodes = style.childNodes;

		if (childNodes[index]) style.removeChild(childNodes[index]);

		if (childNodes.length) {
			style.insertBefore(cssNode, childNodes[index]);
		} else {
			style.appendChild(cssNode);
		}
	}
}

function applyToTag (style, obj) {
	var css = obj.css;
	var media = obj.media;

	if(media) {
		style.setAttribute("media", media)
	}

	if(style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		while(style.firstChild) {
			style.removeChild(style.firstChild);
		}

		style.appendChild(document.createTextNode(css));
	}
}

function updateLink (link, options, obj) {
	var css = obj.css;
	var sourceMap = obj.sourceMap;

	/*
		If convertToAbsoluteUrls isn't defined, but sourcemaps are enabled
		and there is no publicPath defined then lets turn convertToAbsoluteUrls
		on by default.  Otherwise default to the convertToAbsoluteUrls option
		directly
	*/
	var autoFixUrls = options.convertToAbsoluteUrls === undefined && sourceMap;

	if (options.convertToAbsoluteUrls || autoFixUrls) {
		css = fixUrls(css);
	}

	if (sourceMap) {
		// http://stackoverflow.com/a/26603875
		css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
	}

	var blob = new Blob([css], { type: "text/css" });

	var oldSrc = link.href;

	link.href = URL.createObjectURL(blob);

	if(oldSrc) URL.revokeObjectURL(oldSrc);
}


/***/ }),

/***/ "./node_modules/style-loader/lib/urls.js":
/*!***********************************************!*\
  !*** ./node_modules/style-loader/lib/urls.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {


/**
 * When source maps are enabled, `style-loader` uses a link element with a data-uri to
 * embed the css on the page. This breaks all relative urls because now they are relative to a
 * bundle instead of the current page.
 *
 * One solution is to only use full urls, but that may be impossible.
 *
 * Instead, this function "fixes" the relative urls to be absolute according to the current page location.
 *
 * A rudimentary test suite is located at `test/fixUrls.js` and can be run via the `npm test` command.
 *
 */

module.exports = function (css) {
  // get current location
  var location = typeof window !== "undefined" && window.location;

  if (!location) {
    throw new Error("fixUrls requires window.location");
  }

	// blank or null?
	if (!css || typeof css !== "string") {
	  return css;
  }

  var baseUrl = location.protocol + "//" + location.host;
  var currentDir = baseUrl + location.pathname.replace(/\/[^\/]*$/, "/");

	// convert each url(...)
	/*
	This regular expression is just a way to recursively match brackets within
	a string.

	 /url\s*\(  = Match on the word "url" with any whitespace after it and then a parens
	   (  = Start a capturing group
	     (?:  = Start a non-capturing group
	         [^)(]  = Match anything that isn't a parentheses
	         |  = OR
	         \(  = Match a start parentheses
	             (?:  = Start another non-capturing groups
	                 [^)(]+  = Match anything that isn't a parentheses
	                 |  = OR
	                 \(  = Match a start parentheses
	                     [^)(]*  = Match anything that isn't a parentheses
	                 \)  = Match a end parentheses
	             )  = End Group
              *\) = Match anything and then a close parens
          )  = Close non-capturing group
          *  = Match anything
       )  = Close capturing group
	 \)  = Match a close parens

	 /gi  = Get all matches, not the first.  Be case insensitive.
	 */
	var fixedCss = css.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function(fullMatch, origUrl) {
		// strip quotes (if they exist)
		var unquotedOrigUrl = origUrl
			.trim()
			.replace(/^"(.*)"$/, function(o, $1){ return $1; })
			.replace(/^'(.*)'$/, function(o, $1){ return $1; });

		// already a full url? no change
		if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/|\s*$)/i.test(unquotedOrigUrl)) {
		  return fullMatch;
		}

		// convert the url to a full url
		var newUrl;

		if (unquotedOrigUrl.indexOf("//") === 0) {
		  	//TODO: should we add protocol?
			newUrl = unquotedOrigUrl;
		} else if (unquotedOrigUrl.indexOf("/") === 0) {
			// path should be relative to the base url
			newUrl = baseUrl + unquotedOrigUrl; // already starts with '/'
		} else {
			// path should be relative to current directory
			newUrl = currentDir + unquotedOrigUrl.replace(/^\.\//, ""); // Strip leading './'
		}

		// send back the fixed url(...)
		return "url(" + JSON.stringify(newUrl) + ")";
	});

	// send back the fixed css
	return fixedCss;
};


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

/***/ "./resources/js/components/Orders/ReturnUpdateDetail.vue":
/*!***************************************************************!*\
  !*** ./resources/js/components/Orders/ReturnUpdateDetail.vue ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ReturnUpdateDetail_vue_vue_type_template_id_0c7dfd0e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ReturnUpdateDetail.vue?vue&type=template&id=0c7dfd0e& */ "./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=template&id=0c7dfd0e&");
/* harmony import */ var _ReturnUpdateDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ReturnUpdateDetail.vue?vue&type=script&lang=js& */ "./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _ReturnUpdateDetail_vue_vue_type_style_index_0_id_0c7dfd0e_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css& */ "./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _ReturnUpdateDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ReturnUpdateDetail_vue_vue_type_template_id_0c7dfd0e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ReturnUpdateDetail_vue_vue_type_template_id_0c7dfd0e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Orders/ReturnUpdateDetail.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnUpdateDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ReturnUpdateDetail.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnUpdateDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css&":
/*!************************************************************************************************************!*\
  !*** ./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css& ***!
  \************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnUpdateDetail_vue_vue_type_style_index_0_id_0c7dfd0e_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--23-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--23-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=style&index=0&id=0c7dfd0e&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnUpdateDetail_vue_vue_type_style_index_0_id_0c7dfd0e_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnUpdateDetail_vue_vue_type_style_index_0_id_0c7dfd0e_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnUpdateDetail_vue_vue_type_style_index_0_id_0c7dfd0e_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnUpdateDetail_vue_vue_type_style_index_0_id_0c7dfd0e_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=template&id=0c7dfd0e&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=template&id=0c7dfd0e& ***!
  \**********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnUpdateDetail_vue_vue_type_template_id_0c7dfd0e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./ReturnUpdateDetail.vue?vue&type=template&id=0c7dfd0e& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/ReturnUpdateDetail.vue?vue&type=template&id=0c7dfd0e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnUpdateDetail_vue_vue_type_template_id_0c7dfd0e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_ReturnUpdateDetail_vue_vue_type_template_id_0c7dfd0e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Orders/SalesUpdateForm.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/Orders/SalesUpdateForm.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SalesUpdateForm_vue_vue_type_template_id_524468ba___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SalesUpdateForm.vue?vue&type=template&id=524468ba& */ "./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=template&id=524468ba&");
/* harmony import */ var _SalesUpdateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SalesUpdateForm.vue?vue&type=script&lang=js& */ "./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SalesUpdateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SalesUpdateForm_vue_vue_type_template_id_524468ba___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SalesUpdateForm_vue_vue_type_template_id_524468ba___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Orders/SalesUpdateForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SalesUpdateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./SalesUpdateForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SalesUpdateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=template&id=524468ba&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=template&id=524468ba& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_SalesUpdateForm_vue_vue_type_template_id_524468ba___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./SalesUpdateForm.vue?vue&type=template&id=524468ba& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Orders/SalesUpdateForm.vue?vue&type=template&id=524468ba&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_SalesUpdateForm_vue_vue_type_template_id_524468ba___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_SalesUpdateForm_vue_vue_type_template_id_524468ba___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/orders/sales/edit.js":
/*!*******************************************!*\
  !*** ./resources/js/orders/sales/edit.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('sales-update-form', __webpack_require__(/*! ./../../components/Orders/SalesUpdateForm.vue */ "./resources/js/components/Orders/SalesUpdateForm.vue")["default"]);
Vue.component('return-update-detail', __webpack_require__(/*! ./../../components/Orders/ReturnUpdateDetail.vue */ "./resources/js/components/Orders/ReturnUpdateDetail.vue")["default"]);
var app = new Vue({
  el: '#sales',
  data: function data() {
    return {
      consumers: [],
      current_consumer: [],
      products: [],
      salesOrder: []
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
    var getSalesOrderInfo = $('#getSalesOrderInfo').text();
    $.showLoadingModal();
    axios.get(getSalesOrderInfo).then(function (response) {
      _this2.salesOrder = response.data.salesOrder;
      _this2.salesOrder.details = response.data.details;
      $('#consumer_id').val(_this2.salesOrder.consumer_id);
      _this2.getConsumerData({
        id: _this2.salesOrder.consumer_id
      });

      // 計算金額
      var $total_price = 0;
      for (var i = 1; i <= _this2.salesOrder.details.length; i++) {
        var qty = _this2.salesOrder.details[i - 1].quantity;
        var price = _this2.salesOrder.details[i - 1].price;
        var discount = _this2.salesOrder.details[i - 1].discount;
        var subTotal = Math.round(price * qty * discount * 10000) / 10000;
        $total_price = $total_price + subTotal;
      }
      $('#beforePrice').val($total_price);
      var taxType = _this2.salesOrder.taxType;
      var tax = taxType == "1" ? Math.round($total_price * 0.05 * 10000) / 10000 : 0;
      $('#tax_price').val(tax);
      $total_price = Math.round(($total_price + tax) * 10000) / 10000;
      _this2.$refs.salesOrderform.showTotalPrice($total_price);
      $.closeModal();
    });
  }
});

/***/ }),

/***/ 32:
/*!*************************************************!*\
  !*** multi ./resources/js/orders/sales/edit.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\orders\sales\edit.js */"./resources/js/orders/sales/edit.js");


/***/ })

/******/ });