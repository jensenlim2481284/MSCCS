@extends("pages.msccs.layout.index")

@section('head')

<title>  Data Analysis | MSCCS </title>
<link href="/css/page/msccs/call.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/prod/component/table.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/prod/component/chartjs.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')

<a class="info-back-btn" href='/call'>
    <button class='btn circle-btn back-btn'> <i class='ti-arrow-left'> </i> <span>Back</span></button>
</a>

<div class='table-section title-section' >
    <div class='title-icon'> 
        <i class='ti ti-world'></i> {{getConfig('ticket.language_text')[$ticket->language]}} 
    </div>
    <h3 class='title ml-0 mb-1'>{{$ticket->title}} </h3>
    <p>{{$ticket->description}}</p>
</div>

<div class="mobile-drag-scroll first-content">
    <div class='row'>
        <div class='col-sm-4'>
            <div class='custom-item-box small-box'>
                <canvas id="halfDonutChart" class='half-donut-chart'></canvas>   
                <div class='half-donut-center-text'>
                    <small>Satisfaction Rate</small>
                    <p>{{$sentimentScore}} %</p>
                </div>
            </div>           
        </div>
        <div class='col-sm-1'></div>
        <div class='col-sm-5 emoji-section'>
            <div>
                <h2> Customer  </h2> 
                <p> Overall Sentiment Score</p>
            </div>
            @include('component.emoji', ['emoji'=> $sentiment])               
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

        <div class='col-sm-8'>
            <div class='custom-item-box small-box text-bar-box'>                    
                <div class='row'>
                    <div class='col-sm-3 text-bar-content'>
                        <p> Sentiment  </p>
                        <small> Classify </small>
                    </div>
                    <div class='col-sm-9'>
                        <canvas id="textBarChart" class='text-bar-chart'></canvas>   
                    </div>
                </div>
            </div>
        </div>   
      
        <div class='col-sm-4'>
            <div class='custom-item-box small-box text-bar-box'>                    
                <div class='row'>
                    <div class='col-12 text-bar-content text-left'>
                        <p class='text-left mb-3'> Audio Transcript </p>
                    </div>
                    <div class='col-12 transcript'>
                       <textarea class='form-control' rows='10' disabled>{{$ticket->transcript}} </textarea>
                    </div>
                </div>
            </div>
        </div>   
    </div>

</div>


@include('component.chart.setting', ['donut' => true, 'bar'=> true])



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
    'data'=>  [
        ['title'=> 'Negative', 'value' => $negative, 'tooltips'=> ($negative*100).'%', 'color' => randColorCode() ],    
        ['title'=> 'Neutral', 'value' => $neutral, 'tooltips'=> ($neutral*100) .'%', 'color' => randColorCode() ],    
        ['title'=> 'Positive', 'value' => $positive, 'tooltips'=> ($positive*100).'%', 'color' => randColorCode() ],    
    ]
])


@stop