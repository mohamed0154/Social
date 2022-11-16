$(document).on('click','.hide_counter',function(e){
    e.preventDefault();
    var counter=document.querySelector('i.counter');
        counter.textContent='';
    var id=$(this).attr('get_id');
     $.ajaxSetup({
         headers: {
           'X-CSRRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     $.ajax({
       url:"{{route('hide_counter_notify')}}",
       type:'POST',
       data:{
           'id':id,
           '_token':"{{csrf_token()}}"
       },
     });
});
