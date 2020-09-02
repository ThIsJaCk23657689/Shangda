Vue.component('supplier-update-form', require('./../components/Suppliers/SupplierUpdateForm.vue').default);

const app = new Vue({
    el: '#supplier',
    data() {
        return {
            supplier: [],
        }
    },
    methods: {

    },
    created() {
        $.showLoadingModal();
        let SuppliersGetOneURL = $('#SuppliersGetOneURL').text();
        axios.get(SuppliersGetOneURL).then(response => {
            this.supplier = response.data.supplier;

            // 地址
            $('#companyAddress_twzipcode').twzipcode({
                'readonly': false,
                'zipcodeSel': this.supplier.companyAddress_zipcode,
                'county': this.supplier.companyAddress_county,
                'district': this.supplier.companyAddress_district,
                'zipcode': this.supplier.companyAddress_zipcode
            });

            if(this.supplier.monthlyCheckDate == 0 || this.supplier.monthlyCheckDate == null){
                $('#monthlyCheckDate').val(0);
                $('#monthlyCheckDate').attr('disabled', true);
                $('#monthlyCheck').prop('checked', true);
            }else{
                $('#monthlyCheckDate').attr('disabled', false);
                $('#monthlyCheck').prop('checked', false);
            }

            $.closeModal();
        }).catch(error => {
            console.error('抓取供應商資料時發生錯誤，原因：' + error);
            $.showErrorModal(error);
        });
    },
    mounted() {

    }
});
