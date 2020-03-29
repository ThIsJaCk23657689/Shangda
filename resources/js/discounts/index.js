$(function(){

    $('#consumers_dataTable').DataTable();

    $('#products_dataTable').DataTable();

    $('#sortType').change(function(){
        let x = $(this).val();
        if(x == 'products'){
            $('#consumers_card').fadeOut();
            $('#products_card').fadeIn();
        }else{
            $('#consumers_card').fadeIn();
            $('#products_card').fadeOut();
        }
    });
    
});