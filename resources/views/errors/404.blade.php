@extends('errors.layout')

@section('code', '404')

@section('title', 'Page Not Found')

@section('image')

<div style="background-image: url('/img/picture/404.png');" class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
</div>

@endsection

@section('message', 'Sorry, the page you are looking for could not be found.')