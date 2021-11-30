
@extends('errors.layout')

@section('code', '419 ')

@section('title', 'Page Expired')

@section('image')

<div style="background-image: url('/img/picture/404.png');" class="absolute pin bg-no-repeat md:bg-left lg:bg-center">
</div>

@endsection

@section('message', 'Page Expired.')


@section('script')

<script>
    window.location.href = "/";    
</script>

@endsection
