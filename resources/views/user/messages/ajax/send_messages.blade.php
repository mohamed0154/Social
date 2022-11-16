<script>


    $(document).on('click','.send_messages',function(e){
        var message=$('.wr_message').val();
        var user_id=$(this).attr('user_id');

        console.log(user_id);
        e.preventDefault();
        $.ajax({
            type:'POST',
            url:"{{route('send_messages')}}",
            data:{
                'message':message,
                'to_user_id':user_id,
                '_token':"{{csrf_token()}}"
            },
            success:function(data){
                var dv=document.createElement('div');
                dv.setAttribute('class','messages_me');
                dv.innerHTML='mohamed'+"<img src='user/images/"+data.msg+"'width='33px' height='33px' style='border-radius: 50%;margin-left:230px'>";
                $('.pl_messages').append(dv);

            }
        });
    });
</script>
