@extends("pages.msccs.layout.index")

@section('head')

<title> Customer Details | MSCCS </title>
<link href="/css/page/msccs/customer.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<link href="/css/prod/component/table.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/prod/component/table.js{{ config('app.link_version') }}"></script>
<link href="/css/prod/component/chartjs.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/js/prod/component/chartjs.min.js{{ config('app.link_version') }}"></script>
@endsection

@section('content')

<div class='header'>
    <a href='/customer'>
        <button class='btn circle-btn back-btn mb-0'> 
            <i class='ti-arrow-left'> </i>
            <span>Back</span>
        </button>
    </a>
    <h1>Jensen Lim</h1>
</div>
<div class='row'>
    <div class='col-sm-12 col-md-12 col-lg-7 col-xl-7'>
        <div class='credit-section'>
            <div class='row'>
                <div class='col-sm-6 left-section'>
                    <span class='badge top-badge'> Rank 1 Customer </span>
                    <h1> Total Spend </h1>
                    $500
                    <small class='mt-3'> - 10 Purchases </small>
                </div>
                <div class='col-sm-6 left-credit-col'>                  
                    <img src='/img/picture/register_bg.png'/>
                </div>
            </div>
        </div>
        <div class='history-section ' >
            <div class='row'>
                <div class='col-sm-6'>
                    <div class='custom-item-box small-box'>
                        <canvas id="donutChart" class='donut-chart'></canvas>   
                        <div class='donut-center-text'>
                            <small>Total Visit</small>
                            <p> 20 </p>
                        </div>
                    </div>
                </div>
                <div class='col-sm-6'>
                    <div class='custom-item-box small-box'>
                        <canvas id="halfDonutChart" class='half-donut-chart'></canvas>   
                        <div class='half-donut-center-text'>
                            <small>Spending Classify</small>
                            <p>10 %</p>
                        </div>
                    </div>           
                </div>
                <div class='col-12'>
                    <div class='custom-item-box small-box text-bar-box'>                    
                        <div class='row'>
                            <div class='col-12 text-bar-content text-left'>
                                <p class='text-left'> Purchase Behavior </p>
                                <small> Ranking</small>
                            </div>
                            <div class='col-12'>
                                <canvas id="textBarChart" class='text-bar-chart'></canvas>   
                            </div>
                        </div>
                    </div>
                </div>  
                <div class='col-12'>
                    <div class='custom-item-box small-box text-bar-box'>                    
                        <div class='row'>
                            <div class='col-12 text-bar-content text-left'>
                                <p class='text-left'> Browsing Behavior </p>
                                <small> Ranking</small>
                            </div>
                            <div class='col-12'>
                                <canvas id="textBarChart2" class='text-bar-chart'></canvas>   
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>

    </div>
    <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 credit-row-divider"></div>
    <div class='col-sm-12 col-md-12 col-lg-4 col-xl-4'>
        <div class='right-item' >
            <h1 class='title'>Purchase Statistic</h1>
            <div class='linechart-canvas' style="width:100%">
                <canvas id="lineChart" class='line-chart' style="height:100%" > </canvas>    
            </div>
        </div>
        <div class='right-item ' >
            <div class='d-flex justify-content-between align-items-center mb-4'>
                <h1 class='title'>Customer Details</h1>
            </div>
            <div class='bank-list'>
                <div class='bank-account bank-item' >
                    <div class='bank-info'>
                        <h2>Full Name</h2>
                        <p> Jensen Lim</p>
                    </div>
                    <div class='bank-info'>
                        <h2>Email Address</h2>
                        <p> lim@gmail.com</p>
                    </div>
                    <div class='bank-info'>
                        <h2>Phone Number</h2>
                        <p> 60241518584</p>
                    </div>
                    <div class='bank-info'>
                        <h2>Gender</h2>
                        <p> Male</p>
                    </div>
                    <div class='bank-info'>
                        <h2>Age Group</h2>
                        <p> Young Adult</p>
                    </div>
                    <div class='bank-info'>
                        <h2>Joined Since</h2>
                        <p> 15-11-2021</p>
                    </div>
                </div>
                
            </div>
        </div>
        <div class='right-item ' >
            <div class='d-flex justify-content-between align-items-center mb-4'>
                <h1 class='title'>Order History</h1>
                <button class='btn btn-default under-development' data-title='Order History' data-desc='This feature allows merchants to view customer purchase history.'> View History</button>
            </div>
            <div class='bank-list'>
                <div class='no-record no-bank'>
                    <img src='/img/picture/no_widget.png'/>
                    <p>No order record yet. </p>
              
                </div>
            </div>
        </div>
        <div class='right-item ' >
            <div class='d-flex justify-content-between align-items-center mb-4'>
                <h1 class='title'>Note & Remark</h1>
                <button class='btn btn-default under-development' data-title='Bank Account' data-desc='This feature allows merchants to manage their bank account for withdrawal request.'>Add Note </button>
            </div>
            <div class='bank-list'>
                <div class='no-record no-bank'>
                    <img src='/img/picture/no_event.png'/>
                    <p>No note yet. </p>
                    <button class='btn btn-secondary under-development'  data-title='Bank Account' data-desc='This feature allows merchants to manage their bank account for withdrawal request.' >Add note</button>
                </div>
            </div>
        </div>
       
    </div>
</div>

@include('component.chart.setting', ['donut' => true, 'bar'=> true])

@include('component.chart.singleLine',[
    'id'=>'lineChart',
    'chartTitle' => '',
    'bgStart' => '#231CE4',
    'bgEnd' =>'#FF8355',
    'lineStart' => '#231CE4',
    'lineEnd' => '#FF6A32',
    'data'=> [
        ['label'=> '13 Nov', 'value' =>300],
        ['label'=>'15 Nov', 'value' => 20],
        ['label'=>'17 Nov', 'value' => 500],
        ['label'=> '18 Nov', 'value' => 400],
    ] 
])

@include('component.chart.donut',[
    'id'=>'donutChart',
    'data'=> [
        ['title'=>'Middle-end Consumer', 'value' => 20  , 'tooltips' => 20, 'color' => '#7841EC', 'hover' => '#5D26D1', 'no_legend'=>true]             
    ]  
])


@include('component.chart.donut',[
    'id'=>'halfDonutChart',
    'isHalf' => true,
    'data'=> [
        ['title'=> '0 ~ 50% : Low-end', 'value' =>  10  , 'tooltips' => 40, 'color' => '#FF7F36', 'hover' => '#EE6D24'],
        ['title'=>'51 ~ 100% : High-end', 'value' => 100, 'tooltips' => 100 , 'color' => '#E9E9E9', 'hover' => '#DFDFDF'],      
    ]  
])


@include('component.chart.horizontalBar',[
    'id'=>'textBarChart',
    'customTooltips'=>true,
    'data'=> [
        ['title'=> 'Groceries', 'value' => '12', 'tooltips'=> '50%', 'color' => randColorCode() ],    
        ['title'=> 'Fashion', 'value' => '9', 'tooltips'=> '35%', 'color' => randColorCode() ],    
        ['title'=> 'F&B', 'value' => '6', 'tooltips'=> '5%', 'color' => randColorCode() ],    
        ['title'=> 'Pets', 'value' => '3', 'tooltips'=> '2%', 'color' => randColorCode() ],    
        ['title'=> 'Beauty', 'value' => '1', 'tooltips'=> '1%', 'color' => randColorCode() ],    
    ]
])


@include('component.chart.horizontalBar',[
    'id'=>'textBarChart2',
    'customTooltips'=>true,
    'data'=> [
        ['title'=> 'Beauty', 'value' => '32', 'tooltips'=> '40%', 'color' => randColorCode() ],    
        ['title'=> 'Groceries', 'value' => '29', 'tooltips'=> '20%', 'color' => randColorCode() ],    
        ['title'=> 'Fashion', 'value' => '4', 'tooltips'=> '15%', 'color' => randColorCode() ],    
        ['title'=> 'F&B', 'value' => '2', 'tooltips'=> '5%', 'color' => randColorCode() ],    
        ['title'=> 'Pets', 'value' => '1', 'tooltips'=> '2%', 'color' => randColorCode() ],    
    ]
])




@stop