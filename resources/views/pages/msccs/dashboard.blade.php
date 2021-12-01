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
                    <i class='ti ti-heart'></i>
                </div>
                <div class='list-content referrar'>
                    <p> Overall Sentiment Score </p>
                    @include('component.emoji', ['emoji'=> $sentiment])                    
                </div>
            </div>

            <div class='dashboard-list'>
                <div class='icon-box'>
                    <i class='ti ti-star'></i>
                </div>
                <div class='list-content'>
                    <p> Total Call Record </p>
                    <h2> {{$totalCall}} </h2> 
                </div>
            </div>
            <div class='dashboard-list'>
                <div class='icon-box'>
                    <i class='ti ti-face-smile'></i>
                </div>
                <div class='list-content'>
                    <p> Total Customer </p>
                    <h2> {{$totalCustomer}} </h2> 
                </div>
            </div>
        </div>
        <div class='activity-list'>
            <p class='list-title'>Recent Activity </p>
            @foreach($recentActivity as $activity)
                <div class='list-item'>
                    <div class='item-content'>
                        <h2> Call Record </h2>
                        <p> {{$activity->created_at}} </p>
                    </div>
                    <div class='item-balance'>
                        <span class='badge badge-{{$activity->status}}'>{{$activity->getStatus()}}</span>
                    </div>
                </div>
            @endforeach
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
    'data'=> $monthlyData
])

<script type="text/javascript" src="/js/page/msccs/dashboard.js{{ config('app.link_version') }}"></script>

@stop
