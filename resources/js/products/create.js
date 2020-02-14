$(function(){
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

        $('#name').val(color + product_category_name + specification + ' ' + pack_unit + qty_per_pack + weight);
    }

    $('#ManualNamed').click(function(){
        let result = $(this).prop('checked');
        if(result){
            $('#name').attr('readonly', false);
        }else{
            $('#name').attr('readonly', true);
            genereateProductName();
        }
    });

    $('#specification').change(function(){
        if(!$('#ManualNamed').prop('checked')){
            genereateProductName();
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
        }
    });

    $('#qty_per_pack').change(function(){
        if(!$('#ManualNamed').prop('checked')){
            genereateProductName();
        }
    });

    $('#weight').change(function(){
        if(!$('#ManualNamed').prop('checked')){
            genereateProductName();
        }
    });

    $('#category_id').change(function(){
        if(!$('#ManualNamed').prop('checked')){
            genereateProductName();
        }
    });

    $('#unit').change(function(){
        if(!$('#ManualNamed').prop('checked')){
            genereateProductName();
        }
    });
});