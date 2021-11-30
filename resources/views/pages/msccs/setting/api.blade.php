@extends("pages.msccs.layout.index")

@section('head')

<title> API | MSCCS </title>
<link href="/css/page/msccs/api.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<link href="/css/prod/component/table.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<script defer type="text/javascript" src="/js/prod/component/table.min.js{{ config('app.link_version') }}"></script>

@endsection

@section('content')

<a class="info-back-btn" href='/setting'><button class='btn circle-btn back-btn'> <i class='ti-arrow-left'> </i> <span>Back</span></button></a>

<div class='row '>       
    <div class='col-12 api-section'>
        <img src='/img/picture/coming_soon.png'/>   
        <h2> What's Next </h2>
        <h1> API Integration </h1>
        <p> The MSCCS API is designed to allow companies to integrate smart recording features into their existing applications. </p>
    </div>
</div>



@stop