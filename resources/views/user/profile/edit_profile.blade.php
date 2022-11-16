@extends('layouts.modal')
@section('share_id','change_profile')
@section('sharing')
<form action="{{route('change_profile')}}"method="POST" enctype="multipart/form-data">
    @csrf
 <input type="file" name="profile_image">
 <input type="hidden"value="{{Auth::id()}}" name="user_id"class="fa fa-file-image-o">
 <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">change</button>
  </div>
</form>
@endsection

