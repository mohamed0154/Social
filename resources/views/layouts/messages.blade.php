@if (session()->has('success'))
<div >
    {{session()->get('success')}}
</div>

@elseif(session()->has('error'))
<div>
    {{session()->get('error')}}
</div>
@endif
