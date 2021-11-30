@extends("pages.msccs.layout.index")

@section('head')

<title>  Data Analysis | MSCCS </title>
<link href="/css/prod/component/table.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/prod/component/chartjs.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/prod/msccs/report.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>

<script type="text/javascript" src="/js/prod/msccs/report.js{{ config('app.link_version') }}"></script>
@endsection

@section('content')

<div class='table-section' >
    <h3 class='title  ml-0 mb-1'> Overall Data Analysis.</h3>
</div>

<div class="mobile-drag-scroll first-content">
    <h5 class="mobile-drag-title">Analysis Category</h5>
    <div class='row info-row mobile-drag-content mb-5 mt-2'>
        @php($reportItem = ['Overall','Order','Customer','Product','Promotion', 'Store'])
        @php($reportIcon = ['ti-cloud','ti-control-shuffle','ti-user','ti-package','ti-star', 'ti-eye'])
        @foreach($reportItem as $index=>$item)
            <div class='col-sm-4 col-md-4 col-lg-2'>
                <a class='under-development' data-title='Data Analysis' data-desc='This feature allows merchants to overview system data analysis to make better marketing decisions and define marketing direction.'>
                    <div class='report-item {{($loop->first)?"active":""}}'>
                        <i class='{{$reportIcon[$index]}}'></i>
                        <p>{{$item}} </p>
                    </div>
                </a>
            </div>   
        @endforeach        
    </div>
    <div class='row'>
        <div class='col-sm-12'>
            <div class="alert alert-info" role="alert">
                <i class='ti-info-alt'></i>  The following data analysis is based on <b>Beauty industry</b>            
            </div>
        </div>
        <div class='col-sm-4'>
            <div class='custom-item-box small-box'>
                <canvas id="halfDonutChart" class='half-donut-chart'></canvas>   
                <div class='half-donut-center-text'>
                    <small>Industry occupation rate</small>
                    <p>13 %</p>
                </div>
            </div>           
        </div>
        <div class='col-sm-8'>
            <div class='custom-item-box small-box text-bar-box'>                    
                <div class='row'>
                    <div class='col-sm-3 text-bar-content'>
                        <p>  Age Group </p>
                        <small> analysis </small>
                    </div>
                    <div class='col-sm-9 linechart-right-box'>
                        <div class='linechart-canvas' style="width:100%">
                            <canvas id="lineChart" class='line-chart' style="height:100%" > </canvas>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-sm-8'>
            <div class='custom-item-box small-box text-bar-box'>                    
                <div class='row'>
                    <div class='col-sm-3 text-bar-content'>
                        <p> Consumer  </p>
                        <small>Spending Classify </small>
                    </div>
                    <div class='col-sm-9'>
                        <canvas id="textBarChart" class='text-bar-chart'></canvas>   
                    </div>
                </div>
            </div>
        </div>   
        <div class='col-sm-4'>
            <div class='custom-item-box small-box'>
                <canvas id="halfDonutChart2" class='half-donut-chart'></canvas>   
                <div class='half-donut-center-text'>
                    <small>Merchant occupation rate</small>
                    <p>4 %</p>
                </div>
            </div>           
        </div>
        
        <div class='col-12'>
            <div class='custom-item-box small-box text-bar-box'>                    
                <div class='row'>
                    <div class='col-12 text-bar-content text-left'>
                        <p class='text-left'> Consumer Interest </p>
                        <small>  from other industry</small>
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
    'bgStart' => '#605DFB',
    'bgEnd' =>'#FF8355',
    'lineStart' => '#3C39EA',
    'lineEnd' => '#FF6A32',
    'data'=> [
        ['label'=> 'Child', 'value' => 1],
        ['label'=> 'Young Adult', 'value' => 400],
        ['label'=>'Middle-Age', 'value' => 250],
        ['label'=>'Old', 'value' => 10],
    ] 
])


@include('component.chart.singleLine',[
    'id'=>'lineChart2',
    'chartTitle' => '',
    'bgStart' => '#605DFB',
    'bgEnd' =>'#FF8355',
    'lineStart' => '#3C39EA',
    'lineEnd' => '#FF6A32',
    'data'=> [
        ['label'=> 'Fashion', 'value' => 500],
        ['label'=> 'Women Collection', 'value' => 400],
        ['label'=>'F&B', 'value' => 250],
        ['label'=>'Groceries', 'value' => 350],
        ['label'=>'Baby & Toys', 'value' => 150],
        ['label'=>'Pets', 'value' => 350],
        ['label'=>'Phone Accessories', 'value' => 160],
    ] 
])

@include('component.chart.donut',[
    'id'=>'halfDonutChart',
    'isHalf' => true,
    'data'=> [
        ['title'=> 'Beauty', 'value' => '13'  , 'tooltips' => '13', 'color' => '#FF7F36', 'hover' => '#EE6D24'],
        ['title'=> 'Overall', 'value' => '100', 'tooltips' =>  '100', 'color' => '#E9E9E9', 'hover' => '#DFDFDF'],      
    ]  
])



@include('component.chart.donut',[
    'id'=>'halfDonutChart2',    
    'data'=> [
        ['title'=> 'Beauty', 'value' => '4'  , 'tooltips' => '4', 'color' => '#FF7F36', 'hover' => '#EE6D24'],
        ['title'=> 'Overall', 'value' => '96', 'tooltips' =>  '96', 'color' => '#E9E9E9', 'hover' => '#DFDFDF'],      
    ]  
])



@include('component.chart.horizontalBar',[
    'id'=>'textBarChart',
    'customTooltips'=>true,
    'data'=> [
        ['title'=> 'Low-end', 'value' => '5', 'tooltips'=> '5%', 'color' => randColorCode() ],    
        ['title'=> 'Middle-end', 'value' => '40', 'tooltips'=> '35%', 'color' => randColorCode() ],    
        ['title'=> 'High-end', 'value' => '45', 'tooltips'=> '45%', 'color' => randColorCode() ],    
    ]
])


@stop