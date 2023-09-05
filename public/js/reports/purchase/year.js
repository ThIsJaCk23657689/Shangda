!function(t){var e={};function r(n){if(e[n])return e[n].exports;var o=e[n]={i:n,l:!1,exports:{}};return t[n].call(o.exports,o,o.exports,r),o.l=!0,o.exports}r.m=t,r.c=e,r.d=function(t,e,n){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)r.d(n,o,function(e){return t[e]}.bind(null,o));return n},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="/",r(r.s=173)}({0:function(t,e,r){"use strict";function n(t,e,r,n,o,a,s,i){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=r,c._compiled=!0),n&&(c.functional=!0),a&&(c._scopeId="data-v-"+a),s?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(s)},c._ssrRegister=l):o&&(l=i?function(){o.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:o),l)if(c.functional){c._injectStyles=l;var u=c.render;c.render=function(t,e){return l.call(e),u(t,e)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:c}}r.d(e,"a",(function(){return n}))},173:function(t,e,r){t.exports=r(174)},174:function(t,e,r){Vue.component("purchase-year",r(229).default);new Vue({el:"#reports",data:function(){return{reports:[],month_total:["合計",0,0,0,0,0,0,0,0,0,0,0,0,0],filters:{type:1,year:2020,orderby:1}}},methods:{refreshData:function(t){var e=this,r=$("#getPurchaseYearData").text();$.showLoadingModal(),axios.post(r,this.filters).then((function(t){e.reports=t.data.result;var r=["合計",0,0,0,0,0,0,0,0,0,0,0,0,0],n=e;Object.keys(e.reports).forEach((function(t,e){for(var o=n.reports[t],a=1;a<o.length;a++)r[a]+=o[a],r[a]=Math.round(100*r[a])/100})),e.month_total=r,$.closeModal()})).catch((function(t){console.log("生成報表時發生錯誤："+t),$.showErrorModal(t)}))}},created:function(){this.refreshData()},mounted:function(){}})},229:function(t,e,r){"use strict";r.r(e);var n={props:["reports","filters","month_total"],data:function(){return{tableTitle:"供應商名稱"}},methods:{changeType:function(t){1==t.target.value?this.tableTitle="供應商名稱":this.tableTitle="原物料名稱",this.$emit("refresh-data")},changeYear:function(t){this.$emit("refresh-data")},changeOrderby:function(t){this.$emit("refresh-data")}},created:function(){},mounted:function(){}},o=r(0),a=Object(o.a)(n,(function(){var t=this,e=t._self._c;return e("div",[e("div",{staticClass:"card mb-3"},[e("div",{staticClass:"card-header"},[e("i",{staticClass:"fas fa-table mr-2"}),t._v("進貨年度報表 - "+t._s(t.filters.year)+"年\r\n        ")]),t._v(" "),e("div",{staticClass:"card-body"},[e("div",{staticClass:"row justify-content-center mb-2"},[e("div",{staticClass:"col-md-12 justify-content-center"},[e("form",{attrs:{action:"#",method:"GET"}},[e("div",{staticClass:"row mb-3 justify-content-center"},[e("div",{staticClass:"col-md-3"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.filters.type,expression:"filters.type"}],staticClass:"form-control",attrs:{name:"type",id:"type"},on:{change:[function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.filters,"type",e.target.multiple?r:r[0])},t.changeType]}},[e("option",{attrs:{value:"1"}},[t._v("依供應商別")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("依原料別")])])]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.filters.year,expression:"filters.year"}],staticClass:"form-control",attrs:{type:"text",id:"year",name:"year",placeholder:"請輸入年份：2020"},domProps:{value:t.filters.year},on:{change:t.changeYear,input:function(e){e.target.composing||t.$set(t.filters,"year",e.target.value)}}})]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.filters.orderby,expression:"filters.orderby"}],staticClass:"form-control",attrs:{name:"orderby",id:"orderby"},on:{change:[function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.filters,"orderby",e.target.multiple?r:r[0])},t.changeOrderby]}},[e("option",{attrs:{value:"1"}},[t._v("總進貨額升序")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("總進貨額降序")])])])])])])]),t._v(" "),e("div",{staticClass:"table-responsive"},[e("table",{staticClass:"table table-bordered",attrs:{id:"PurchaseYearTable",width:"100%",cellspacing:"0"}},[e("thead",[e("tr",[e("th",[t._v(t._s(t.tableTitle))]),t._v(" "),t._l(12,(function(r){return e("th",{key:r},[t._v(t._s(r+"月"))])})),t._v(" "),e("th",[t._v("小計")])],2)]),t._v(" "),e("tbody",[t._l(t.reports,(function(r){return e("tr",{key:r[0]},t._l(r.length,(function(n){return e("td",{key:n},[t._v(t._s(r[n-1]))])})),0)})),t._v(" "),e("tr",t._l(t.month_total.length,(function(r){return e("td",{key:r},[e("strong",[t._v(t._s(t.month_total[r-1]))])])})),0)],2)])])])])])}),[],!1,null,null,null);e.default=a.exports}});