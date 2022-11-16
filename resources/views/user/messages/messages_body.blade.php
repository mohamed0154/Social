
<div class="your_messages">
    <div class="messages_icon">
      <a href="#"class="users_messages">messages</a>
      <a href="#" class="users_active">active</a>
    </div>
    <div class="content_messages">
        <div class="messages">
            Messages
        </div>
        <div class="write_message">
        </div>
        @foreach (get_users_active() as $user)
            <a href="#" class="user_active" user_id="{{$user->id}}">
                <div class="st_user_active" style="display: none">
                    <img class="user_image_active" src="{{asset('user/images/'.$user->profile_image)}}" alt="" width="30px" height="30px" style="border-radius: 50%">
                    <span class="user_name_active">{{$user->name}}</span>
                    <br>
                </div>
            </a>
        @endforeach
    </div>
    <div class="lin_actions">
       <a href="#" class="btn btn-success up"><span class="text-up">Up</span></a>
    </div>
</div>

