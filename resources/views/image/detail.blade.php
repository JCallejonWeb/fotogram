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
                    <a class="profileUsername pl-2 pt-3" href="{{route('user.profile', ['id' => $image->user->id])}}"><h4>{{'@'.$image->user->nick}}</h4></a>

                </div>

                <div class="card-body ">

                    <img class='uploadImg' src="{{ route('image.file',['filename' => $image->image_path]) }}">

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
                        <img class="btn-like likes" data-id="{{$image->id}}" src="{{ asset('imgs/kokoroR.png') }}">
                        @else
                        <img class="btn-dislike likes" data-id="{{$image->id}}" src="{{ asset('imgs/kokoroV.png') }}">
                        @endif
                        <span class="fecha mr-5">| {{ \FormatTime::LongTimeFilter($image->created_at) }}<span>
                        <button type="button" class="btn btn-warning btnEdit" data-toggle="modal" data-target="#updateModal">Editar</button>
                        <a id="btnDeleteImg" href="{{ route('image.delete',['id' => $image->id]) }}" onclick=" return confirm('La imagen se va a eliminar.¿Estás seguro?')" class="btnDelete btn btn-danger .text-dark">Eliminar</a>
                    </div>
                    <div class="description">
                        <p>{{ $image->description }}</p>
                    </div>
                    <h3 class="detailComments"> Comentarios ({{count($image->comments)}})</h3>
                    <form method="GET" action="{{ route('comment.save') }}">
                        @csrf
                        <p class="pub_comment">
                            <input type="hidden" name="image_id" value="{{$image->id}}">

                            <textarea id="content"
                                class="form-control areaComent  @error('content') is-invalid @enderror"
                                name="content"> </textarea>
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
                        <p class="contentNick">
                            <span class="nickComment">{{ '@'.$comment->user->nick }}</span>
                            <span class="fecha">{{ \FormatTime::LongTimeFilter($comment->created_at) }}</span>
                            @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id ==
                            Auth::user()->id))
                            <a href="{{ route('comment.delete',['id'=> $comment->id])}}"><i class="bi bi-trash"></i></a>
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
@include('includes.update-modal')