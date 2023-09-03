!function(t){var e={};function a(n){if(e[n])return e[n].exports;var o=e[n]={i:n,l:!1,exports:{}};return t[n].call(o.exports,o,o.exports,a),o.l=!0,o.exports}a.m=t,a.c=e,a.d=function(t,e,n){a.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},a.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},a.t=function(t,e){if(1&e&&(t=a(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(a.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)a.d(n,o,function(e){return t[e]}.bind(null,o));return n},a.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return a.d(e,"a",e),e},a.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},a.p="/",a(a.s=135)}({0:function(t,e,a){"use strict";function n(t,e,a,n,o,s,r,i){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=a,u._compiled=!0),n&&(u.functional=!0),s&&(u._scopeId="data-v-"+s),r?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(r)},u._ssrRegister=c):o&&(c=i?function(){o.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:o),c)if(u.functional){u._injectStyles=c;var l=u.render;u.render=function(t,e){return c.call(e),l(t,e)}}else{var d=u.beforeCreate;u.beforeCreate=d?[].concat(d,c):[c]}return{exports:t,options:u}}a.d(e,"a",(function(){return n}))},135:function(t,e,a){t.exports=a(136)},136:function(t,e,a){Vue.component("consumers-table",a(210).default),Vue.component("paginate-custom",a(211).default);new Vue({el:"#consumer",data:function(){return{rowsPerPage:10,pageNum:1,totalPage:0,DataTotalCount:0,consumers:[],status:0,category:14,type:0,keywords:"",orderby:2}},methods:{changeStatus:function(t){this.status=t,this.updateConsumer(this.pageNum,!0)},changeOrder:function(t){this.orderby=t,this.updateConsumer(this.pageNum,!0)},changeKeywordsType:function(t,e,a,n,o){this.category=n,this.keywords=t,this.type=e,this.status=a,this.orderby=o,this.updateConsumer(this.pageNum,!0)},changeCategory:function(t){this.category=t,this.updateConsumer(this.pageNum,!0)},updateConsumer:function(t,e){var a=this;this.pageNum=e?1:t;var n=(t-1)*this.rowsPerPage,o=this.rowsPerPage,s=this.status,r=this.keywords,i=this.type,c=this.category,u=this.orderby,l=$("#ConsumersGetList").html();$(".dataTables_processing",$("#ConsumersDataTable").closest(".dataTables_wrapper")).fadeIn(),axios.get(l,{params:{skip:n,take:o,status:s,keywords:r,type:i,category:c,first_page:e,orderby:u}}).then((function(t){a.consumers=t.data.consumers,a.DataTotalCount=t.data.DataTotalCount,a.totalPage=Math.ceil(a.DataTotalCount/a.rowsPerPage),$(".dataTables_processing",$("#ConsumersDataTable").closest(".dataTables_wrapper")).fadeOut(),$("#ConsumersDataTable").dataTable().fnClearTable(),0!=a.consumers.length&&$("#ConsumersDataTable").dataTable().fnAddData(a.consumers),a.refreshDeleteBtn()})).catch((function(t){console.log("讀取顧客清單時發生錯誤！"),console.log(t)}))},refreshDeleteBtn:function(){var t=this;$(".delete-btn").click((function(e){var a=this;e.preventDefault(),Swal.fire({title:"注意！",text:"確定要封鎖此顧客嗎？",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"確認",cancelButtonText:"取消"}).then((function(e){if(e.value){$.showLoadingModal();var n=$(a).next().html();axios.post(n,{_method:"DELETE"}).then((function(e){$.showSuccessModal("封鎖成功！"),t.updateConsumer(t.pageNum,!0)})).catch((function(t){$.showErrorModal(t)}))}}))})),$(".unlock-btn").click((function(e){var a=this;e.preventDefault(),Swal.fire({title:"注意！",text:"確定要解鎖此顧客嗎？",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"確認",cancelButtonText:"取消"}).then((function(e){if(e.value){$.showLoadingModal();var n=$(a).next().html();axios.post(n,{_method:"DELETE"}).then((function(e){$.showSuccessModal("解鎖成功！"),t.updateConsumer(t.pageNum,!0)})).catch((function(t){$.showErrorModal(t)}))}}))}))}},created:function(){var t=this,e=$("#ConsumersGetList").html();axios.get(e).then((function(e){t.DataTotalCount=e.data.DataTotalCount,t.totalPage=Math.ceil(t.DataTotalCount/t.rowsPerPage),t.consumers=e.data.consumers,$("#ConsumersDataTable").on("draw.dt",(function(){})).on("init.dt",(function(){})).dataTable({data:t.consumers,columns:[{data:"index"},{data:"account"},{data:"name"},{data:"taxID"},{data:"operator_name_1"},{data:"operator_tel_1"},{data:"uncheckedAmount"},{data:"action"}],lengthChange:!1,searching:!1,pageLength:t.rowsPerPage,info:!1,paging:!1,processing:!0,ordering:!1}),t.refreshDeleteBtn()}))},mounted:function(){}})},210:function(t,e,a){"use strict";a.r(e);var n={props:["consumers","rowsPerPage","pageNum","totalPage"],data:function(){return{}},methods:{getConsumerList:function(t){this.$emit("update-consumer",t)},changeStatus:function(t){var e=t.target.value;this.$emit("change-status",e)},changeOrder:function(t){var e=t.target.value;this.$emit("change-order",e)},changeKeywordsType:function(t){var e=$(t.target).serializeObject(),a=e.keywords,n=e.type,o=e.category,s=e.status,r=e.orderby;this.$emit("change-keywords-type",a,n,s,o,r)},changeCategory:function(t){var e=t.target.value;this.$emit("change-category",e)}},created:function(){},mounted:function(){}},o=a(0),s=Object(o.a)(n,(function(){var t=this,e=t._self._c;return e("div",[e("div",{staticClass:"card mb-3"},[t._m(0),t._v(" "),e("div",{staticClass:"card-body"},[e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-12 justify-content-center"},[e("form",{attrs:{method:"GET",id:"search-by-keywords-form"},on:{submit:function(e){return e.preventDefault(),t.changeKeywordsType.apply(null,arguments)}}},[e("div",{staticClass:"row mb-3 justify-content-center"},[e("div",{staticClass:"col-md-3"},[e("select",{staticClass:"form-control",attrs:{name:"status",id:"status"},on:{change:t.changeStatus}},[e("option",{attrs:{value:"0"}},[t._v("所有狀態")]),t._v(" "),e("option",{attrs:{value:"1"}},[t._v("已封鎖")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("未封鎖")])])]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("select",{staticClass:"form-control",attrs:{name:"category",id:"category"},on:{change:t.changeCategory}},[e("option",{attrs:{value:"0"}},[t._v("所有類別")]),t._v(" "),e("option",{attrs:{value:"1"}},[t._v("個人帳號")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("公司帳號")]),t._v(" "),e("option",{attrs:{value:"3"}},[t._v("管理者創建")]),t._v(" "),e("option",{attrs:{value:"4"}},[t._v("顧客創建")])])]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("select",{staticClass:"form-control",attrs:{name:"orderby",id:"orderby"},on:{change:t.changeOrder}},[e("option",{attrs:{value:"4"}},[t._v("排序方式")]),t._v(" "),e("option",{attrs:{value:"1"}},[t._v("建立日期(舊->新)")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("建立日期(新->舊)")]),t._v(" "),e("option",{attrs:{value:"3"}},[t._v("更新日期(舊->新)")]),t._v(" "),e("option",{attrs:{value:"4",selected:""}},[t._v("更新日期(新->舊)")])])])]),t._v(" "),t._m(1)])])]),t._v(" "),t._m(2)]),t._v(" "),e("div",{staticClass:"card-footer"},[e("paginate-custom",{attrs:{pageNum:t.pageNum,totalPage:t.totalPage},on:{updatePage:t.getConsumerList}})],1)])])}),[function(){var t=this._self._c;return t("div",{staticClass:"card-header"},[t("i",{staticClass:"fas fa-table mr-2"}),this._v("顧客列表\r\n        ")])},function(){var t=this,e=t._self._c;return e("div",{staticClass:"row justify-content-center"},[e("div",{staticClass:"col-md-3"},[e("select",{staticClass:"form-control",attrs:{name:"type",id:"type"}},[e("option",{attrs:{value:"0"}},[t._v("所有欄位")]),t._v(" "),e("option",{attrs:{value:"1"}},[t._v("帳號")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("名稱")]),t._v(" "),e("option",{attrs:{value:"3"}},[t._v("統編")]),t._v(" "),e("option",{attrs:{value:"4"}},[t._v("聯絡人姓名")]),t._v(" "),e("option",{attrs:{value:"5"}},[t._v("聯絡人電話")])])]),t._v(" "),e("div",{staticClass:"col-md-4"},[e("div",{staticClass:"form-group"},[e("input",{staticClass:"form-control mb-2",attrs:{id:"keywords",name:"keywords",type:"text",value:"",autocomplete:"off",placeholder:"關鍵字搜尋..."}})])]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("button",{staticClass:"btn btn-block btn-primary",attrs:{type:"submit"}},[t._v("\r\n                                    確認\r\n                                ")])])])},function(){var t=this,e=t._self._c;return e("div",{staticClass:"table-responsive"},[e("table",{staticClass:"table table-bordered",attrs:{id:"ConsumersDataTable",width:"100%",cellspacing:"0"}},[e("thead",[e("tr",[e("th",[t._v("編號")]),t._v(" "),e("th",[t._v("帳號")]),t._v(" "),e("th",[t._v("名稱")]),t._v(" "),e("th",[t._v("統編")]),t._v(" "),e("th",[t._v("聯絡人名稱")]),t._v(" "),e("th",[t._v("聯絡人電話")]),t._v(" "),e("th",[t._v("未沖帳總額")]),t._v(" "),e("th",[t._v("操作")])])])])])}],!1,null,null,null);e.default=s.exports},211:function(t,e,a){"use strict";a.r(e);var n={props:{pageNum:{type:Number,default:1},totalPage:{type:Number}},data:function(){return{currentPageNum:this.pageNum}},methods:{chagePage:function(t){this.$emit("updatePage",t)}},created:function(){},mounted:function(){}},o=a(0),s=Object(o.a)(n,(function(){return(0,this._self._c)("paginate",{attrs:{value:this.pageNum,"page-count":this.totalPage,"click-handler":this.chagePage,"page-range":5,"margin-pages":2,"prev-text":"上一頁","next-text":"下一頁","container-class":"pagination justify-content-center","page-class":"page-item","page-link-class":"page-link","prev-class":"page-item","next-class":"page-item","prev-link-class":"page-link","next-link-class":"page-link","active-class":"active"}})}),[],!1,null,null,null);e.default=s.exports}});