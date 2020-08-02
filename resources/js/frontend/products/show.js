const contnet = new Vue({
    el: '#product-detail',
    data() {
        return {

        }
    },
    methods: {

    },
    created() {
        // let getOnePictures = $('#getOnePictures').text();
        // axios.get(getOnePictures).then(response => {
        //     // this.images = response.data.images;
        //     this.test = response.data.images;
        //     console.log(this.test);
        //     console.log(this.images);

        // });

    },
    mounted() {
        $('.sp-wrap').smoothproducts();
    }
});