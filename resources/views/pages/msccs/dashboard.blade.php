@extends("pages.msccs.layout.index")

@section('head')

<title> Dashboard | MSCCS </title>
<link href="/css/page/msccs/dashboard.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/js/page/msccs/dashboard.js{{ config('app.link_version') }}"></script>

@endsection

@section('content')

<div class='row'>
    <div class='col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7'>
        <div class='ref-box'>
            <h1>Revamping Call Center with Modzy </h1>
            <p>Let's utilize call data to automated post-call processes, enhance customer experience and to grow your business. </p>
            <button type='button' class='btn btn-default'  data-toggle="modal" data-target="#ticketModal"> Record Call </button>
            <button class='btn btn-primary under-development' data-title='Onboarding Checklist' data-desc='This feature will guide merchants how to set up their online store step by step.'> Analysis </button>
            <img src='/img/picture/refland3.gif'/>
        </div>
        <div id="overviewChart">
            <h2> Revenue Overview </h2>
            <canvas id="lineChart" class='line-chart' style="height:200px; max-height:200px" > </canvas>   
        </div>
    </div>
    <div class='col-12 col-sm-12 col-md-12 col-lg-1 col-xl-1'></div>
    <div class='col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4'>
        <div class="dashboard-view-list">
            <div class='dashboard-list active'>
                <div class='icon-box'>
                    <i class='ti ti-money'></i>
                </div>
                <div class='list-content referrar'>
                    <p> Account Balance </p>
                    <h2> 500.00 </h2> 
                    <img src='/img/icon/coin.png'/>
                </div>
            </div>

            <div class='dashboard-list'>
                <div class='icon-box'>
                    <i class='ti ti-star'></i>
                </div>
                <div class='list-content'>
                    <p> Total Earning </p>
                    <h2> 5421.00 </h2> 
                </div>
            </div>
            <div class='dashboard-list'>
                <div class='icon-box'>
                    <i class='ti ti-heart'></i>
                </div>
                <div class='list-content'>
                    <p> Total Customer </p>
                    <h2> 435 </h2> 
                </div>
            </div>
        </div>
        <div class='activity-list'>
            <p class='list-title'>Recent Activity </p>
            <div class='list-item'>
                <div class='item-content'>
                    <h2> Earning </h2>
                    <p> 2021-11-14 15:45:20</p>
                </div>
                <div class='item-balance'>
                    <span class='badge badge-positive'>+500</span>
                </div>
            </div>
            <div class='list-item'>
                <div class='item-content'>
                    <h2> Withdrawal </h2>
                    <p> 2021-11-14 16:45:20</p>
                </div>
                <div class='item-balance'>
                    <span class='badge badge-negative'>-500</span>
                </div>
            </div>
            <div class='list-item'>
                <div class='item-content'>
                    <h2> Withdrawal </h2>
                    <p> 2021-11-14 17:45:20</p>
                </div>
                <div class='item-balance'>
                    <span class='badge badge-negative'>-500</span>
                </div>
            </div>
        </div>
    </div>
</div>

@include('component.chart.setting')
@include('component.chart.singleLine',[
    'id'=>'lineChart',
    'chartTitle' => '',
    'bgStart' => '#605DFB',
    'bgEnd' =>'#FF8355',
    'lineStart' => '#3C39EA',
    'lineEnd' => '#FF6A32',
    'data'=> [['label'=>'21/9/2021', 'value'=> 40],['label'=>'22/9/2021', 'value'=> 50],['label'=>'23/9/2021', 'value'=> 80],['label'=>'24/9/2021', 'value'=> 10]] 
])

<script type="text/javascript" src="/js/page/msccs/dashboard.js{{ config('app.link_version') }}"></script>

@stop
