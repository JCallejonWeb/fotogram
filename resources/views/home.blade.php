@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">

            @include('includes.success-msg')
            @foreach($images as $image)
                <div class="card pub_image ">

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

                    <div class="card-body img-container">

                    <a href="{{ route('image.detail',['id' => $image->id])}}"><img class='uploadImg' src="{{ route('image.file',['filename' => $image->image_path]) }}"></a>

                        <hr>
                        <div class="container-likes-comments">
                        <!--Comprobamos si el usuario autenticado le ha dado like-->
                            <?php $user_like = false; ?>
                            {{$image->likes->count()}}
                            @foreach($image->likes as $like)
                                @if ($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                                @endif
                            @endforeach

                            @if($user_like)
                                <img class="btn-like likes" src="{{ asset('imgs/kokoroR.png') }}">
                            @else
                                <img class="btn-dislike likes" src="{{ asset('imgs/kokoroV.png') }}">
                            @endif
                            <a href="{{ route('image.detail',['id' => $image->id])}}" class="btn btn-primary btn-comments"> Comentarios ({{count($image->comments)}}) </a>
                            <span class="fecha">| {{ \FormatTime::LongTimeFilter($image->created_at) }}<span>
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
