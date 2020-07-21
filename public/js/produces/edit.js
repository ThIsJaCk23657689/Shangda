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
/******/ 	return __webpack_require__(__webpack_require__.s = 21);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['materials'],
  data: function data() {
    return {
      details: [],
      current_material: []
    };
  },
  methods: {
    // 取得原物料資料
    getMaterialData: function getMaterialData() {
      var _this = this;

      var material_id = $('#material_id').val();

      if (material_id != 0) {
        var getMeterialInfo = $('#getMeterialInfo').html();
        $('#addMaterialBtn').attr('disabled', true);
        axios.post(getMeterialInfo, {
          id: material_id
        }).then(function (response) {
          _this.current_material = response.data;
          $('#addMaterialBtn').attr('disabled', false);
        });
      } else {
        this.current_material = [];
      }
    },
    // 新增原物料細項
    addDetail: function addDetail() {
      var material_id = $('#material_id').val();

      if (material_id == 0) {
        $.showWarningModal("請先選擇原物料!");
      } else {
        this.$emit('refresh-materials', {
          id: material_id - 1,
          type: 'add'
        });

        if (this.current_material.length != 0) {
          this.details.push({
            count: this.details.length,
            material: {
              id: this.current_material.id,
              name: this.current_material.name,
              unit: this.current_material.unit,
              showUnit: this.current_material.showUnit,
              showSafeQty: this.current_material.showSafeQty
            },
            currentQty: this.current_material.showStock,
            quantity: 0,
            afterQty: this.current_material.showStock
          });
          this.current_material = [];
        } else {
          $.showWarningModal('請選擇原物料');
        }
      }
    },
    // 刪除原物料細項
    deleteDetail: function deleteDetail(id) {
      this.details.splice(id, 1);
      this.$emit('refresh-materials', {
        id: $('#materialID_' + (id + 1)).val(),
        type: 'deleted'
      });
    },
    // 計算原物料減量
    calculateAfterQty: function calculateAfterQty(id) {
      var currentQty = parseFloat($('#currentQty_' + id).val());
      var quantity, afterQty;

      if ($.isFloatOrInt($('#quantity_' + id))) {
        quantity = parseFloat($('#quantity_' + id).val());

        if (quantity > currentQty) {
          console.log(quantity > currentQty);
          $.showWarningModal('原物料庫存不足！');
          $('#quantity_' + id).val(0);
          afterQty = parseFloat(Math.round(currentQty * 10000) / 10000);
          this.details[id - 1].quantity = 0;
        } else {
          afterQty = parseFloat(Math.round((currentQty - quantity) * 10000) / 10000);
          this.details[id - 1].quantity = quantity;
        }
      } else {
        $('#quantity_' + id).val(0);
        afterQty = parseFloat(Math.round(currentQty * 10000) / 10000);
        this.details[id - 1].quantity = 0;
      }

      $('#afterQty_' + id).val(afterQty);
      this.details[id - 1].afterQty = afterQty;
    },
    setDetails: function setDetails($details) {
      this.details = $details;
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['products'],
  data: function data() {
    return {
      details: [],
      current_product: []
    };
  },
  methods: {
    // 取得商品資料
    getProductData: function getProductData() {
      var _this = this;

      var product_id = $('#product_id').val();

      if (product_id != 0) {
        var getProductsInfo = $('#getProductsInfo').html();
        $('#addProductBtn').attr('disabled', true);
        axios.post(getProductsInfo, {
          id: product_id
        }).then(function (response) {
          _this.current_product = response.data;
          $('#addProductBtn').attr('disabled', false);
        });
      } else {
        this.current_product = [];
      }
    },
    // 新增商品細項
    addDetail: function addDetail() {
      var product_id = $('#product_id').val();

      if (product_id == 0) {
        $.showWarningModal('請先選擇商品!');
      } else {
        this.$emit('refresh-products', {
          id: product_id - 1,
          type: 'add'
        });

        if (this.current_product.length != 0) {
          this.details.push({
            count: this.details.length,
            product: {
              id: this.current_product.id,
              name: this.current_product.name,
              unit: this.current_product.unit,
              showUnit: this.current_product.showUnit,
              safeQuantity: this.current_product.safeQuantity
            },
            currentQty: this.current_product.quantity,
            quantity: 0,
            afterQty: this.current_product.quantity
          });
          this.current_product = [];
        } else {
          $.showWarningModal('請先選擇商品!');
        }
      }
    },
    // 刪除商品細項
    deleteDetail: function deleteDetail(id) {
      this.details.splice(id, 1);
      this.$emit('refresh-products', {
        id: $('#productID_' + (id + 1)).val(),
        type: 'deleted'
      });
    },
    // 計算商品的增量
    calculateAfterQty: function calculateAfterQty(id) {
      var currentQty = parseFloat($('#p_currentQty_' + id).val());
      var quantity, afterQty;

      if ($.isFloatOrInt($('#p_quantity_' + id))) {
        quantity = parseFloat($('#p_quantity_' + id).val());
        afterQty = parseFloat(Math.round((currentQty + quantity) * 10000) / 10000);
        this.details[id - 1].quantity = quantity;
      } else {
        $('#p_quantity_' + id).val(0);
        afterQty = parseFloat(Math.round(currentQty * 10000) / 10000);
        this.details[id - 1].quantity = 0;
      }

      $('#p_afterQty_' + id).val(afterQty);
      this.details[id - 1].afterQty = afterQty;
    },
    setDetails: function setDetails($details) {
      this.details = $details;
    }
  },
  created: function created() {},
  mounted: function mounted() {// console.log('ProducesDetail.vue mounted.');
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=script&lang=js& ***!
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['products', 'materials', 'produce'],
  data: function data() {
    return {
      getProducesIndex: $('#getProducesIndex').text(),
      updateProduce: $('#updateProduce').text()
    };
  },
  methods: {
    refreshMaterials: function refreshMaterials(data) {
      this.$emit('refresh-materials', data);
    },
    refreshProducts: function refreshProducts(data) {
      this.$emit('refresh-products', data);
    },
    // 遞交Produce Update Form
    updateProduceForm: function updateProduceForm(e) {
      var _this = this;

      if (this.$refs.ProducesMaterialsDetail.details.length == 0) {
        $.showWarningModal("不可沒有所消耗的原物料!");
        return false;
      }

      if (this.$refs.ProducesProductsDetail.details.length == 0) {
        $.showWarningModal("不可沒有所產出的商品!");
        return false;
      }

      if (!this.checkNoZeroQty(this.$refs.ProducesMaterialsDetail.details) || !this.checkNoZeroQty(this.$refs.ProducesProductsDetail.details)) {
        $.showWarningModal("不得有0投入的原物料或者0產出商品的存在！");
        return false;
      }

      $.showLoadingModal();
      var url = this.updateProduce;
      var data = $(e.target).serialize();
      axios.patch(url, data).then(function (response) {
        $('#m_produceID').val(response.data.produce_id);
        $('#p_produceID').val(response.data.produce_id);
        var detail_url = $('#updateProduceDetail').text();
        var detail_data = {
          produce_id: response.data.produce_id,
          material_details: _this.$refs.ProducesMaterialsDetail.details,
          product_details: _this.$refs.ProducesProductsDetail.details
        };
        axios.patch(detail_url, detail_data).then(function (response) {
          $.showSuccessModal(response.data.message, response.data.url); // location.href = $('#getProducesIndex').html();
        })["catch"](function (error) {
          console.error('新增庫存細項時發生錯誤，錯誤訊息：' + error);
          $.showErrorModal(error);
        });
      })["catch"](function (error) {
        console.error('新增商品庫存時發生錯誤，錯誤訊息：' + error);
        $.showErrorModal(error);
      });
    },
    checkNoZeroQty: function checkNoZeroQty($details) {
      var result = true;

      for (var i = 0; i < $details.length; i++) {
        if ($details[i].quantity == 0) {
          result = false;
          break;
        }
      }

      return result;
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=template&id=31596259&":
/*!***********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=template&id=31596259& ***!
  \***********************************************************************************************************************************************************************************************************************************/
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
          attrs: {
            id: "ProduceMaterialsDetailForm",
            method: "POST",
            action: "#"
          }
        },
        [
          _c("input", {
            attrs: {
              type: "hidden",
              id: "m_produceID",
              name: "produce_id",
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
                  _vm._l(_vm.materials, function(material) {
                    return _c(
                      "option",
                      { key: material.id, domProps: { value: material.id } },
                      [_vm._v(_vm._s(material.name))]
                    )
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
                  attrs: { id: "addMaterialBtn", type: "button" },
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
                    _c("td", [_vm._v(_vm._s(index + 1))]),
                    _vm._v(" "),
                    _c("td", [
                      _vm._v(
                        "\r\n                            " +
                          _vm._s(detail.material.name)
                      ),
                      _c("br"),
                      _vm._v(" "),
                      detail.material.safeQuantity >
                      detail.currentQty - detail.quantity
                        ? _c("span", { staticClass: "badge badge-warning" }, [
                            _vm._v("庫存警告")
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          id: "materialID_" + (index + 1),
                          name: "details[" + (index + 1) + "][material_id]"
                        },
                        domProps: { value: detail.material.id }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        staticClass: "form-control mr-2",
                        staticStyle: { width: "60%", display: "inline-block" },
                        attrs: {
                          id: "currentQty_" + (index + 1),
                          type: "text",
                          disabled: ""
                        },
                        domProps: { value: detail.currentQty }
                      }),
                      _vm._v(" "),
                      _c("span", [_vm._v(_vm._s(detail.material.showUnit))])
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        staticClass: "form-control mr-2",
                        staticStyle: { width: "60%", display: "inline-block" },
                        attrs: {
                          id: "quantity_" + (index + 1),
                          type: "text",
                          name: "details[" + (index + 1) + "][quantity]"
                        },
                        domProps: { value: detail.quantity },
                        on: {
                          change: function($event) {
                            return _vm.calculateAfterQty(index + 1)
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("span", [_vm._v(_vm._s(detail.material.showUnit))])
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        staticClass: "form-control mr-2",
                        staticStyle: { width: "60%", display: "inline-block" },
                        attrs: {
                          id: "afterQty_" + (index + 1),
                          type: "text",
                          disabled: ""
                        },
                        domProps: { value: detail.afterQty }
                      }),
                      _vm._v(" "),
                      _c("span", [_vm._v(_vm._s(detail.material.showUnit))])
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
        _c("th", [_vm._v("消耗前存量")]),
        _vm._v(" "),
        _c("th", [_vm._v("消耗量")]),
        _vm._v(" "),
        _c("th", [_vm._v("剩餘量")]),
        _vm._v(" "),
        _c("th", [_vm._v("操作")])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=template&id=cbbf786e&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=template&id=cbbf786e& ***!
  \**********************************************************************************************************************************************************************************************************************************/
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
          attrs: {
            id: "ProduceProductsDetailForm",
            method: "POST",
            action: "#"
          }
        },
        [
          _c("input", {
            attrs: {
              type: "hidden",
              id: "p_produceID",
              name: "produce_id",
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
                  _vm._l(_vm.products, function(product) {
                    return _c(
                      "option",
                      { key: product.id, domProps: { value: product.id } },
                      [_vm._v(_vm._s(product.name))]
                    )
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
                    _c("td", [_vm._v(_vm._s(index + 1))]),
                    _vm._v(" "),
                    _c("td", [
                      _vm._v(
                        "\r\n                            " +
                          _vm._s(detail.product.name)
                      ),
                      _c("br"),
                      _vm._v(" "),
                      detail.product.safeQuantity >
                      detail.currentQty + detail.quantity
                        ? _c("span", { staticClass: "badge badge-warning" }, [
                            _vm._v("庫存警告")
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _c("input", {
                        attrs: {
                          type: "hidden",
                          id: "p_productID_" + (index + 1),
                          name: "details[" + (index + 1) + "][product_id]"
                        },
                        domProps: { value: detail.product.id }
                      })
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        staticClass: "form-control mr-2",
                        staticStyle: { width: "60%", display: "inline-block" },
                        attrs: {
                          id: "p_currentQty_" + (index + 1),
                          type: "text",
                          disabled: ""
                        },
                        domProps: { value: detail.currentQty }
                      }),
                      _vm._v(" "),
                      _c("span", [_vm._v(_vm._s(detail.product.showUnit))])
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        staticClass: "form-control mr-2",
                        staticStyle: { width: "60%", display: "inline-block" },
                        attrs: {
                          id: "p_quantity_" + (index + 1),
                          type: "text",
                          name: "details[" + (index + 1) + "][quantity]"
                        },
                        domProps: { value: detail.quantity },
                        on: {
                          change: function($event) {
                            return _vm.calculateAfterQty(index + 1)
                          }
                        }
                      }),
                      _vm._v(" "),
                      _c("span", [_vm._v(_vm._s(detail.product.showUnit))])
                    ]),
                    _vm._v(" "),
                    _c("td", [
                      _c("input", {
                        staticClass: "form-control mr-2",
                        staticStyle: { width: "60%", display: "inline-block" },
                        attrs: {
                          id: "p_afterQty_" + (index + 1),
                          type: "text",
                          disabled: ""
                        },
                        domProps: { value: detail.afterQty }
                      }),
                      _vm._v(" "),
                      _c("span", [_vm._v(_vm._s(detail.product.showUnit))])
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
        _c("th", [_vm._v("產前量")]),
        _vm._v(" "),
        _c("th", [_vm._v("增加量")]),
        _vm._v(" "),
        _c("th", [_vm._v("產後量")]),
        _vm._v(" "),
        _c("th", [_vm._v("操作")])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=template&id=529b1821&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=template&id=529b1821& ***!
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
    _c("div", { staticClass: "col-md-10" }, [
      _c(
        "form",
        {
          attrs: { id: "ProduceUpdateForm", method: "POST", action: "#" },
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.updateProduceForm($event)
            }
          }
        },
        [
          _vm._m(0),
          _vm._v(" "),
          _c("produces-materials-detail", {
            ref: "ProducesMaterialsDetail",
            attrs: { materials: _vm.materials },
            on: { "refresh-materials": _vm.refreshMaterials }
          }),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          _vm._m(1),
          _vm._v(" "),
          _c("produces-products-detail", {
            ref: "ProducesProductsDetail",
            attrs: { products: _vm.products },
            on: { "refresh-products": _vm.refreshProducts }
          }),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          _c("div", { staticClass: "form-group row justify-content-center" }, [
            _c("div", { staticClass: "col-md-8" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-block btn-success",
                  attrs: { type: "submit" }
                },
                [
                  _vm._v(
                    "\r\n                        確認修改\r\n                    "
                  )
                ]
              ),
              _vm._v(" "),
              _c(
                "a",
                {
                  staticClass: "btn btn-block btn-danger",
                  attrs: { href: _vm.getProducesIndex }
                },
                [
                  _vm._v(
                    "\r\n                        返回上一頁\r\n                    "
                  )
                ]
              )
            ])
          ])
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
    return _c("div", { staticClass: "row", attrs: { id: "step1" } }, [
      _c("div", { staticClass: "col-md-12 mb-2" }, [
        _c("h4", [_vm._v("1. 投入原物料")]),
        _vm._v(" "),
        _c("small", [_vm._v("請輸入投入原料數量")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "row", attrs: { id: "step2" } }, [
      _c("div", { staticClass: "col-md-12 mb-2" }, [
        _c("h4", [_vm._v("2. 產出商品")]),
        _vm._v(" "),
        _c("small", [_vm._v("請輸入產出商品數量")])
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

/***/ "./resources/js/components/Produces/ProducesMaterialsDetail.vue":
/*!**********************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesMaterialsDetail.vue ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProducesMaterialsDetail_vue_vue_type_template_id_31596259___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProducesMaterialsDetail.vue?vue&type=template&id=31596259& */ "./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=template&id=31596259&");
/* harmony import */ var _ProducesMaterialsDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProducesMaterialsDetail.vue?vue&type=script&lang=js& */ "./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProducesMaterialsDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProducesMaterialsDetail_vue_vue_type_template_id_31596259___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProducesMaterialsDetail_vue_vue_type_template_id_31596259___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Produces/ProducesMaterialsDetail.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesMaterialsDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProducesMaterialsDetail.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesMaterialsDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=template&id=31596259&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=template&id=31596259& ***!
  \*****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesMaterialsDetail_vue_vue_type_template_id_31596259___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProducesMaterialsDetail.vue?vue&type=template&id=31596259& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesMaterialsDetail.vue?vue&type=template&id=31596259&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesMaterialsDetail_vue_vue_type_template_id_31596259___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesMaterialsDetail_vue_vue_type_template_id_31596259___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Produces/ProducesProductsDetail.vue":
/*!*********************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesProductsDetail.vue ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProducesProductsDetail_vue_vue_type_template_id_cbbf786e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProducesProductsDetail.vue?vue&type=template&id=cbbf786e& */ "./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=template&id=cbbf786e&");
/* harmony import */ var _ProducesProductsDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProducesProductsDetail.vue?vue&type=script&lang=js& */ "./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProducesProductsDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProducesProductsDetail_vue_vue_type_template_id_cbbf786e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProducesProductsDetail_vue_vue_type_template_id_cbbf786e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Produces/ProducesProductsDetail.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesProductsDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProducesProductsDetail.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesProductsDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=template&id=cbbf786e&":
/*!****************************************************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=template&id=cbbf786e& ***!
  \****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesProductsDetail_vue_vue_type_template_id_cbbf786e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProducesProductsDetail.vue?vue&type=template&id=cbbf786e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesProductsDetail.vue?vue&type=template&id=cbbf786e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesProductsDetail_vue_vue_type_template_id_cbbf786e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesProductsDetail_vue_vue_type_template_id_cbbf786e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Produces/ProducesUpdateForm.vue":
/*!*****************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesUpdateForm.vue ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProducesUpdateForm_vue_vue_type_template_id_529b1821___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProducesUpdateForm.vue?vue&type=template&id=529b1821& */ "./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=template&id=529b1821&");
/* harmony import */ var _ProducesUpdateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProducesUpdateForm.vue?vue&type=script&lang=js& */ "./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProducesUpdateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProducesUpdateForm_vue_vue_type_template_id_529b1821___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProducesUpdateForm_vue_vue_type_template_id_529b1821___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Produces/ProducesUpdateForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesUpdateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProducesUpdateForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesUpdateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=template&id=529b1821&":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=template&id=529b1821& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesUpdateForm_vue_vue_type_template_id_529b1821___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProducesUpdateForm.vue?vue&type=template&id=529b1821& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesUpdateForm.vue?vue&type=template&id=529b1821&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesUpdateForm_vue_vue_type_template_id_529b1821___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesUpdateForm_vue_vue_type_template_id_529b1821___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/produces/edit.js":
/*!***************************************!*\
  !*** ./resources/js/produces/edit.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('produces-update-form', __webpack_require__(/*! ./../components/Produces/ProducesUpdateForm.vue */ "./resources/js/components/Produces/ProducesUpdateForm.vue")["default"]);
Vue.component('produces-materials-detail', __webpack_require__(/*! ./../components/Produces/ProducesMaterialsDetail.vue */ "./resources/js/components/Produces/ProducesMaterialsDetail.vue")["default"]);
Vue.component('produces-products-detail', __webpack_require__(/*! ./../components/Produces/ProducesProductsDetail.vue */ "./resources/js/components/Produces/ProducesProductsDetail.vue")["default"]);
var app = new Vue({
  el: '#Produces',
  data: function data() {
    return {
      products: [],
      all_products: [],
      products_disabled: [],
      materials: [],
      all_materials: [],
      materials_disabled: [],
      produce: []
    };
  },
  methods: {
    // 更新原物料清單
    refreshMaterials: function refreshMaterials(data) {
      this.materials = this.all_materials;

      if (data.type == 'add') {
        this.materials_disabled.push({
          id: this.materials[data.id].id,
          name: this.materials[data.id].name
        });
      } else {
        var index;

        for (var i = 0; i < this.materials_disabled.length; i++) {
          if (this.materials_disabled[i].id == data.id) {
            index = i;
            break;
          }
        }

        this.materials_disabled.splice(index, 1);
      }

      this.materials = [];

      for (var _i = 0; _i < this.all_materials.length; _i++) {
        var canAdd = true;

        for (var j = 0; j < this.materials_disabled.length; j++) {
          if (this.all_materials[_i].id == this.materials_disabled[j].id) {
            canAdd = false;
          }
        }

        if (canAdd) {
          this.materials.push(this.all_materials[_i]);
        }
      }
    },
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

      for (var _i2 = 0; _i2 < this.all_products.length; _i2++) {
        var canAdd = true;

        for (var j = 0; j < this.products_disabled.length; j++) {
          if (this.all_products[_i2].id == this.products_disabled[j].id) {
            canAdd = false;
          }
        }

        if (canAdd) {
          this.products.push(this.all_products[_i2]);
        }
      }
    }
  },
  created: function created() {
    var _this = this;

    $.showLoadingModal(); // 取得所有商品列表(id與name)

    var getProductsName = $('#getProductsName').text();
    axios.get(getProductsName).then(function (response) {
      _this.products = response.data;
      _this.all_products = _this.products;
    }); // 取得所有原物料列表(id與name)

    var getMeterialsName = $('#getMeterialsName').text();
    axios.get(getMeterialsName).then(function (response) {
      _this.materials = response.data;
      _this.all_materials = _this.materials;
    }); // 取得欲要修改的produce資料。

    var getProducesData = $('#getProducesData').text();
    axios.get(getProducesData).then(function (response) {
      _this.produce = response.data.produce;
      var update_form = _this.$refs.ProduceUpdateForm;
      update_form.$refs.ProducesMaterialsDetail.setDetails(_this.produce.produce_details);
      update_form.$refs.ProducesProductsDetail.setDetails(_this.produce.produce_products);
      $.closeModal();
    });
  },
  mounted: function mounted() {}
});

/***/ }),

/***/ 21:
/*!*********************************************!*\
  !*** multi ./resources/js/produces/edit.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\produces\edit.js */"./resources/js/produces/edit.js");


/***/ })

/******/ });