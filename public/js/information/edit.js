!function(t){var e={};function i(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,i),o.l=!0,o.exports}i.m=t,i.c=e,i.d=function(t,e,r){i.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},i.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},i.t=function(t,e){if(1&e&&(t=i(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(i.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)i.d(r,o,function(e){return t[e]}.bind(null,o));return r},i.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="/",i(i.s=170)}({0:function(t,e,i){"use strict";function r(t,e,i,r,o,n,a,s){var l,p="function"==typeof t?t.options:t;if(e&&(p.render=e,p.staticRenderFns=i,p._compiled=!0),r&&(p.functional=!0),n&&(p._scopeId="data-v-"+n),a?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},p._ssrRegister=l):o&&(l=s?function(){o.call(this,(p.functional?this.parent:this).$root.$options.shadowRoot)}:o),l)if(p.functional){p._injectStyles=l;var c=p.render;p.render=function(t,e){return l.call(e),c(t,e)}}else{var u=p.beforeCreate;p.beforeCreate=u?[].concat(u,l):[l]}return{exports:t,options:p}}i.d(e,"a",(function(){return r}))},17:function(t,e,i){"use strict";i.r(e);var r={props:["uploadimg","title","aspectRatio","prefix","helptext"],data:function(){return{url:null,isCropActived:!1,cropData:null,ImageURL:null}},methods:{uploadURLImage:function(t){this.stopCropper(),t||(this.ImageURL=null),this.ImageURL=t,$("#"+this.prefix+"_preview-image").attr("src",this.ImageURL),$("#"+this.prefix+"_file_label").text("從爬蟲抓來的圖片")},spwanPreviewImg:function(t){var e,i=$(t.target).prop("files");i.length>0?(e=i[0],this.isImageFile(e)?(this.ImageURL=null,$("#"+this.prefix+"_file_label").text($("#"+this.prefix+"_image_file").prop("files")[0].name),this.url&&URL.revokeObjectURL(this.url),this.url=URL.createObjectURL(e),this.startCropper()):$.showErrorModalWithoutError("只能上傳(png, jpg, jpeg, gif)格式之圖片。")):this.stopCropper()},isImageFile:function(t){return t.type?/^image\/\w+$/.test(t.type):/\.(jpg|jpeg|png|gif|bmp)$/.test(t)},startCropper:function(){var t=this;this.isCropActived?$("#"+this.prefix+"_preview-image").cropper("replace",this.url):($("#"+this.prefix+"_preview-image").attr("src",this.url),$("#"+this.prefix+"_preview-image").cropper({aspectRatio:this.aspectRatio,autoCropArea:.5,movable:!1,zoomable:!1,dragMode:"move",checkCrossOrigin:!1,checkOrientation:!1,crop:function(e){var i=['{"x":'+e.detail.x,'"y":'+e.detail.y,'"height":'+e.detail.height,'"width":'+e.detail.width,'"rotate":'+e.detail.rotate+"}"].join();t.cropData=i}}),this.isCropActived=!0)},stopCropper:function(){this.isCropActived&&($("#"+this.prefix+"_preview-image").cropper("destroy"),$("#"+this.prefix+"_preview-image").attr("src",this.uploadimg),$("#"+this.prefix+"_file_label").text("請選擇檔案"),this.isCropActived=!1)}},created:function(){},mounted:function(){}},o=i(0),n=Object(o.a)(r,(function(){var t=this,e=t._self._c;return e("div",[e("div",{staticClass:"form-group"},[e("div",{staticClass:"col-md-12 px-0",attrs:{id:t.prefix+"_preview-image-div"}},[e("img",{staticClass:"img-fluid rounded",attrs:{id:t.prefix+"_preview-image",src:t.uploadimg}})])]),t._v(" "),e("div",{staticClass:"form-group"},[e("label",{staticClass:"mb-2",attrs:{for:t.prefix+"_image_file"}},[t._v("\r\n            "+t._s(t.title)+"\r\n        ")]),t._v(" "),e("div",{staticClass:"custom-file"},[e("input",{attrs:{type:"hidden",id:t.prefix+"_image_url",name:"image_url"},domProps:{value:t.ImageURL}}),t._v(" "),e("input",{attrs:{type:"hidden",id:t.prefix+"_image_data",name:"image_data"},domProps:{value:t.cropData}}),t._v(" "),e("input",{staticClass:"custom-file-input",attrs:{type:"file",id:t.prefix+"_image_file",name:"image_file",accept:"image/jpeg,image/png,image/bmp","aria-describedby":"PictureHelp"},on:{change:t.spwanPreviewImg}}),t._v(" "),e("small",{staticClass:"form-text text-muted",attrs:{id:t.prefix+"_PictureHelp"}},[t._v("僅支援JPG、JPEG、PNG與BMP格式圖片，且檔案大小上限為20MB。"+t._s(t.helptext||""))]),t._v(" "),e("label",{staticClass:"custom-file-label",attrs:{id:t.prefix+"_file_label",for:t.prefix+"_image_file"}},[t._v("請選擇檔案")])])])])}),[],!1,null,null,null);e.default=n.exports},170:function(t,e,i){t.exports=i(171)},171:function(t,e,i){Vue.component("information-update-form",i(230).default),Vue.component("upload-images",i(17).default);new Vue({el:"#information",data:function(){return{information:[],InformationGetOneURL:$("#InformationGetOneURL").text()}},methods:{},created:function(){var t=this;$.showLoadingModal(),axios.get(this.InformationGetOneURL).then((function(e){t.information=e.data.information,$.closeModal()})).catch((function(t){console.error("讀取最新消息資料時發生錯誤："+t),$.showErrorModal(t)}))},mounted:function(){}})},230:function(t,e,i){"use strict";i.r(e);var r={props:["information"],data:function(){return{InformationUpdateURL:$("#InformationUpdateURL").html()}},methods:{informationEditForm:function(t){var e=this.InformationUpdateURL,i=new FormData($(t.target)[0]);i.append("_method","patch"),$.showLoadingModal(),axios.post(e,i).then((function(t){$.showSuccessModal("編輯成功",t.data.url)})).catch((function(t){console.error("編輯首頁封面圖片時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))}},created:function(){},mounted:function(){}},o=i(0),n=Object(o.a)(r,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-8"},[e("form",{attrs:{method:"POST",action:"#"},on:{submit:function(e){return e.preventDefault(),t.informationEditForm.apply(null,arguments)}}},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12 text-center"},[e("upload-images",{ref:"uploadCoverImages",attrs:{title:"上傳封面圖片","aspect-ratio":4/3,prefix:"information",helptext:"",uploadimg:t.information.showCoverImage}})],1)]),t._v(" "),t._m(0)])])])}),[function(){var t=this._self._c;return t("div",{staticClass:"form-group row justify-content-center"},[t("div",{staticClass:"col-md-8"},[t("button",{staticClass:"btn btn-block btn-success",attrs:{type:"submit"}},[this._v("\r\n                        確認編輯\r\n                    ")])])])}],!1,null,null,null);e.default=n.exports}});