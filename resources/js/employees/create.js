import { County, ZipcodeGroupby, Zipcode } from 'twzipcode-vue'
Vue.component('employee-form-page', require('./../components/Employees/EmployeeForm.vue').default);
Vue.component('twzipcode-county', County);
Vue.component('twzipcode-zipcode', Zipcode);
Vue.component('twzipcode-zipcode-groupby', ZipcodeGroupby);

const app = new Vue({
    el: '#employee-app',
    data() {
        return {
        }
    },
    methods: {
    },
    created() {
    },
    mounted() {
    }
});
