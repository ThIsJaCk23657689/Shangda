<template>
<div class="row justify-content-center">
    <div class="col-md-8">
        <form method="POST" action="#" @submit.prevent="announcementEditForm">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">標題</label>
                        <input id="title" name="title" type="text" class="form-control" v-model="announcement.title" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <upload-images ref="uploadCoverImages" :title="'上傳封面圖片'" :aspect-ratio="1"  :prefix="'announcement'" :helptext="'（建議尺寸：500px * 500px）'" :uploadimg="announcement.showCoverImage"></upload-images>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content">內容</label>
                        <textarea name="content" id="content" class="form-control" cols="30" rows="5" v-model="announcement.content"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-block btn-success">
                        確認編輯
                    </button>
                    <a :href="AnnouncementsIndexURL" class="btn btn-block btn-danger">
                        返回列表
                    </a>
                </div>
            </div>

        </form>
    </div>
</div>
</template>

<script>
export default {
    props:['announcement'],
    data(){
        return {
            AnnouncementsIndexURL: $('#AnnouncementsIndexURL').html(),
            AnnouncementsUpdateURL: $('#AnnouncementsUpdateURL').html(),
        }
    },
    methods: {
        announcementEditForm(e) {
            let url = this.AnnouncementsUpdateURL;
            let formData = new FormData($(e.target)[0]);
            formData.append('_method', 'patch');

            $.showLoadingModal();
            axios.post(url, formData).then(response => {
                $.showSuccessModal('編輯成功', response.data.url);
            }).catch((error) => {
                console.error('編輯最新消息時發生錯誤，錯誤訊息：' + error);
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
