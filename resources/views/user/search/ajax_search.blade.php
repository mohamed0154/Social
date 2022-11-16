{{-- <script> --}}
$(document).on('click','.do_search',function(e){
    e.preventDefault();
    console.log('shsdsdsds');
    var data=new FormData($('#all_data')[0]);
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
    url:"{{route('searchable')}}",
    type:'POST',
    data:data,
        processData: false,
        contentType: false,
        cache: false,
        success:function(data){

            var v=document.querySelector('div.body-search');
            if(data.status==true){
                v.innerHTML=data.content;
            }
        },
        error:function(reject){
        }

    });

 });
