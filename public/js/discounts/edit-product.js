!function(t){var e={};function s(n){if(e[n])return e[n].exports;var r=e[n]={i:n,l:!1,exports:{}};return t[n].call(r.exports,r,r.exports,s),r.l=!0,r.exports}s.m=t,s.c=e,s.d=function(t,e,n){s.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},s.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},s.t=function(t,e){if(1&e&&(t=s(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(s.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)s.d(n,r,function(e){return t[e]}.bind(null,r));return n},s.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return s.d(e,"a",e),e},s.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},s.p="/",s(s.s=147)}({0:function(t,e,s){"use strict";function n(t,e,s,n,r,o,i,a){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=s,u._compiled=!0),n&&(u.functional=!0),o&&(u._scopeId="data-v-"+o),i?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},u._ssrRegister=c):r&&(c=a?function(){r.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:r),c)if(u.functional){u._injectStyles=c;var l=u.render;u.render=function(t,e){return c.call(e),l(t,e)}}else{var d=u.beforeCreate;u.beforeCreate=d?[].concat(d,c):[c]}return{exports:t,options:u}}s.d(e,"a",(function(){return n}))},147:function(t,e,s){t.exports=s(148)},148:function(t,e,s){Vue.component("product-discounts",s(215).default);new Vue({el:"#discounts",data:function(){return{consumers:[],all_consumers:[],consumers_disabled:[],original_discounts:[],this_product_retailPrice:0,discounts:[]}},methods:{refreshConsumers:function(t){if(this.consumers=this.all_consumers,"add"==t.type)this.consumers_disabled.push({id:this.consumers[t.id].id,name:this.consumers[t.id].name});else{for(var e,s=0;s<this.consumers_disabled.length;s++)if(this.consumers_disabled[s].id==t.id){e=s;break}this.consumers_disabled.splice(e,1)}this.consumers=[];for(var n=0;n<this.all_consumers.length;n++){for(var r=!0,o=0;o<this.consumers_disabled.length;o++)this.all_consumers[n].id==this.consumers_disabled[o].id&&(r=!1);r&&this.consumers.push(this.all_consumers[n])}}},created:function(){var t=this,e=$("#getConsumersName").html();axios.get(e).then((function(e){t.consumers=e.data,t.all_consumers=t.consumers}));var s=$("#getDiscountsList").html();axios.get(s).then((function(e){t.original_discounts=e.data.discounts,t.this_product_retailPrice=e.data.retailPrice;for(var s=0;s<t.original_discounts.length;s++)t.refreshConsumers({id:t.original_discounts[s].id-1,type:"add"}),t.discounts.push({count:t.discounts.length,consumer:{id:t.original_discounts[s].id,shownID:t.original_discounts[s].shownID,name:t.original_discounts[s].name,taxID:t.original_discounts[s].taxID,inCharge1:t.original_discounts[s].inCharge1,tel1:t.original_discounts[s].tel1},relativePrice:t.original_discounts[s].pivot.price,absolutePirce:Math.round(1e3*(t.this_product_retailPrice-t.original_discounts[s].pivot.price))/1e3})}))},mounted:function(){}})},215:function(t,e,s){"use strict";s.r(e);var n={props:["consumers","discounts"],mounted:function(){console.log("ProductDiscounts.vue mounted.")},data:function(){return{current_consumer:[],discountsIndex:$("#discountsIndex").html()}},methods:{addDiscount:function(){var t=$("#consumer_id").val();0==t?alert("請先選擇顧客!"):(this.$emit("refresh-consumers",{id:t-1,type:"add"}),0!=this.current_consumer.length?this.discounts.push({count:this.discounts.length,consumer:{id:this.current_consumer.id,shownID:this.current_consumer.shownID,name:this.current_consumer.name,taxID:this.current_consumer.taxID,inCharge1:this.current_consumer.inCharge1,tel1:this.current_consumer.tel1},relativePrice:0,absolutePirce:parseFloat($("#retailPrice").val())}):alert("請選擇顧客"))},deleteDiscount:function(t){this.discounts.splice(t,1),this.$emit("refresh-consumer",{id:$("#consumerID_"+(t+1)).val(),type:"deleted"})},calculateAbsolutePirce:function(t){var e=parseFloat($("#totalCost").val()),s=parseFloat($("#retailPrice").val()),n=parseFloat(Math.round(1e3*$("#relativePrice_"+t).val())/1e3),r=parseFloat(Math.round(1e3*(s-n))/1e3);r<e&&(alert("折扣價已低於成本價，這麼做會開始虧錢，無法這樣使用。"),n=0,r=s,$("#relativePrice_"+t).val(0),$("#absolutePirce_"+t).val(r)),this.discounts[t-1].relativePrice=n,this.discounts[t-1].absolutePirce=r},calculateRelativePrice:function(t){var e=parseFloat($("#totalCost").val()),s=parseFloat($("#retailPrice").val()),n=parseFloat(Math.round(1e3*$("#absolutePirce_"+t).val())/1e3),r=parseFloat(Math.round(1e3*(s-n))/1e3);n<e&&(alert("折扣價已低於成本價，這麼做會開始虧錢，無法這樣使用。"),r=0,n=s,$("#relativePrice_"+t).val(0),$("#absolutePirce_"+t).val(n)),this.discounts[t-1].relativePrice=r,this.discounts[t-1].absolutePirce=n},getConsumerData:function(){var t=this,e=$("#consumer_id").val();if(0!=e){var s=$("#getConsumerInfo").html();$("#addConsumerBtn").attr("disabled",!0),axios.post(s,{id:e}).then((function(e){t.current_consumer=e.data,$("#addConsumerBtn").attr("disabled",!1)}))}else alert("請選擇顧客")},submitEditDisCountsForm:function(){if(0==this.discounts.length)alert("請先新增折扣商品!");else{var t=$("#editDiscountsForm").attr("action"),e=$("#editDiscountsForm").serialize();$.showLoadingModal(),axios.post(t,e).then((function(t){$.showSuccessModal(t.data.message,t.data.url)})).catch((function(t){console.error("編輯折扣時發生錯誤，錯誤訊息："+t),$.showErrorModal(t)}))}}}},r=s(0),o=Object(r.a)(n,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-10"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-6 mb-2"},[e("select",{staticClass:"form-control",attrs:{id:"consumer_id"},on:{change:t.getConsumerData}},[e("option",{attrs:{value:"0"}},[t._v("請選擇...")]),t._v(" "),t._l(t.consumers,(function(s){return e("option",{domProps:{value:s.id}},[t._v(t._s(s.name))])}))],2)]),t._v(" "),e("div",{staticClass:"col-md-6"},[e("button",{staticClass:"btn btn-md btn-success",attrs:{id:"addConsumerBtn",type:"button"},on:{click:t.addDiscount}},[t._v("新增折扣")])])]),t._v(" "),e("form",{attrs:{id:"editDiscountsForm",method:"POST",action:"#"},on:{submit:function(e){return e.preventDefault(),t.submitEditDisCountsForm.apply(null,arguments)}}},[e("table",{staticClass:"table table-bordered",attrs:{width:"100%",cellspacing:"0"}},[t._m(0),t._v(" "),e("tbody",t._l(t.discounts,(function(s,n){return e("tr",{key:n},[e("td",[t._v(t._s(n))]),t._v(" "),e("td",[t._v("\r\n                            "+t._s(s.consumer.name)+"\r\n                            "),e("input",{attrs:{type:"hidden",name:"discounts["+(n+1)+"][consumer_id]"},domProps:{value:s.consumer.id}})]),t._v(" "),e("td",[t._v(t._s(s.consumer.taxID||"無"))]),t._v(" "),e("td",[t._v(t._s(s.consumer.operator_name_1||"無"))]),t._v(" "),e("td",[t._v(t._s(s.consumer.operator_tel_1||"無"))]),t._v(" "),e("td",[e("input",{staticClass:"form-control",attrs:{id:"relativePrice_"+(n+1),type:"text",name:"discounts["+(n+1)+"][relativePrice]"},domProps:{value:s.relativePrice},on:{change:function(e){return t.calculateAbsolutePirce(n+1)}}})]),t._v(" "),e("td",[e("input",{staticClass:"form-control",attrs:{id:"absolutePirce_"+(n+1),type:"text",name:"discounts["+(n+1)+"][absolutePirce]"},domProps:{value:s.absolutePirce},on:{change:function(e){return t.calculateRelativePrice(n+1)}}})]),t._v(" "),e("td",[e("button",{staticClass:"btn btn-md btn-danger",attrs:{type:"button"},on:{click:function(e){return t.deleteDiscount(n)}}},[e("i",{staticClass:"far fa-trash-alt"})])])])})),0)]),t._v(" "),e("div",{staticClass:"form-group row justify-content-center"},[e("div",{staticClass:"col-md-8"},[e("button",{staticClass:"btn btn-block btn-primary",attrs:{type:"submit"}},[t._v("\r\n                        確認儲存\r\n                    ")]),t._v(" "),e("a",{staticClass:"btn btn-block btn-danger",attrs:{href:t.discountsIndex}},[t._v("\r\n                        返回列表\r\n                    ")])])])])])])}),[function(){var t=this,e=t._self._c;return e("thead",[e("tr",[e("th",[t._v("編號")]),t._v(" "),e("th",[t._v("顧客名稱")]),t._v(" "),e("th",[t._v("統編")]),t._v(" "),e("th",[t._v("負責人")]),t._v(" "),e("th",[t._v("電話")]),t._v(" "),e("th",[t._v("相對價格")]),t._v(" "),e("th",[t._v("絕對價格")]),t._v(" "),e("th",[t._v("操作")])])])}],!1,null,null,null);e.default=o.exports}});