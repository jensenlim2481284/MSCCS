@extends('errors.layout')

@section('code', '500  ')

@section('title', 'Ooops... Something Went Wrong')

@section('image')

<div style="background-image: url('/img/picture/500.jpg');" class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
</div>

@endsection

@section('message',"Sorry something went wrong, please reach to me and I will solve it as soon as possible")