@extends("pages.msccs.layout.index")

@section('head')

<title> Setting | MSCCS </title>

@endsection

@section('content')

<div class='row'>

    @include('component.panel',['data'=>[
        [
            'img' => '/img/picture/setting.png',
            'title'=> 'General Setting',
            'desc' =>'Manage keyword detection and general setting',
            'btn_desc'=>'Manage Setting',
            'url' => '/setting/general'
        ],                                                                   
        [
            'img' => '/img/picture/api.png',
            'title'=> 'API',
            'desc' => 'Integrate MSCCS features into your existing system.',
            'btn_desc'=> 'Get Started',
            'url' => '/setting/api'
        ],                                                                   
        [
            'img' => '/img/picture/embed.png',
            'title'=> 'Embed',
            'desc' => 'Quick embed MSCCS features into your existing system.',
            'btn_desc'=> 'Get Started',
            'url' => '/setting/embed'
        ], 
    ]])    
    
</div>

@stop