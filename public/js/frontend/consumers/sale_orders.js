!function(e){var t={};function a(i){if(t[i])return t[i].exports;var s=t[i]={i:i,l:!1,exports:{}};return e[i].call(s.exports,s,s.exports,a),s.l=!0,s.exports}a.m=e,a.c=t,a.d=function(e,t,i){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(a.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var s in e)a.d(i,s,function(t){return e[t]}.bind(null,s));return i},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=92)}({0:function(e,t,a){"use strict";function i(e,t,a,i,s,n,r,l){var c,o="function"==typeof e?e.options:e;if(t&&(o.render=t,o.staticRenderFns=a,o._compiled=!0),i&&(o.functional=!0),n&&(o._scopeId="data-v-"+n),r?(c=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),s&&s.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(r)},o._ssrRegister=c):s&&(c=l?function(){s.call(this,(o.functional?this.parent:this).$root.$options.shadowRoot)}:s),c)if(o.functional){o._injectStyles=c;var d=o.render;o.render=function(e,t){return c.call(t),d(e,t)}}else{var u=o.beforeCreate;o.beforeCreate=u?[].concat(u,c):[c]}return{exports:e,options:o}}a.d(t,"a",(function(){return i}))},199:function(e,t,a){"use strict";a.r(t);var i={props:["saleOrders"],data:function(){return{}},methods:{},created:function(){},mounted:function(){}},s=a(0),n=Object(s.a)(i,(function(){var e=this._self._c;return e("div",{staticClass:"sale-orders-list"},[this._l(this.saleOrders,(function(t){return e("sale-order-card",{key:t.id,attrs:{saleOrder:t}})})),this._v(" "),0==this.saleOrders.length?e("div",{staticClass:"not-found-message"},[this._v("\r\n        很抱歉，無法找到您所查詢的資料，請重新查詢謝謝。\r\n    ")]):this._e()],2)}),[],!1,null,null,null);t.default=n.exports},200:function(e,t,a){"use strict";a.r(t);var i={props:["saleOrder"],data:function(){return{}},methods:{},created:function(){},mounted:function(){}},s=a(0),n=Object(s.a)(i,(function(){var e=this,t=e._self._c;return t("div",{staticClass:"sale-order-content"},[t("div",{staticClass:"card"},[t("div",{staticClass:"card-header"},[t("p",[t("i",{staticClass:"fas fa-calendar-alt"}),e._v(" "+e._s(e.saleOrder.created_at))])]),e._v(" "),t("div",{staticClass:"card-body"},[t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-6"},[t("p",[e._v("訂單編號 : "+e._s(e.saleOrder.shown_id))])]),e._v(" "),t("div",{staticClass:"col-md-6"},[t("p",[e._v("訂單狀態 : "+e._s(e.saleOrder.showSaleOrderStatus))])])]),e._v(" "),t("div",{staticClass:"row"},[t("div",{staticClass:"col-md-6"},[t("p",[e._v("訂單總額 : "+e._s(e.saleOrder.totalTaxPrice)+" 元")])]),e._v(" "),t("div",{staticClass:"col-md-6"},[t("p",[e._v("付款/出貨日期 : "+e._s(e.saleOrder.showPaidAtDate)+" / "+e._s(e.saleOrder.showDeliverAtDate))])])]),e._v(" "),t("a",{staticClass:"btn btn-primary",attrs:{href:e.saleOrder.showURL}},[e._v("查看訂單詳細資料")])])])])}),[],!1,null,null,null);t.default=n.exports},201:function(e,t,a){"use strict";a.r(t);var i={props:["filter"],data:function(){return{}},methods:{allClick:function(){$("#a_all").addClass("active"),$("#i_all").fadeIn(),$("#a_none").removeClass("active"),$("#a_paid").removeClass("active"),$("#a_delivered").removeClass("active"),$("#a_done").removeClass("active"),$("#i_none").hide(),$("#i_paid").hide(),$("#i_delivered").hide(),$("#i_done").hide();this.$emit("change-status",0)},noneClick:function(){$("#a_none").addClass("active"),$("#i_none").fadeIn(),$("#a_all").removeClass("active"),$("#a_paid").removeClass("active"),$("#a_delivered").removeClass("active"),$("#a_done").removeClass("active"),$("#i_all").hide(),$("#i_paid").hide(),$("#i_delivered").hide(),$("#i_done").hide();this.$emit("change-status",1)},paidClick:function(){$("#a_paid").addClass("active"),$("#i_paid").fadeIn(),$("#a_all").removeClass("active"),$("#a_none").removeClass("active"),$("#a_delivered").removeClass("active"),$("#a_done").removeClass("active"),$("#i_all").hide(),$("#i_none").hide(),$("#i_delivered").hide(),$("#i_done").hide();this.$emit("change-status",2)},deliveredClick:function(){$("#a_delivered").addClass("active"),$("#i_delivered").fadeIn(),$("#a_all").removeClass("active"),$("#a_none").removeClass("active"),$("#a_paid").removeClass("active"),$("#a_done").removeClass("active"),$("#i_all").hide(),$("#i_none").hide(),$("#i_paid").hide(),$("#i_done").hide();this.$emit("change-status",3)},doneClick:function(){$("#a_done").addClass("active"),$("#i_done").fadeIn(),$("#a_all").removeClass("active"),$("#a_none").removeClass("active"),$("#a_paid").removeClass("active"),$("#a_delivered").removeClass("active"),$("#i_all").hide(),$("#i_none").hide(),$("#i_paid").hide(),$("#i_delivered").hide();this.$emit("change-status",4)}},created:function(){},mounted:function(){}},s=a(0),n=Object(s.a)(i,(function(){var e=this,t=e._self._c;return t("div",{staticClass:"nav-div"},[t("ul",{staticClass:"nav"},[t("li",{staticClass:"nav-item"},[t("a",{staticClass:"nav-link active",attrs:{href:"#",id:"a_all"},on:{click:e.allClick}},[t("i",{staticClass:"fas fa-check-double",attrs:{id:"i_all"}}),e._v("所有訂單")])]),e._v(" "),t("li",{staticClass:"nav-item"},[t("a",{staticClass:"nav-link",attrs:{href:"#",id:"a_none"},on:{click:e.noneClick}},[t("i",{staticClass:"fas fa-check-double",staticStyle:{display:"none"},attrs:{id:"i_none"}}),e._v("未付款未出貨訂單")])]),e._v(" "),t("li",{staticClass:"nav-item"},[t("a",{staticClass:"nav-link",attrs:{href:"#",id:"a_paid"},on:{click:e.paidClick}},[t("i",{staticClass:"fas fa-check-double",staticStyle:{display:"none"},attrs:{id:"i_paid"}}),e._v("已付款未出貨訂單")])]),e._v(" "),t("li",{staticClass:"nav-item"},[t("a",{staticClass:"nav-link",attrs:{href:"#",id:"a_delivered"},on:{click:e.deliveredClick}},[t("i",{staticClass:"fas fa-check-double",staticStyle:{display:"none"},attrs:{id:"i_delivered"}}),e._v("未付款已出貨訂單")])]),e._v(" "),t("li",{staticClass:"nav-item"},[t("a",{staticClass:"nav-link",attrs:{href:"#",id:"a_done"},on:{click:e.doneClick}},[t("i",{staticClass:"fas fa-check-double",staticStyle:{display:"none"},attrs:{id:"i_done"}}),e._v("已完成訂單")])])])])}),[],!1,null,null,null);t.default=n.exports},52:function(e,t,a){"use strict";a.r(t);var i={props:["currentPage","totalPage"],data:function(){return{}},methods:{range:function(e,t){for(var a=[],i=e;i<=t;i++)a.push(i);return a},chagePage:function(e){var t=parseInt($(e.target).text());this.$emit("chage-page",t)},nextPage:function(){this.$emit("chage-page",this.currentPage+1)},prevPage:function(){this.$emit("chage-page",this.currentPage-1)}},created:function(){},mounted:function(){}},s=a(0),n=Object(s.a)(i,(function(){var e=this,t=e._self._c;return t("div",{staticClass:"row"},[t("div",{staticClass:"content-paginate-container"},[e.totalPage<=7?t("ul",{staticClass:"content-paginate"},[t("li",[e.currentPage>1?t("span",{on:{click:e.prevPage}},[t("i",{staticClass:"fa fa-angle-left",attrs:{"aria-hidden":"true"}})]):e._e()]),e._v(" "),e._l(e.totalPage,(function(a){return t("li",{key:a},[a==e.currentPage?t("span",{staticClass:"activated"},[e._v(e._s(a))]):t("span",{on:{click:e.chagePage}},[e._v(e._s(a))])])})),e._v(" "),t("li",[e.currentPage!=e.totalPage&&e.totalPage>0?t("span",{on:{click:e.nextPage}},[t("i",{staticClass:"fa fa-angle-right",attrs:{"aria-hidden":"true"}})]):e._e()])],2):e._e(),e._v(" "),e.totalPage>7?t("ul",{staticClass:"content-paginate"},[t("li",[1!=e.currentPage?t("span",{on:{click:e.prevPage}},[t("i",{staticClass:"fa fa-angle-left",attrs:{"aria-hidden":"true"}})]):e._e()]),e._v(" "),e.currentPage<=4?t("div",{staticClass:"d-inline"},e._l(5,(function(a){return t("li",{key:a},[a==e.currentPage?t("span",{staticClass:"activated"},[e._v(e._s(a))]):t("span",{on:{click:e.chagePage}},[e._v(e._s(a))])])})),0):e.currentPage>e.totalPage-4?t("div",{staticClass:"d-inline"},e._l(3,(function(a){return t("li",{key:a},[a==e.currentPage?t("span",{staticClass:"activated"},[e._v(e._s(a))]):t("span",{on:{click:e.chagePage}},[e._v(e._s(a))])])})),0):t("div",{staticClass:"d-inline"},e._l(2,(function(a){return t("li",{key:a},[a==e.currentPage?t("span",{staticClass:"activated"},[e._v(e._s(a))]):t("span",{on:{click:e.chagePage}},[e._v(e._s(a))])])})),0),e._v(" "),t("li",{staticClass:"disabled"},[e._v("...")]),e._v(" "),e.currentPage>4&&e.currentPage<e.totalPage-3?t("div",{staticClass:"d-inline"},[e._l(e.range(e.currentPage-1,e.currentPage+1),(function(a){return t("li",{key:a},[a==e.currentPage?t("span",{staticClass:"activated"},[e._v(e._s(a))]):t("span",{on:{click:e.chagePage}},[e._v(e._s(a))])])})),e._v(" "),t("li",{staticClass:"disabled"},[e._v("...")])],2):e._e(),e._v(" "),e.currentPage>e.totalPage-4?t("div",{staticClass:"d-inline"},e._l(e.range(e.totalPage-4,e.totalPage),(function(a){return t("li",{key:a},[a==e.currentPage?t("span",{staticClass:"activated"},[e._v(e._s(a))]):t("span",{on:{click:e.chagePage}},[e._v(e._s(a))])])})),0):e.currentPage<=4?t("div",{staticClass:"d-inline"},e._l(e.range(e.totalPage-2,e.totalPage),(function(a){return t("li",{key:a},[a==e.currentPage?t("span",{staticClass:"activated"},[e._v(e._s(a))]):t("span",{on:{click:e.chagePage}},[e._v(e._s(a))])])})),0):t("div",{staticClass:"d-inline"},e._l(e.range(e.totalPage-1,e.totalPage),(function(a){return t("li",{key:a},[a==e.currentPage?t("span",{staticClass:"activated"},[e._v(e._s(a))]):t("span",{on:{click:e.chagePage}},[e._v(e._s(a))])])})),0),e._v(" "),t("li",[e.currentPage!=e.totalPage&&e.totalPage>0?t("span",{on:{click:e.nextPage}},[t("i",{staticClass:"fa fa-angle-right",attrs:{"aria-hidden":"true"}})]):e._e()])]):e._e()])])}),[],!1,null,null,null);t.default=n.exports},92:function(e,t,a){e.exports=a(93)},93:function(e,t,a){Vue.component("sale-orders-container",a(199).default),Vue.component("sale-order-card",a(200).default),Vue.component("content-paginate",a(52).default),Vue.component("sale-order-filter",a(201).default);new Vue({el:"#sale-orders",data:function(){return{saleOrders:[],filter:{status:0},totalcount:0,currentPage:1,totalPage:0}},methods:{getSaleOrders:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0;$.showLoadingModal(),1!=t&&0!=this.currentPage||(this.currentPage=1);var a=$("#getSaleOrdersFrontend").text(),i=$("#getConsumerID").text();axios.post(a,{skip:5*(this.currentPage-1),status:this.filter.status,firstPage:t,consumer_id:i}).then((function(t){e.saleOrders=t.data.sale_orders,e.totalcount=t.data.totalcount,e.totalPage=Math.ceil(e.totalcount/5),0==e.totalcount&&(e.currentPage=0),$.closeModal()})).catch((function(e){console.log("抓取訂單資料時錯誤。"),$.showErrorModal(e)}))},changeStatus:function(e){this.filter.status=e;this.getSaleOrders(1),this.goBackToTop()},goBackToTop:function(){$("html, body").animate({scrollTop:0},500)},chagePage:function(e){this.currentPage=e,this.getSaleOrders(),this.goBackToTop()}},created:function(){this.getSaleOrders()},mounted:function(){}})}});