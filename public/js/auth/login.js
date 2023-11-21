!function(t){var e={};function r(n){if(e[n])return e[n].exports;var o=e[n]={i:n,l:!1,exports:{}};return t[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=t,r.c=e,r.d=function(t,e,n){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)r.d(n,o,function(e){return t[e]}.bind(null,o));return n},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="/",r(r.s=108)}({0:function(t,e,r){"use strict";function n(t,e,r,n,o,s,a,i){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=r,u._compiled=!0),n&&(u.functional=!0),s&&(u._scopeId="data-v-"+s),a?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},u._ssrRegister=c):o&&(c=i?function(){o.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:o),c)if(u.functional){u._injectStyles=c;var l=u.render;u.render=function(t,e){return c.call(e),l(t,e)}}else{var d=u.beforeCreate;u.beforeCreate=d?[].concat(d,c):[c]}return{exports:t,options:u}}r.d(e,"a",(function(){return n}))},108:function(t,e,r){t.exports=r(109)},109:function(t,e,r){Vue.component("login-form",r(202).default);new Vue({el:"#auth",data:function(){return{}},methods:{},created:function(){},mounted:function(){}})},202:function(t,e,r){"use strict";r.r(e);var n={props:[],data:function(){return{LoginURL:$("#LoginURL").text(),ForgetPasswordURL:$("#ForgetPasswordURL").text()}},methods:{login:function(t){$(".form-input").removeClass("error");var e=$(t.target).serializeObject();$.showLoadingModal("驗證帳戶資訊中..."),axios.post(this.LoginURL,e).then((function(t){""!=$("#IntendedURL").html()&&null!=$("#IntendedURL").html()?location.href=$("#IntendedURL").html():location.href=t.data.redirect_url})).catch((function(t){(console.error("登入失敗，錯誤訊息："+t),null==t.response.data.errors)?$.showErrorModalWithoutError("登入失敗，錯誤訊息："+t.response.data.message+"\n請聯絡系統設計師處理。"):(console.error(t.response.data.errors),$.showErrorModal(t),Object.keys(t.response.data.errors).forEach((function(e,r){$("#"+e+"-ic").addClass("error"),$("#"+e+"-error-msg").html("<strong>"+t.response.data.errors[e]+"</strong>")})))}))}},created:function(){},mounted:function(){}},o=r(0),s=Object(o.a)(n,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"auth-panel bg-dark"},[e("form",{staticClass:"auth-form",attrs:{action:"#",method:"POST"},on:{submit:function(e){return e.preventDefault(),t.login.apply(null,arguments)}}},[e("h2",{staticClass:"form-title"},[t._v("後台登入")]),t._v(" "),t._m(0),t._v(" "),t._m(1),t._v(" "),e("div",{staticClass:"auth-login-footer"},[t._m(2),t._v(" "),e("div",[e("a",{staticClass:"form-link",attrs:{href:t.ForgetPasswordURL}},[t._v("忘記密碼？")])])]),t._v(" "),t._m(3)])])}),[function(){var t=this._self._c;return t("div",{staticClass:"input-container mb-2",attrs:{id:"account-ic"}},[t("input",{staticClass:"form-control form-input mb-2",attrs:{type:"text",name:"account",autocomplete:"off",placeholder:"帳號",required:"",autofocus:""}}),this._v(" "),t("small",{staticClass:"error-message",attrs:{id:"account-error-msg"}})])},function(){var t=this._self._c;return t("div",{staticClass:"input-container m-b-12",attrs:{id:"password-ic"}},[t("input",{staticClass:"form-control form-input mb-2",attrs:{type:"password",name:"password",autocomplete:"current-password",placeholder:"密碼",required:""}}),this._v(" "),t("small",{staticClass:"error-message",attrs:{id:"password-error-msg"}})])},function(){var t=this._self._c;return t("div",{staticClass:"checkbox-container"},[t("input",{staticClass:"checkbox-input",attrs:{type:"checkbox",name:"remember",id:"remember"}}),this._v(" "),t("label",{staticClass:"checkbox-label",attrs:{for:"remember"}},[this._v("\r\n                    記住我\r\n                ")])])},function(){var t=this._self._c;return t("div",{staticClass:"button-container"},[t("button",{staticClass:"submit-button",attrs:{type:"submit"}},[this._v("登入")])])}],!1,null,null,null);e.default=s.exports}});