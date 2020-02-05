
Vue.component('basic-materials-table', require('./../../components/Materials/Basic/BasicMaterialsTable.vue').default);

const app = new Vue({
    el: '#basicmaterial',
    data() {
        return {
            basic_materials: [],
        }
    },
    methods: {

    },
    created(){
        let getBasicMaterialsList = $('#getBasicMaterialsList').html();
        axios.get(getBasicMaterialsList).then(response => {
            this.basic_materials = response.data;
        });
    }
});