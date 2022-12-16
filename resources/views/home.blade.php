@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <h4 class="text-center mb-5" style="color:#6a9650;  text-shadow: 2px 2px 5px #6a9650;">{{ $loginInfo }}</h4>
            <div class="d-flex justify-content-center">
            <img src="{{asset('images/logo3.png')}}" alt="" style="width: 300px;height:300px;;">
            </div>
            
        </div>
    </div>
</div>
@endsection