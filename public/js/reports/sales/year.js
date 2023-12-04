!function(t){var e={};function r(n){if(e[n])return e[n].exports;var a=e[n]={i:n,l:!1,exports:{}};return t[n].call(a.exports,a,a.exports,r),a.l=!0,a.exports}r.m=t,r.c=e,r.d=function(t,e,n){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var a in t)r.d(n,a,function(e){return t[e]}.bind(null,a));return n},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="/",r(r.s=172)}({0:function(t,e,r){"use strict";function n(t,e,r,n,a,o,s,i){var l,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=r,c._compiled=!0),n&&(c.functional=!0),o&&(c._scopeId="data-v-"+o),s?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),a&&a.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(s)},c._ssrRegister=l):a&&(l=i?function(){a.call(this,(c.functional?this.parent:this).$root.$options.shadowRoot)}:a),l)if(c.functional){c._injectStyles=l;var u=c.render;c.render=function(t,e){return l.call(e),u(t,e)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,l):[l]}return{exports:t,options:c}}r.d(e,"a",(function(){return n}))},172:function(t,e,r){t.exports=r(173)},173:function(t,e,r){Vue.component("sales-year",r(231).default);new Vue({el:"#reports",data:function(){return{reports:[],month_total:["合計",0,0,0,0,0,0,0,0,0,0,0,0,0],filters:{type:1,year:2023,orderby:2}}},methods:{refreshData:function(t){var e=this,r=$("#getSalesYearData").text();$.showLoadingModal(),axios.post(r,this.filters).then((function(t){e.reports=t.data.result;var r=["合計",0,0,0,0,0,0,0,0,0,0,0,0,0],n=e;Object.keys(e.reports).forEach((function(t,e){for(var a=n.reports[t],o=2;o<a.length;o++)r[o-1]+=a[o],r[o-1]=Math.round(100*r[o-1])/100})),e.month_total=r,$.closeModal()})).catch((function(t){console.log("生成報表時發生錯誤："+t),$.showErrorModal(t)}))}},created:function(){this.refreshData()},mounted:function(){var t=new Date;this.year=t.getFullYear()}})},231:function(t,e,r){"use strict";r.r(e);var n={props:["reports","filters","month_total"],data:function(){return{tableTitle:"客戶名稱"}},methods:{changeType:function(t){1==t.target.value?this.tableTitle="客戶名稱":this.tableTitle="商品名稱",this.$emit("refresh-data")},changeYear:function(t){this.$emit("refresh-data")},changeOrderby:function(t){this.$emit("refresh-data")}},created:function(){},mounted:function(){}},a=r(0),o=Object(a.a)(n,(function(){var t=this,e=t._self._c;return e("div",[e("div",{staticClass:"card mb-3"},[e("div",{staticClass:"card-header"},[e("i",{staticClass:"fas fa-table mr-2"}),t._v("銷售年度報表 - "+t._s(t.filters.year)+"年\r\n        ")]),t._v(" "),e("div",{staticClass:"card-body"},[e("div",{staticClass:"row justify-content-center mb-2"},[e("div",{staticClass:"col-md-12 justify-content-center"},[e("form",{attrs:{action:"#",method:"GET"},on:{submit:function(e){return e.preventDefault(),t.changeYear.apply(null,arguments)}}},[e("div",{staticClass:"row mb-3 justify-content-center"},[e("div",{staticClass:"col-md-3"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.filters.type,expression:"filters.type"}],staticClass:"form-control",attrs:{name:"type",id:"type"},on:{change:[function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.filters,"type",e.target.multiple?r:r[0])},t.changeType]}},[e("option",{attrs:{value:"1"}},[t._v("依客戶別")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("依商品別")])])]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.filters.year,expression:"filters.year"}],staticClass:"form-control",attrs:{type:"text",id:"year",name:"year",placeholder:"請輸入年份"},domProps:{value:t.filters.year},on:{change:t.changeYear,keydown:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:(e.preventDefault(),t.changeYear.apply(null,arguments))},input:function(e){e.target.composing||t.$set(t.filters,"year",e.target.value)}}})]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.filters.orderby,expression:"filters.orderby"}],staticClass:"form-control",attrs:{name:"orderby",id:"orderby"},on:{change:[function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.filters,"orderby",e.target.multiple?r:r[0])},t.changeOrderby]}},[e("option",{attrs:{value:"1"}},[t._v("總銷售額升序")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("總銷售額降序")])])])])])])]),t._v(" "),e("div",{staticClass:"table-responsive"},[e("table",{staticClass:"table table-bordered",attrs:{id:"SalesYearTable"}},[e("thead",[e("tr",[e("th",[t._v(t._s(t.tableTitle))]),t._v(" "),t._l(12,(function(r){return e("th",{key:r},[t._v(t._s(r+"月"))])})),t._v(" "),e("th",[t._v("小計")])],2)]),t._v(" "),e("tbody",[t._l(t.reports,(function(r){return e("tr",{key:r[0]},[e("td",[t._v(t._s(r[1]))]),t._v(" "),e("td",[t._v(t._s(r[2]))]),t._v(" "),e("td",[t._v(t._s(r[3]))]),t._v(" "),e("td",[t._v(t._s(r[4]))]),t._v(" "),e("td",[t._v(t._s(r[5]))]),t._v(" "),e("td",[t._v(t._s(r[6]))]),t._v(" "),e("td",[t._v(t._s(r[7]))]),t._v(" "),e("td",[t._v(t._s(r[8]))]),t._v(" "),e("td",[t._v(t._s(r[9]))]),t._v(" "),e("td",[t._v(t._s(r[10]))]),t._v(" "),e("td",[t._v(t._s(r[11]))]),t._v(" "),e("td",[t._v(t._s(r[12]))]),t._v(" "),e("td",[t._v(t._s(r[13]))]),t._v(" "),e("td",[t._v(t._s(r[14]))])])})),t._v(" "),e("tr",t._l(t.month_total.length,(function(r){return e("td",{key:r},[e("strong",[t._v(t._s(t.month_total[r-1]))])])})),0)],2)])])])])])}),[],!1,null,null,null);e.default=o.exports}});