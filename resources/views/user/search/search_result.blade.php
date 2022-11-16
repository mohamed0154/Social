@extends('layouts.app')
@section('content')
@include('pages.scroll')
<div id="post_content">
@include('layouts.messages')
</div>
@include('pages.nav')

{{-- -------------messages----------------- --}}
@include('user.messages.messages_body')
<div class="container-fluid py-4" style="width: 1000px;">
    <div class="row">
        <div class="col-12">
          <div class="card mb-4 search-result">
            <div class="card-header pb-0">
              <h6>Result</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                      @if (isset($users) && $users->count() > 0)
                          @foreach ($users as $user)
                          <tr>
                            <td>
                              <div class="d-flex px-2 py-1">
                                 <div>
                                     <img src="{{asset('user/images/'.$user->profile_image)}}" class="avatar avatar-sm me-3" alt="user1">
                                 </div>
                                 <div class="d-flex flex-column justify-content-center">
                                     <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                                     <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                                 </div>
                              </div>
                           </td>
                              <td>
                                 <p class="text-xs font-weight-bold mb-0">Manager</p>
                                 <p class="text-xs text-secondary mb-0">Organization</p>
                              </td>
                               <td class="align-middle text-center text-sm">
                                 <span class="badge badge-sm bg-gradient-success">Online</span>
                               </td>
                               <td class="align-middle text-center">
                                 <span class="text-secondary text-xs font-weight-bold">{{$user->created_at}}</span>
                               </td>
                               <td class="align-middle">
                                   @if (friend_status($user->id) == 'Add Friend')
                                        <a href="#" get_user_id="{{$user->id}}" class="text-secondary font-weight-bold text-xs add_friend st_friend{{$user->id}}">
                                            {{friend_status($user->id)}}
                                        </a>
                                   @elseif(friend_status($user->id) == 'Sended')
                                        <a href="#" get_user_id="{{$user->id}}" class="text-secondary font-weight-bold text-xs add_friend st_friend{{$user->id}}">
                                            {{friend_status($user->id)}}
                                        </a>
                                   @else
                                        <small>friends</small>
                                   @endif

                               </td>
                          </tr>
                          @endforeach
                      @endif
                    </tbody>
                   </table>
                  </div>
                 </div>
                </div>
               </div>
              </div>
              {{-- <footer class="footer pt-3  ">
              <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                    © <script>
                        document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                    for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                    </li>
                    </ul>
                </div>
                </div>
              </div>
              </footer> --}}
             </div>
 @endsection
<style>
   .st_body{
         background-color: #f3f6f9
   }
</style>

@section('scripts')
    <script>
 @include('user.friends.add_friend_ajax');
 ////////////////Hide Notifications///////////
 @include('user.ajax.hide_counter_notifies')


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

@endsection
