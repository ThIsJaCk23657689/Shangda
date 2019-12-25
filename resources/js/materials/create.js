$(function(){
    $('#form_submit_btn').click(function(e){
        e.preventDefault();
        
        $('material_create_form').submit();
    });

    let prev_unit;
    $('#unit').on('focus', function(){
        prev_unit = $(this).val();
    }).change(function(){
        let x = $('#stock_before').val();
    });
});