@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">

            <h1 class="text-center favImgs">Mis imagenes favoritas</h1>
            <hr>
            @foreach($likes as $like)

                @include('includes.image',['image' => $like->image])

            @endforeach
          
        </div>
            <div class="clearfix"></div>
            {{$likes->links("pagination::bootstrap-4")}}
    </div>
</div>
@endsection
