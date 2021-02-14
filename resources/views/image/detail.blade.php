@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @include('includes.success-msg')
            
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

                    <img class='uploadImg' src="{{ route('image.file',['filename' => $image->image_path]) }}">

                     
                    <div class="container-likes-comments">
                            <img class="likes" src="{{ asset('imgs/kokoroV.png') }}">
                            <span class="fecha">{{ \FormatTime::LongTimeFilter($image->created_at) }}<span>  
                        </div>
                        <div class="description"><p>{{ $image->description }}</p></div>
                        <h3 class="detailComments"> Comentarios ({{count($image->comments)}})</h3>
                        <form method="POST" action="{{ route('comment.save') }}">
                            @csrf
                            <p class="pub_comment">
                                <input type="hidden" name="image_id" value="{{$image->id}}">

                                <textarea id="content" class="form-control areaComent  @error('content') is-invalid @enderror" name="content"> </textarea>
                                @error('content')
                                    <span class="invalid-feedback commentError" role="alert">
                                        <strong>No puedes publicar un comentario vacío!</strong>
                                    </span>
                                @enderror
                                <button type="submit" class="btn btn-primary">Publicar comentario</button>
                            <p>

                        </form>

                        @foreach($image->comments as $comment)
                        <div class="comment">
                            <p class="contentNick" >
                                <span class="nickComment">{{ '@'.$comment->user->nick }}</span>
                                <span class="fecha">{{ \FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                    <a href="{{ route('comment.delete',['id'=> $comment->id])}}" ><i class="bi bi-trash"></i></a>
                                @endif
                            </p>
                            <hr>
                            <p class="contentCmt">
                                <span>{{ $comment->content }}</span>
                            </p>

                        </div>

                        @endforeach
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
