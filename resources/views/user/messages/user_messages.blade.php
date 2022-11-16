@section('all_messages')

    <div class="user_data">
        <span class="user-name">{{$user->name}}</span>
        <img width="50px" class="user-img" height="50px" src="{{asset('user/images/'.$user->profile_image)}}" alt="">
    </div>
    <div class="pl_messages">
        @if (my_messages() && my_messages()->count() > 0)
            @foreach (my_messages() as $mess)
              @if ($mess->to_user_id == $user->id)
                <div class="messages_me">
                    {{$mess->message}}
                    <img width="33px" height="33px" style="border-radius: 50%;margin-left:230px" src="{{asset('user/images/'.Auth::user()->profile_image)}}" alt="">
                </div>
              @endif
            @endforeach
        @endif
        @if (messages_for_me() && messages_for_me()->count() > 0)
            @foreach (messages_for_me() as $mess)
                @if ($mess->user_id == $user->id)
                    <div class="messages_user">
                        <img width="33px" height="33px" style="border-radius: 50%"  src="{{asset('user/images/'.App\Models\User::find($mess->user_id)->profile_image)}}" alt="">
                        <span style="margin-left: 210px">{{$mess->message}}</span>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <textarea type="text" name="message" class="wr_message"></textarea>
    <button type="submit" class="btn btn-light send_messages" user_id="{{$user->id}}">Send</button>
@stop
