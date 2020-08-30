<template>
<div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form method="POST" id="user_create_form" action="#" @submit.prevent="userCreateForm">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">
                                <span class="text-danger mr-2">*</span>姓名
                            </label>
                            <input id="name" name="name" type="text" class="form-control mb-2" value="" required autocomplete="off" autofocus>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email"><span class="text-danger mr-2">*</span>信箱</label>
                            <input id="email" name="email" type="email" class="form-control" value="" required autocomplete="off">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="gender"><span class="text-danger mr-2">*</span>性別</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="0">小姐</option>
                                <option value="1">先生</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="jobTitle"><span class="text-danger mr-2">*</span>職稱</label>
                            <select name="jobTitle" id="jobTitle" class="form-control" required>
                                <option v-for="jobTitle in jobTitles" :key="jobTitle.id" :value="jobTitle.id">{{ jobTitle.name }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="account"><span class="text-danger mr-2">*</span>帳號</label>
                            <input id="account" name="account" type="text" class="form-control mb-2" value="" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password"><span class="text-danger mr-2">*</span>密碼</label>
                            <input id="password" name="password" type="password" class="form-control mb-2" value="" required autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="password_confirmation"><span class="text-danger mr-2">*</span>密碼確認</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control mb-2" value="" required autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tel">電話</label>
                            <input id="tel" name="tel" type="text" class="form-control mb-2" value="" placeholder="例：0412345678" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="phone">手機</label>
                            <input id="phone" name="phone" type="text" class="form-control mb-2" value="" placeholder="例：0912345678" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birthday">生日</label>
                            <input id="birthday" name="birthday" type="text" class="form-control mb-2" value="" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="comment">備註內容</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div id="address_twzipcode" class="form-group">
                            <label>地址</label>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <div data-role="county" data-style="form-control" data-name="address_county" data-value=""></div>
                                </div>
                                <div class="col-md-4">
                                    <div data-role="district" data-style="form-control" data-name="address_district" data-value=""></div>
                                </div>
                                <div class="col-md-4">
                                    <div data-role="zipcode" data-style="form-control" data-name="address_zipcode" data-value=""></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="address_others" type="text" class="form-control" name="address_others" value="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-center">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-block btn-primary">
                            確認新增
                        </button>
                        <a :href="UsersIndexURL" class="btn btn-block btn-danger">
                            返回列表
                        </a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['jobTitles'],
    data(){
        return {
            UsersIndexURL: $('#UsersIndexURL').html(),
            UsersStoreURL: $('#UsersStoreURL').html(),
        }
    },
    methods: {
        userCreateForm(e) {
            let url = this.UsersStoreURL;
            let data = $(e.target).serializeObject();

            $.showLoadingModal();
            axios.post(url, data).then(response => {
                $.showSuccessModal(response.data.message, response.data.url);
            }).catch((error) => {
                console.error('新增員工時發生錯誤，錯誤訊息：' + error);
                $.showErrorModal(error);
            });
        }
    },
    mounted(){
        // 地址
        $('#address_twzipcode').twzipcode({
            'readonly': false
        });

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
