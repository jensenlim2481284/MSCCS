@extends("pages.msccs.layout.index")

@section('head')

<title> Embed | MSCCS </title>
<link href="/css/page/msccs/embed.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<link href="/css/prod/component/table.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<script defer type="text/javascript" src="/js/prod/component/table.min.js{{ config('app.link_version') }}"></script>
<script defer type="text/javascript" src="/js/page/msccs/embed.js{{ config('app.link_version') }}"></script>

@endsection

@section('content')

<a class="info-back-btn" href='/setting'><button class='btn circle-btn back-btn'> <i class='ti-arrow-left'> </i> <span>Back</span></button></a>

<div class='row info-row'>       
    <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8'>
        <div class='form-section'>
            <h1> Easy Embed </h1>
            <p class='title-desc mb-5'>Quick embed MSCCS features into your existing system.</p>
            <div class="form-group mb-5 row">   
                <div class='col-12 embed-item'>
                    <div class='row'>
                        <div class='col-5'>
                            <img src='/img/picture/recording.png'/>
                        </div>
                        <div class='col-7'>
                            <h2> Smart Recording </h2>
                            <p>Embed smart recording function into your existing application and let Modzy process audio data with Modzy Artificiate Inteliigent </p>
                            <button class='btn btn-default mt-3' data-toggle="modal" data-target="#embedRecording"> Embed Now </button>
                        </div>
                    </div>
                </div>
                <div class='col-12 embed-item'>
                    <div class='row'>
                        <div class='col-5'>
                            <img src='/img/icon/analysis.png'  style="width:50%; display:flex; margin:auto"/>
                        </div>
                        <div class='col-7'>
                            <h2> What's Next - MSCCS AI Analysis </h2>
                            <p>Embed audio data analysis results into your existing application. </p>
                        </div>
                    </div>
                </div>
                <div class='col-12 embed-item'>
                    <div class='row'>
                        <div class='col-5'>
                            <img src='/img/icon/customer.png' style="width:50%; display:flex; margin:auto"/>
                        </div>
                        <div class='col-7'>
                            <h2> What's Next - Customer Data</h2>
                            <p>Embed customer data collected from audio data into your existing application. </p>
                        </div>
                    </div>
                </div>
                
            </div>   
        </div>
    </div>
    <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4'>
        {!! Form::open(['method'=>'post', 'url' => route('setting.embed.whitelist.update')]) !!}
        <div class='form-section company-form'>
            <h1> Domain Whitelist </h1>
            <p class='title-desc'> Mark your domain as trusted so that MSCCS can communicate and collaborate with this domain. </p>
            <div class="form-group mb-5 store-name-section">
                <div class='row'>
                    <div class='col-12'>
                        <p>Domain</p>
                        <input type="text" class="form-control mb-0"  name='domain' value="{{$company->domain}}">
                        <small> Ex : modzy.com </small>
                        <div class='form-group text-right mt-4 mb-0'>
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

</div>


@include('pages.msccs.modal.embed')


@stop