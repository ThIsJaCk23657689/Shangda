!function(t){var e={};function n(i){if(e[i])return e[i].exports;var o=e[i]={i:i,l:!1,exports:{}};return t[i].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,i){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:i})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var i=Object.create(null);if(n.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(i,o,function(e){return t[e]}.bind(null,o));return i},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=159)}({0:function(t,e,n){"use strict";function i(t,e,n,i,o,r,a,s){var c,l="function"==typeof t?t.options:t;if(e&&(l.render=e,l.staticRenderFns=n,l._compiled=!0),i&&(l.functional=!0),r&&(l._scopeId="data-v-"+r),a?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},l._ssrRegister=c):o&&(c=s?function(){o.call(this,(l.functional?this.parent:this).$root.$options.shadowRoot)}:o),c)if(l.functional){l._injectStyles=c;var u=l.render;l.render=function(t,e){return c.call(e),u(t,e)}}else{var p=l.beforeCreate;l.beforeCreate=p?[].concat(p,c):[c]}return{exports:t,options:l}}n.d(e,"a",(function(){return i}))},159:function(t,e,n){t.exports=n(160)},160:function(t,e,n){Vue.component("announcement-update-form",n(221).default),Vue.component("upload-images",n(17).default);new Vue({el:"#announcement",data:function(){return{announcement:[],AnnouncementsGetOneURL:$("#AnnouncementsGetOneURL").text()}},methods:{},created:function(){var t=this;$.showLoadingModal(),axios.get(this.AnnouncementsGetOneURL).then((function(e){t.announcement=e.data.announcement,$.closeModal()})).catch((function(t){console.error("讀取最新消息資料時發生錯誤："+t),$.showErrorModal(t)}))},mounted:function(){}})},17:function(t,e,n){"use strict";n.r(e);var i={props:["uploadimg","title","aspectRatio","prefix","helptext"],data:function(){return{url:null,isCropActived:!1,cropData:null,ImageURL:null}},methods:{uploadURLImage:function(t){this.stopCropper(),t||(this.ImageURL=null),this.ImageURL=t,$("#"+this.prefix+"_preview-image").attr("src",this.ImageURL),$("#"+this.prefix+"_file_label").text("從爬蟲抓來的圖片")},spwanPreviewImg:function(t){var e,n=$(t.target).prop("files");n.length>0?(e=n[0],this.isImageFile(e)?(this.ImageURL=null,$("#"+this.prefix+"_file_label").text($("#"+this.prefix+"_image_file").prop("files")[0].name),this.url&&URL.revokeObjectURL(this.url),this.url=URL.createObjectURL(e),this.startCropper()):$.showErrorModalWithoutError("只能上傳(png, jpg, jpeg, gif)格式之圖片。")):this.stopCropper()},isImageFile:function(t){return t.type?/^image\/\w+$/.test(t.type):/\.(jpg|jpeg|png|gif|bmp)$/.test(t)},startCropper:function(){var t=this;this.isCropActived?$("#"+this.prefix+"_preview-image").cropper("replace",this.url):($("#"+this.prefix+"_preview-image").attr("src",this.url),$("#"+this.prefix+"_preview-image").cropper({aspectRatio:this.aspectRatio,autoCropArea:.5,movable:!1,zoomable:!1,dragMode:"move",checkCrossOrigin:!1,checkOrientation:!1,crop:function(e){var n=['{"x":'+e.detail.x,'"y":'+e.detail.y,'"height":'+e.detail.height,'"width":'+e.detail.width,'"rotate":'+e.detail.rotate+"}"].join();t.cropData=n}}),this.isCropActived=!0)},stopCropper:function(){this.isCropActived&&($("#"+this.prefix+"_preview-image").cropper("destroy"),$("#"+this.prefix+"_preview-image").attr("src",this.uploadimg),$("#"+this.prefix+"_file_label").text("請選擇檔案"),this.isCropActived=!1)}},created:function(){},mounted:function(){}},o=n(0),r=Object(o.a)(i,(function(){var t=this,e=t._self._c;return e("div",[e("div",{staticClass:"form-group"},[e("div",{staticClass:"col-md-12 px-0",attrs:{id:t.prefix+"_preview-image-div"}},[e("img",{staticClass:"img-fluid rounded",attrs:{id:t.prefix+"_preview-image",src:t.uploadimg}})])]),t._v(" "),e("div",{staticClass:"form-group"},[e("label",{staticClass:"mb-2",attrs:{for:t.prefix+"_image_file"}},[t._v("\r\n            "+t._s(t.title)+"\r\n        ")]),t._v(" "),e("div",{staticClass:"custom-file"},[e("input",{attrs:{type:"hidden",id:t.prefix+"_image_url",name:"image_url"},domProps:{value:t.ImageURL}}),t._v(" "),e("input",{attrs:{type:"hidden",id:t.prefix+"_image_data",name:"image_data"},domProps:{value:t.cropData}}),t._v(" "),e("input",{staticClass:"custom-file-input",attrs:{type:"file",id:t.prefix+"_image_file",name:"image_file",accept:"image/jpeg,image/png,image/bmp","aria-describedby":"PictureHelp"},on:{change:t.spwanPreviewImg}}),t._v(" "),e("small",{staticClass:"form-text text-muted",attrs:{id:t.prefix+"_PictureHelp"}},[t._v("僅支援JPG、JPEG、PNG與BMP格式圖片，且檔案大小上限為20MB。"+t._s(t.helptext||""))]),t._v(" "),e("label",{staticClass:"custom-file-label",attrs:{id:t.prefix+"_file_label",for:t.prefix+"_image_file"}},[t._v("請選擇檔案")])])])])}),[],!1,null,null,null);e.default=r.exports},221:function(t,e,n){"use strict";n.r(e);var i={props:["announcement"],data:function(){return{AnnouncementsIndexURL:$("#AnnouncementsIndexURL").html(),AnnouncementsUpdateURL:$("#AnnouncementsUpdateURL").html()}},methods:{announcementEditForm:function(t){var e=this.AnnouncementsUpdateURL,n=new FormData($(t.target)[0]);n.append("_method","patch"),$.showLoadingModal(),axios.post(e,n).then((function(t){$.showSuccessModal("編輯成功",t.data.url)})).catch((function(t){console.error("編輯最新消息時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))}},created:function(){},mounted:function(){}},o=n(0),r=Object(o.a)(i,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-8"},[e("form",{attrs:{method:"POST",action:"#"},on:{submit:function(e){return e.preventDefault(),t.announcementEditForm.apply(null,arguments)}}},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"title"}},[t._v("標題")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.announcement.title,expression:"announcement.title"}],staticClass:"form-control",attrs:{id:"title",name:"title",type:"text",autocomplete:"off"},domProps:{value:t.announcement.title},on:{input:function(e){e.target.composing||t.$set(t.announcement,"title",e.target.value)}}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12 text-center"},[e("upload-images",{ref:"uploadCoverImages",attrs:{title:"上傳封面圖片","aspect-ratio":1,prefix:"announcement",helptext:"（建議尺寸：500px * 500px）",uploadimg:t.announcement.showCoverImage}})],1)]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"content"}},[t._v("內容")]),t._v(" "),e("textarea",{directives:[{name:"model",rawName:"v-model",value:t.announcement.content,expression:"announcement.content"}],staticClass:"form-control",attrs:{name:"content",id:"content",cols:"30",rows:"5"},domProps:{value:t.announcement.content},on:{input:function(e){e.target.composing||t.$set(t.announcement,"content",e.target.value)}}})])])]),t._v(" "),e("div",{staticClass:"form-group row justify-content-center"},[e("div",{staticClass:"col-md-8"},[e("button",{staticClass:"btn btn-block btn-success",attrs:{type:"submit"}},[t._v("\r\n                        確認編輯\r\n                    ")]),t._v(" "),e("a",{staticClass:"btn btn-block btn-danger",attrs:{href:t.AnnouncementsIndexURL}},[t._v("\r\n                        返回列表\r\n                    ")])])])])])])}),[],!1,null,null,null);e.default=r.exports}});