@extends('layouts.modal')
@section('share_id','create_post')
@section('sharing')
<form action="{{route('store_post')}}"method="POST" enctype="multipart/form-data">
    @csrf
 <textarea id="textArea" name="post" cols="50" rows="5" placeholder="Write your thinks"></textarea>
<br> <input type="file" name="image">
 <input type="hidden"value="{{Auth::id()}}" name="user_id"class="fa fa-file-image-o">
 <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Share</button>
  </div>
</form>
@endsection
