<template>
<div class="row justify-content-center">
    <div class="col-md-8">
        <form method="POST" action="#" @submit.prevent="informationEditForm">

            <div class="row">
                <div class="col-md-12 text-center">
                    <upload-images ref="uploadCoverImages" :title="'上傳封面圖片'" :aspect-ratio="4/3"  :prefix="'information'" :helptext="''" :uploadimg="information.showCoverImage"></upload-images>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-block btn-success">
                        確認編輯
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
</template>

<script>
export default {
    props:['information'],
    data(){
        return {
            InformationUpdateURL: $('#InformationUpdateURL').html(),
        }
    },
    methods: {
        informationEditForm(e) {
            let url = this.InformationUpdateURL;
            let formData = new FormData($(e.target)[0]);
            formData.append('_method', 'patch');

            $.showLoadingModal();
            axios.post(url, formData).then(response => {
                $.showSuccessModal('編輯成功', response.data.url);
            }).catch((error) => {
                console.error('編輯首頁封面圖片時發生錯誤，錯誤訊息：' + error);
                $.showErrorModal(error);
            });
        }
    },
    created(){

    },
    mounted(){

    }
}
</script>

<style>

</style>
