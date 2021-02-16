@extends('layouts.app')

@section('content')
<div class="container">
@include('includes.success-msg')
        <div class="pb-3">
            @if($user->image)
            <div class="profileAvatar">
                <img class="" src="{{ route('user.avatar',['filename' => $user->image]) }}">
            </div>
            @else
            <div class="profileAvatar">
                <img class="" src="{{ route('user.avatar',['filename' => 'perfil.png']) }}">
            </div>
            @endif
            <div class=' pt-3 mb-5'>
                <a class="profileUsername" href="{{route('user.profile', ['id' => $user->id])}}">
                    <h4>{{'@'.$user->nick}}</h4>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
        @foreach($user->images as $image)

        <div class="col-md-4">
            <div class="card card-container">
                <div class="card-body img-container profileCard">
                    <a href="{{ route('image.detail',['id' => $image->id])}}"><img class='uploadImg' src="{{ route('image.file',['filename' => $image->image_path]) }}"></a>
                </div>
            </div>

        </div>
        @endforeach
       </div>
    </div>
    @endsection