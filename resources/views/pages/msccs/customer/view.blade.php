@extends("pages.msccs.layout.index")

@section('head')

<title>  Customer Data Analysis | MSCCS </title>
<link href="/css/page/msccs/customer.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/prod/component/table.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/prod/component/chartjs.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')

<a class="info-back-btn" href='/customer'><button class='btn circle-btn back-btn'> <i class='ti-arrow-left'> </i> <span>Back</span></button></a>

<div class='table-section' >
    <h3 class='title ml-0 mb-1'> {{$customer->name}} - Customer Data Analysis.</h3>
</div>

@if($customer->call->count()<=0)
    <div class='no-data'>
        <img src='/img/picture/no_data.png'/>
        <h2> No call record binded to this customer. </h2> 
        <p> Bind audio record to this customer to view real time audio data analysis </p>
    </div>

@else 


    <div class="mobile-drag-scroll first-content">
        <div class='row'>
            <div class='col-12 d-flex flex-column justify-content-center align-items-center emoji-section'>
                <div>
                    <h2> Customer  </h2> 
                    <p> Sentiment Score</p>
                </div>
                @include('component.emoji', ['emoji'=> $sentiment])                
            </div>
            <div class='col-sm-8'>
                <div class='custom-item-box small-box text-bar-box'>                    
                    <div class='row'>
                        <div class='col-sm-3 text-bar-content'>
                            <p>  Call Record </p>
                            <small> vs date </small>
                        </div>
                        <div class='col-sm-9 linechart-right-box'>
                            <div class='linechart-canvas' style="width:100%">
                                <canvas id="lineChart" class='line-chart' style="height:100%" > </canvas>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  
            <div class='col-sm-4'>
                <div class='custom-item-box small-box'>
                    <canvas id="halfDonutChart2" class='half-donut-chart'></canvas>   
                    <div class='half-donut-center-text'>
                        <small>Total Call</small>
                        <p>{{$totalCall}}</p>
                    </div>
                </div>           
            </div>
            
            <div class='col-12'>
                <div class='custom-item-box small-box text-bar-box'>                    
                    <div class='row'>
                        <div class='col-12 text-bar-content text-left'>
                            <p class='text-left'> Overall Keyword </p>
                            <small>  spotting from audio data</small>
                        </div>
                        <div class='col-12 linechart-right-box'>
                            <div class='linechart-canvas' style="width:100%">
                                <canvas id="lineChart2" class='line-chart' style="height:100%" > </canvas>    
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>   
        </div>

    </div>

    @include('component.chart.setting', ['donut' => true, 'bar'=> true])


    @include('component.chart.singleLine',[
        'id'=>'lineChart',
        'chartTitle' => '',
        'bgStart' => '#4FF1E8',
        'bgEnd' =>'#C090F3',
        'lineStart' => '#3BA9A6',
        'lineEnd' => '#541B90',
        'data'=> $monthlyData
    ])


    @include('component.chart.singleLine',[
        'id'=>'lineChart2',
        'chartTitle' => '',
        'bgStart' => '#605DFB',
        'bgEnd' =>'#FF8355',
        'lineStart' => '#3C39EA',
        'lineEnd' => '#FF6A32',
        'data'=> $keywordData
    ])


    @include('component.chart.donut',[
        'id'=>'halfDonutChart2',    
        'data'=> [
            ['title'=> 'Call record', 'value' => $totalCall  , 'tooltips' => $totalCall, 'color' => '#FF7F36', 'hover' => '#EE6D24', 'no_legend'=>true],              
        ]  
    ])




@endif

@stop