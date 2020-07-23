<template>
<div>
    <div class="form-group col-md-12 uploader-head">
        商品圖片
        <small class="form-text text-muted">僅支援JPG、JPEG、PNG與BMP格式圖片，且檔案大小上限為20MB。</small>
        <div class="uploader-info">{{ pictures_data.length }}/5</div>
    </div>

    <div class="form-group col-md-12 uploader-body d-flex-row-nowarp">
        <ul class="preview-img-container d-flex-row-nowarp">
            <li class="preview-img" v-for="picture in pictures_data" :key="picture.index" v-bind:style="{ 'background-image': 'url(' + picture.blob_url + ')' }"></li>
        </ul>
        <div class="image-input-container" v-if="pictures_data.length < 5">
            <input class="image-input" type="file" multiple accept="image/jpeg,image/png,image/bmp" @change="addImage">
        </div>
        <div class="previewer" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="previewer-bg"></div>
            <div class="previewer-bd"></div>
            <div class="previewer-ft"></div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: [],
    data(){
        return {
            pictures_data: [],
            filelist: [],
        }
    },
    methods: {
        addImage(e){
            let $files = $(e.target).prop('files');
            let max_files_count = 5 - this.pictures_data.length;

            if($files.length > max_files_count){
                $.showErrorModalWithoutError('圖片最多不得超過五張。');
                $(e.target).val('');
                return false;
            }

            if($files.length > 0){
                for(let $i = 0; $i < $files.length; $i++){
                    let $file = $files[$i];
                    if(this.isImageFile($file)){
                        // 這邊使用 Object URL 的功能。
                        let $url = URL.createObjectURL($file);
                        this.pictures_data.push({
                            index: (this.pictures_data.length + 1),
                            blob_url: $url,
                            name: $file.name,
                            type: $file.type,
                            size: $file.size,
                        });
                        this.filelist.push($file);
                    }else{
                        $.showErrorModalWithoutError('只能上傳(png, jpg, jpeg, gif)格式之圖片。');
                        continue;
                    }
                }
            }
        },
        // 檢查所上傳的檔案是不是圖片檔案。
        isImageFile($file){
            if ($file.type) {
				return /^image\/\w+$/.test($file.type);
			} else {
				return /\.(jpg|jpeg|png|gif|bmp)$/.test($file);
			}
        },
    },
    created(){

    },
    mounted(){

    }
}
</script>

<style>
.uploader-body{
    background-color: #fafafa;
}

.d-flex-row-nowarp{
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
}

.uploader-info{
    display: inline-block;
    position: absolute;
    top: 0;
    right: 15px;
}

.preview-img-container{
    list-style: none;
    margin: 0;
    padding: 0;
}

.preview-img{
    margin-left: 9px;
    margin-bottom: 9px;
    margin-top: 9px;
    width: 80px;
    height: 80px;
    background: no-repeat center center;
    background-size: cover;
    cursor: pointer;
}

.image-input-container{
    position: relative;
    margin-left: 9px;
    margin-bottom: 9px;
    margin-top: 9px;
    width: 80px;
    height: 80px;
    border: 1px solid #d9d9d9;
}

.image-input-container:before, .image-input-container:after{
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #d9d9d9;
}

.image-input-container:before{
    width: 2px;
    height: 39.5px;
}

.image-input-container:after{
    width: 39.5px;
    height: 2px;
}

.image-input{
    width: 100%;
    height: 100%;
    cursor: pointer;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    opacity: 0;
}

.previewer{
    display: none;
    position: fixed;
    width: 100vw;
    height: 100vh;
    top: 0;
    left: 0;
    overflow: hidden;
    touch-action: none;
    z-index: 1500;
    outline: none;
}

.open{
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
}

.previewer-bg{
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: #000;
    opacity: 0;
    transition: opacity 333ms cubic-bezier(0.4, 0, 0.22, 1);
}

.previewer-bd{

}

.previewer-ft{

}
</style>