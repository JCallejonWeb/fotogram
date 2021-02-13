@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('includes.success-msg')
            @foreach($images as $image)
                <div class="card pub_image img-container">

                    <div class="card-header">
                        @if( $image->user->image)
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
                    
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
