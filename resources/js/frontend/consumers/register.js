Vue.component('individual-consumer-create-form', require('./../../components/Consumers/IndividualConsumerCreateForm.vue').default);
Vue.component('company-consumer-create-form', require('./../../components/Consumers/CompanyConsumerCreateForm.vue').default);
Vue.component('upload-images', require('./../../components/Partials/UploadImages.vue').default);

const app = new Vue({
    el: '#consumer',
    data() {
        return {

        }
    },
    methods: {

    },
    created() {

    },
    mounted() {
        $('#individual_btn').click(function(e){
            $('#individual_form').slideDown();
            $('#individual_btn').attr('disabled', true);
            $('#company_btn').attr('disabled', true);
            $('#step1').slideUp();
            $('#goback2step1').slideDown();
            $('#individual_act').focus();
        });

        $('#company_btn').click(function(e){
            $('#company_form').slideDown();
            $('#individual_btn').attr('disabled', true);
            $('#company_btn').attr('disabled', true);
            $('#step1').slideUp();
            $('#goback2step1').slideDown();
        });

        $('#goback2step1_btn').click(function(e){
            $('#individual_form').slideUp();
            $('#company_form').slideUp();
            $('#individual_btn').attr('disabled', false);
            $('#company_btn').attr('disabled', false);
            $('#step1').slideDown();
            $('#goback2step1').slideUp();
        });
    }
});
