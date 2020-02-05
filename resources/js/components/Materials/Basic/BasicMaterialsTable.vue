<template>
<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        基礎原物料管理
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>編號</th>
                        <th>名稱</th>
                        <th>價格(元)</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(basic_material, index) in basic_materials" :key="index">
                        <td>{{ basic_material.id }}</td>
                        <td>
                            <input :id="'name_' + basic_material.id" type="text" class="form-control" v-model="basic_material.name" value="basic_material.name" disabled>
                        </td>
                        <td>
                            <input :id="'price_' + basic_material.id" type="text" class="form-control" v-model="basic_material.price" value="basic_material.price" disabled>
                        </td>
                        <td>
                            <button :id="'startBtn_' + basic_material.id" type="button" class="btn btn-md btn-success" @click="startEdit(basic_material.id)">
                                <i class="fas fa-edit"></i>
                                編輯
                            </button>
                            <button :id="'saveBtn_' + basic_material.id" type="button" class="btn btn-md btn-warning" @click="editdata(basic_material.id)" style="display: none;">
                                <span :id="'loading_' + basic_material.id" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                <i class="fas fa-save"></i>
                                儲存
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['basic_materials'],
    mounted() {
        console.log('BasicMaterialsTable.vue mounted.');
    },
    data(){
        return {

        }
    },
    methods:{
        startEdit(id){
            // 把其他的也要關起來

            $('#startBtn_' + id).attr('disabled', true);
            $('#startBtn_' + id).fadeOut();
            $('#name_' + id).attr('disabled', false);
            $('#price_' + id).attr('disabled', false);
            $('#saveBtn_' + id).attr('disabled', false);
            $('#saveBtn_' + id).fadeIn();
        },
        editdata(id){
            confirm('您確定要更變此原物料資料？')
            $('#loading_' + id).fadeIn();
            $('#saveBtn_' + id).attr('disabled', true);
            $('#name_' + id).attr('disabled', true);
            $('#price_' + id).attr('disabled', true);

            let getBasicMaterialsURL = $('#getBasicMaterialsURL').html();
            axios.post(getBasicMaterialsURL + '/' + id, {
                name: this.basic_materials[id-1].name,
                price: this.basic_materials[id-1].price,
                _method: 'PATCH'
            }).then(response => {
                console.log(response);
                alert('修改成功！');
                $('#loading_' + id).fadeOut();
                $('#saveBtn_' + id).fadeOut();
                $('#startBtn_' + id).attr('disabled', false);
                $('#startBtn_' + id).fadeIn();
            });
        }
    }
}
</script>

<style>

</style>