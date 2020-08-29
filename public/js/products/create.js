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
/******/ 	return __webpack_require__(__webpack_require__.s = 30);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/PicturesUpload.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Products/PicturesUpload.vue?vue&type=script&lang=js& ***!
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
/* harmony default export */ __webpack_exports__["default"] = ({
  props: [],
  data: function data() {
    return {
      pictures_data: [],
      filelist: [],
      isShowPreview: false,
      current_image_index: null
    };
  },
  methods: {
    addImage: function addImage(e) {
      var $files = $(e.target).prop('files');
      var max_files_count = 5 - this.pictures_data.length;

      if ($files.length > max_files_count) {
        $.showErrorModalWithoutError('圖片最多不得超過五張。');
        $(e.target).val('');
        return false;
      }

      if ($files.length > 0) {
        for (var $i = 0; $i < $files.length; $i++) {
          var $file = $files[$i];

          if (this.isImageFile($file)) {
            // 這邊使用 Object URL 的功能。
            var $url = URL.createObjectURL($file);
            this.pictures_data.push({
              index: this.pictures_data.length + 1,
              blob_url: $url,
              name: $file.name,
              type: $file.type,
              size: $file.size
            });
            this.filelist.push($file);
          } else {
            $.showErrorModalWithoutError('只能上傳(png, jpg, jpeg, gif)格式之圖片。');
            continue;
          }
        }
      }
    },
    // 檢查所上傳的檔案是不是圖片檔案。
    isImageFile: function isImageFile($file) {
      if ($file.type) {
        return /^image\/\w+$/.test($file.type);
      } else {
        return /\.(jpg|jpeg|png|gif|bmp)$/.test($file);
      }
    },
    showPreview: function showPreview(e) {
      $(this.$refs.previewer).addClass('open');
      var $index = $(e.target).children().text() - 1;
      this.current_image_index = $index;
      $(this.$refs.previewImg).attr('src', this.pictures_data[$index].blob_url);
      this.isShowPreview = true;
    },
    closePreview: function closePreview(e) {
      $(this.$refs.previewer).removeClass('open');
      this.isShowPreview = false;
      this.current_image_index = null;
      $(this.$refs.previewImg).attr('src', '');
    },
    removeImage: function removeImage(e) {
      this.pictures_data.splice(this.current_image_index, 1);
      this.filelist.splice(this.current_image_index, 1);

      for (var $i = 0; $i < this.pictures_data.length; $i++) {
        this.pictures_data[$i].index = $i + 1;
      }
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

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
    calculateProfit: function calculateProfit() {
      this.calculateTotalCost();
      this.retail_price = $('#retailPrice').val();
      this.profit = -parseFloat(this.total_cost) + parseFloat(this.retail_price);
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

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/PicturesUpload.vue?vue&type=style&index=0&lang=css&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--23-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--23-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Products/PicturesUpload.vue?vue&type=style&index=0&lang=css& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.uploader-body{\r\n    background-color: #fafafa;\n}\n.d-flex-row-nowarp{\r\n    display: -webkit-box;\r\n    display: flex;\r\n    -webkit-box-orient: horizontal;\r\n    -webkit-box-direction: normal;\r\n            flex-direction: row;\r\n    flex-wrap: nowrap;\n}\n.uploader-info{\r\n    display: inline-block;\r\n    position: absolute;\r\n    top: 0;\r\n    right: 15px;\n}\n.preview-img-container{\r\n    list-style: none;\r\n    margin: 0;\r\n    padding: 0;\n}\n.preview-img{\r\n    margin-left: 9px;\r\n    margin-bottom: 9px;\r\n    margin-top: 9px;\r\n    width: 80px;\r\n    height: 80px;\r\n    background: no-repeat center center;\r\n    background-size: cover;\r\n    cursor: pointer;\n}\n.image-input-container{\r\n    position: relative;\r\n    margin-left: 9px;\r\n    margin-bottom: 9px;\r\n    margin-top: 9px;\r\n    width: 80px;\r\n    height: 80px;\r\n    border: 1px solid #d9d9d9;\n}\n.image-input-container:before, .image-input-container:after{\r\n    content: '';\r\n    position: absolute;\r\n    top: 50%;\r\n    left: 50%;\r\n    -webkit-transform: translate(-50%, -50%);\r\n            transform: translate(-50%, -50%);\r\n    background-color: #d9d9d9;\n}\n.image-input-container:before{\r\n    width: 2px;\r\n    height: 39.5px;\n}\n.image-input-container:after{\r\n    width: 39.5px;\r\n    height: 2px;\n}\n.image-input{\r\n    width: 100%;\r\n    height: 100%;\r\n    cursor: pointer;\r\n    position: absolute;\r\n    top: 0;\r\n    left: 0;\r\n    z-index: 1;\r\n    opacity: 0;\n}\n.previewer{\r\n    display: none;\r\n    position: fixed;\r\n    width: 100vw;\r\n    height: 100vh;\r\n    top: 0;\r\n    left: 0;\r\n    overflow: hidden;\r\n    touch-action: none;\r\n    z-index: 1500;\r\n    outline: none;\n}\n.open{\r\n    display: -webkit-box;\r\n    display: flex;\r\n    -webkit-box-orient: vertical;\r\n    -webkit-box-direction: normal;\r\n            flex-direction: column;\r\n    flex-wrap: nowrap;\n}\n.previewer-bg{\r\n    position: absolute;\r\n    width: 100%;\r\n    height: 100%;\r\n    top: 0;\r\n    left: 0;\r\n    background: #000;\r\n    opacity: 1;\r\n    z-index: -1;\n}\n.fade-enter-active, .fade-leave-active {\r\n    -webkit-transition: opacity 333ms cubic-bezier(0.4, 0, 0.22, 1);\r\n    transition: opacity 333ms cubic-bezier(0.4, 0, 0.22, 1);\n}\n.fade-enter, .fade-leave-to {\r\n    opacity: 0;\n}\n.previewer-bd{\r\n    width: 100%;\r\n    height: calc(100% - 60px);\n}\n.previewer-bd img{\r\n    height: 634px;\r\n    position: absolute;\r\n    top: 48%;\r\n    left: 50%;\r\n    -webkit-transform: translate3d(-50%, -50%, 0);\r\n            transform: translate3d(-50%, -50%, 0);\n}\n.previewer-ft{\r\n    width: 100%;\r\n    height: 60px;\r\n    background-color: #0d0d0d;\r\n    color: #fff;\r\n    line-height: 60px;\r\n    text-align: center;\r\n    z-index: 2;\r\n    cursor: pointer;\r\n    -webkit-transition: background-color 0.3s ease-in-out;\r\n    transition: background-color 0.3s ease-in-out;\n}\n.previewer-ft:hover{\r\n    background-color: #2d2d2d;\n}\r\n", ""]);

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

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/PicturesUpload.vue?vue&type=style&index=0&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--23-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--23-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Products/PicturesUpload.vue?vue&type=style&index=0&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--23-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--23-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./PicturesUpload.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/PicturesUpload.vue?vue&type=style&index=0&lang=css&");

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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/PicturesUpload.vue?vue&type=template&id=364570a6&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Products/PicturesUpload.vue?vue&type=template&id=364570a6& ***!
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
  return _c("div", [
    _c("div", { staticClass: "form-group col-md-12 uploader-head" }, [
      _vm._v("\r\n        商品圖片\r\n        "),
      _c("small", { staticClass: "form-text text-muted" }, [
        _vm._v("僅支援JPG、JPEG、PNG與BMP格式圖片，且檔案大小上限為20MB。")
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "uploader-info" }, [
        _vm._v(_vm._s(_vm.pictures_data.length) + "/5")
      ])
    ]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "form-group col-md-12 uploader-body d-flex-row-nowarp" },
      [
        _c(
          "ul",
          { staticClass: "preview-img-container d-flex-row-nowarp" },
          _vm._l(_vm.pictures_data, function(picture) {
            return _c(
              "li",
              {
                key: picture.index,
                staticClass: "preview-img",
                style: { "background-image": "url(" + picture.blob_url + ")" },
                on: { click: _vm.showPreview }
              },
              [
                _c("span", { staticClass: "d-none" }, [
                  _vm._v(_vm._s(picture.index))
                ])
              ]
            )
          }),
          0
        ),
        _vm._v(" "),
        _vm.pictures_data.length < 5
          ? _c("div", { staticClass: "image-input-container" }, [
              _c("input", {
                staticClass: "image-input",
                attrs: {
                  type: "file",
                  multiple: "",
                  accept: "image/jpeg,image/png,image/bmp"
                },
                on: { change: _vm.addImage }
              })
            ])
          : _vm._e(),
        _vm._v(" "),
        _c(
          "div",
          {
            ref: "previewer",
            staticClass: "previewer",
            attrs: { tabindex: "-1", role: "dialog", "aria-hidden": "true" },
            on: { click: _vm.closePreview }
          },
          [
            _c("transition", { attrs: { name: "fade" } }, [
              _vm.isShowPreview
                ? _c("div", { staticClass: "previewer-bg" })
                : _vm._e()
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "previewer-bd" }, [
              _c("img", {
                ref: "previewImg",
                staticClass: "previewer-images",
                attrs: { src: "", alt: "" }
              })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "previewer-ft", on: { click: _vm.removeImage } },
              [_c("i", { staticClass: "fas fa-trash-alt" })]
            )
          ],
          1
        )
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



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
              attrs: { id: "retailPrice", name: "retailPrice", type: "text" },
              domProps: { value: this.retail_price },
              on: { change: _vm.calculateProfit }
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

/***/ "./resources/js/components/Products/PicturesUpload.vue":
/*!*************************************************************!*\
  !*** ./resources/js/components/Products/PicturesUpload.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PicturesUpload_vue_vue_type_template_id_364570a6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PicturesUpload.vue?vue&type=template&id=364570a6& */ "./resources/js/components/Products/PicturesUpload.vue?vue&type=template&id=364570a6&");
/* harmony import */ var _PicturesUpload_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PicturesUpload.vue?vue&type=script&lang=js& */ "./resources/js/components/Products/PicturesUpload.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _PicturesUpload_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./PicturesUpload.vue?vue&type=style&index=0&lang=css& */ "./resources/js/components/Products/PicturesUpload.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _PicturesUpload_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PicturesUpload_vue_vue_type_template_id_364570a6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PicturesUpload_vue_vue_type_template_id_364570a6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Products/PicturesUpload.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Products/PicturesUpload.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/Products/PicturesUpload.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./PicturesUpload.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/PicturesUpload.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Products/PicturesUpload.vue?vue&type=style&index=0&lang=css&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/Products/PicturesUpload.vue?vue&type=style&index=0&lang=css& ***!
  \**********************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--23-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--23-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./PicturesUpload.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/PicturesUpload.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_23_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_23_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/Products/PicturesUpload.vue?vue&type=template&id=364570a6&":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/Products/PicturesUpload.vue?vue&type=template&id=364570a6& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_template_id_364570a6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./PicturesUpload.vue?vue&type=template&id=364570a6& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Products/PicturesUpload.vue?vue&type=template&id=364570a6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_template_id_364570a6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PicturesUpload_vue_vue_type_template_id_364570a6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



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
Vue.component('pictures-upload', __webpack_require__(/*! ./../components/Products/PicturesUpload.vue */ "./resources/js/components/Products/PicturesUpload.vue")["default"]);
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
    $.showLoadingModal();
    var getMeterialsName = $('#getMeterialsName').html();
    axios.get(getMeterialsName).then(function (response) {
      _this.materials = response.data;
      _this.all_materials = _this.materials;
      $.closeModal();
    });
  },
  mounted: function mounted() {
    var vm = this;

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

      if (vm.$refs.productRecipes.recipes.length == 0) {
        $.showWarningModal('請輸入商品之原物料。');
        return false;
      }

      ;
      var url = $(this).attr('action');
      var data = $(this).serializeObject();
      var formdata = new FormData();
      console.log(formdata);
      Object.keys(data).forEach(function (key) {
        return formdata.append(key, data[key]);
      });
      console.log(formdata);
      var pictures = vm.$refs.picturesUpload.filelist;
      console.log('sss：' + pictures.length);
      console.log(pictures);

      if (pictures.length > 0) {
        for (var $i = 0; $i < pictures.length; $i++) {
          var picture = pictures[$i];
          formdata.append('pictures[' + $i + ']', picture);
        }
      }

      console.log(formdata);
      $.showLoadingModal();
      axios.post(url, formdata, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(function (response) {
        $('#productID').val(response.data.product_id);
        $.showSuccessModal(response.data.messenge, response.data.redirect_url);
      })["catch"](function (error) {
        console.error('新增商品時發生錯誤，錯誤訊息：' + error);
        $.showErrorModal(error);
      });
    });
  }
});

/***/ }),

/***/ 30:
/*!***********************************************!*\
  !*** multi ./resources/js/products/create.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\products\create.js */"./resources/js/products/create.js");


/***/ })

/******/ });