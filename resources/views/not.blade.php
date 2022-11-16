@extends('layouts.app')
@section('content')
<form id="all_data" action="#" method="POST">
    @csrf
    <input type="text" name="message">
    <button type="submit" class="subData">ss</button>
</form>
<div class="jk">

</div>

@endsection


  @section('scripts')

  <script>
      $(document).on('click','.subData',function(e){
      e.preventDefault();
      console.log('shsdsdsds');
      var data=new FormData($('#all_data')[0]);
      $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
      url:"{{route('mess_us')}}",
      type:'POST',
      data:data,
          processData: false,
          contentType: false,
          cache: false,
          success:function(data){

              if(data.status==true){
              }
          },
          error:function(reject){
          }

      });

   });

  </script>


  @endsection
