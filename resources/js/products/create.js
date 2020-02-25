Vue.component('product-recipes', require('./../components/Products/ProductRecipes.vue').default);

const app = new Vue({
    el: '#product',
    data() {
        return {
            materials: [],
            all_materials: [],
            materials_disabled: [],
        }
    },
    methods: {
        // 更新原物料清單
        refreshMaterials(data){
            this.materials = this.all_materials;

            if(data.type == 'add'){
                this.materials_disabled.push({
                    id: this.materials[data.id].id,
                    name: this.materials[data.id].name
                });
            }else{
                let index;
                for(let i = 0; i < this.materials_disabled.length; i++){
                    if(this.materials_disabled[i].id == data.id){
                        index = i;
                        break;
                    }
                }
                this.materials_disabled.splice(index, 1);
            }
            
            this.materials = [];
            for(let i = 0; i < this.all_materials.length; i++){
                let canAdd = true;
                for(let j = 0; j < this.materials_disabled.length; j++){
                    if(this.all_materials[i].id == this.materials_disabled[j].id){
                        canAdd = false;
                    }
                }
                if(canAdd){
                    this.materials.push(this.all_materials[i]);
                }
            }
        },
    },
    created(){
        // 取得所有原物料列表(id與name)
        let getMeterialsName = $('#getMeterialsName').html();
        axios.get(getMeterialsName).then(response => {
            this.materials = response.data;
            this.all_materials = this.materials;
        });
    },
    mounted(){
        $('#picture').change(function(){
            let input = $(this)[0];
            readURL(input);
        });
    
        function readURL(input) {
            if (input.files && input.files[0]) {
                $('#preview-upload').fadeIn();
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImg-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $('#fundamentalPrice').change(function(){
            $.isFloatOrInt($(this));
            caluatedRetailPrice();
        });
    
        $('#materialCoefficient1').change(function(){
            $.isFloatOrInt($(this));
            caluatedRetailPrice();
        });
    
        $('#materialCoefficient2').change(function(){
            $.isFloatOrInt($(this));
            caluatedRetailPrice();
        });
    
        $('#materialCoefficient3').change(function(){
            $.isFloatOrInt($(this));
            caluatedRetailPrice();
        });
    
        $('#materialCoefficient4').change(function(){
            $.isFloatOrInt($(this));
            caluatedRetailPrice();
        });
    
        $('#materialCoefficient5').change(function(){
            $.isFloatOrInt($(this));
            caluatedRetailPrice();
        });
    
        function caluatedRetailPrice(){
            let fp = parseFloat($('#fundamentalPrice').val()) ;
    
            let mc1 = parseFloat($('#materialCoefficient1').val());
            let mc2 = parseFloat($('#materialCoefficient2').val());
            let mc3 = parseFloat($('#materialCoefficient3').val());
            let mc4 = parseFloat($('#materialCoefficient4').val());
            let mc5 = parseFloat($('#materialCoefficient5').val());
    
            let mp1 = parseFloat($('#material_1').html());
            let mp2 = parseFloat($('#material_2').html());
            let mp3 = parseFloat($('#material_3').html());
            let mp4 = parseFloat($('#material_4').html());
            let mp5 = parseFloat($('#material_5').html());
    
            let rp = fp + mc1 * mp1 + mc2 * mp2 + mc3 * mp3 + mc4 * mp4 + mc5 * mp5;
            $('#retailPrice').val(rp);
        }
    
        function genereateProductID(){
            // 取得商品規格 (例如：兩斤、半斤、四兩)
            let specification = $('#specification').val();
            let specification_text_array = [
                '四兩', '六兩', '大六兩', '半斤', 
                '一斤', '兩斤', '三斤', '五斤', '七斤', 
                '十斤', '十五斤', '二十斤'
            ];
            let specification_id_array = [
                '004', '006', '0066', '008', 
                '010', '020', '030', '050', '070', 
                '110', '115', '120'
            ];
            let temp_index = specification_text_array.indexOf(specification);
            let specification_id = (temp_index != -1) ? specification_id_array[temp_index] : '' ;
    
            // 取得商品重量（例如：5 6 7 10 10.5 11 12，單位：兩）
            let weight = $('#weight').val();
            let weight_text_array = [
                '5', '6', '7', '10', '10.5', '11', '12'
            ];
            let weight_id_array = [
                '5', '6', '7', '3', '1', '', '2'
            ];
            temp_index = weight_text_array.indexOf(weight);
            let weight_id = (temp_index != -1) ? weight_id_array[temp_index] : '' ;
    
            // 取得商品慣用單位
            let unit = $('#unit').val();
    
            // 取得商品類別名稱
            let product_category_name = $('#category_id :selected').text();
            let first_code = '';
            if(product_category_name == '耐熱袋'){
                if(unit == 'package'){
                    first_code = '2';
                }else if(unit == 'roll'){
                    first_code = '1';
                }
            }
            
            if(first_code != '' || weight_id != '' || specification_id != ''){
                $('#shownID').val(first_code + weight_id + '-' + specification_id);
            }
        }
    
        $('#ManualID').click(function(){
            let result = $(this).prop('checked');
            if(result){
                $('#shownID').attr('readonly', false);
            }else{
                $('#shownID').attr('readonly', true);
                genereateProductID();
            }
        });
    
        function genereateProductName(){
            // 取得商品規格 (例如：兩斤、半斤、四兩)
            let specification = $('#specification').val();
    
            // 取得商品顏色或花樣 (例如：黑、紅白、白花)
            let color = $('#color').val();
    
            // 取得商品重量（例如：5 6 7 10 10.5 11 12，單位：兩）
            // 如果該重量值不是空值或是0，就外加括號，反之就都不顯示於商品名稱內。
            let weight = $('#weight').val();
            if(weight != '' && weight != null && weight != 0){
                weight = ' (' + weight + ')';
            }else{
                weight = '';
            }
    
            // 取得商品慣用單位
            let unit = $('#unit').val();
            
            // 取得每件數量
            let qty_per_pack = $('#qty_per_pack').val();
    
            if(unit == 'kg'){
                qty_per_pack = qty_per_pack + 'KG';
            }
    
            // 取得商品類別名稱。
            let product_category_name = $('#category_id :selected').text();
            
            let pack_unit = '1 * ';
            if(product_category_name == '耐熱袋' && unit == 'package'){
                pack_unit = '1P * ';
            }else if(unit == 'roll'){
                pack_unit = '5P * ';
            }
    
            if(color != '' || specification != '' || qty_per_pack != '' || weight != ''){
                $('#name').val(color + product_category_name + specification + ' ' + pack_unit + qty_per_pack + weight);
            }
        }
    
        $('#ManualNamed').click(function(){
            let result = $(this).prop('checked');
            if(result){
                $('#name').attr('readonly', false);
            }else{
                $('#name').attr('readonly', true);
                genereateProductName();
                genereateProductID();
            }
        });
    
        $('#specification').change(function(){
            if(!$('#ManualNamed').prop('checked')){
                genereateProductName();
                genereateProductID();
            }
        });
    
        $('#color').change(function(){
            if(!$('#ManualNamed').prop('checked')){
                genereateProductName();
            }
        });
    
        $('#weight').change(function(){
            if(!$('#ManualNamed').prop('checked')){
                genereateProductName();
                genereateProductID();
            }
        });
    
        $('#qty_per_pack').change(function(){
            if(!$('#ManualNamed').prop('checked')){
                genereateProductName();
            }
        });
    
        $('#category_id').change(function(){
            if(!$('#ManualNamed').prop('checked')){
                genereateProductName();
                genereateProductID();
            }
        });
    
        $('#unit').change(function(){
            if(!$('#ManualNamed').prop('checked')){
                genereateProductName();
                genereateProductID();
            }
        });

        $('#product_create_form').submit(function(e){
            e.preventDefault();

            let url = $(this).attr('action');

            let data = $(this).serializeObject();
            let formdata = new FormData();
            Object.keys(data).forEach(
                key => formdata.append(key, data[key])
            );
            formdata.append('picture', $('#picture')[0].files[0]);
            console.log(formdata);
            
            $('#LoadingModal').modal('show');
            axios.post(url, formdata, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                console.log(response);
                $('#productID').val(response.data.product_id);
                alert(response.data.messenge);
                location.href = response.data.redirect_url;
            }).catch((error) => {
                console.error('新增商品時發生錯誤，錯誤訊息：' + error);
                alert('新增商品時發生錯誤，錯誤訊息：' + error);

                $key = Object.keys(error.response.data.errors);
                $key.forEach(function(item, index){
                    console.log(error.response.data.errors[$key]);
                    alert(error.response.data.errors[$key]);
                });
                $('#LoadingModal').modal('hide');
            });
        });
    }
});