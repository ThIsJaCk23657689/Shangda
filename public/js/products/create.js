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
/******/ 	return __webpack_require__(__webpack_require__.s = 19);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/ProductRecipes.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Products/ProductRecipes.vue?vue&type=script&lang=js& ***!
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['materials'],
  mounted: function mounted() {
    console.log('ProductRecipes.vue mounted.');
  },
  data: function data() {
    return {
      recipes: [],
      current_material: [],
      total_cost: 0,
      profit: 0,
      retail_price: 0
    };
  },
  methods: {
    // 新增原物料到商品成分表
    addRecipe: function addRecipe() {
      var material_id = $('#material_id').val();

      if (material_id == 0) {
        alert("請先選擇原物料!");
      } else {
        this.$emit('refresh-materials', {
          id: material_id - 1,
          type: 'add'
        });

        if (this.current_material.length != 0) {
          this.recipes.push({
            count: this.recipes.length,
            material: {
              id: this.current_material.id,
              name: this.current_material.name,
              unitPrice: this.current_material.unitPrice,
              unit: this.current_material.unit
            },
            raito: 0,
            subcost: 0
          });
        } else {
          alert('請選擇原物料');
        }
      }
    },
    // 刪除原物料成分
    deleteRecipe: function deleteRecipe(id) {
      this.recipes.splice(id, 1);
      this.$emit('refresh-materials', {
        id: $('#materialID_' + (id + 1)).val(),
        type: 'deleted'
      });
      this.calculateTotalCost();
    },
    calculateSubcost: function calculateSubcost(id) {
      var raito = parseFloat($('#raito_' + id).val());
      var unitPrice = this.recipes[id - 1].material.unitPrice;
      var subcost = Math.round(unitPrice * raito * 10000) / 10000;
      this.recipes[id - 1].raito = raito;
      this.recipes[id - 1].subcost = subcost;
      this.calculateTotalCost();
    },
    calculateTotalCost: function calculateTotalCost() {
      this.total_cost = 0;

      for (var i = 1; i <= this.recipes.length; i++) {
        this.total_cost = this.total_cost + this.recipes[i - 1].subcost;
      }
    },
    calculateRetailPrice: function calculateRetailPrice() {
      this.calculateTotalCost();
      this.profit = $('#profit').val();
      this.retail_price = parseFloat(this.total_cost) + parseFloat(this.profit);
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/ProductRecipes.vue?vue&type=template&id=0ba52bc6&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Products/ProductRecipes.vue?vue&type=template&id=0ba52bc6& ***!
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
              _c("option", { attrs: { value: "0" } }, [_vm._v("請選擇...")]),
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
              on: { click: _vm.addRecipe }
            },
            [_vm._v("新增至成分")]
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
            _vm._l(_vm.recipes, function(recipe, index) {
              return _c("tr", { key: index }, [
                _c("td", [_vm._v(_vm._s(index + 1))]),
                _vm._v(" "),
                _c("td", [
                  _vm._v(
                    "\r\n                        " +
                      _vm._s(recipe.material.name) +
                      "\r\n                        "
                  ),
                  _c("input", {
                    attrs: {
                      type: "hidden",
                      name: "recipes[" + (index + 1) + "][material_id]"
                    },
                    domProps: { value: recipe.material.id }
                  })
                ]),
                _vm._v(" "),
                _c("td", [
                  _c("input", {
                    staticClass: "form-control mr-2",
                    staticStyle: { width: "60%", display: "inline-block" },
                    attrs: {
                      id: "unitPrice_" + (index + 1),
                      type: "text",
                      disabled: ""
                    },
                    domProps: { value: recipe.material.unitPrice }
                  }),
                  _vm._v(" "),
                  _c("span", [
                    _vm._v(
                      " 元 / " +
                        _vm._s(recipe.material.unit == 1 ? "公斤" : "公噸")
                    )
                  ])
                ]),
                _vm._v(" "),
                _c("td", [
                  _c("input", {
                    staticClass: "form-control",
                    attrs: {
                      id: "raito_" + (index + 1),
                      type: "text",
                      name: "recipes[" + (index + 1) + "][raito]"
                    },
                    domProps: { value: recipe.raito },
                    on: {
                      change: function($event) {
                        return _vm.calculateSubcost(index + 1)
                      }
                    }
                  })
                ]),
                _vm._v(" "),
                _c("td", [
                  _c("input", {
                    staticClass: "form-control",
                    attrs: {
                      id: "subcost_" + (index + 1),
                      type: "text",
                      disabled: ""
                    },
                    domProps: { value: recipe.subcost }
                  })
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
                          return _vm.deleteRecipe(index)
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
      ),
      _vm._v(" "),
      _c("hr"),
      _vm._v(" "),
      _c("div", { staticClass: "row" }, [
        _c("div", { staticClass: "col-md-4" }, [
          _c("div", { staticClass: "form-group" }, [
            _c("label", { attrs: { for: "totalCost" } }, [_vm._v("總成本價")]),
            _vm._v(" "),
            _c("input", {
              staticClass: "form-control mb-2",
              attrs: {
                id: "totalCost",
                name: "totalCost",
                type: "text",
                readonly: ""
              },
              domProps: { value: this.total_cost }
            })
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "col-md-4" }, [
          _c("div", { staticClass: "form-group" }, [
            _vm._m(1),
            _vm._v(" "),
            _c("input", {
              staticClass: "form-control mb-2",
              attrs: {
                id: "profit",
                name: "profit",
                type: "text",
                required: "",
                autocomplete: "off"
              },
              domProps: { value: this.profit },
              on: { change: _vm.calculateRetailPrice }
            })
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "col-md-4" }, [
          _c("div", { staticClass: "form-group" }, [
            _c("label", { attrs: { for: "retailPrice" } }, [_vm._v("零售價")]),
            _vm._v(" "),
            _c("input", {
              staticClass: "form-control",
              attrs: {
                id: "retailPrice",
                name: "retailPrice",
                type: "text",
                readonly: ""
              },
              domProps: { value: this.retail_price }
            })
          ])
        ])
      ])
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
        _c("th", [_vm._v("單價")]),
        _vm._v(" "),
        _c("th", [_vm._v("耗材比")]),
        _vm._v(" "),
        _c("th", [_vm._v("成本價")]),
        _vm._v(" "),
        _c("th", [_vm._v("操作")])
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", { attrs: { for: "profit" } }, [
      _c("span", { staticClass: "text-danger mr-2" }, [_vm._v("*")]),
      _vm._v("利潤\r\n                    ")
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

/***/ "./resources/js/components/Products/ProductRecipes.vue":
/*!*************************************************************!*\
  !*** ./resources/js/components/Products/ProductRecipes.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ProductRecipes_vue_vue_type_template_id_0ba52bc6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ProductRecipes.vue?vue&type=template&id=0ba52bc6& */ "./resources/js/components/Products/ProductRecipes.vue?vue&type=template&id=0ba52bc6&");
/* harmony import */ var _ProductRecipes_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ProductRecipes.vue?vue&type=script&lang=js& */ "./resources/js/components/Products/ProductRecipes.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ProductRecipes_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ProductRecipes_vue_vue_type_template_id_0ba52bc6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ProductRecipes_vue_vue_type_template_id_0ba52bc6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Products/ProductRecipes.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Products/ProductRecipes.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/Products/ProductRecipes.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductRecipes_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductRecipes.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/ProductRecipes.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductRecipes_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Products/ProductRecipes.vue?vue&type=template&id=0ba52bc6&":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/Products/ProductRecipes.vue?vue&type=template&id=0ba52bc6& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductRecipes_vue_vue_type_template_id_0ba52bc6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ProductRecipes.vue?vue&type=template&id=0ba52bc6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/ProductRecipes.vue?vue&type=template&id=0ba52bc6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductRecipes_vue_vue_type_template_id_0ba52bc6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ProductRecipes_vue_vue_type_template_id_0ba52bc6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/products/create.js":
/*!*****************************************!*\
  !*** ./resources/js/products/create.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('product-recipes', __webpack_require__(/*! ./../components/Products/ProductRecipes.vue */ "./resources/js/components/Products/ProductRecipes.vue")["default"]);
var app = new Vue({
  el: '#product',
  data: function data() {
    return {
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
    }
  },
  created: function created() {
    var _this = this;

    // 取得所有原物料列表(id與name)
    var getMeterialsName = $('#getMeterialsName').html();
    axios.get(getMeterialsName).then(function (response) {
      _this.materials = response.data;
      _this.all_materials = _this.materials;
    });
  },
  mounted: function mounted() {
    $('#picture').change(function () {
      var input = $(this)[0];
      readURL(input);
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        $('#preview-upload').fadeIn();
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#previewImg-upload').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function genereateProductID() {
      // 取得商品規格 (例如：兩斤、半斤、四兩)
      var specification = $('#specification').val();
      var specification_text_array = ['四兩', '六兩', '大六兩', '半斤', '一斤', '兩斤', '三斤', '五斤', '七斤', '十斤', '十五斤', '二十斤'];
      var specification_id_array = ['004', '006', '0066', '008', '010', '020', '030', '050', '070', '110', '115', '120'];
      var temp_index = specification_text_array.indexOf(specification);
      var specification_id = temp_index != -1 ? specification_id_array[temp_index] : ''; // 取得商品重量（例如：5 6 7 10 10.5 11 12，單位：兩）

      var weight = $('#weight').val();
      var weight_text_array = ['5', '6', '7', '10', '10.5', '11', '12'];
      var weight_id_array = ['5', '6', '7', '3', '1', '', '2'];
      temp_index = weight_text_array.indexOf(weight);
      var weight_id = temp_index != -1 ? weight_id_array[temp_index] : ''; // 取得商品慣用單位

      var unit = $('#unit').val(); // 取得商品類別名稱

      var product_category_name = $('#category_id :selected').text();
      var first_code = '';

      if (product_category_name == '耐熱袋') {
        if (unit == 'package') {
          first_code = '2';
        } else if (unit == 'roll') {
          first_code = '1';
        }
      }

      if (first_code != '' || weight_id != '' || specification_id != '') {
        $('#shownID').val(first_code + weight_id + '-' + specification_id);
      }
    }

    $('#ManualID').click(function () {
      var result = $(this).prop('checked');

      if (result) {
        $('#shownID').attr('readonly', false);
      } else {
        $('#shownID').attr('readonly', true);
        genereateProductID();
      }
    });

    function genereateProductName() {
      // 取得商品規格 (例如：兩斤、半斤、四兩)
      var specification = $('#specification').val(); // 取得商品顏色或花樣 (例如：黑、紅白、白花)

      var color = $('#color').val(); // 取得商品重量（例如：5 6 7 10 10.5 11 12，單位：兩）
      // 如果該重量值不是空值或是0，就外加括號，反之就都不顯示於商品名稱內。

      var weight = $('#weight').val();

      if (weight != '' && weight != null && weight != 0) {
        weight = ' (' + weight + ')';
      } else {
        weight = '';
      } // 取得商品慣用單位


      var unit = $('#unit').val(); // 取得每件數量

      var qty_per_pack = $('#qty_per_pack').val();

      if (unit == 'kg') {
        qty_per_pack = qty_per_pack + 'KG';
      } // 取得商品類別名稱。


      var product_category_name = $('#category_id :selected').text();
      var pack_unit = '1 * ';

      if (product_category_name == '耐熱袋' && unit == 'package') {
        pack_unit = '1P * ';
      } else if (unit == 'roll') {
        pack_unit = '5P * ';
      }

      if (color != '' || specification != '' || qty_per_pack != '' || weight != '') {
        $('#name').val(color + product_category_name + specification + ' ' + pack_unit + qty_per_pack + weight);
      }
    }

    $('#ManualNamed').click(function () {
      var result = $(this).prop('checked');

      if (result) {
        $('#name').attr('readonly', false);
      } else {
        $('#name').attr('readonly', true);
        genereateProductName();
        genereateProductID();
      }
    });
    $('#specification').change(function () {
      if (!$('#ManualNamed').prop('checked')) {
        genereateProductName();
        genereateProductID();
      }
    });
    $('#color').change(function () {
      if (!$('#ManualNamed').prop('checked')) {
        genereateProductName();
      }
    });
    $('#weight').change(function () {
      if (!$('#ManualNamed').prop('checked')) {
        genereateProductName();
        genereateProductID();
      }
    });
    $('#qty_per_pack').change(function () {
      if (!$('#ManualNamed').prop('checked')) {
        genereateProductName();
      }
    });
    $('#category_id').change(function () {
      if (!$('#ManualNamed').prop('checked')) {
        genereateProductName();
        genereateProductID();
      }
    });
    $('#unit').change(function () {
      if (!$('#ManualNamed').prop('checked')) {
        genereateProductName();
        genereateProductID();
      }
    });
    $('#product_create_form').submit(function (e) {
      e.preventDefault();
      var url = $(this).attr('action');
      var data = $(this).serializeObject();
      var formdata = new FormData();
      Object.keys(data).forEach(function (key) {
        return formdata.append(key, data[key]);
      });
      formdata.append('picture', $('#picture')[0].files[0]);
      console.log(formdata);
      $('#LoadingModal').modal('show');
      axios.post(url, formdata, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(function (response) {
        console.log(response);
        $('#productID').val(response.data.product_id);
        alert(response.data.messenge);
        location.href = response.data.redirect_url;
      })["catch"](function (error) {
        console.error('新增商品時發生錯誤，錯誤訊息：' + error);
        alert('新增商品時發生錯誤，錯誤訊息：' + error);
        $key = Object.keys(error.response.data.errors);
        $key.forEach(function (item, index) {
          console.log(error.response.data.errors[$key]);
          alert(error.response.data.errors[$key]);
        });
        $('#LoadingModal').modal('hide');
      });
    });
  }
});

/***/ }),

/***/ 19:
/*!***********************************************!*\
  !*** multi ./resources/js/products/create.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\products\create.js */"./resources/js/products/create.js");


/***/ })

/******/ });