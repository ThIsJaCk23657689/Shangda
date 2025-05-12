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
/******/ 	return __webpack_require__(__webpack_require__.s = 37);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['uploadimg', 'formtype', 'captchasitekey'],
  data: function data() {
    return {
      ConsumersIndexURL: $('#ConsumersIndexURL').text(),
      ConsumersStoreURL: $('#ConsumersStoreURL').text(),
      title: '顧客圖片'
    };
  },
  methods: {
    searchByTaxID: function searchByTaxID(e) {
      // 分公司欄位設定為非必填，且disabled開啟，必填星號消失。
      $('#branch_label').addClass('text-muted');
      $('#company_branch').attr('disabled', true);
      $('#company_branch').attr('required', false);
      $('#branch_required_tag').fadeOut();

      // 清空資料
      $('#company_taxID_type').val('');
      $('#company_name').val('');
      $('#company_principal').val('');
      var $TaxUrl = $('#ConsumersTaxIDURL').text();
      console.log('taxUrl' + $TaxUrl);
      var $taxID = $(e.target).val();
      if ($taxID != "") {
        var re = /^[0-9]{8}$/;
        if (re.test($taxID)) {
          var params = new URLSearchParams();
          params.append('taxID', $taxID);
          var url = new URL($TaxUrl);
          url.search = params.toString();
          console.log('url' + url);
          $.showLoadingModal();
          axios.get(url).then(function (response) {
            switch (response.data.status) {
              case "4":
                // 抓取api資料時出錯。
                $.showErrorModalWithoutError(response.data.msg);
                console.log(response.data.result);
                break;
              case "3":
                // 如果統編是公司類型的話
                // 自動填上統編類型、公司名稱、負責人名稱
                $('#company_taxID_type').val(response.data.type);
                $('#company_name').val(response.data.result['0'].Company_Name);
                $('#company_principal').val(response.data.result['0'].Responsible_Name);
                break;
              case "2":
                // 如果統編是分公司類型的話
                // 分公司欄位設定為必填，且disabled關閉，必填星號出現。
                $('#branch_label').removeClass('text-muted');
                $('#company_branch').attr('disabled', false);
                $('#company_branch').attr('required', true);
                $('#branch_required_tag').fadeIn();

                // 由於目前無法抓取分公司統編資料，所以不自動填上資料了
                $('#company_taxID_type').val(response.data.type);
                break;
              case "1":
                // 如果統編是商業類型的話

                // 由於目前無法抓取商業統編資料，所以不自動填上資料了
                $('#company_taxID_type').val(response.data.type);
                break;
              default:
                // 如果統編為無效的話
                $.showWarningModal('查無此統編相關資料，無法使用此統編進行註冊。');
                $('#company_taxID').val('');
                break;
            }
            $.closeModal();
          })["catch"](function (error) {
            console.error('查詢統一編號時發生錯誤，錯誤訊息：' + error);
            $.showErrorModal(error);
          });
        } else {
          // 失敗
          $.showErrorModalWithoutError('請輸入正確格式的統一編號。');
          $(e.target).val('');
        }
      }
    },
    consumerCreateForm: function consumerCreateForm(e) {
      var url = this.ConsumersStoreURL;
      var formdata = new FormData($(e.target)[0]);
      $.showLoadingModal();
      axios.post(url, formdata, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(function (response) {
        $.showSuccessModal(response.data.message, response.data.url);
      })["catch"](function (error) {
        console.error('新增顧客時發生錯誤，錯誤訊息：' + error);
        $.showErrorModal(error);
      });
    }
  },
  created: function created() {},
  mounted: function mounted() {
    $('#company_address_twzipcode').twzipcode({
      'readonly': true
    });
    $('#company_deliveryAddress_twzipcode').twzipcode({
      'readonly': true
    });
    $('input[name=company_operator_phone_1],input[name=company_operator_tel_1]').on('input', function () {
      // Set the required property of the other input to false if this input is not empty.
      $('input[name=company_operator_phone_1],input[name=company_operator_tel_1]').not(this).prop('required', !$(this).val().length);
    });
    $('input[name=company_operator_phone_2],input[name=company_operator_tel_2]').on('input', function () {
      // Set the required property of the other input to false if this input is not empty.
      $('input[name=company_operator_phone_2],input[name=company_operator_tel_2]').not(this).prop('required', !$(this).val().length);
    });
    $('#isSameAsPrincipal').click(function (e) {
      if ($(this).prop("checked")) {
        $('#company_operator_name_1').val($('#company_principal').val());
      } else {
        $('#company_operator_name_1').val('');
      }
    });
    $('#isSameAsComTel').click(function (e) {
      if ($(this).prop("checked")) {
        $('#company_operator_tel_1').val($('#company_tel').val());
      } else {
        $('#company_operator_tel_1').val('');
      }
    });
    $('#isSameAsComEmail').click(function (e) {
      if ($(this).prop("checked")) {
        $('#company_operator_email_1').val($('#company_email').val());
      } else {
        $('#company_operator_email_1').val('');
      }
    });
    $('#isSameAsComAddress').click(function (e) {
      if ($(this).prop("checked")) {
        var $zipcode = $('#company_address_twzipcode').twzipcode('get', 'zipcode');
        $('#company_deliveryAddress_twzipcode').twzipcode('set', $zipcode[0]);
        $('#company_deliveryAddress_others').val($('#company_address_others').val());
      } else {
        $('#company_deliveryAddress_twzipcode').twzipcode('reset');
        $('#company_deliveryAddress_others').val('');
      }
    });
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['uploadimg', 'formtype', 'captchasitekey'],
  data: function data() {
    return {
      ConsumersIndexURL: $('#ConsumersIndexURL').text(),
      ConsumersStoreURL: $('#ConsumersStoreURL').text(),
      title: '顧客頭貼'
    };
  },
  methods: {
    consumerCreateForm: function consumerCreateForm(e) {
      var url = this.ConsumersStoreURL;
      var formdata = new FormData($(e.target)[0]);
      $.showLoadingModal();
      axios.post(url, formdata, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(function (response) {
        $.showSuccessModal(response.data.message, response.data.url);
      })["catch"](function (error) {
        console.error('新增顧客時發生錯誤，錯誤訊息：' + error);
        $.showErrorModal(error);
      });
    }
  },
  created: function created() {},
  mounted: function mounted() {
    $("#individual_birthday").datepicker({
      dateFormat: 'yy-mm-dd',
      changeYear: true,
      changeMonth: true,
      yearRange: "-80:+0",
      maxDate: '-15y'
    });
    $('#individual_monthlyCheck').change(function (e) {
      if ($(this).prop("checked")) {
        $('#individual_monthlyCheckDate').val(0);
        $('#individual_monthlyCheckDate').attr('disabled', true);
      } else {
        $('#individual_monthlyCheckDate').val(0);
        $('#individual_monthlyCheckDate').attr('disabled', false);
      }
    });
    $('#company_monthlyCheck').change(function (e) {
      if ($(this).prop("checked")) {
        $('#company_monthlyCheckDate').val(0);
        $('#company_monthlyCheckDate').attr('disabled', true);
      } else {
        $('#company_monthlyCheckDate').val(0);
        $('#company_monthlyCheckDate').attr('disabled', false);
      }
    });
    $('#individual_address_twzipcode').twzipcode({
      'readonly': true
    });
    $('input[name=individual_phone],input[name=individual_tel]').on('input', function () {
      // Set the required property of the other input to false if this input is not empty.
      $('input[name=individual_phone],input[name=individual_tel]').not(this).prop('required', !$(this).val().length);
    });
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/UploadImages.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Partials/UploadImages.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['uploadimg', 'title', 'aspectRatio', 'prefix', 'helptext'],
  data: function data() {
    return {
      url: null,
      isCropActived: false,
      cropData: null,
      ImageURL: null
    };
  },
  methods: {
    uploadURLImage: function uploadURLImage(url) {
      this.stopCropper();
      if (!url) {
        // url是空值。
        this.ImageURL = null;
      }
      this.ImageURL = url;
      $('#' + this.prefix + '_preview-image').attr('src', this.ImageURL);
      $('#' + this.prefix + '_file_label').text('從爬蟲抓來的圖片');
    },
    // 當 input 更動時，所觸發的function。
    spwanPreviewImg: function spwanPreviewImg(e) {
      var $files = $(e.target).prop('files');
      var $file;
      if ($files.length > 0) {
        $file = $files[0];
        if (this.isImageFile($file)) {
          // 確定要上傳本地端圖片，就不要管爬蟲圖片了。
          this.ImageURL = null;
          $('#' + this.prefix + '_file_label').text($('#' + this.prefix + '_image_file').prop('files')[0].name);
          if (this.url) {
            URL.revokeObjectURL(this.url);
          }

          // 這邊使用 Object URL 的功能。
          this.url = URL.createObjectURL($file);
          this.startCropper();
        } else {
          $.showErrorModalWithoutError('只能上傳(png, jpg, jpeg, gif)格式之圖片。');
        }
      } else {
        this.stopCropper();
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
    // 開始裁切。
    startCropper: function startCropper() {
      var _this = this;
      if (this.isCropActived) {
        // 如果已經開啟了 crop 取代原本的url即可。
        $('#' + this.prefix + '_preview-image').cropper('replace', this.url);
      } else {
        $('#' + this.prefix + '_preview-image').attr('src', this.url);
        $('#' + this.prefix + '_preview-image').cropper({
          aspectRatio: this.aspectRatio,
          autoCropArea: 0.5,
          movable: false,
          zoomable: false,
          dragMode: 'move',
          checkCrossOrigin: false,
          checkOrientation: false,
          crop: function crop(e) {
            var json = ['{"x":' + e.detail.x, '"y":' + e.detail.y, '"height":' + e.detail.height, '"width":' + e.detail.width, '"rotate":' + e.detail.rotate + '}'].join();

            // 蒐集裁切的數據
            _this.cropData = json;
          }
        });
        this.isCropActived = true;
      }
    },
    // 結束裁切。
    stopCropper: function stopCropper() {
      if (this.isCropActived) {
        $('#' + this.prefix + '_preview-image').cropper('destroy');
        $('#' + this.prefix + '_preview-image').attr('src', this.uploadimg);
        $('#' + this.prefix + '_file_label').text('請選擇檔案');
        this.isCropActived = false;
      }
    }
  },
  created: function created() {},
  mounted: function mounted() {}
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=template&id=2fa9c2c6&":
/*!********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=template&id=2fa9c2c6& ***!
  \********************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("form", {
    staticStyle: {
      display: "none"
    },
    attrs: {
      id: "company_form",
      method: "POST",
      action: _vm.ConsumersStoreURL,
      enctype: "multipart/form-data"
    },
    on: {
      submit: function submit($event) {
        $event.preventDefault();
        return _vm.consumerCreateForm.apply(null, arguments);
      }
    }
  }, [_c("input", {
    attrs: {
      id: "company_account_type",
      name: "account_type",
      type: "hidden",
      value: "company"
    }
  }), _vm._v(" "), _vm._m(0), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6 text-center"
  }, [_c("upload-images", {
    ref: "uploadCompanyConsumerAvatars",
    attrs: {
      uploadimg: _vm.uploadimg,
      title: _vm.title,
      "aspect-ratio": 1,
      prefix: "CompanyConsumer"
    }
  })], 1), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_taxID"
    }
  }, [_vm._v("統一編號")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_taxID",
      name: "company_taxID",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：12345678"
    },
    on: {
      change: _vm.searchByTaxID
    }
  })])]), _vm._v(" "), _vm._m(1)]), _vm._v(" "), _vm._m(2), _vm._v(" "), _vm._m(3), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_monthlyCheckDate"
    }
  }, [_vm._v("\r\n                            月結日\r\n                        ")]), _vm._v(" "), _c("select", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "company_monthlyCheckDate",
      name: "company_monthlyCheckDate",
      disabled: ""
    }
  }, [_c("option", {
    attrs: {
      value: "0"
    }
  }, [_vm._v("請選擇...")]), _vm._v(" "), _vm._l(31, function (n) {
    return _c("option", {
      key: n,
      domProps: {
        value: n
      }
    }, [_vm._v(_vm._s(n))]);
  })], 2), _vm._v(" "), _vm._m(4)])]), _vm._v(" "), _vm.formtype == "backend" ? _c("div", {
    staticClass: "col-md-4"
  }, [_vm._m(5)]) : _vm._e(), _vm._v(" "), _vm.formtype == "backend" ? _c("div", {
    staticClass: "col-md-4"
  }, [_vm._m(6)]) : _vm._e()]), _vm._v(" "), _vm._m(7)])]), _vm._v(" "), _vm._m(8), _vm._v(" "), _vm._m(9), _vm._v(" "), _vm._m(10), _vm._v(" "), _vm._m(11), _vm._v(" "), _vm._m(12), _vm._v(" "), _vm.formtype == "frontend" ? _c("div", {
    staticClass: "row mb-4"
  }, [_c("div", {
    staticClass: "col-md-12 d-flex justify-content-center"
  }, [_c("vue-recaptcha", {
    attrs: {
      sitekey: _vm.captchasitekey,
      loadRecaptchaScript: true
    }
  })], 1)]) : _vm._e(), _vm._v(" "), _c("div", {
    staticClass: "row justify-content-center"
  }, [_c("div", {
    staticClass: "col-md-8"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_vm.formtype == "backend" ? _c("button", {
    staticClass: "btn btn-block btn-primary",
    attrs: {
      type: "submit"
    }
  }, [_vm._v("\r\n                    確認新增\r\n                ")]) : _c("button", {
    staticClass: "btn btn-block btn-primary",
    attrs: {
      type: "submit"
    }
  }, [_vm._v("\r\n                    註冊\r\n                ")]), _vm._v(" "), _c("a", {
    staticClass: "btn btn-block btn-danger",
    attrs: {
      href: _vm.ConsumersIndexURL
    }
  }, [_vm._v("\r\n                    返回列表\r\n                ")])])])])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12 mb-2"
  }, [_c("h4", [_vm._v("3. 填寫基本資訊")]), _vm._v(" "), _c("small", [_vm._v("請先填寫統一編號，可以自動填寫部分欄位")])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_taxID_type"
    }
  }, [_vm._v("\r\n                            統編類型\r\n                        ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_taxID_type",
      name: "company_taxID_type",
      type: "text",
      value: "",
      readonly: ""
    }
  })])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-8"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_name"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("公司名稱\r\n                        ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_name",
      name: "company_name",
      type: "text",
      value: "",
      required: "",
      autocomplete: "off",
      placeholder: "例：尚達塑膠有限公司"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "text-muted",
    attrs: {
      id: "branch_label",
      "for": "company_branch"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2",
    staticStyle: {
      display: "none"
    },
    attrs: {
      id: "branch_required_tag"
    }
  }, [_vm._v("*")]), _vm._v("分店名\r\n                        ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_branch",
      name: "company_branch",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：文心店",
      disabled: ""
    }
  })])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_shortName"
    }
  }, [_vm._v("簡稱")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_shortName",
      name: "company_shortName",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：尚達"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_principal"
    }
  }, [_vm._v("負責人姓名")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_principal",
      name: "company_principal",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：王大明"
    }
  })])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "custom-control custom-switch"
  }, [_c("input", {
    staticClass: "custom-control-input",
    attrs: {
      type: "checkbox",
      name: "company_monthlyCheck",
      id: "company_monthlyCheck",
      value: "1",
      checked: ""
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "custom-control-label",
    attrs: {
      "for": "company_monthlyCheck"
    }
  }, [_c("small", [_vm._v("日結")])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_uncheckedAmount"
    }
  }, [_vm._v("\r\n                            未沖銷帳款\r\n                        ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_uncheckedAmount",
      name: "company_uncheckedAmount",
      type: "text",
      value: "0",
      autocomplete: "off"
    }
  })]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_totalConsumption"
    }
  }, [_vm._v("\r\n                            總消費額\r\n                        ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_totalConsumption",
      name: "company_totalConsumption",
      type: "text",
      value: "0",
      autocomplete: "off"
    }
  })]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_comment"
    }
  }, [_vm._v("備註")]), _vm._v(" "), _c("textarea", {
    staticClass: "form-control",
    attrs: {
      id: "company_comment",
      name: "company_comment",
      type: "text"
    }
  })])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12 mb-2"
  }, [_c("h4", [_vm._v("4. 填寫聯絡資訊")]), _vm._v(" "), _c("small", [_vm._v("聯絡人手機與聯絡人電話欄位擇一填寫。")])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_tel"
    }
  }, [_vm._v("公司電話")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_tel",
      name: "company_tel",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：0412345678"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v('電話請包含區碼並省略"-"。')])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_tax"
    }
  }, [_vm._v("公司傳真")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_tax",
      name: "company_tax",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：0412345678"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v('傳真請包含區碼並省略"-"。')])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_email"
    }
  }, [_vm._v("公司信箱")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_email",
      name: "company_email",
      type: "email",
      value: "",
      autocomplete: "off",
      placeholder: "例：test@example.com"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-2"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_lineID"
    }
  }, [_vm._v("Line ID")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_lineID",
      name: "company_lineID",
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
    staticClass: "col-md-2"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_operator_name_1"
    }
  }, [_vm._v("\r\n                    聯絡窗口1 - 姓名\r\n                ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "company_operator_name_1",
      name: "company_operator_name_1",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：王大明"
    }
  }), _vm._v(" "), _c("div", {
    staticClass: "custom-control custom-switch"
  }, [_c("input", {
    staticClass: "custom-control-input",
    attrs: {
      type: "checkbox",
      id: "isSameAsPrincipal",
      value: "1"
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "custom-control-label",
    attrs: {
      "for": "isSameAsPrincipal"
    }
  }, [_c("small", [_vm._v("與負責人相同")])])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_operator_tel_1"
    }
  }, [_vm._v("\r\n                    聯絡窗口1 - 電話\r\n                ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_operator_tel_1",
      name: "company_operator_tel_1",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：0412345678"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v('電話請包含區碼並省略"-"。')]), _vm._v(" "), _c("div", {
    staticClass: "custom-control custom-switch"
  }, [_c("input", {
    staticClass: "custom-control-input",
    attrs: {
      type: "checkbox",
      id: "isSameAsComTel",
      value: "1"
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "custom-control-label",
    attrs: {
      "for": "isSameAsComTel"
    }
  }, [_c("small", [_vm._v("與公司電話相同")])])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_operator_phone_1"
    }
  }, [_c("span", {
    staticClass: "text-warning mr-2"
  }, [_vm._v("*")]), _vm._v("聯絡窗口1 - 手機\r\n                ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_operator_phone_1",
      name: "company_operator_phone_1",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：0912345678"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v("手機號碼不需+886")])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_operator_email_1"
    }
  }, [_vm._v("聯絡窗口1 - 信箱")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_operator_email_1",
      name: "company_operator_email_1",
      type: "email",
      value: "",
      autocomplete: "off",
      placeholder: "例：test@example.com"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v("此信箱不綁定帳號，用於聯絡")]), _vm._v(" "), _c("div", {
    staticClass: "custom-control custom-switch"
  }, [_c("input", {
    staticClass: "custom-control-input",
    attrs: {
      type: "checkbox",
      id: "isSameAsComEmail",
      value: "1"
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "custom-control-label",
    attrs: {
      "for": "isSameAsComEmail"
    }
  }, [_c("small", [_vm._v("與公司信箱相同")])])])])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-2"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_operator_name_2"
    }
  }, [_vm._v("聯絡窗口2 - 姓名")]), _vm._v(" "), _c("input", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "company_operator_name_2",
      name: "company_operator_name_2",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：王大明"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_operator_tel_2"
    }
  }, [_vm._v("聯絡窗口2 - 電話")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_operator_tel_2",
      name: "company_operator_tel_2",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：0412345678"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v('電話請包含區碼並省略"-"。')])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_operator_phone_2"
    }
  }, [_c("span", {
    staticClass: "text-warning mr-2"
  }, [_vm._v("*")]), _vm._v("聯絡窗口2 - 手機\r\n                ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_operator_phone_2",
      name: "company_operator_phone_2",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：0912345678"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v("手機號碼不需+886")])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "company_operator_email_2"
    }
  }, [_vm._v("聯絡窗口2 - 信箱")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_operator_email_2",
      name: "company_operator_email_2",
      type: "email",
      value: "",
      autocomplete: "off",
      placeholder: "例：test@example.com"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v("此信箱不綁定帳號，用於聯絡")])])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group",
    attrs: {
      id: "company_address_twzipcode"
    }
  }, [_c("label", [_vm._v("公司地址")]), _vm._v(" "), _c("div", {
    staticClass: "row mb-2"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "county",
      "data-style": "form-control",
      "data-name": "company_address_county",
      "data-value": ""
    }
  })]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "district",
      "data-style": "form-control",
      "data-name": "company_address_district",
      "data-value": ""
    }
  })]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "zipcode",
      "data-style": "form-control",
      "data-name": "company_address_zipcode",
      "data-value": ""
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_address_others",
      type: "text",
      name: "company_address_others",
      value: "",
      autocomplete: "off"
    }
  })])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group",
    attrs: {
      id: "company_deliveryAddress_twzipcode"
    }
  }, [_c("label", [_vm._v("送貨地址")]), _vm._v(" "), _c("div", {
    staticClass: "row mb-2"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "county",
      "data-style": "form-control",
      "data-name": "company_deliveryAddress_county",
      "data-value": ""
    }
  })]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "district",
      "data-style": "form-control",
      "data-name": "company_deliveryAddress_district",
      "data-value": ""
    }
  })]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "zipcode",
      "data-style": "form-control",
      "data-name": "company_deliveryAddress_zipcode",
      "data-value": ""
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "row mb-2"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("input", {
    staticClass: "form-control",
    attrs: {
      id: "company_deliveryAddress_others",
      type: "text",
      name: "company_deliveryAddress_others",
      value: "",
      autocomplete: "off"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    staticClass: "custom-control custom-switch"
  }, [_c("input", {
    staticClass: "custom-control-input",
    attrs: {
      type: "checkbox",
      name: "isSameAsComAddress",
      id: "isSameAsComAddress",
      value: "1"
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "custom-control-label",
    attrs: {
      "for": "isSameAsComAddress"
    }
  }, [_c("small", [_vm._v("與公司地址相同")])])])])])])])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=template&id=0b3ba368&":
/*!***********************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=template&id=0b3ba368& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("form", {
    staticStyle: {
      display: "none"
    },
    attrs: {
      id: "individual_form",
      method: "POST",
      action: _vm.ConsumersStoreURL,
      enctype: "multipart/form-data"
    },
    on: {
      submit: function submit($event) {
        $event.preventDefault();
        return _vm.consumerCreateForm.apply(null, arguments);
      }
    }
  }, [_c("input", {
    attrs: {
      id: "individual_account_type",
      name: "account_type",
      type: "hidden",
      value: "individual"
    }
  }), _vm._v(" "), _vm._m(0), _vm._v(" "), _vm._m(1), _vm._v(" "), _vm._m(2), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6 text-center"
  }, [_c("upload-images", {
    ref: "uploadIndividualConsumerAvatars",
    attrs: {
      uploadimg: _vm.uploadimg,
      title: _vm.title,
      "aspect-ratio": 1,
      prefix: "IndividualConsumer"
    }
  })], 1), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_vm._m(3), _vm._v(" "), _vm._m(4), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_vm._m(5), _vm._v(" "), _c("select", {
    staticClass: "form-control mb-2",
    attrs: {
      id: "individual_monthlyCheckDate",
      name: "individual_monthlyCheckDate",
      disabled: ""
    }
  }, [_c("option", {
    attrs: {
      value: "0"
    }
  }, [_vm._v("請選擇...")]), _vm._v(" "), _vm._l(31, function (n) {
    return _c("option", {
      key: n,
      domProps: {
        value: n
      }
    }, [_vm._v(_vm._s(n))]);
  })], 2), _vm._v(" "), _vm._m(6)])]), _vm._v(" "), _vm.formtype == "backend" ? _c("div", {
    staticClass: "col-md-4"
  }, [_vm._m(7)]) : _vm._e(), _vm._v(" "), _vm.formtype == "backend" ? _c("div", {
    staticClass: "col-md-4"
  }, [_vm._m(8)]) : _vm._e()]), _vm._v(" "), _vm._m(9)])]), _vm._v(" "), _vm._m(10), _vm._v(" "), _vm._m(11), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_vm._m(12), _vm._v(" "), _vm.formtype == "frontend" ? _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_vm._m(13), _vm._v(" "), _c("vue-recaptcha", {
    attrs: {
      sitekey: _vm.captchasitekey,
      loadRecaptchaScript: true
    }
  })], 1)]) : _vm._e()]), _vm._v(" "), _c("div", {
    staticClass: "row justify-content-center"
  }, [_c("div", {
    staticClass: "col-md-8"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_vm.formtype == "backend" ? _c("button", {
    staticClass: "btn btn-block btn-primary",
    attrs: {
      type: "submit"
    }
  }, [_vm._v("\r\n                    確認新增\r\n                ")]) : _c("button", {
    staticClass: "btn btn-block btn-primary",
    attrs: {
      type: "submit"
    }
  }, [_vm._v("\r\n                    註冊\r\n                ")]), _vm._v(" "), _c("a", {
    staticClass: "btn btn-block btn-danger",
    attrs: {
      href: _vm.ConsumersIndexURL
    }
  }, [_vm._v("\r\n                    返回列表\r\n                ")])])])])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12 mb-2"
  }, [_c("h4", [_vm._v("2. 填寫帳戶資訊")])])]);
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
      "for": "individual_account"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("帳號\r\n                ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_account",
      name: "individual_account",
      type: "text",
      value: "",
      required: "",
      autocomplete: "off",
      placeholder: "請輸入6~30個英文或數字"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_password"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("密碼\r\n                ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_password",
      name: "individual_password",
      type: "password",
      value: "",
      required: "",
      autocomplete: "off",
      placeholder: "請輸入至少6個英文或數字"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_password_confirmation"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("密碼確認\r\n                ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_password_confirmation",
      name: "individual_password_confirmation",
      type: "password",
      value: "",
      required: "",
      autocomplete: "off",
      placeholder: "請再次輸入密碼"
    }
  })])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12 mb-2"
  }, [_c("h4", [_vm._v("3. 填寫基本資訊")])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_name"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("姓名\r\n                        ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_name",
      name: "individual_name",
      type: "text",
      value: "",
      required: "",
      autocomplete: "off",
      placeholder: "例：王大明"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_shortName"
    }
  }, [_vm._v("簡稱")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_shortName",
      name: "individual_shortName",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：明哥"
    }
  })])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_gender"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("性別\r\n                        ")]), _vm._v(" "), _c("select", {
    staticClass: "form-control",
    attrs: {
      id: "individual_gender",
      name: "individual_gender",
      required: ""
    }
  }, [_c("option", {
    attrs: {
      value: "0"
    }
  }, [_vm._v("女")]), _vm._v(" "), _c("option", {
    attrs: {
      value: "1"
    }
  }, [_vm._v("男")])])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_birthday"
    }
  }, [_vm._v("生日")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_birthday",
      name: "individual_birthday",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：1950-01-01"
    }
  })])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("label", {
    attrs: {
      "for": "individual_monthlyCheckDate"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("月結日\r\n                        ")]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "custom-control custom-switch"
  }, [_c("input", {
    staticClass: "custom-control-input",
    attrs: {
      type: "checkbox",
      name: "individual_monthlyCheck",
      id: "individual_monthlyCheck",
      value: "1",
      checked: ""
    }
  }), _vm._v(" "), _c("label", {
    staticClass: "custom-control-label",
    attrs: {
      "for": "individual_monthlyCheck"
    }
  }, [_c("small", [_vm._v("日結")])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_uncheckedAmount"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("未沖銷帳款\r\n                        ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_uncheckedAmount",
      name: "individual_uncheckedAmount",
      type: "text",
      value: "0",
      autocomplete: "off",
      required: ""
    }
  })]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_totalConsumption"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("總消費額\r\n                        ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_totalConsumption",
      name: "individual_totalConsumption",
      type: "text",
      value: "0",
      autocomplete: "off",
      required: ""
    }
  })]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_comment"
    }
  }, [_vm._v("備註")]), _vm._v(" "), _c("textarea", {
    staticClass: "form-control",
    attrs: {
      id: "individual_comment",
      name: "individual_comment",
      type: "text"
    }
  })])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12 mb-2"
  }, [_c("h4", [_vm._v("4. 填寫聯絡資訊")]), _vm._v(" "), _c("small", [_vm._v("手機與電話欄位擇一填寫。")])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_phone"
    }
  }, [_c("span", {
    staticClass: "text-warning mr-2"
  }, [_vm._v("*")]), _vm._v("手機\r\n                ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_phone",
      name: "individual_phone",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：0912345678",
      required: ""
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v("手機號碼不需+886。")])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-3"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_tel"
    }
  }, [_c("span", {
    staticClass: "text-warning mr-2"
  }, [_vm._v("*")]), _vm._v("電話\r\n                ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_tel",
      name: "individual_tel",
      type: "text",
      value: "",
      autocomplete: "off",
      placeholder: "例：0412345678"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v('電話請包含區碼並省略"-"。')])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_email"
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("信箱\r\n                ")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_email",
      name: "individual_email",
      type: "email",
      value: "",
      autocomplete: "off",
      required: "",
      placeholder: "例：test@example.com"
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted"
  }, [_vm._v("請填寫正確並可使用之信箱。")])])]), _vm._v(" "), _c("div", {
    staticClass: "col-md-2"
  }, [_c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    attrs: {
      "for": "individual_lineID"
    }
  }, [_vm._v("Line ID")]), _vm._v(" "), _c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_lineID",
      name: "individual_lineID",
      type: "text",
      value: "",
      autocomplete: "off"
    }
  })])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "col-md-6"
  }, [_c("div", {
    staticClass: "form-group",
    attrs: {
      id: "individual_address_twzipcode"
    }
  }, [_c("label", [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("地址")]), _vm._v(" "), _c("div", {
    staticClass: "row mb-2"
  }, [_c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "county",
      "data-style": "form-control",
      "data-name": "individual_address_county",
      "data-value": "",
      "data-required": "1"
    }
  })]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "district",
      "data-style": "form-control",
      "data-name": "individual_address_district",
      "data-value": "",
      "data-required": "1"
    }
  })]), _vm._v(" "), _c("div", {
    staticClass: "col-md-4"
  }, [_c("div", {
    attrs: {
      "data-role": "zipcode",
      "data-style": "form-control",
      "data-name": "individual_address_zipcode",
      "data-value": "",
      "data-required": "1"
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("input", {
    staticClass: "form-control",
    attrs: {
      id: "individual_address_others",
      type: "text",
      name: "individual_address_others",
      value: "",
      required: "",
      autocomplete: "off"
    }
  })])])])]);
}, function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("label", {
    attrs: {
      "for": ""
    }
  }, [_c("span", {
    staticClass: "text-danger mr-2"
  }, [_vm._v("*")]), _vm._v("機器人驗證")]);
}];
render._withStripped = true;


/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/UploadImages.vue?vue&type=template&id=43e6710a&":
/*!******************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Partials/UploadImages.vue?vue&type=template&id=43e6710a& ***!
  \******************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "form-group"
  }, [_c("div", {
    staticClass: "col-md-12 px-0",
    attrs: {
      id: _vm.prefix + "_preview-image-div"
    }
  }, [_c("img", {
    staticClass: "img-fluid rounded",
    attrs: {
      id: _vm.prefix + "_preview-image",
      src: _vm.uploadimg
    }
  })])]), _vm._v(" "), _c("div", {
    staticClass: "form-group"
  }, [_c("label", {
    staticClass: "mb-2",
    attrs: {
      "for": _vm.prefix + "_image_file"
    }
  }, [_vm._v("\r\n            " + _vm._s(_vm.title) + "\r\n        ")]), _vm._v(" "), _c("div", {
    staticClass: "custom-file"
  }, [_c("input", {
    attrs: {
      type: "hidden",
      id: _vm.prefix + "_image_url",
      name: "image_url"
    },
    domProps: {
      value: _vm.ImageURL
    }
  }), _vm._v(" "), _c("input", {
    attrs: {
      type: "hidden",
      id: _vm.prefix + "_image_data",
      name: "image_data"
    },
    domProps: {
      value: _vm.cropData
    }
  }), _vm._v(" "), _c("input", {
    staticClass: "custom-file-input",
    attrs: {
      type: "file",
      id: _vm.prefix + "_image_file",
      name: "image_file",
      accept: "image/jpeg,image/png,image/bmp",
      "aria-describedby": "PictureHelp"
    },
    on: {
      change: _vm.spwanPreviewImg
    }
  }), _vm._v(" "), _c("small", {
    staticClass: "form-text text-muted",
    attrs: {
      id: _vm.prefix + "_PictureHelp"
    }
  }, [_vm._v("僅支援JPG、JPEG、PNG與BMP格式圖片，且檔案大小上限為20MB。" + _vm._s(_vm.helptext || ""))]), _vm._v(" "), _c("label", {
    staticClass: "custom-file-label",
    attrs: {
      id: _vm.prefix + "_file_label",
      "for": _vm.prefix + "_image_file"
    }
  }, [_vm._v("請選擇檔案")])])])]);
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

/***/ "./resources/js/components/Consumers/CompanyConsumerCreateForm.vue":
/*!*************************************************************************!*\
  !*** ./resources/js/components/Consumers/CompanyConsumerCreateForm.vue ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CompanyConsumerCreateForm_vue_vue_type_template_id_2fa9c2c6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CompanyConsumerCreateForm.vue?vue&type=template&id=2fa9c2c6& */ "./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=template&id=2fa9c2c6&");
/* harmony import */ var _CompanyConsumerCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CompanyConsumerCreateForm.vue?vue&type=script&lang=js& */ "./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CompanyConsumerCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CompanyConsumerCreateForm_vue_vue_type_template_id_2fa9c2c6___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CompanyConsumerCreateForm_vue_vue_type_template_id_2fa9c2c6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Consumers/CompanyConsumerCreateForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CompanyConsumerCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./CompanyConsumerCreateForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CompanyConsumerCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=template&id=2fa9c2c6&":
/*!********************************************************************************************************!*\
  !*** ./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=template&id=2fa9c2c6& ***!
  \********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_CompanyConsumerCreateForm_vue_vue_type_template_id_2fa9c2c6___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./CompanyConsumerCreateForm.vue?vue&type=template&id=2fa9c2c6& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/CompanyConsumerCreateForm.vue?vue&type=template&id=2fa9c2c6&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_CompanyConsumerCreateForm_vue_vue_type_template_id_2fa9c2c6___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_CompanyConsumerCreateForm_vue_vue_type_template_id_2fa9c2c6___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Consumers/IndividualConsumerCreateForm.vue":
/*!****************************************************************************!*\
  !*** ./resources/js/components/Consumers/IndividualConsumerCreateForm.vue ***!
  \****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _IndividualConsumerCreateForm_vue_vue_type_template_id_0b3ba368___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./IndividualConsumerCreateForm.vue?vue&type=template&id=0b3ba368& */ "./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=template&id=0b3ba368&");
/* harmony import */ var _IndividualConsumerCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./IndividualConsumerCreateForm.vue?vue&type=script&lang=js& */ "./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _IndividualConsumerCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _IndividualConsumerCreateForm_vue_vue_type_template_id_0b3ba368___WEBPACK_IMPORTED_MODULE_0__["render"],
  _IndividualConsumerCreateForm_vue_vue_type_template_id_0b3ba368___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Consumers/IndividualConsumerCreateForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_IndividualConsumerCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./IndividualConsumerCreateForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_IndividualConsumerCreateForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=template&id=0b3ba368&":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=template&id=0b3ba368& ***!
  \***********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_IndividualConsumerCreateForm_vue_vue_type_template_id_0b3ba368___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./IndividualConsumerCreateForm.vue?vue&type=template&id=0b3ba368& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Consumers/IndividualConsumerCreateForm.vue?vue&type=template&id=0b3ba368&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_IndividualConsumerCreateForm_vue_vue_type_template_id_0b3ba368___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_IndividualConsumerCreateForm_vue_vue_type_template_id_0b3ba368___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/Partials/UploadImages.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/Partials/UploadImages.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _UploadImages_vue_vue_type_template_id_43e6710a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./UploadImages.vue?vue&type=template&id=43e6710a& */ "./resources/js/components/Partials/UploadImages.vue?vue&type=template&id=43e6710a&");
/* harmony import */ var _UploadImages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./UploadImages.vue?vue&type=script&lang=js& */ "./resources/js/components/Partials/UploadImages.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _UploadImages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _UploadImages_vue_vue_type_template_id_43e6710a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _UploadImages_vue_vue_type_template_id_43e6710a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Partials/UploadImages.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Partials/UploadImages.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/Partials/UploadImages.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UploadImages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./UploadImages.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/UploadImages.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_UploadImages_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Partials/UploadImages.vue?vue&type=template&id=43e6710a&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/Partials/UploadImages.vue?vue&type=template&id=43e6710a& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_UploadImages_vue_vue_type_template_id_43e6710a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../node_modules/vue-loader/lib??vue-loader-options!./UploadImages.vue?vue&type=template&id=43e6710a& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Partials/UploadImages.vue?vue&type=template&id=43e6710a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_UploadImages_vue_vue_type_template_id_43e6710a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_UploadImages_vue_vue_type_template_id_43e6710a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/consumers/create.js":
/*!******************************************!*\
  !*** ./resources/js/consumers/create.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

Vue.component('individual-consumer-create-form', __webpack_require__(/*! ./../components/Consumers/IndividualConsumerCreateForm.vue */ "./resources/js/components/Consumers/IndividualConsumerCreateForm.vue")["default"]);
Vue.component('company-consumer-create-form', __webpack_require__(/*! ./../components/Consumers/CompanyConsumerCreateForm.vue */ "./resources/js/components/Consumers/CompanyConsumerCreateForm.vue")["default"]);
Vue.component('upload-images', __webpack_require__(/*! ./../components/Partials/UploadImages.vue */ "./resources/js/components/Partials/UploadImages.vue")["default"]);
var app = new Vue({
  el: '#consumer',
  data: function data() {
    return {};
  },
  methods: {},
  created: function created() {},
  mounted: function mounted() {
    $('#individual_btn').click(function (e) {
      $('#individual_form').slideDown();
      $('#individual_btn').attr('disabled', true);
      $('#company_btn').attr('disabled', true);
      $('#step1').slideUp();
      $('#goback2step1').slideDown();
      $('#individual_act').focus();
    });
    $('#company_btn').click(function (e) {
      $('#company_form').slideDown();
      $('#individual_btn').attr('disabled', true);
      $('#company_btn').attr('disabled', true);
      $('#step1').slideUp();
      $('#goback2step1').slideDown();
    });
    $('#goback2step1_btn').click(function (e) {
      $('#individual_form').slideUp();
      $('#company_form').slideUp();
      $('#individual_btn').attr('disabled', false);
      $('#company_btn').attr('disabled', false);
      $('#step1').slideDown();
      $('#goback2step1').slideUp();
    });
  }
});

/***/ }),

/***/ 37:
/*!************************************************!*\
  !*** multi ./resources/js/consumers/create.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\AppServ\www\Shangda\resources\js\consumers\create.js */"./resources/js/consumers/create.js");


/***/ })

/******/ });