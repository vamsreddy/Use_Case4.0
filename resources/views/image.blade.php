
@extends('layout')
@section('content')

<div class="chat-container">
    <h1>Imagebot Response</h1>

    @isset($image)
    <div class="image-container">
        <img src="{{ $image}}" alt="Generated Image" height="200" width="200">
    </div>
    @endisset

    <form method="POST" action="{{ route('image.generate') }}">
        @csrf
        <div class="input-container">
            <input type="text" name="prompt" placeholder="Enter a prompt...">
            <button type="submit" class="submit-button"><i class="fas fa-paper-plane"></i></button>
        </div>
    </form>
</div>
@endsection
