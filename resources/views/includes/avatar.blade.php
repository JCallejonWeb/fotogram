@if(Auth::user()->image)
    <div class="row ">
        <img class="avatar" src="{{ route('user.avatar',['filename' => Auth::user()->image]) }}">
    </div>
@endif