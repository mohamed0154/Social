@extends('layouts.app')
@section('content')
@include('pages.scroll')
<div id="post_content">
@include('layouts.messages')
</div>
{{-- =========Nav===========--}}
@include('pages.nav')

{{-- =============Messages============= --}}
@include('user.messages.messages_body')

<div style="margin-top: 55px;width:100px" class="container-fluid py-4">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 max">
      <div class="card help contentt">
      @if(isset($posts) && count($posts) > 0)
      @foreach ($posts as $post)
      <div class="card-body p-3 bd-st">
      <div class="row row2">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-capitalize font-weight-bold">{{$post->user->name}}</p>
              <h5 class="font-weight-bolder mb-0">
               <span class="text-success text-sm font-weight-bolder">{{$post->created_at}}</span>
              </h5>
            </div>
          </div>
          <div class="col-4 text-end">
            <div >
              <img width="45px" height="45px" style="border-radius: 30px" src="{{asset('user/images/'.$post->user->profile_image)}}" alt="user">
            </div>
          </div>
         {{-- <img height='445px' src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" alt=""> --}}
          <span class="lang-text">{{$post->post}}</span>
          <div class="img">
          @if ($post->image != null)
              <img id="post_img" src="{{asset('user/posts/images/'.$post->image)}}" alt="">
          @endif
         </div>
         <div class="share">
             <div class="icons_place">
                    <strong class="icons"><a href=""> <i class="fa fa-share"></i></a></strong>
                    <strong class="icons"><a href="" data-bs-toggle="modal" data-bs-target="#create_comment{{$post->id}}">
                     <span class="comment-number{{$post->id}}">{{$post->comments->count() > 0 ? $post->comments->count() : ''}}</span>
                      <i class="fa fa-comment"></i></a>
                    </strong>
                    <form class="data{{$post->id}}" action="" method="POST">
                        @csrf
                        <input type="hidden" name="post_id"value="{{$post->id}}">
                        <input type="hidden" name="user_id"value="{{Auth::id()}}">
                        <a href="#" get_id="{{$post->id}}" user_id="{{$post->user->id}}" class="icons submit_like" >
                         <strong class="likes-number{{$post->id}}"> {{$post->likes->count() > 0 ? $post->likes->count() : ''}}</strong>
                             @if (App\Models\Like::where('user_id',Auth::id())->where('post_id',$post->id)->first())
                              <i style="color: red" class="fa fa-heart heart_icons{{$post->id}} "></i>
                             @else
                                 <i class="fa fa-heart heart_icons{{$post->id}} "></i>
                             @endif
                        </a>
                    </form>
                 </div>
              </div>
           </div>
        </div>
   {{-- //////////////Comment Modal///////////  --}}
      @include('user.comments.create')
      @endforeach
      @else
        Welcome in Share with your friends
      @endif
 </div>
 </div>
 </div>

 @endsection

@section('scripts')
<style>
    .st_body{
    background-color: #f3f6f9;
  }
</style>
<script>

////////////////Hide Notifications///////////
@include('user.ajax.hide_counter_notifies')

////////////////Make Like//////////////
$(document).on('click','.submit_like',function(e){
    e.preventDefault();

    var id=$(this).attr('get_id');
    var user_id=$(this).attr('user_id');
    var data=new FormData($('.data'+id)[0]);
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
     $.ajax({
       url:"{{route('store_like')}}",
       type:'POST',
       data:data,
        processData: false,
        contentType: false,
        cache: false,
        success:function(data){
          var like_icon=document.querySelector('i.heart_icons'+id),
              counter=document.querySelector('strong.likes-number'+id);

          if(data.status==true && data.like == 1){
            console.log(counter);
              like_icon.style="color:red";
              if(data.likes_number == 0){
                counter.textContent=1;
              }else{
                counter.textContent=data.likes_number+1;
              }

           }else if((data.status==true && data.like == 0)){
            console.log(counter);
              like_icon.style="color:black";
              if(data.likes_number == 1){
                counter.textContent='';
              }else{
                counter.textContent=data.likes_number-1;
              }
          }
        },
        error:function(reject){
        }
     });
});


///////////////////Make Comment///////////////////


$(document).on('click','.submit_comment',function(e){
    e.preventDefault();

    var id=$(this).attr('get_id');
    var data=new FormData($('.all_data'+id)[0]);
    console.log(id);
     $.ajax({
       url:"{{route('store_comment')}}",
       type:'POST',
       data:data,
        processData: false,
        contentType: false,
        cache: false,
        success:function(data){

          if(data.status==true){
            var pl=document.querySelector('div.com'+id),
                namee=document.createElement('div'),
                img=document.createElement('img'),
                comment=document.createElement('div');

                // namee.setAttribute('class','name');
                // img.setAttribute('class','img_comm');
                // img.src=data.user_image;
                // comment.setAttribute('class','st_com');
                // namee.textContent=data.user_name;
                // comment.innerHTML='<span>'+data.comment+'</span>'+'<br><br>';

                // pl.appendChild(namee);
                // pl.appendChild(img);
                // pl.appendChild(comment);
          }
        },
        error:function(reject){
        }
     });
});

/////////////////Users Active///////////////

$('.user_active').click(function(){
    var user_id=$(this).attr('user_id');
    $.ajax({
       type:'POST',
       url:"{{route('message_user')}}",
       data:{
           'user_id':user_id,
           '_token':"{{csrf_token()}}"
       },
       success:function(data){
         if(data.status == true){
           $('.write_message').html(data.body);
         }
       }
   })
});
</script>
{{-- ///////////////messages//////////////////////// --}}
<script src="{{asset('jquery/messages.js')}}"></script>



@include('user.messages.ajax.send_messages')

@include('user.friends.accept_friend_requests')
@endsection
