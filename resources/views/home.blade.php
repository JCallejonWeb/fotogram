@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">

            @include('includes.success-msg')
            @foreach($images as $image)

                @include('includes.image',['image'=>$image])
            
            @endforeach
        </div>
            <div class="clearfix"></div>
            {{$images->links("pagination::bootstrap-4")}}
    </div>
</div>
@endsection
