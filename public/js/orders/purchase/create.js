!function(t){var a={};function s(e){if(a[e])return a[e].exports;var r=a[e]={i:e,l:!1,exports:{}};return t[e].call(r.exports,r,r.exports,s),r.l=!0,r.exports}s.m=t,s.c=a,s.d=function(t,a,e){s.o(t,a)||Object.defineProperty(t,a,{enumerable:!0,get:e})},s.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},s.t=function(t,a){if(1&a&&(t=s(t)),8&a)return t;if(4&a&&"object"==typeof t&&t&&t.__esModule)return t;var e=Object.create(null);if(s.r(e),Object.defineProperty(e,"default",{enumerable:!0,value:t}),2&a&&"string"!=typeof t)for(var r in t)s.d(e,r,function(a){return t[a]}.bind(null,r));return e},s.n=function(t){var a=t&&t.__esModule?function(){return t.default}:function(){return t};return s.d(a,"a",a),a},s.o=function(t,a){return Object.prototype.hasOwnProperty.call(t,a)},s.p="/",s(s.s=119)}({0:function(t,a,s){"use strict";function e(t,a,s,e,r,i,l,o){var c,n="function"==typeof t?t.options:t;if(a&&(n.render=a,n.staticRenderFns=s,n._compiled=!0),e&&(n.functional=!0),i&&(n._scopeId="data-v-"+i),l?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(l)},n._ssrRegister=c):r&&(c=o?function(){r.call(this,(n.functional?this.parent:this).$root.$options.shadowRoot)}:r),c)if(n.functional){n._injectStyles=c;var d=n.render;n.render=function(t,a){return c.call(a),d(t,a)}}else{var m=n.beforeCreate;n.beforeCreate=m?[].concat(m,c):[c]}return{exports:t,options:n}}s.d(a,"a",(function(){return e}))},119:function(t,a,s){t.exports=s(120)},120:function(t,a,s){Vue.component("purchase-create-form",s(202).default),Vue.component("purchase-detail",s(203).default),Vue.component("create-supplier-modal",s(58).default);new Vue({el:"#purchase",data:function(){return{suppliers:[],current_supplier:[],materials:[],form_error:[]}},methods:{getSupplierData:function(t){var a=this,s=$("#getSupplierInfo").html();axios.post(s,t).then((function(t){console.log(t),a.current_supplier=t.data}))}},created:function(){var t=this,a=$("#getSuppliersName").html(),s=$("#getMeterialsName").html();$.showLoadingModal(),axios.get(a).then((function(a){t.suppliers=a.data})),axios.get(s).then((function(a){t.materials=a.data,$.closeModal()}))}})},202:function(t,a,s){"use strict";s.r(a);var e={props:["suppliers","current_supplier","materials"],data:function(){return{total_price:0,getPurchaseOrderIndex:$("#getPurchaseOrderIndex").html()}},methods:{showTotalPrice:function(t){this.total_price=t},changeTax:function(){this.$refs.purchasedetail.calculateTotalPrice()},getSupplierData:function(){var t=$("#supplier_id").val();0!=t?this.$emit("get-supplier-data",{id:t}):showWarningModal("請選擇廠商")},createPurchaseOrder:function(){if(0==this.$refs.purchasedetail.details.length)return $.showWarningModal("進貨單必須至少要有一項原物料進貨。"),!1;var t=$("#createPurchaseOrder").html(),a=$("#PurchaseOrderCreateForm").serialize();$.showLoadingModal(),axios.post(t,a).then((function(t){$("#purchaseOrderID").val(t.data.purchaseOrder_id),$("#PurchaseOrderDetailForm").submit()})).catch((function(t){console.error("新增進貨單時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))}},created:function(){},mounted:function(){$("#expectReceived_at").datepicker({dateFormat:"yy-mm-dd",changeYear:!0,changeMonth:!0,yearRange:"-80:+0"}),$("#PurchaseOrderDetailForm").submit((function(t){t.preventDefault();var a=$("#createPurchaseOrderDetail").html(),s=$(this).serialize();axios.post(a,s).then((function(t){$.showSuccessModal(t.data.message,t.data.url)})).catch((function(t){console.error("新增進貨單細項時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))}))}},r=s(0),i=Object(r.a)(e,(function(){var t=this,a=t._self._c;return a("div",{staticClass:"row justify-content-center"},[a("div",{staticClass:"col-md-12"},[a("form",{attrs:{id:"PurchaseOrderCreateForm",method:"POST",action:"#"},on:{submit:function(a){return a.preventDefault(),t.createPurchaseOrder.apply(null,arguments)}}},[a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"form-group row"},[t._m(0),t._v(" "),a("div",{staticClass:"col-md-6 mb-2"},[a("select",{staticClass:"form-control",attrs:{id:"supplier_id",name:"supplier_id"},on:{change:t.getSupplierData}},[a("option",{attrs:{value:"0"}},[t._v("請選擇...")]),t._v(" "),t._l(t.suppliers,(function(s){return a("option",{key:s.id,domProps:{value:s.id}},[t._v(t._s(s.name))])}))],2)]),t._v(" "),t._m(1)])])]),t._v(" "),a("create-supplier-modal"),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"showShortName"}},[t._v("供應商簡稱")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"showShortName",type:"text",disabled:""},domProps:{value:t.current_supplier.shortName}})])])]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"showTaxId"}},[t._v("統一編號")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"showTaxId",type:"text",disabled:""},domProps:{value:t.current_supplier.taxId}})])])])]),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"row"},[a("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"showTel"}},[t._v("電話")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"showTel",type:"text",disabled:""},domProps:{value:t.current_supplier.tel}})])])]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"row"},[a("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"showTax"}},[t._v("傳真")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"showTax",type:"text",disabled:""},domProps:{value:t.current_supplier.tax}})])])])]),t._v(" "),a("hr"),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"showInCharge1"}},[t._v("\r\n                            負責人1 - 名稱\r\n                        ")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"showInCharge1",type:"text",disabled:""},domProps:{value:t.current_supplier.operator_name_1}})])])]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"showTel1"}},[t._v("\r\n                            負責人1 - 電話\r\n                        ")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"showTel1",type:"text",disabled:""},domProps:{value:t.current_supplier.operator_tel_1}})])])])]),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"row"},[a("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"showCompanyAddress"}},[t._v("\r\n                            公司地址\r\n                        ")]),t._v(" "),a("div",{staticClass:"col-md-9"},[a("input",{staticClass:"form-control",attrs:{id:"showCompanyAddress",type:"text",disabled:""},domProps:{value:t.current_supplier.companyAddress}})])])])]),t._v(" "),a("hr"),t._v(" "),t._m(2),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"taxType"}},[t._v("\r\n                            稅別\r\n                        ")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("select",{staticClass:"form-control",attrs:{name:"taxType",id:"taxType",required:""},on:{change:t.changeTax}},[a("option",{attrs:{value:"1"}},[t._v("應稅")]),t._v(" "),a("option",{attrs:{value:"2"}},[t._v("未稅")]),t._v(" "),a("option",{attrs:{value:"3"}},[t._v("免稅")]),t._v(" "),a("option",{attrs:{value:"4"}},[t._v("零稅 - 經海關")]),t._v(" "),a("option",{attrs:{value:"5"}},[t._v("零稅 - 非經海關")])])])])]),t._v(" "),t._m(3)]),t._v(" "),a("hr"),t._v(" "),a("input",{staticClass:"form-control",attrs:{id:"totalPrice",name:"totalPrice",type:"hidden"},domProps:{value:t.total_price}}),t._v(" "),a("purchase-detail",{ref:"purchasedetail",attrs:{materials:t.materials},on:{"show-total-price":t.showTotalPrice}}),t._v(" "),a("div",{staticClass:"row mb-2"},[t._m(4),t._v(" "),t._m(5),t._v(" "),a("div",{staticClass:"col-md-4"},[a("div",{staticClass:"row"},[a("label",{staticClass:"col-md-2 col-form-label text-md-right",attrs:{for:"totalPrice"}},[t._v("總額")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"showTotalPrice",type:"text",disabled:""},domProps:{value:t.total_price}})])])])]),t._v(" "),a("hr"),t._v(" "),a("div",{staticClass:"form-group row justify-content-center"},[a("div",{staticClass:"col-md-8"},[a("button",{staticClass:"btn btn-block btn-primary",attrs:{type:"submit"}},[t._v("\r\n                        確認新增\r\n                    ")]),t._v(" "),a("a",{staticClass:"btn btn-block btn-danger",attrs:{href:t.getPurchaseOrderIndex}},[t._v("\r\n                        返回進貨單首頁\r\n                    ")])])])],1)])])}),[function(){var t=this._self._c;return t("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"supplier_id"}},[t("span",{staticClass:"text-danger"},[this._v("*")]),this._v("\r\n                            供應商\r\n                        ")])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-3"},[t("button",{staticClass:"btn btn-block btn-primary",attrs:{type:"button","data-toggle":"modal","data-target":"#CreateSupplierModal"}},[this._v("\r\n                                新增供應商\r\n                            ")])])},function(){var t=this._self._c;return t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-6"},[t("div",{staticClass:"form-group row"},[t("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"expectReceived_at"}},[t("span",{staticClass:"text-danger"},[this._v("*")]),this._v("\r\n                            預期到貨時間\r\n                        ")]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("input",{staticClass:"form-control",attrs:{id:"expectReceived_at",name:"expectReceived_at",type:"text",value:"",autocomplete:"off",required:""}})])])]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("div",{staticClass:"form-group row"},[t("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"PurchaseComment"}},[this._v("\r\n                            備註\r\n                        ")]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("textarea",{staticClass:"form-control",attrs:{name:"comment",id:"PurchaseComment",cols:"30",rows:"2"}})])])])])},function(){var t=this,a=t._self._c;return a("div",{staticClass:"col-md-6"},[a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"invoiceType"}},[t._v("\r\n                            發票類型\r\n                        ")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("select",{staticClass:"form-control",attrs:{name:"invoiceType",id:"invoiceType",required:""}},[a("option",{attrs:{value:"1"}},[t._v("三聯式")]),t._v(" "),a("option",{attrs:{value:"2"}},[t._v("二聯式")]),t._v(" "),a("option",{attrs:{value:"3"}},[t._v("三聯銷退折讓")]),t._v(" "),a("option",{attrs:{value:"4"}},[t._v("二聯銷退折讓")]),t._v(" "),a("option",{attrs:{value:"5"}},[t._v("三聯式收銀機")]),t._v(" "),a("option",{attrs:{value:"6"}},[t._v("免用發票")])])])])])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"row"},[t("label",{staticClass:"col-md-3 col-form-label text-md-right",attrs:{for:"beforePrice"}},[this._v("銷售額")]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("input",{staticClass:"form-control",attrs:{id:"beforePrice",type:"text",value:"",disabled:""}})])])])},function(){var t=this._self._c;return t("div",{staticClass:"col-md-4"},[t("div",{staticClass:"row"},[t("label",{staticClass:"col-md-2 col-form-label text-md-right",attrs:{for:"tax_price"}},[this._v("稅額")]),this._v(" "),t("div",{staticClass:"col-md-6"},[t("input",{staticClass:"form-control",attrs:{id:"tax_price",type:"text",value:"",disabled:""}})])])])}],!1,null,null,null);a.default=i.exports},203:function(t,a,s){"use strict";s.r(a);var e={props:["materials"],data:function(){return{details:[],current_material:[],total_price:0}},methods:{addDetail:function(){0!=this.current_material.length?this.details.push({count:this.details.length,material:{id:this.current_material.id,name:this.current_material.name,internationalNum:this.current_material.internationalNum,unitPrice:this.current_material.unitPrice,unit:this.current_material.unit},quantity:0,discount:1,subTotal:0,comment:null}):alert("請選擇原物料")},deleteDetail:function(t){this.details.splice(t,1),0!=this.details.length&&this.calculateSubtotal(1),this.calculateTotalPrice()},calculateSubtotal:function(t){var a=$("#qty_"+t).val(),s=$("#unitPrice_"+t).val(),e=$("#discount_"+t).val(),r=Math.round(s*a*e*1e4)/1e4;$("#subtotal_"+t).html(r),this.details[t-1].quantity=a,this.details[t-1].material.unitPrice=s,this.details[t-1].discount=e,this.details[t-1].subTotal=r,this.calculateTotalPrice()},calculateTotalPrice:function(){this.total_price=0;for(var t=1;t<=this.details.length;t++){var a=this.details[t-1].quantity,s=this.details[t-1].material.unitPrice,e=this.details[t-1].discount,r=Math.round(s*a*e*1e4)/1e4;this.total_price=this.total_price+r}$("#beforePrice").val(this.total_price);var i="1"==$("#taxType").val()?Math.round(.05*this.total_price*1e4)/1e4:0;$("#tax_price").val(i),this.total_price=Math.round(Math.round(1e4*(this.total_price+i))/1e4),this.$emit("show-total-price",this.total_price)},updateComment:function(t){var a=$("#comment_"+t).val();this.details[t-1].comment=a},getMaterialData:function(){var t=this,a=$("#material_id").val();if(0!=a){var s=$("#getMeterialInfo").html();axios.post(s,{id:a}).then((function(a){t.current_material=a.data}))}else this.current_material=[]}},created:function(){},mounted:function(){}},r=s(0),i=Object(r.a)(e,(function(){var t=this,a=t._self._c;return a("div",{staticClass:"row justify-content-center"},[a("div",{staticClass:"col-md-12"},[a("form",{attrs:{id:"PurchaseOrderDetailForm",method:"POST",action:"#"}},[a("input",{attrs:{type:"hidden",id:"purchaseOrderID",name:"purchaseOrder_id",value:""}}),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-6 mb-2"},[a("select",{staticClass:"form-control",attrs:{id:"material_id"},on:{change:t.getMaterialData}},[a("option",{attrs:{value:"0"}},[t._v("請選擇...")]),t._v(" "),t._l(t.materials,(function(s){return a("option",{key:s.id,domProps:{value:s.id}},[t._v(t._s(s.name))])}))],2)]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("button",{staticClass:"btn btn-md btn-success",attrs:{type:"button"},on:{click:t.addDetail}},[t._v("新增至細項")])])]),t._v(" "),a("table",{staticClass:"table table-bordered",attrs:{width:"100%",cellspacing:"0"}},[t._m(0),t._v(" "),a("tbody",t._l(t.details,(function(s,e){return a("tr",{key:e},[a("td",{staticStyle:{width:"5%"}},[t._v(t._s(e+1))]),t._v(" "),a("td",{staticStyle:{width:"20%"}},[t._v("\r\n                            "+t._s(s.material.name)+"\r\n                            "),a("input",{attrs:{type:"hidden",name:"details["+(e+1)+"][material_id]"},domProps:{value:s.material.id}})]),t._v(" "),a("td",{staticStyle:{width:"10%"}},[t._v("\r\n                            "+t._s(s.material.internationalNum)+"\r\n                        ")]),t._v(" "),a("td",{staticStyle:{width:"15%"}},[a("input",{staticClass:"form-control mr-2",staticStyle:{width:"60%",display:"inline-block"},attrs:{id:"qty_"+(e+1),type:"text",name:"details["+(e+1)+"][quantity]"},domProps:{value:s.quantity},on:{change:function(a){return t.calculateSubtotal(e+1)}}}),t._v(" "),a("span",[t._v(t._s(1==s.material.unit?"公斤":"公噸"))])]),t._v(" "),a("td",{staticStyle:{width:"10%"}},[a("input",{staticClass:"form-control",attrs:{id:"unitPrice_"+(e+1),type:"text",name:"details["+(e+1)+"][price]"},domProps:{value:s.material.unitPrice},on:{change:function(a){return t.calculateSubtotal(e+1)}}})]),t._v(" "),a("td",{staticStyle:{width:"10%"}},[a("input",{staticClass:"form-control",attrs:{id:"discount_"+(e+1),type:"text",name:"details["+(e+1)+"][discount]"},domProps:{value:s.discount},on:{change:function(a){return t.calculateSubtotal(e+1)}}})]),t._v(" "),a("td",{staticStyle:{width:"10%"}},[a("input",{staticClass:"form-control",attrs:{id:"subtotal_"+(e+1),type:"text",disabled:""},domProps:{value:s.subTotal}})]),t._v(" "),a("td",{staticStyle:{width:"15%"}},[a("input",{staticClass:"form-control",attrs:{id:"comment_"+(e+1),type:"text",name:"details["+(e+1)+"][comment]"},domProps:{value:s.comment},on:{change:function(a){return t.updateComment(e+1)}}})]),t._v(" "),a("td",{staticStyle:{width:"5%"}},[a("button",{staticClass:"btn btn-md btn-danger",attrs:{type:"button"},on:{click:function(a){return t.deleteDetail(e)}}},[a("i",{staticClass:"far fa-trash-alt"})])])])})),0)])])])])}),[function(){var t=this,a=t._self._c;return a("thead",[a("tr",[a("th",[t._v("編號")]),t._v(" "),a("th",[t._v("原物料")]),t._v(" "),a("th",[t._v("國際條碼")]),t._v(" "),a("th",[t._v("數量")]),t._v(" "),a("th",[t._v("單價")]),t._v(" "),a("th",[t._v("折數")]),t._v(" "),a("th",[t._v("小計")]),t._v(" "),a("th",[t._v("備註")]),t._v(" "),a("th",[t._v("操作")])])])}],!1,null,null,null);a.default=i.exports},58:function(t,a,s){"use strict";s.r(a);var e={data:function(){return{}},mounted:function(){$("#copycompany1").click((function(t){$(this).prop("checked")?$("#deliveryAddress").val($("#companyAddress").val()):$("#deliveryAddress").val("")})),$("#copycompany2").click((function(t){$(this).prop("checked")?$("#invoiceAddress").val($("#companyAddress").val()):$("#invoiceAddress").val("")}))}},r=s(0),i=Object(r.a)(e,(function(){this._self._c;return this._m(0)}),[function(){var t=this,a=t._self._c;return a("div",{staticClass:"modal fade bd-example-modal-lg",attrs:{id:"CreateSupplierModal",tabindex:"-1",role:"dialog","aria-labelledby":"CreateSupplierModalLabel","aria-hidden":"true"}},[a("div",{staticClass:"modal-dialog modal-lg",attrs:{role:"document"}},[a("div",{staticClass:"modal-content"},[a("div",{staticClass:"modal-header"},[a("h5",{staticClass:"modal-title",attrs:{id:"CreateSupplierModalLabel"}},[t._v("新增供應商")]),t._v(" "),a("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"}},[a("span",{attrs:{"aria-hidden":"true"}},[t._v("×")])])]),t._v(" "),a("div",{staticClass:"modal-body"},[a("div",{staticClass:"container-fluid"},[a("form",{attrs:{id:"CreateSupplierForm",action:"#",method:"POST"}},[a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"name"}},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v("\r\n                                供應商名稱\r\n                            ")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"name",type:"text",name:"name",value:"",required:"",autocomplete:"name",autofocus:""}})])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"shortName"}},[t._v("供應商簡稱")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"shortName",type:"text",name:"shortName",value:"",autocomplete:"shortName"}})])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"taxId"}},[t._v("統一編號")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"taxId",type:"text",name:"taxId",value:"",autocomplete:"taxId"}})])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"tel"}},[t._v("電話")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"tel",type:"text",name:"tel",value:"",autocomplete:"tel"}})])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"tax"}},[t._v("傳真")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"tax",type:"text",name:"tax",value:"",autocomplete:"tax"}})])]),t._v(" "),a("hr"),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"inCharge1"}},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v("\r\n                                負責人1 - 名稱\r\n                            ")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"inCharge1",type:"text",name:"inCharge1",value:"",autocomplete:"inCharge1"}})])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"tel1"}},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v("\r\n                                負責人1 - 電話\r\n                            ")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"tel1",type:"text",name:"tel1",value:"",autocomplete:"tel1"}})])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"email1"}},[t._v("負責人1 - 信箱")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"email1",type:"email",name:"email1",value:"",autocomplete:"email1"}})])]),t._v(" "),a("hr"),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"inCharge2"}},[t._v("負責人2 - 名稱")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"inCharge2",type:"text",name:"inCharge2",value:"",autocomplete:"inCharge2"}})])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"tel2"}},[t._v("負責人2 - 電話")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"tel2",type:"text",name:"tel2",value:"",autocomplete:"tel2"}})])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"email2"}},[t._v("負責人2 - 信箱")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"email2",type:"email",name:"email2",value:"",autocomplete:"email2"}})])]),t._v(" "),a("hr"),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"companyAddress"}},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v("\r\n                                公司地址\r\n                            ")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"companyAddress",type:"text",name:"companyAddress",value:"",autocomplete:"companyAddress",required:""}})])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"deliveryAddress"}},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v("\r\n                                送貨地址\r\n                            ")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"deliveryAddress",type:"text",name:"deliveryAddress",value:"",autocomplete:"deliveryAddress",required:""}})]),t._v(" "),a("div",{staticClass:"form-check"},[a("input",{staticClass:"form-check-input",attrs:{type:"checkbox",id:"copycompany1"}}),t._v(" "),a("label",{staticClass:"form-check-label",attrs:{for:"copycompany1"}},[t._v("同公司地址")])])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"invoiceAddress"}},[a("span",{staticClass:"text-danger"},[t._v("*")]),t._v("\r\n                                發票地址\r\n                            ")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"invoiceAddress",type:"text",name:"invoiceAddress",value:"",required:"",autocomplete:"invoiceAddress"}})]),t._v(" "),a("div",{staticClass:"form-check"},[a("input",{staticClass:"form-check-input",attrs:{type:"checkbox",id:"copycompany2"}}),t._v(" "),a("label",{staticClass:"form-check-label",attrs:{for:"copycompany2"}},[t._v("同公司地址")])])]),t._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-md-4 col-form-label text-md-right",attrs:{for:"comment"}},[t._v("備註")]),t._v(" "),a("div",{staticClass:"col-md-6"},[a("input",{staticClass:"form-control",attrs:{id:"comment",type:"text",name:"comment",value:"",autocomplete:"comment"}})])]),t._v(" "),a("div",{staticClass:"form-group row justify-content-center"},[a("div",{staticClass:"col-md-8"},[a("button",{staticClass:"btn btn-block btn-primary",attrs:{type:"submit"}},[t._v("\r\n                                    確認新增\r\n                                ")]),t._v(" "),a("button",{staticClass:"btn btn-block btn-danger",attrs:{type:"button","data-dismiss":"modal"}},[t._v("\r\n                                    取消\r\n                                ")])])])])])])])])])}],!1,null,null,null);a.default=i.exports}});