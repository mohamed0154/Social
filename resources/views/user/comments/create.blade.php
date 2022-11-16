
<div class="modal fade" id="create_comment{{$post->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">comments</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="comments">
             <div id="comments_place" class="com{{$post->id}}">
                 @if (isset($post->comments) && $post->comments->count() > 0)
                 @foreach($post->comments as $comment)
                    <span class="name">{{$comment->user->name}}
                          <img class="img_comm" src="{{asset('user/images/'.$comment->user->profile_image)}}" alt="">
                    </span>
                    <div class="st_com">
                        <span> {{$comment->comment}}</span><br><br>
                    </div>
                 @endforeach
                 @endif
            </div>
            </div>
            <form class="all_data{{$post->id}}" action="{{route('store_comment')}}"method="POST">
                @csrf
                <textarea name="comment" id="" cols="30"  placeholder="Comment" rows="10"></textarea>
                <input type="hidden"value="{{Auth::id()}}" name="user_id"class="fa fa-file-image-o">
                <input type="hidden"value="{{$post->id}}" name="post_id"class="fa fa-file-image-o">
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button get_id="{{$post->id}}"  type="submit" class="btn btn-primary submit_comment">add</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
