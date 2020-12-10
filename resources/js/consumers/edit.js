Vue.component('individual-consumer-update-form', require('./../components/Consumers/IndividualConsumerUpdateForm.vue').default);
Vue.component('company-consumer-update-form', require('./../components/Consumers/CompanyConsumerUpdateForm.vue').default);
Vue.component('upload-images', require('./../components/Partials/UploadImages.vue').default);

const app = new Vue({
    el: '#consumer',
    data() {
        return {
            consumer: [],
        }
    },
    methods: {

    },
    created() {
        let ConsumerGetOneURL = $('#ConsumerGetOneURL').html();
        $.showLoadingModal();
        axios.get(ConsumerGetOneURL).then(response => {
            this.consumer = response.data.consumer;

            if(this.consumer.account_type == 0){

                if(this.consumer.monthlyCheckDate == 0){
                    $('#individual_monthlyCheckDate').prop('disabled', true);
                    $('#individual_monthlyCheck').prop('checked', true);
                }else{
                    $('#individual_monthlyCheckDate').prop('disabled', false);
                    $('#individual_monthlyCheck').prop('checked', false);
                }

                $('#individual_address_twzipcode').twzipcode({
                    'readonly': true,
                    'zipcodeSel': this.consumer.address_zipcode,
                    'county': this.consumer.address_county,
                    'district': this.consumer.address_district,
                    'zipcode': this.consumer.address_zipcode
                });
            }else{
                if(this.consumer.monthlyCheckDate == 0){
                    $('#company_monthlyCheckDate').prop('disabled', true);
                    $('#company_monthlyCheck').prop('checked', true);
                }else{
                    $('#company_monthlyCheckDate').prop('disabled', false);
                    $('#company_monthlyCheck').prop('checked', false);
                }

                $('#company_address_twzipcode').twzipcode({
                    'readonly': true,
                    'zipcodeSel': this.consumer.address_zipcode,
                    'county': this.consumer.address_county,
                    'district': this.consumer.address_district,
                    'zipcode': this.consumer.address_zipcode
                });

                $('#company_deliveryAddress_twzipcode').twzipcode({
                    'readonly': true,
                    'zipcodeSel': this.consumer.deliveryAddress_zipcode,
                    'county': this.consumer.deliveryAddress_county,
                    'district': this.consumer.deliveryAddress_district,
                    'zipcode': this.consumer.deliveryAddress_zipcode
                });
            }
            $.closeModal();
            
        });
    },
    mounted() {

    }
});