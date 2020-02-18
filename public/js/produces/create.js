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
/******/ 	return __webpack_require__(__webpack_require__.s = 14);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=script&lang=js& ***!
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  props: ['products', 'current_product', 'materials'],
  mounted: function mounted() {
    console.log('ProducesCreateForm.vue mounted.'); // 庫存細項 表單程式碼

    $('#ProduceDetailForm').submit(function (e) {
      e.preventDefault();
      var url = $('#createProduceDetail').html();
      var data = $(this).serialize();
      axios.post(url, data).then(function (response) {
        // console.log(response);
        alert("新增成功！" + response.data.massenge);
        location.href = $('#getProducesIndex').html();
      })["catch"](function (error) {
        console.error('新增庫存細項時發生錯誤，錯誤訊息：' + error);
      });
    });
  },
  data: function data() {
    return {
      getProducesIndex: $('#getProducesIndex').html(),
      createProduce: $('#createProduce').html()
    };
  },
  methods: {
    refreshMaterials: function refreshMaterials(data) {
      this.$emit('refresh-materials', data);
    },
    // 取得商品資料 => 觸發監聽事件:get-product-data，並回傳所選擇的商品id到父元件
    getProductData: function getProductData() {
      var product_id = $('#product_id').val();

      if (product_id != 0) {
        this.$emit('get-product-data', {
          id: product_id
        });
      } else {
        alert('請選擇商品');
      }
    },
    // 觸發事件：當"庫存增量數量"欄位被更動時
    // 試算商品庫存：目前庫存 + 增加量 = 最終庫存 (四捨五入到小數點後4位)
    calculateProductAfterQty: function calculateProductAfterQty() {
      if ($('#product_id').val() == "0") {
        alert("請先選擇商品!");
        $('#product_quantity').val(0);
      } else if ($.isFloatOrInt($('#product_quantity'))) {
        var currentQty = parseFloat($('#product_currentQty').val());
        var qty = parseFloat($('#product_quantity').val());
        var afterQty = parseFloat(Math.round((currentQty + qty) * 10000) / 10000);
        $('#product_afterQty').val(afterQty);
      } else {
        var _afterQty = parseFloat($('#product_currentQty').val());

        $('#product_afterQty').val(_afterQty);
      }
    },
    // 遞交Produce Create Form
    submitProduceForm: function submitProduceForm(event) {
      if ($('#product_id').val() == "0") {
        alert("請先選擇商品!");
      } else if (this.$refs.ProduceDetailForm.details.length == 0) {
        alert("請新增所消耗原物料!");
      } else {
        $('#producesubmitBtn').attr('disabled', true);
        $('#loading_icon').fadeIn(); // 1. 先創建 Produce

        var url = event.target.action;
        var data = $(event.target).serialize();
        axios.post(url, data).then(function (response) {
          // console.log(response);
          $('#produceID').val(response.data.produce_id); // 2. 建立 Produce Detail

          $('#ProduceDetailForm').submit();
        })["catch"](function (error) {
          console.error('新增商品庫存時發生錯誤，錯誤訊息：' + error);
        });
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesDetail.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Produces/ProducesDetail.vue?vue&type=script&lang=js& ***!
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['materials'],
  mounted: function mounted() {
    console.log('ProducesDetail.vue mounted.');
  },
  data: function data() {
    return {
      details: [],
      current_material: []
    };
  },
  methods: {
    // 新增原物料細項
    addDetail: function addDetail() {
      var material_id = $('#material_id').val();

      if (material_id == 0) {
        alert("請先選擇原物料!");
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
              showUnit: this.current_material.showUnit
            },
            currentQty: this.current_material.showStock,
            quantity: 0,
            afterQty: 0
          });
          this.current_material = [];
        } else {
          alert('請選擇原物料');
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
        afterQty = parseFloat(Math.round((currentQty - quantity) * 10000) / 10000);
        this.details[id - 1].quantity = quantity;
      } else {
        $('#quantity_' + id).val(0);
        afterQty = parseFloat(Math.round(currentQty * 10000) / 10000);
        this.details[id - 1].quantity = 0;
      }

      $('#afterQty' + id).val(afterQty);
      this.details[id - 1].afterQty = afterQty;
    },
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
          // console.log(response);
          _this.current_material = response.data;
          $('#addMaterialBtn').attr('disabled', false);
        });
      } else {
        alert('請選擇原物料');
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=template&id=55ba9d54&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=template&id=55ba9d54& ***!
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
    _c("div", { staticClass: "col-md-12" }, [
      _c(
        "form",
        {
          attrs: {
            id: "ProduceCreateForm",
            method: "POST",
            action: _vm.createProduce
          },
          on: {
            submit: function($event) {
              $event.preventDefault()
              return _vm.submitProduceForm($event)
            }
          }
        },
        [
          _c("div", { staticClass: "form-group row" }, [
            _vm._m(0),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-6" }, [
              _c(
                "select",
                {
                  staticClass: "form-control",
                  attrs: { id: "product_id", name: "product_id" },
                  on: { change: _vm.getProductData }
                },
                [
                  _c("option", { attrs: { value: "0" } }, [
                    _vm._v("請選擇...")
                  ]),
                  _vm._v(" "),
                  _vm._l(_vm.products, function(product) {
                    return _c("option-item", {
                      key: product.id,
                      attrs: { data: product }
                    })
                  })
                ],
                2
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group row" }, [
            _c(
              "label",
              {
                staticClass: "col-md-4 col-form-label text-md-right",
                attrs: { for: "product_currentQty" }
              },
              [_vm._v("\r\n                    目前庫存\r\n                ")]
            ),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-4" }, [
              _c("input", {
                staticClass: "form-control",
                attrs: {
                  id: "product_currentQty",
                  type: "text",
                  name: "product_currentQty",
                  disabled: ""
                },
                domProps: { value: _vm.current_product.quantity || 0 }
              })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-2" }, [
              _c(
                "label",
                { staticClass: "col-form-label", attrs: { for: "" } },
                [_vm._v(_vm._s(_vm.current_product.showUnit))]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group row" }, [
            _vm._m(1),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-4" }, [
              _c("input", {
                staticClass: "form-control",
                attrs: {
                  id: "product_quantity",
                  type: "text",
                  name: "product_quantity",
                  value: "0",
                  required: ""
                },
                on: { change: _vm.calculateProductAfterQty }
              })
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-2" }, [
              _c(
                "label",
                {
                  staticClass: "col-form-label",
                  attrs: { for: "product_quantity" }
                },
                [_vm._v(_vm._s(_vm.current_product.showUnit))]
              )
            ])
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "form-group row" }, [
            _vm._m(2),
            _vm._v(" "),
            _vm._m(3),
            _vm._v(" "),
            _c("div", { staticClass: "col-md-2" }, [
              _c(
                "label",
                {
                  staticClass: "col-form-label",
                  attrs: { for: "product_afterQty" }
                },
                [_vm._v(_vm._s(_vm.current_product.showUnit))]
              )
            ])
          ]),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          _c("produces-detail", {
            ref: "ProduceDetailForm",
            attrs: { materials: _vm.materials },
            on: { "refresh-materials": _vm.refreshMaterials }
          }),
          _vm._v(" "),
          _c("hr"),
          _vm._v(" "),
          _c("div", { staticClass: "form-group row justify-content-center" }, [
            _c("div", { staticClass: "col-md-8" }, [
              _vm._m(4),
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
    return _c(
      "label",
      {
        staticClass: "col-md-4 col-form-label text-md-right",
        attrs: { for: "product_id" }
      },
      [
        _c("span", { staticClass: "text-danger" }, [_vm._v("*")]),
        _vm._v("\r\n                    商品名稱\r\n                ")
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "label",
      {
        staticClass: "col-md-4 col-form-label text-md-right",
        attrs: { for: "product_quantity" }
      },
      [
        _c("span", { staticClass: "text-danger" }, [_vm._v("*")]),
        _vm._v("\r\n                    庫存增量數量\r\n                ")
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "label",
      {
        staticClass: "col-md-4 col-form-label text-md-right",
        attrs: { for: "product_afterQty" }
      },
      [
        _c("span", { staticClass: "text-danger" }, [_vm._v("*")]),
        _vm._v("\r\n                    增量後庫存量\r\n                ")
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-md-4" }, [
      _c("input", {
        staticClass: "form-control",
        attrs: {
          id: "product_afterQty",
          type: "text",
          value: "0",
          disabled: ""
        }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "button",
      {
        staticClass: "btn btn-block btn-primary",
        attrs: { id: "producesubmitBtn", type: "submit" }
      },
      [
        _c("span", {
          staticClass: "spinner-border spinner-border-sm",
          staticStyle: { display: "none" },
          attrs: { id: "loading_icon", role: "status", "aria-hidden": "true" }
        }),
        _vm._v("\r\n                        確認新增\r\n                    ")
      ]
    )
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesDetail.vue?vue&type=template&id=1b729f45&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Produces/ProducesDetail.vue?vue&type=template&id=1b729f45& ***!
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
    _c("div", { staticClass: "col-md-12" }, [
      _c(
        "form",
        { attrs: { id: "ProduceDetailForm", method: "POST", action: "#" } },
        [
          _c("input", {
            attrs: {
              type: "hidden",
              id: "produceID",
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
                          _vm._s(detail.material.name) +
                          "\r\n                            "
                      ),
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
        _c("th", [_vm._v("目前庫存量")]),
        _vm._v(" "),
        _c("th", [_vm._v("消耗庫存量")]),
        _vm._v(" "),
        _c("th", [_vm._v("剩餘庫存量")]),
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

/***/ "./resources/js/components/Produces/ProducesCreateForm.vue":
/*!*****************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesCreateForm.vue ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProducesCreateForm_vue_vue_type_template_id_55ba9d54___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProducesCreateForm.vue?vue&type=template&id=55ba9d54& */ "./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=template&id=55ba9d54&");
/* harmony import */ var _ProducesCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProducesCreateForm.vue?vue&type=script&lang=js& */ "./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProducesCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProducesCreateForm_vue_vue_type_template_id_55ba9d54___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProducesCreateForm_vue_vue_type_template_id_55ba9d54___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Produces/ProducesCreateForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProducesCreateForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=template&id=55ba9d54&":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=template&id=55ba9d54& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesCreateForm_vue_vue_type_template_id_55ba9d54___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProducesCreateForm.vue?vue&type=template&id=55ba9d54& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesCreateForm.vue?vue&type=template&id=55ba9d54&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesCreateForm_vue_vue_type_template_id_55ba9d54___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesCreateForm_vue_vue_type_template_id_55ba9d54___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Produces/ProducesDetail.vue":
/*!*************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesDetail.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProducesDetail_vue_vue_type_template_id_1b729f45___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProducesDetail.vue?vue&type=template&id=1b729f45& */ "./resources/js/components/Produces/ProducesDetail.vue?vue&type=template&id=1b729f45&");
/* harmony import */ var _ProducesDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProducesDetail.vue?vue&type=script&lang=js& */ "./resources/js/components/Produces/ProducesDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProducesDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProducesDetail_vue_vue_type_template_id_1b729f45___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProducesDetail_vue_vue_type_template_id_1b729f45___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Produces/ProducesDetail.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Produces/ProducesDetail.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesDetail.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProducesDetail.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesDetail.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesDetail_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Produces/ProducesDetail.vue?vue&type=template&id=1b729f45&":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/Produces/ProducesDetail.vue?vue&type=template&id=1b729f45& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesDetail_vue_vue_type_template_id_1b729f45___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProducesDetail.vue?vue&type=template&id=1b729f45& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Produces/ProducesDetail.vue?vue&type=template&id=1b729f45&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesDetail_vue_vue_type_template_id_1b729f45___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProducesDetail_vue_vue_type_template_id_1b729f45___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/produces/create.js":
/*!*****************************************!*\
  !*** ./resources/js/produces/create.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('produces-create-form', __webpack_require__(/*! ./../components/Produces/ProducesCreateForm.vue */ "./resources/js/components/Produces/ProducesCreateForm.vue")["default"]);
Vue.component('produces-detail', __webpack_require__(/*! ./../components/Produces/ProducesDetail.vue */ "./resources/js/components/Produces/ProducesDetail.vue")["default"]);
var app = new Vue({
  el: '#Produces',
  data: function data() {
    return {
      products: [],
      current_product: [],
      materials: [],
      all_materials: [],
      materials_disabled: []
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
    // 取得商品資料
    getProductData: function getProductData(id) {
      var _this = this;

      var getProductsInfo = $('#getProductsInfo').html();
      axios.post(getProductsInfo, id).then(function (response) {
        // console.log(response);
        _this.current_product = response.data; // 觸發事件：當"商品名稱"欄位被更動時
        // 試算商品庫存：目前庫存 + 增加量 = 最終庫存 (四捨五入到小數點後4位)

        var currentQty = _this.current_product.quantity;
        var qty = parseFloat($('#product_quantity').val());
        var afterQty = parseFloat(Math.round((currentQty + qty) * 10000) / 10000);
        $('#product_afterQty').val(afterQty);
      });
    }
  },
  created: function created() {
    var _this2 = this;

    // 取得所有商品列表(id與name)
    var getProductsName = $('#getProductsName').html();
    axios.get(getProductsName).then(function (response) {
      _this2.products = response.data;
    }); // 取得所有原物料列表(id與name)

    var getMeterialsName = $('#getMeterialsName').html();
    axios.get(getMeterialsName).then(function (response) {
      _this2.materials = response.data;
      _this2.all_materials = _this2.materials;
    });
  }
});

/***/ }),

/***/ 14:
/*!***********************************************!*\
  !*** multi ./resources/js/produces/create.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\produces\create.js */"./resources/js/produces/create.js");


/***/ })

/******/ });