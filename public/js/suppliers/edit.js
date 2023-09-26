!function(t){var e={};function a(o){if(e[o])return e[o].exports;var s=e[o]={i:o,l:!1,exports:{}};return t[o].call(s.exports,s,s.exports,a),s.l=!0,s.exports}a.m=t,a.c=e,a.d=function(t,e,o){a.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:o})},a.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},a.t=function(t,e){if(1&e&&(t=a(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var o=Object.create(null);if(a.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var s in t)a.d(o,s,function(e){return t[e]}.bind(null,s));return o},a.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return a.d(e,"a",e),e},a.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},a.p="/",a(a.s=116)}({0:function(t,e,a){"use strict";function o(t,e,a,o,s,r,i,n){var l,p="function"==typeof t?t.options:t;if(e&&(p.render=e,p.staticRenderFns=a,p._compiled=!0),o&&(p.functional=!0),r&&(p._scopeId="data-v-"+r),i?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),s&&s.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},p._ssrRegister=l):s&&(l=n?function(){s.call(this,(p.functional?this.parent:this).$root.$options.shadowRoot)}:s),l)if(p.functional){p._injectStyles=l;var c=p.render;p.render=function(t,e){return l.call(e),c(t,e)}}else{var u=p.beforeCreate;p.beforeCreate=u?[].concat(u,l):[l]}return{exports:t,options:p}}a.d(e,"a",(function(){return o}))},116:function(t,e,a){t.exports=a(117)},117:function(t,e,a){Vue.component("supplier-update-form",a(204).default);new Vue({el:"#supplier",data:function(){return{supplier:[]}},methods:{},created:function(){var t=this;$.showLoadingModal();var e=$("#SuppliersGetOneURL").text();axios.get(e).then((function(e){t.supplier=e.data.supplier,$("#companyAddress_twzipcode").twzipcode({readonly:!1,zipcodeSel:t.supplier.companyAddress_zipcode,county:t.supplier.companyAddress_county,district:t.supplier.companyAddress_district,zipcode:t.supplier.companyAddress_zipcode}),0==t.supplier.monthlyCheckDate||null==t.supplier.monthlyCheckDate?($("#monthlyCheckDate").val(0),$("#monthlyCheckDate").attr("disabled",!0),$("#monthlyCheck").prop("checked",!0)):($("#monthlyCheckDate").attr("disabled",!1),$("#monthlyCheck").prop("checked",!1)),$.closeModal()})).catch((function(t){console.error("抓取供應商資料時發生錯誤，原因："+t),$.showErrorModal(t)}))},mounted:function(){}})},204:function(t,e,a){"use strict";a.r(e);var o={props:["supplier"],data:function(){return{SuppliersIndexURL:$("#SuppliersIndexURL").text(),SuppliersUpdateURL:$("#SuppliersUpdateURL").text()}},methods:{supplierUpdateForm:function(t){var e=this.SuppliersUpdateURL,a=$(t.target).serializeObject();$.showLoadingModal(),axios.patch(e,a).then((function(t){$.showSuccessModal(t.data.message,t.data.url)})).catch((function(t){console.error("編輯供應商時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))}},created:function(){},mounted:function(){$("#monthlyCheck").change((function(t){$(this).prop("checked")?($("#monthlyCheckDate").val(0),$("#monthlyCheckDate").attr("disabled",!0)):($("#monthlyCheckDate").val(0),$("#monthlyCheckDate").attr("disabled",!1))})),$("#isSameAsName").click((function(t){$(this).prop("checked")?$("#bank_account_name").val($("#name").val()):$("#bank_account_name").val("")}))}},s=a(0),r=Object(s.a)(o,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-10"},[e("form",{attrs:{method:"POST",action:"#"},on:{submit:function(e){return e.preventDefault(),t.supplierUpdateForm.apply(null,arguments)}}},[t._m(0),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[t._m(1),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.name,expression:"supplier.name"}],staticClass:"form-control",attrs:{id:"name",name:"name",type:"text",required:"",autocomplete:"off",autofocus:""},domProps:{value:t.supplier.name},on:{input:function(e){e.target.composing||t.$set(t.supplier,"name",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"shortName"}},[t._v("供應商簡稱")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.shortName,expression:"supplier.shortName"}],staticClass:"form-control",attrs:{id:"shortName",name:"shortName",type:"text",autocomplete:"off"},domProps:{value:t.supplier.shortName},on:{input:function(e){e.target.composing||t.$set(t.supplier,"shortName",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"taxId"}},[t._v("統一編號")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.taxId,expression:"supplier.taxId"}],staticClass:"form-control",attrs:{id:"taxId",name:"taxId",type:"text",autocomplete:"off"},domProps:{value:t.supplier.taxId},on:{input:function(e){e.target.composing||t.$set(t.supplier,"taxId",e.target.value)}}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"tel"}},[t._v("電話")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.tel,expression:"supplier.tel"}],staticClass:"form-control",attrs:{id:"tel",type:"text",name:"tel",autocomplete:"off"},domProps:{value:t.supplier.tel},on:{input:function(e){e.target.composing||t.$set(t.supplier,"tel",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"tax"}},[t._v("傳真")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.tax,expression:"supplier.tax"}],staticClass:"form-control",attrs:{id:"tax",type:"text",name:"tax",autocomplete:"off"},domProps:{value:t.supplier.tax},on:{input:function(e){e.target.composing||t.$set(t.supplier,"tax",e.target.value)}}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12"},[e("div",{staticClass:"form-group",attrs:{id:"companyAddress_twzipcode"}},[t._m(2),t._v(" "),e("div",{staticClass:"row mb-2"},[e("div",{staticClass:"col-md-4"},[e("div",{attrs:{"data-role":"county","data-style":"form-control","data-name":"companyAddress_county","data-value":t.supplier.companyAddress_county}})]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{attrs:{"data-role":"district","data-style":"form-control","data-name":"companyAddress_district","data-value":t.supplier.companyAddress_district}})]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{attrs:{"data-role":"zipcode","data-style":"form-control","data-name":"companyAddress_zipcode","data-value":t.supplier.companyAddress_zipcode}})])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.companyAddress_others,expression:"supplier.companyAddress_others"}],staticClass:"form-control",attrs:{id:"companyAddress_others",type:"text",name:"companyAddress_others",autocomplete:"off",required:""},domProps:{value:t.supplier.companyAddress_others},on:{input:function(e){e.target.composing||t.$set(t.supplier,"companyAddress_others",e.target.value)}}})])])])])])]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-12"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"comment"}},[t._v("備註")]),t._v(" "),e("textarea",{directives:[{name:"model",rawName:"v-model",value:t.supplier.comment,expression:"supplier.comment"}],staticClass:"form-control",attrs:{id:"comment",name:"comment",type:"text",rows:"6"},domProps:{value:t.supplier.comment},on:{input:function(e){e.target.composing||t.$set(t.supplier,"comment",e.target.value)}}})])])])])]),t._v(" "),t._m(3),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[t._m(4),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.operator_name_1,expression:"supplier.operator_name_1"}],staticClass:"form-control",attrs:{id:"operator_name_1",type:"text",name:"operator_name_1",autocomplete:"off",required:""},domProps:{value:t.supplier.operator_name_1},on:{input:function(e){e.target.composing||t.$set(t.supplier,"operator_name_1",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[t._m(5),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.operator_tel_1,expression:"supplier.operator_tel_1"}],staticClass:"form-control",attrs:{id:"operator_tel_1",type:"text",name:"operator_tel_1",autocomplete:"off",required:""},domProps:{value:t.supplier.operator_tel_1},on:{input:function(e){e.target.composing||t.$set(t.supplier,"operator_tel_1",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"operator_email_1"}},[t._v("聯絡窗口1 - 信箱")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.operator_email_1,expression:"supplier.operator_email_1"}],staticClass:"form-control",attrs:{id:"operator_email_1",type:"email",name:"operator_email_1",autocomplete:"off"},domProps:{value:t.supplier.operator_email_1},on:{input:function(e){e.target.composing||t.$set(t.supplier,"operator_email_1",e.target.value)}}})])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"operator_name_2"}},[t._v("聯絡窗口2 - 名稱")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.operator_name_2,expression:"supplier.operator_name_2"}],staticClass:"form-control",attrs:{id:"operator_name_2",type:"text",name:"operator_name_2",autocomplete:"off"},domProps:{value:t.supplier.operator_name_2},on:{input:function(e){e.target.composing||t.$set(t.supplier,"operator_name_2",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"operator_tel_2"}},[t._v("聯絡窗口2 - 電話")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.operator_tel_2,expression:"supplier.operator_tel_2"}],staticClass:"form-control",attrs:{id:"operator_tel_2",type:"text",name:"operator_tel_2",autocomplete:"off"},domProps:{value:t.supplier.operator_tel_2},on:{input:function(e){e.target.composing||t.$set(t.supplier,"operator_tel_2",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"operator_email_2"}},[t._v("聯絡窗口2 - 信箱")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.operator_email_2,expression:"supplier.operator_email_2"}],staticClass:"form-control",attrs:{id:"operator_email_2",type:"email",name:"operator_email_2",autocomplete:"off"},domProps:{value:t.supplier.operator_email_2},on:{input:function(e){e.target.composing||t.$set(t.supplier,"operator_email_2",e.target.value)}}})])])]),t._v(" "),e("hr"),t._v(" "),t._m(6),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"bank_name"}},[t._v("銀行名稱")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.bank_name,expression:"supplier.bank_name"}],staticClass:"form-control",attrs:{id:"bank_name",type:"text",name:"bank_name",autocomplete:"off"},domProps:{value:t.supplier.bank_name},on:{input:function(e){e.target.composing||t.$set(t.supplier,"bank_name",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"bank_branch_name"}},[t._v("分行名稱")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.bank_branch_name,expression:"supplier.bank_branch_name"}],staticClass:"form-control",attrs:{id:"bank_branch_name",type:"text",name:"bank_branch_name",autocomplete:"off"},domProps:{value:t.supplier.bank_branch_name},on:{input:function(e){e.target.composing||t.$set(t.supplier,"bank_branch_name",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"bank_code"}},[t._v("銀行通匯代號")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.bank_code,expression:"supplier.bank_code"}],staticClass:"form-control",attrs:{id:"bank_code",type:"text",name:"bank_code",autocomplete:"off"},domProps:{value:t.supplier.bank_code},on:{input:function(e){e.target.composing||t.$set(t.supplier,"bank_code",e.target.value)}}}),t._v(" "),e("small",{staticClass:"form-text text-muted"},[t._v("銀行代號+分行代號")])])])]),t._v(" "),e("div",{staticClass:"row mb-2"},[e("div",{staticClass:"col-md-6"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"bank_account"}},[t._v("帳號")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.bank_account,expression:"supplier.bank_account"}],staticClass:"form-control",attrs:{id:"bank_account",type:"text",name:"bank_account",autocomplete:"off"},domProps:{value:t.supplier.bank_account},on:{input:function(e){e.target.composing||t.$set(t.supplier,"bank_account",e.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("label",{attrs:{for:"bank_account_name"}},[t._v("戶名")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.supplier.bank_account_name,expression:"supplier.bank_account_name"}],staticClass:"form-control mb-2",attrs:{id:"bank_account_name",type:"text",name:"bank_account_name",autocomplete:"off"},domProps:{value:t.supplier.bank_account_name},on:{input:function(e){e.target.composing||t.$set(t.supplier,"bank_account_name",e.target.value)}}}),t._v(" "),t._m(7)])]),t._v(" "),e("div",{staticClass:"col-md-2"},[e("div",{staticClass:"form-group"},[t._m(8),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.supplier.monthlyCheckDate,expression:"supplier.monthlyCheckDate"}],staticClass:"form-control mb-2",attrs:{id:"monthlyCheckDate",name:"monthlyCheckDate",disabled:""},on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.supplier,"monthlyCheckDate",e.target.multiple?a:a[0])}}},[e("option",{attrs:{value:"0"}},[t._v("請選擇...")]),t._v(" "),t._l(31,(function(a){return e("option",{key:a,domProps:{value:a}},[t._v(t._s(a))])}))],2),t._v(" "),t._m(9)])])]),t._v(" "),e("div",{staticClass:"form-group row justify-content-center"},[e("div",{staticClass:"col-md-8"},[e("button",{staticClass:"btn btn-block btn-success",attrs:{type:"submit"}},[t._v("\r\n                        確認修改\r\n                    ")]),t._v(" "),e("a",{staticClass:"btn btn-block btn-danger",attrs:{href:t.SuppliersIndexURL}},[t._v("\r\n                        返回列表\r\n                    ")])])])])])])}),[function(){var t=this._self._c;return t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-12 mb-2"},[t("h4",[this._v("1. 供應商基本資訊")])])])},function(){var t=this._self._c;return t("label",{attrs:{for:"name"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("供應商名稱\r\n                        ")])},function(){var t=this._self._c;return t("label",[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("公司地址")])},function(){var t=this._self._c;return t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-12 mb-2"},[t("h4",[this._v("2. 窗口聯絡資訊")])])])},function(){var t=this._self._c;return t("label",{attrs:{for:"operator_name_1"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("聯絡窗口1 - 名稱")])},function(){var t=this._self._c;return t("label",{attrs:{for:"operator_tel_1"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("聯絡窗口1 - 電話")])},function(){var t=this._self._c;return t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-12 mb-2"},[t("h4",[this._v("3. 付款資訊")])])])},function(){var t=this._self._c;return t("div",{staticClass:"custom-control custom-switch"},[t("input",{staticClass:"custom-control-input",attrs:{type:"checkbox",name:"isSameAsName",id:"isSameAsName",value:"1"}}),this._v(" "),t("label",{staticClass:"custom-control-label",attrs:{for:"isSameAsName"}},[t("small",[this._v("與供應商名稱相同")])])])},function(){var t=this._self._c;return t("label",{attrs:{for:"monthlyCheckDate"}},[t("span",{staticClass:"text-danger mr-2"},[this._v("*")]),this._v("月結日\r\n                        ")])},function(){var t=this._self._c;return t("div",{staticClass:"custom-control custom-switch"},[t("input",{staticClass:"custom-control-input",attrs:{type:"checkbox",name:"monthlyCheck",id:"monthlyCheck",value:"1",checked:""}}),this._v(" "),t("label",{staticClass:"custom-control-label",attrs:{for:"monthlyCheck"}},[t("small",[this._v("日結")])])])}],!1,null,null,null);e.default=r.exports}});