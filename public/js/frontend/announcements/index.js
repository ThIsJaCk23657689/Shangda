!function(t){var e={};function n(a){if(e[a])return e[a].exports;var r=e[a]={i:a,l:!1,exports:{}};return t[a].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=t,n.c=e,n.d=function(t,e,a){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)n.d(a,r,function(e){return t[e]}.bind(null,r));return a},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=74)}({0:function(t,e,n){"use strict";function a(t,e,n,a,r,o,s,i){var c,l="function"==typeof t?t.options:t;if(e&&(l.render=e,l.staticRenderFns=n,l._compiled=!0),a&&(l.functional=!0),o&&(l._scopeId="data-v-"+o),s?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),r&&r.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(s)},l._ssrRegister=c):r&&(c=i?function(){r.call(this,(l.functional?this.parent:this).$root.$options.shadowRoot)}:r),c)if(l.functional){l._injectStyles=c;var u=l.render;l.render=function(t,e){return c.call(e),u(t,e)}}else{var d=l.beforeCreate;l.beforeCreate=d?[].concat(d,c):[c]}return{exports:t,options:l}}n.d(e,"a",(function(){return a}))},169:function(t,e,n){"use strict";n.r(e);var a={props:["filter"],data:function(){return{}},methods:{changeType:function(){this.$emit("refresh-announcement",1)},search:function(){this.$emit("refresh-announcement",1)},changeOrder:function(){this.$emit("refresh-announcement")}},created:function(){},mounted:function(){}},r=n(0),o=Object(r.a)(a,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row filter-row"},[e("div",{staticClass:"col-md-3 col-6 d-flex"},[e("div",{staticClass:"filter-dropbox-container"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.filter.type,expression:"filter.type"}],staticClass:"form-control filter-dropbox",attrs:{id:"filter-column",name:"column"},on:{change:[function(e){var n=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.filter,"type",e.target.multiple?n:n[0])},t.changeType]}},[e("option",{attrs:{value:"0"}},[t._v("依條件")]),t._v(" "),e("option",{attrs:{value:"1"}},[t._v("標題")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("內文")]),t._v(" "),e("option",{attrs:{value:"0"}},[t._v("全部搜尋")])])])]),t._v(" "),e("div",{staticClass:"col-md-6 col-12 d-flex search-div"},[e("div",{staticClass:"filter-search"},[t._m(0),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.filter.keyword,expression:"filter.keyword"}],staticClass:"form-control search-input",attrs:{type:"text",id:"search-input",name:"keyword",placeholder:"請輸入關鍵字"},domProps:{value:t.filter.keyword},on:{keypress:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.search.apply(null,arguments)},input:function(e){e.target.composing||t.$set(t.filter,"keyword",e.target.value)}}}),t._v(" "),e("a",{staticClass:"search-button",attrs:{href:"#"},on:{click:function(e){return e.preventDefault(),t.search.apply(null,arguments)}}},[t._v("\r\n                搜尋\r\n            ")])])]),t._v(" "),e("div",{staticClass:"col-md-3 col-6 d-flex order-2"},[e("select",{directives:[{name:"model",rawName:"v-model",value:t.filter.order,expression:"filter.order"}],staticClass:"form-control filter-dropbox",attrs:{id:"filter-order",name:"order"},on:{change:[function(e){var n=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.filter,"order",e.target.multiple?n:n[0])},t.changeOrder]}},[e("option",{attrs:{value:"0"}},[t._v("排序方式")]),t._v(" "),e("option",{attrs:{value:"1"}},[t._v("最新 -> 最舊")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("最舊 -> 最新")])])])])}),[function(){var t=this._self._c;return t("div",{staticClass:"search-icon"},[t("i",{staticClass:"fas fa-search"})])}],!1,null,null,null);e.default=o.exports},170:function(t,e,n){"use strict";n.r(e);var a={props:["announcements"],data:function(){return{}},methods:{},created:function(){},mounted:function(){}},r=n(0),o=Object(r.a)(a,(function(){var t=this._self._c;return t("div",{staticClass:"row announcement-list"},[this._l(this.announcements,(function(e){return t("announcement-card",{key:e.id,attrs:{announcement:e}})})),this._v(" "),0==this.announcements.length?t("span",{staticClass:"not-found-message"},[this._v("\r\n        很抱歉，無法找到您所查詢的資料，請重新查詢謝謝。\r\n    ")]):this._e()],2)}),[],!1,null,null,null);e.default=o.exports},171:function(t,e,n){"use strict";n.r(e);var a={props:["announcement"],data:function(){return{}},methods:{zoomIn:function(t){$(t.target).addClass("animate")},zoomOut:function(t){$(t.target).removeClass("animate")}},created:function(){},mounted:function(){}},r=n(0),o=Object(r.a)(a,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"announcement-card",on:{mouseenter:t.zoomIn,mouseleave:t.zoomOut}},[e("a",{staticClass:"card-link",attrs:{href:t.announcement.detailURL}},[e("div",{staticClass:"announcement-card-image"},[e("img",{attrs:{src:t.announcement.showCoverImage,alt:"最新消息封面圖"}}),t._v(" "),e("div",{staticClass:"image-gray"})]),t._v(" "),e("div",{staticClass:"announcement-card-info"},[e("div",{staticClass:"announcement-card-date"},[e("h3",[t._v(t._s(t.announcement.showDay))]),t._v(" "),e("span",[t._v(t._s(t.announcement.showMonth)),e("br"),t._v(t._s(t.announcement.showYear))])]),t._v(" "),e("div",{staticClass:"announcement-card-title"},[t._v("\r\n                "+t._s(t.announcement.title)+"\r\n            ")])])])])}),[],!1,null,null,null);e.default=o.exports},47:function(t,e,n){"use strict";n.r(e);var a={props:["currentPage","totalPage"],data:function(){return{}},methods:{range:function(t,e){for(var n=[],a=t;a<=e;a++)n.push(a);return n},chagePage:function(t){var e=parseInt($(t.target).text());this.$emit("chage-page",e)},nextPage:function(){this.$emit("chage-page",this.currentPage+1)},prevPage:function(){this.$emit("chage-page",this.currentPage-1)}},created:function(){},mounted:function(){}},r=n(0),o=Object(r.a)(a,(function(){var t=this,e=t._self._c;return e("div",{staticClass:"row"},[e("div",{staticClass:"content-paginate-container"},[t.totalPage<=7?e("ul",{staticClass:"content-paginate"},[e("li",[t.currentPage>1?e("span",{on:{click:t.prevPage}},[e("i",{staticClass:"fa fa-angle-left",attrs:{"aria-hidden":"true"}})]):t._e()]),t._v(" "),t._l(t.totalPage,(function(n){return e("li",{key:n},[n==t.currentPage?e("span",{staticClass:"activated"},[t._v(t._s(n))]):e("span",{on:{click:t.chagePage}},[t._v(t._s(n))])])})),t._v(" "),e("li",[t.currentPage!=t.totalPage&&t.totalPage>0?e("span",{on:{click:t.nextPage}},[e("i",{staticClass:"fa fa-angle-right",attrs:{"aria-hidden":"true"}})]):t._e()])],2):t._e(),t._v(" "),t.totalPage>7?e("ul",{staticClass:"content-paginate"},[e("li",[1!=t.currentPage?e("span",{on:{click:t.prevPage}},[e("i",{staticClass:"fa fa-angle-left",attrs:{"aria-hidden":"true"}})]):t._e()]),t._v(" "),t.currentPage<=4?e("div",{staticClass:"d-inline"},t._l(5,(function(n){return e("li",{key:n},[n==t.currentPage?e("span",{staticClass:"activated"},[t._v(t._s(n))]):e("span",{on:{click:t.chagePage}},[t._v(t._s(n))])])})),0):t.currentPage>t.totalPage-4?e("div",{staticClass:"d-inline"},t._l(3,(function(n){return e("li",{key:n},[n==t.currentPage?e("span",{staticClass:"activated"},[t._v(t._s(n))]):e("span",{on:{click:t.chagePage}},[t._v(t._s(n))])])})),0):e("div",{staticClass:"d-inline"},t._l(2,(function(n){return e("li",{key:n},[n==t.currentPage?e("span",{staticClass:"activated"},[t._v(t._s(n))]):e("span",{on:{click:t.chagePage}},[t._v(t._s(n))])])})),0),t._v(" "),e("li",{staticClass:"disabled"},[t._v("...")]),t._v(" "),t.currentPage>4&&t.currentPage<t.totalPage-3?e("div",{staticClass:"d-inline"},[t._l(t.range(t.currentPage-1,t.currentPage+1),(function(n){return e("li",{key:n},[n==t.currentPage?e("span",{staticClass:"activated"},[t._v(t._s(n))]):e("span",{on:{click:t.chagePage}},[t._v(t._s(n))])])})),t._v(" "),e("li",{staticClass:"disabled"},[t._v("...")])],2):t._e(),t._v(" "),t.currentPage>t.totalPage-4?e("div",{staticClass:"d-inline"},t._l(t.range(t.totalPage-4,t.totalPage),(function(n){return e("li",{key:n},[n==t.currentPage?e("span",{staticClass:"activated"},[t._v(t._s(n))]):e("span",{on:{click:t.chagePage}},[t._v(t._s(n))])])})),0):t.currentPage<=4?e("div",{staticClass:"d-inline"},t._l(t.range(t.totalPage-2,t.totalPage),(function(n){return e("li",{key:n},[n==t.currentPage?e("span",{staticClass:"activated"},[t._v(t._s(n))]):e("span",{on:{click:t.chagePage}},[t._v(t._s(n))])])})),0):e("div",{staticClass:"d-inline"},t._l(t.range(t.totalPage-1,t.totalPage),(function(n){return e("li",{key:n},[n==t.currentPage?e("span",{staticClass:"activated"},[t._v(t._s(n))]):e("span",{on:{click:t.chagePage}},[t._v(t._s(n))])])})),0),t._v(" "),e("li",[t.currentPage!=t.totalPage&&t.totalPage>0?e("span",{on:{click:t.nextPage}},[e("i",{staticClass:"fa fa-angle-right",attrs:{"aria-hidden":"true"}})]):t._e()])]):t._e()])])}),[],!1,null,null,null);e.default=o.exports},74:function(t,e,n){t.exports=n(75)},75:function(t,e,n){Vue.component("announcement-filter",n(169).default),Vue.component("announcement-container",n(170).default),Vue.component("announcement-card",n(171).default),Vue.component("content-paginate",n(47).default);new Vue({el:"#announcement",data:function(){return{announcements:[],filter:{type:0,keyword:"",order:0},totalcount:0,currentPage:1,totalPage:0}},methods:{getAnnouncements:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:0;$.showLoadingModal(),1!=e&&0!=this.currentPage||(this.currentPage=1);var n=$("#GetAnnouncementsList").text();axios.post(n,{skip:6*(this.currentPage-1),type:this.filter.type,keywords:this.filter.keyword,orderBy:this.filter.order,firstPage:e,status:1}).then((function(e){t.announcements=e.data.announcements,t.totalcount=e.data.totalcount,t.totalPage=Math.ceil(t.totalcount/6),0==t.totalcount&&(t.currentPage=0),$.closeModal()})).catch((function(t){console.log("抓取最新消息資料時錯誤。"),$.showErrorModal(t)}))},refreshAnnouncement:function(t){this.getAnnouncements(t),this.goBackToTop()},goBackToTop:function(){$("html, body").animate({scrollTop:440},500)},chagePage:function(t){this.currentPage=t,this.getAnnouncements(),this.goBackToTop()}},created:function(){this.getAnnouncements()},mounted:function(){}})}});