{{-- $(document).on('click','.actionn'function(e){ --}}
<script>
$('a.action_type').click(function(){
   var action_name=$(this).text();
   var id=$(this).attr('friend_request_id');

    $.ajax({
        type:'POST',
        url:"{{route('accept_or_refuse')}}",
        data:{
        'id':id,
        'status':action_name,
        '_token':"{{csrf_token()}}"
        },
        success:function(data){
          if(data.status == true){
              $('.friend_req'+id).remove();
          }
        }
    });
});
</script>
