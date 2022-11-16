<main >
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" >
      <div class="container-fluid py-1 px-3 navv">
        <nav aria-label="breadcrumb">
            @if (isset($posts))
            <div class="upload">
                <div class="post">
                  <button type="button" class="share_post" data-bs-toggle="modal" data-bs-target="#create_post"  style="border-radius: 150px;padding:10px 220px 10px 220px;" ></i>Share your life</button>
                  <img width="50" height="50px" style="border-radius: 30px;margin-left:20px" src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg" alt="">
                </div>
                <div class="camera">
                    <a href=""><strong class="item">camera  <i class="fa fa-camera"></i></strong> </a>
                    <a href=""><strong class="item">video <i class="fa fa-video-camera"></i></strong> </a>
                </div>
            </div>
            @else
             Search Result
            @endif
          @include('user.posts.create')
        </nav>
         <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
                <form id="all_data" action="{{route('searchable')}}" method="POST">
                    @csrf
                    <button class="do_search" type="submit"><span class="input-group-text text-body icon-search-body"><i class="fas fa-search icon_search" aria-hidden="true"></i></span></button>
                    <input type="search" class="form-control" name="search" placeholder="Type here...">
                </form>
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-envelope-open-o"></i>
                <span class="d-sm-inline d-none"></span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a class="hide_counter" get_id="{{Auth::id()}}" href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
               @foreach (App\Models\User::get() as $us)
                    @if ($us->id == Auth::id())
                        <i class="fa fa-bell cursor-pointer counter notify_to{{$us->id}}">
                            @if(isset($notify_number) && $notify_number > 0)
                                {{$notify_number}}
                            @elseif(isset($counter_comment_notify) && $counter_comment_notify > 0)
                                {{$counter_comment_notify}}
                            @endif

                            @if(isset($friend_requests_counter) && $friend_requests_counter > 0)
                                {{$friend_requests_counter}}
                            @endif
                        </i>
                    @else
                        <i class="fa fa-bell cursor-pointer counter notify_to{{$us->id}}"  style="display: none">
                            @if(isset($notify_number) && $notify_number > 0)
                                {{$notify_number}}
                            @elseif(isset($counter_comment_notify) && $counter_comment_notify > 0)
                                {{$counter_comment_notify}}
                            @endif

                            @if(isset($friend_requests_counter) && $friend_requests_counter > 0)
                                {{$friend_requests_counter}}
                            @endif
                        </i>
                    @endif
               @endforeach
              </a>
              <a id="hide_counter" get_id="{{Auth::id()}}" href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">

                @foreach (App\Models\User::get() as $us)
                @if ($us->id == Auth::id())
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4 bell_notify{{$us->id}}" aria-labelledby="dropdownMenuButton">
                        @if(isset($likes) && count($likes) > 0)
                            @foreach (array_reverse($likes) as $notify)
                                @if ($notify->type == 'like')
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="{{asset('user/images/'.$notify->user->profile_image)}}" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                                {{-- <img width="45px" height="45px" style="border-radius: 30px"  alt=""> --}}
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">{{$notify->type}}</span> {{$notify->user->name}}
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                day-1
                                                </p>
                                            </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                        @if(isset($comments) && count($comments) > 0)
                            @foreach(array_reverse($comments) as $comment)
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="{{asset('user/images/'.$comment->user->profile_image)}}" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                                {{-- <img width="45px" height="45px" style="border-radius: 30px"  alt=""> --}}
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">comment</span> {{$comment->user->name}}
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                day-1
                                                </p>
                                            </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                        @endif
                        @if(isset($friend_requests) && $friend_requests->count() > 0)
                            @foreach ($friend_requests as $request)
                            <li class="mb-2 friend_req{{$request->id}}">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                    <div class="my-auto">
                                    <a href="{{route('profile',$request->user_id)}}"><img src="{{asset('user/images/'.$request->user->image)}}" class="avatar avatar-sm bg-gradient-dark  me-3 "></a>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                        <span class="font-weight-bold">Friend Request From </span> {{$request->user->name}}
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                        <i class="fa fa-clock me-1"></i>
                                        {{date('h-m-s',time())}}
                                        </p>
                                        <div class="your_action">
                                            <a href="#" class="btn btn-success accept action_type" friend_request_id="{{$request->id}}"><strong class="text-accept">accept</strong></a>
                                            <a href="#" class="btn btn-danger refuse action_type"friend_request_id="{{$request->id}}"><strong class="text-refuse">refuse</strong></a>
                                        </div>
                                    </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                @else
                    <ul  class="{{$us->id == Auth::id()?'dropdown-menu  dropdown-menu-end':''}} px-2 py-3 me-sm-n4 bell_notify{{$us->id}}" aria-labelledby="dropdownMenuButton" style="display: none">
                        @if(isset($likes) && count($likes) > 0)
                            @foreach (array_reverse($likes) as $notify)
                                @if ($notify->type == 'like')
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="{{asset('user/images/'.$notify->user->profile_image)}}" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                                {{-- <img width="45px" height="45px" style="border-radius: 30px"  alt=""> --}}
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">{{$notify->type}}</span> {{$notify->user->name}}
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                1 day
                                                </p>
                                            </div>
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                        @if(isset($comments) && count($comments) > 0)
                            @foreach(array_reverse($comments) as $comment)
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <img src="{{asset('user/images/'.$comment->user->profile_image)}}" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                                {{-- <img width="45px" height="45px" style="border-radius: 30px"  alt=""> --}}
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">comment</span> {{$comment->user->name}}
                                                </h6>
                                                <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                {{date('h-m-s',time())}}
                                                </p>
                                            </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                        @endif
                        @if(isset($friend_requests) && $friend_requests->count() > 0)
                            @foreach ($friend_requests as $request)
                            <li class="mb-2 friend_req{{$request->id}}">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                    <div class="my-auto">
                                    <a href="{{route('profile',$request->user_id)}}"><img src="{{asset('user/images/'.$request->user->image)}}" class="avatar avatar-sm bg-gradient-dark  me-3 "></a>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                        <span class="font-weight-bold">Friend Request From </span> {{$request->user->name}}
                                        </h6>
                                        <p class="text-xs text-secondary mb-0">
                                        <i class="fa fa-clock me-1"></i>
                                        {{date('h-m-s',time())}}
                                        </p>
                                        <div class="your_action">
                                            <a href="#" class="btn btn-success accept action_type" friend_request_id="{{$request->id}}"><strong class="text-accept">accept</strong></a>
                                            <a href="#" class="btn btn-danger refuse action_type"friend_request_id="{{$request->id}}"><strong class="text-refuse">refuse</strong></a>
                                        </div>
                                    </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                @endif
              @endforeach
            </li>
          </ul>
        </div>
      </div>
    </nav>
   </main>

