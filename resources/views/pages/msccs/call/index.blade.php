@extends("pages.msccs.layout.index")

@section('head')

<title>  Call Center Management | MSCCS </title>
<link href="/css/page/msccs/call.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/prod/component/table.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/prod/component/table.min.js{{ config('app.link_version') }}"></script>

@endsection

@section('content')

<button class='btn circle-btn ' data-toggle="modal" data-target="#ticketModal">
    <i class='ti-microphone'> </i>
    <span>Record</span>
</button>

<button class='btn circle-btn secondary-circle-btn ml-3' > <i class='ti-cloud-up'> </i>
    <span>Upload</span>
</button>

<div class='table-section'>
    <div class='inline-table-form-section'>
        @include('component.table_top_section',[
            'title'=> 'Call Center Management',
            'data'=>[
                ['type'=>'date','name'=>'startDate','title'=> 'Start Date'],
                ['type'=>'date','name'=>'endDate','title'=> 'End Date'],
            ]
        ])
    </div>
    <div class='row'>
   
    </div>
    
</div>

@stop