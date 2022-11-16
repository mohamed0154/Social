$('.add_friend').click(function(){
    var user_id=$(this).attr('get_user_id');

    $.ajax({
        type:'POST',
        url:"{{route('add_friend')}}",
        data:{
        'to_user_id':user_id,
        '_token':"{{csrf_token()}}"
        },
        success:function(data){
            if(data.status==true && data.content == 'added'){
                $('.st_friend'+user_id).html('Added');
            }else{
                $('.st_friend'+user_id).html('Add Friend');
            }
        }
    });

});
