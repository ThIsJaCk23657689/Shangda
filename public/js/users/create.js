!function(t){var s={};function e(a){if(s[a])return s[a].exports;var r=s[a]={i:a,l:!1,exports:{}};return t[a].call(r.exports,r,r.exports,e),r.l=!0,r.exports}e.m=t,e.c=s,e.d=function(t,s,a){e.o(t,s)||Object.defineProperty(t,s,{enumerable:!0,get:a})},e.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e.t=function(t,s){if(1&s&&(t=e(t)),8&s)return t;if(4&s&&"object"==typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(e.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&s&&"string"!=typeof t)for(var r in t)e.d(a,r,function(s){return t[s]}.bind(null,r));return a},e.n=function(t){var s=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(s,"a",s),s},e.o=function(t,s){return Object.prototype.hasOwnProperty.call(t,s)},e.p="/",e(e.s=96)}({0:function(t,s,e){"use strict";function a(t,s,e,a,r,o,i,n){var l,c="function"==typeof t?t.options:t;if(s&&(c.render=s,c.staticRenderFns=e,c._compiled=!0),a&&(c.functional=!0),o&&(c._scopeId="data-v-"+o),i?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},c._ssrRegister=l):r&&(l=n?function(){r.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:r),l)if(c.functional){c._injectStyles=l;var d=c.render;c.render=function(t,s){return l.call(s),d(t,s)}}else{var u=c.beforeCreate;c.beforeCreate=u?[].concat(u,l):[l]}return{exports:t,options:c}}e.d(s,"a",(function(){return a}))},183:function(t,s,e){"use strict";e.r(s);var a={props:["jobTitles"],data:function(){return{UsersIndexURL:$("#UsersIndexURL").text(),UsersStoreURL:$("#UsersStoreURL").text()}},methods:{userCreateForm:function(t){var s=this.UsersStoreURL,e=$(t.target).serializeObject();$.showLoadingModal(),axios.post(s,e).then((function(t){$.showSuccessModal(t.data.message,t.data.url)})).catch((function(t){console.error("新增員工時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))}},mounted:function(){$("#address_twzipcode").twzipcode({readonly:!1}),$("#birthday").datepicker({dateFormat:"yy-mm-dd",changeYear:!0,changeMonth:!0,yearRange:"-80:+0",maxDate:"-15y"})}},r=e(0),o=Object(r.a)(a,(function(){var t=this,s=t._self._c;return s("div",{staticClass:"row justify-content-center"},[s("div",{staticClass:"col-md-10"},[s("form",{attrs:{method:"POST",id:"user_create_form",action:"#"},on:{submit:function(s){return s.preventDefault(),t.userCreateForm.apply(null,arguments)}}},[s("div",{staticClass:"row"},[t._m(0),t._v(" "),t._m(1),t._v(" "),t._m(2),t._v(" "),s("div",{staticClass:"col-md-3"},[s("div",{staticClass:"form-group"},[t._m(3),t._v(" "),s("select",{staticClass:"form-control",attrs:{name:"jobTitle",id:"jobTitle",required:""}},t._l(t.jobTitles,(function(e){return s("option",{key:e.id,domProps:{value:e.id}},[t._v(t._s(e.name))])})),0)])])]),t._v(" "),t._m(4),t._v(" "),t._m(5),t._v(" "),t._m(6),t._v(" "),s("div",{staticClass:"form-group row justify-content-center"},[s("div",{staticClass:"col-md-8"},[s("button",{staticClass:"btn btn-block btn-primary",attrs:{type:"submit"}},[t._v("\r\n                        確認新增\r\n                    ")]),t._v(" "),s("a",{staticClass:"btn btn-block btn-danger",attrs:{href:t.UsersIndexURL}},[t._v("\r\n                        返回列表\r\n                    ")])])])])])])}),[function(){var t=this._self._c;return t("div",{staticClass:"col-md-3"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"name"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("姓名\r\n                        ")]),this._v(" "),t("input",{staticClass:"form-control mb-2",attrs:{id:"name",name:"name",type:"text",value:"",required:"",autocomplete:"off",autofocus:""}})])])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"email"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("信箱")]),this._v(" "),t("input",{staticClass:"form-control",attrs:{id:"email",name:"email",type:"email",value:"",required:"",autocomplete:"off"}})])])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-2"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"gender"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("性別")]),this._v(" "),t("select",{staticClass:"form-control",attrs:{name:"gender",id:"gender",required:""}},[t("option",{attrs:{value:"0"}},[this._v("小姐")]),this._v(" "),t("option",{attrs:{value:"1"}},[this._v("先生")])])])])},function(){var t=this._self._c;return t("label",{attrs:{for:"jobTitle"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("職稱")])},function(){var t=this,s=t._self._c;return s("div",{staticClass:"row"},[s("div",{staticClass:"col-md-4"},[s("div",{staticClass:"form-group"},[s("label",{attrs:{for:"account"}},[s("span",{staticClass:"text-danger mr-2"},[t._v("*")]),t._v("帳號")]),t._v(" "),s("input",{staticClass:"form-control mb-2",attrs:{id:"account",name:"account",type:"text",value:"",required:"",autocomplete:"off"}})])]),t._v(" "),s("div",{staticClass:"col-md-4"},[s("div",{staticClass:"form-group"},[s("label",{attrs:{for:"password"}},[s("span",{staticClass:"text-danger mr-2"},[t._v("*")]),t._v("密碼")]),t._v(" "),s("input",{staticClass:"form-control mb-2",attrs:{id:"password",name:"password",type:"password",value:"",required:"",autocomplete:"off"}})])]),t._v(" "),s("div",{staticClass:"col-md-4"},[s("div",{staticClass:"form-group"},[s("label",{attrs:{for:"password_confirmation"}},[s("span",{staticClass:"text-danger mr-2"},[t._v("*")]),t._v("密碼確認")]),t._v(" "),s("input",{staticClass:"form-control mb-2",attrs:{id:"password_confirmation",name:"password_confirmation",type:"password",value:"",required:"",autocomplete:"off"}})])])])},function(){var t=this._self._c;return t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"tel"}},[this._v("電話")]),this._v(" "),t("input",{staticClass:"form-control mb-2",attrs:{id:"tel",name:"tel",type:"text",value:"",placeholder:"例：0412345678",autocomplete:"off"}})])]),this._v(" "),t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"phone"}},[this._v("手機")]),this._v(" "),t("input",{staticClass:"form-control mb-2",attrs:{id:"phone",name:"phone",type:"text",value:"",placeholder:"例：0912345678",autocomplete:"off"}})])]),this._v(" "),t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"birthday"}},[this._v("生日")]),this._v(" "),t("input",{staticClass:"form-control mb-2",attrs:{id:"birthday",name:"birthday",type:"text",value:"",autocomplete:"off"}})])])])},function(){var t=this._self._c;return t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"form-group"},[t("label",{attrs:{for:"comment"}},[this._v("備註內容")]),this._v(" "),t("textarea",{staticClass:"form-control",attrs:{name:"comment",id:"comment",rows:"3"}})])]),this._v(" "),t("div",{staticClass:"col-md-8"},[t("div",{staticClass:"form-group",attrs:{id:"address_twzipcode"}},[t("label",[this._v("地址")]),this._v(" "),t("div",{staticClass:"row mb-2"},[t("div",{staticClass:"col-md-4"},[t("div",{attrs:{"data-role":"county","data-style":"form-control","data-name":"address_county","data-value":""}})]),this._v(" "),t("div",{staticClass:"col-md-4"},[t("div",{attrs:{"data-role":"district","data-style":"form-control","data-name":"address_district","data-value":""}})]),this._v(" "),t("div",{staticClass:"col-md-4"},[t("div",{attrs:{"data-role":"zipcode","data-style":"form-control","data-name":"address_zipcode","data-value":""}})])]),this._v(" "),t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-12"},[t("input",{staticClass:"form-control",attrs:{id:"address_others",type:"text",name:"address_others",value:"",autocomplete:"off"}})])])])])])}],!1,null,null,null);s.default=o.exports},96:function(t,s,e){t.exports=e(97)},97:function(t,s,e){Vue.component("user-create-form",e(183).default);new Vue({el:"#user",data:function(){return{jobTitles:[]}},methods:{},created:function(){var t=this;$.showLoadingModal();var s=$("#GetJobTitleListURL").text();axios.get(s).then((function(s){t.jobTitles=s.data.jobTitles,t.jobTitles.splice(3,1),$.closeModal()})).catch((function(t){console.error("抓取職稱清單時發生錯誤，原因："+t),$.showErrorModal(t)}))},mounted:function(){}})}});