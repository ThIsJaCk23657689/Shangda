Vue.component('customer-sales-detail', require('../../components/Reports/CustomerSalesDetail.vue').default);

new Vue({
    el: '#customer-sales-report',
    data: {
        consumers: JSON.parse(document.getElementById('customerSalesConsumers').textContent || '[]'),
        dataUrl: document.getElementById('customerSalesDataUrl').textContent.trim(),
        exportUrl: document.getElementById('customerSalesExportUrl').textContent.trim(),
    },
});
