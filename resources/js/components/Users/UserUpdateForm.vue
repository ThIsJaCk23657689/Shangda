<template>
<div class="row justify-content-center">
    <div class="col-md-8">
        <form method="POST" action="#" @submit.prevent="userUpdateForm">
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">
                            <span class="text-danger mr-2">*</span>姓名
                        </label>
                        <input id="name" name="name" type="text" class="form-control mb-2" v-model="user.name" required autofocus>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email"><span class="text-danger mr-2">*</span>信箱</label>
                        <input id="email" name="email" type="email" class="form-control" v-model="user.email" required>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="gender"><span class="text-danger mr-2">*</span>性別</label>
                        <select name="gender" id="gender" class="form-control" v-model="user.gender" required>
                            <option value="0">小姐</option>
                            <option value="1">先生</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="jobTitle"><span class="text-danger mr-2">*</span>帳號類型</label>
                        <select name="jobTitle" id="jobTitle" class="form-control" v-model="user.job_title_id" required>
                            <option v-for="jobTitle in jobTitles" :key="jobTitle.id" :value="jobTitle.id">{{ jobTitle.name }}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tel">電話</label>
                        <input id="tel" name="tel" type="text" class="form-control" v-model="user.tel" placeholder="例：0412345678">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone">手機</label>
                        <input id="phone" name="phone" type="text" class="form-control" v-model="user.phone" placeholder="例：0912345678">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="birthday">生日</label>
                        <input id="birthday" name="birthday" type="text" class="form-control" v-model="user.birthday" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="comment">備註內容</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3" v-model="user.comment"></textarea>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="address_twzipcode" class="form-group">
                        <label>地址</label>
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div data-role="county" data-style="form-control" data-name="address_county" :data-value="user.address_county"></div>
                            </div>
                            <div class="col-md-4">
                                <div data-role="district" data-style="form-control" data-name="address_district" :data-value="user.address_district"></div>
                            </div>
                            <div class="col-md-4">
                                <div data-role="zipcode" data-style="form-control" data-name="address_zipcode" :data-value="user.address_zipcode"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input id="address_others" type="text" class="form-control" name="address_others" v-model="user.address_others">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn btn-block btn-success">
                        確認修改
                    </button>
                    <a :href="UsersIndexURL" class="btn btn-block btn-danger">
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
    props: ['user', 'jobTitles'],
    data(){
        return {
            UsersIndexURL: $('#UsersIndexURL').text(),
            UsersUpdateURL: $('#UsersUpdateURL').text(),
        }
    },
    methods: {
        userUpdateForm(e) {
            let url = this.UsersUpdateURL;
            let data = $(e.target).serializeObject();

            $.showLoadingModal();
            axios.patch(url, data).then(response => {
                $.showSuccessModal(response.data.message, response.data.url);
            }).catch((error) => {
                console.error('編輯員工時發生錯誤，錯誤訊息：' + error);
                $.showErrorModal(error);
            });
        }
    },
    created(){
        
    },
    mounted(){
        // 生日
        $("#birthday").datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            yearRange: "-80:+0",
            maxDate: '-15y',
        });
    }
}
</script>

<style>

</style>
