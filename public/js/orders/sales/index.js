!function(e){var t={};function n(a){if(t[a])return t[a].exports;var o=t[a]={i:a,l:!1,exports:{}};return e[a].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,a){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:a})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var a=Object.create(null);if(n.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(a,o,function(t){return e[t]}.bind(null,o));return a},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=126)}({126:function(e,t,n){e.exports=n(127)},127:function(e,t){$((function(){$("#delivered_delivered_at").datepicker({dateFormat:"yy-mm-dd",changeYear:!0,changeMonth:!0,maxDate:new Date}),$("#paid_paid_at").datepicker({dateFormat:"yy-mm-dd",changeYear:!0,changeMonth:!0,maxDate:new Date});var e=new Date,t=e.getFullYear()+"-"+("0"+(e.getMonth()+1)).slice(-2)+"-"+("0"+e.getDate()).slice(-2);$("#delivered_delivered_at").val(t),$("#paid_paid_at").val(t),$(".delivered-btn").click((function(){var e=$(this).data("id"),t=$(this).data("expectDeliveredAt");$("#delivered_sales_id").val(e),$("#delivered_expectDelivered_at").val(t)})),$(".cancle-delivered-btn").click((function(){var e=this;Swal.fire({title:"注意！",text:"您確定要取消出貨嗎？",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"確認",cancelButtonText:"取消"}).then((function(t){t.value&&$(e).next().submit()}))})),$(".cancle-delivered-form").submit((function(e){e.preventDefault();var t=$(this).attr("action"),n=$(this).serializeObject();$.showLoadingModal(),axios.post(t,n).then((function(e){$.showSuccessModal(e.data.message,e.data.url)})).catch((function(e){$.showErrorModal(e),console.error("取消銷貨單出貨時間時發生錯誤，錯誤訊息："+e)}))})),$("#DeliveredForm").submit((function(e){e.preventDefault();var t=$(this).attr("action"),n=$(this).serializeObject();$.showLoadingModal(),axios.post(t,n).then((function(e){$.showSuccessModal(e.data.message,e.data.url),$("#DeliveredForm").modal("hide")})).catch((function(e){$.showErrorModal(e),console.error("修改銷貨單到貨時間時發生錯誤，錯誤訊息："+e)}))})),$(".paid-btn").click((function(){var e=$(this).data("id");$("#paid_sales_id").val(e)})),$("#PaidForm").submit((function(e){e.preventDefault();var t=$(this).attr("action"),n=$(this).serializeObject();$.showLoadingModal(),axios.post(t,n).then((function(e){$.showSuccessModal(e.data.message,e.data.url),$("#PaidModal").modal("hide")})).catch((function(e){$.showErrorModal(e),console.error("確認進貨單付清時間時發生錯誤，錯誤訊息："+e)}))})),$(".cancle-paid-btn").click((function(){var e=this;Swal.fire({title:"注意！",text:"您確定要取消此銷貨單的付清狀態？",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"確認",cancelButtonText:"取消"}).then((function(t){t.value&&$(e).next().submit()}))})),$(".cancle-paid-form").submit((function(e){e.preventDefault();var t=$(this).attr("action"),n=$(this).serializeObject();$.showLoadingModal(),axios.post(t,n).then((function(e){$.showSuccessModal(e.data.message,e.data.url)})).catch((function(e){$.showErrorModal(e),console.error("確認或取消進貨單付清時發生錯誤，錯誤訊息："+e)}))}))}))}});