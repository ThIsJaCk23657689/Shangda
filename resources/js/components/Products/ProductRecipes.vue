<template>
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-6 mb-2">
                <select id="material_id" class="form-control" @change="getMaterialData">
                    <option value="0">請選擇...</option>
                    <option v-for="material in materials" :key="material.id" :value="material.id">{{ material.name }}</option>
                </select>
            </div>

            <div class="col-md-6">
                <button id="addMaterialBtn" type="button" class="btn btn-md btn-success" @click="addRecipe">新增至成分</button>
            </div>
        </div>

        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>編號</th>
                    <th>原物料</th>
                    <th>單價</th>
                    <th>耗材比</th>
                    <th>成本價</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(recipe, index) in recipes" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>
                        {{ recipe.material.name }}
                        <input type="hidden" :name="'recipes[' + (index + 1) + '][material_id]'" :value="recipe.material.id">
                    </td>
                    <td>
                        <input :id="'unitPrice_' + (index + 1)" type="text" class="form-control mr-2" :value="recipe.material.unitPrice" disabled style="width:60%;display:inline-block;">
                        <span> 元 / {{ (recipe.material.unit == 1) ? '公斤' : '公噸' }}</span>
                    </td>
                    <td>
                        <input :id="'raito_' + (index + 1)" type="text" class="form-control" :name="'recipes[' + (index + 1)+ '][raito]'" :value="recipe.raito" @change="calculateSubcost(index+1)">
                    </td>
                    <td>
                        <input :id="'subcost_' + (index + 1)" type="text" class="form-control" :value="recipe.subcost" disabled>
                    </td>
                    <td>
                        <button type="button" class="btn btn-md btn-danger" @click="deleteRecipe(index)">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <hr>

        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="totalCost">總成本價</label>
                    <input id="totalCost" name="totalCost" type="text" class="form-control mb-2" :value="this.total_cost" readonly>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="profit">
                        <span class="text-danger mr-2">*</span>利潤
                    </label>

                    <input id="profit" name="profit" type="text" class="form-control mb-2" :value="this.profit" required autocomplete="off" @change="calculateRetailPrice">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="retailPrice">零售價</label>
                    <input id="retailPrice" name="retailPrice" type="text" class="form-control" :value="this.retail_price" readonly>
                </div>
            </div>

        </div>
        
    </div>
</div>
</template>

<script>
export default {
    props: ['materials'],
    mounted() {
        console.log('ProductRecipes.vue mounted.');
    },
    data(){
        return {
            recipes: [],
            current_material: [],
            
            total_cost: 0,
            profit: 0,
            retail_price: 0
        }
    },
    methods: {
        // 新增原物料到商品成分表
        addRecipe(){
            let material_id = $('#material_id').val();
            if(material_id == 0){
                alert("請先選擇原物料!");
            }else{
                this.$emit('refresh-materials', {
                    id: material_id - 1,
                    type: 'add'
                });

                if(this.current_material.length != 0){
                    this.recipes.push({
                        count: this.recipes.length,
                        material: {
                            id: this.current_material.id,
                            name: this.current_material.name,
                            unitPrice: this.current_material.unitPrice,
                            unit: this.current_material.unit
                        },
                        raito: 0,
                        subcost: 0
                    });
                }else{
                    alert('請選擇原物料');
                }
            }
        },

        // 刪除原物料成分
        deleteRecipe(id){
            this.recipes.splice(id, 1);
            this.$emit('refresh-materials', {
                id: $('#materialID_' + (id + 1)).val(),
                type: 'deleted'
            });
            this.calculateTotalCost();
        },

        calculateSubcost(id){
            let raito = parseFloat($('#raito_' + id).val());
            let unitPrice = this.recipes[id - 1].material.unitPrice;
            let subcost = Math.round(unitPrice * raito * 10000) / 10000;

            this.recipes[id - 1].raito = raito;
            this.recipes[id - 1].subcost = subcost;
            this.calculateTotalCost();
        },

        calculateTotalCost(){
            this.total_cost = 0;
            for(let i = 1; i <=  this.recipes.length; i++){
                this.total_cost = this.total_cost +  this.recipes[i - 1].subcost;
            }
        },

        calculateRetailPrice(){
            this.calculateTotalCost();
            this.profit = $('#profit').val();
            this.retail_price = parseFloat(this.total_cost) + parseFloat(this.profit);
        },

        // 取得原物料資料
        getMaterialData(){
            let material_id = $('#material_id').val();

            if(material_id != 0){
                let getMeterialInfo = $('#getMeterialInfo').html();
                $('#addMaterialBtn').attr('disabled', true);
                axios.post(getMeterialInfo, {
                    id: material_id
                }).then(response => {
                    // console.log(response);
                    this.current_material = response.data;
                    $('#addMaterialBtn').attr('disabled', false);
                });
            }else{
                alert('請選擇原物料');
            }
        },
    }
}
</script>

<style>

</style>