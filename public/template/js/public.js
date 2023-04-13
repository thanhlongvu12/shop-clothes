$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMore(){
    const page = $('#page').val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: { page },
        url: 'services/load-product',
        success: function(result){
            if(result.html !== ''){
                $('#loadMore').append(result.html);
                $('#page').val(page + 1);
            }else{
                alert("Done");
                $('#btn-loadMore').css('display','none'); 
            }
        }
    })
}

// function showDetal(id){
//     $('#modal').addClass('show-modal1');
//     $.ajax({
//         type: 'POST',
//         dataType: 'JSON',
//         data: { id },
//         url: 'services/detal-product',
//         success: function(result){
//             // $('#showDetalModal').append(result.html);
//         }
//     });
// }   
