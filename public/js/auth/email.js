!function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(r,o,function(e){return t[e]}.bind(null,o));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=103)}({0:function(t,e,n){"use strict";function r(t,e,n,r,o,s,i,a){var u,l="function"==typeof t?t.options:t;if(e&&(l.render=e,l.staticRenderFns=n,l._compiled=!0),r&&(l.functional=!0),s&&(l._scopeId="data-v-"+s),i?(u=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},l._ssrRegister=u):o&&(u=a?function(){o.call(this,(l.functional?this.parent:this).$root.$options.shadowRoot)}:o),u)if(l.functional){l._injectStyles=u;var c=l.render;l.render=function(t,e){return u.call(e),c(t,e)}}else{var d=l.beforeCreate;l.beforeCreate=d?[].concat(d,u):[u]}return{exports:t,options:l}}n.d(e,"a",(function(){return r}))},103:function(t,e,n){t.exports=n(104)},104:function(t,e,n){Vue.component("request-link-form",n(196).default);new Vue({el:"#auth",data:function(){return{}},methods:{},created:function(){},mounted:function(){}})},196:function(t,e,n){"use strict";n.r(e);var r={props:[],data:function(){return{PasswordEmailURL:$("#PasswordEmailURL").text(),counter:60}},methods:{submitRequestForm:function(t){var e=this;$(".input-container").removeClass("error");var n=$(t.target).serializeObject();$.showLoadingModal("驗證帳戶資訊中..."),axios.post(this.PasswordEmailURL,n).then((function(t){$.showSuccessModal(t.data.message),e.disableForm()})).catch((function(t){console.error("請求重設密碼信件失敗，錯誤訊息："+t),$.showErrorModal(t),$(".input-container").addClass("error"),$("#email-error-msg").html(t.response.data.message)}))},countDownTimer:function(){var t=this;this.counter>0?setTimeout((function(){t.counter--,t.countDownTimer()}),1e3):this.enableForm()},enableForm:function(){$(".submit-button").attr("disabled",!1).removeClass("disabled"),$("#email").attr("disabled",!1),$("#counter").fadeTo(100,0).addClass("d-none"),this.counter=60},disableForm:function(){$(".submit-button").attr("disabled",!0).addClass("disabled"),$("#email").attr("disabled",!0),$("#counter").removeClass("d-none").fadeTo(0,100),this.countDownTimer()}},created:function(){},mounted:function(){}},o=n(0),s=Object(o.a)(r,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"auth-panel bg-dark"},[e("form",{staticClass:"auth-form",attrs:{action:"#",method:"POST"},on:{submit:function(e){return e.preventDefault(),t.submitRequestForm.apply(null,arguments)}}},[e("h2",{staticClass:"form-title pb-2"},[t._v("忘記密碼")]),t._v(" "),e("small",{staticClass:"text-white pb-3"},[t._v("我們將為您引導來重新設定您的密碼，請輸入您帳號所綁定的信箱。")]),t._v(" "),t._m(0),t._v(" "),e("small",{staticClass:"text-white mb-2 d-none",attrs:{id:"counter"}},[t._v("沒有收到信件嗎？"+t._s(t.counter)+"秒後重新再試。")]),t._v(" "),t._m(1)])])}),[function(){var t=this._self._c;return t("div",{staticClass:"input-container mb-2"},[t("input",{staticClass:"form-control form-input mb-2",attrs:{type:"email",name:"email",id:"email",autocomplete:"off",placeholder:"信箱",required:""}}),this._v(" "),t("small",{staticClass:"error-message",attrs:{id:"email-error-msg"}})])},function(){var t=this._self._c;return t("div",{staticClass:"button-container"},[t("button",{staticClass:"submit-button",attrs:{type:"submit"}},[this._v("發送重設密碼連結")])])}],!1,null,null,null);e.default=s.exports}});