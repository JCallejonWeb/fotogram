@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">

            @include('includes.success-msg')
            @foreach($images as $image)
                <div class="card pub_image img-container">

                    <div class="card-header">
                        @if($image->user->image)
                        <div class="container-avatar">
                            <img class="avatar" src="{{ route('user.avatar',['filename' => $image->user->image]) }}">
                        </div>
                        @else
                        <div class="container-avatar">
                           <img class="avatar" src="{{ route('user.avatar',['filename' => 'perfil.png']) }}">
                        </div>
                        @endif
                        <div class='username'>{{'@'.$image->user->nick}}</div>

                    </div>

                    <div class="card-body ">

                    <a href="{{ route('image.detail',['id' => $image->id])}}"><img class='uploadImg' src="{{ route('image.file',['filename' => $image->image_path]) }}"></a>

                        
                    <div class="container-likes-comments">
                            <img class="likes" src="{{ asset('imgs/kokoroV.png') }}">
                            <a href="" class="btn btn-primary btn-comments"> Comentarios ({{count($image->comments)}}) </a>
                        </div>
                        <div class="description"><p>{{ $image->description }}</p></div>


                    </div>

                </div>
            @endforeach
        </div>
            <div class="clearfix"></div>
            {{$images->links("pagination::bootstrap-4")}}
    </div>
</div>
@endsection
