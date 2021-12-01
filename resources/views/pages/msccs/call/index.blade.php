@extends("pages.msccs.layout.index")

@section('head')

<title>  Call Center Management | MSCCS </title>
<link href="/css/page/msccs/call.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/prod/component/table.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/prod/component/table.min.js{{ config('app.link_version') }}"></script>
<script defer type="text/javascript" src="/js/page/msccs/call.js{{ config('app.link_version') }}"></script>

@endsection

@section('content')

<button class='btn circle-btn ' data-toggle="modal" data-target="#ticketModal">
    <i class='ti-microphone'> </i>
    <span>Record</span>
</button>

<button class='btn circle-btn secondary-circle-btn ml-3'  data-toggle="modal" data-target="#uploadAudioModal" > <i class='ti-cloud-up'> </i>
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
        @foreach($records as $index=>$record)
            <div class='col-sm-4'>
                <div class='grid-box-item'>
                    <div role="group">
                        <button id="btnGroupDrop{{$index}}" type="button" aria-haspopup="true" aria-expanded="false" class="btn btn-default menu-tooltip" data-tooltip-content="#tooltip_menu{{$index}}">
                            <i class='ti-more-alt'></i>
                        </button>
                        <div class="tooltip_templates">
                            <span id="tooltip_menu{{$index}}" class='tooltip_menus'>
                                @if($record->isCompleted())
                                <a href='/call/{{$record->uid}}'>
                                    <button  class='btn btn-default' >
                                        <i class='ti-bar-chart'></i> Analysis Overview
                                    </button>        
                                </a>
                                @endif
                                <a href="{{$record->getAudioPath()}}" target="_blank">
                                    <button class='btn btn-default'>
                                        <i class='ti-control-play'></i>
                                        <span>Play Audio</span>
                                    </button>
                                </a>
                                @if($record->customer)
                                    <a href="/customer?query={{$record->customer->uid}}">
                                        <button class='btn btn-default'>
                                            <i class='ti-face-smile'></i>
                                            <span>View Customer</span>
                                        </button>
                                    </a>
                                @endif
                                <button class='btn btn-default edit-call' data-toggle="modal" data-target="#editModal" data-value="{{$record}}" >
                                    <i class='ti-pencil-alt'></i>
                                    <span>Edit</span>
                                </button>
                                <button class='btn btn-default action-btn' data-toggle="modal"
                                    data-target="#actionModel" 
                                    target-id="actionID"
                                    data-route="{{route('call.delete')}}"
                                    value="{{$record->uid}}">
                                    <i class='ti-trash'></i> Delete
                                </button>
                            </span>
                        </div>
                    </div>         
                    <div class='img-section'> <img src='/img/icon/chat.png'/> </div>
                    <div class='content-section'>
                        <span class='badge badge-{{$record->status}}'>{{$record->getStatus()}}</span>
                        <h1> {{$record->title??'-'}} </h1>
                        <p> {{$record->description??'-'}} </p>
                        <div class='detail d-flex justify-content-around align-items-center mt-5'>
                            <p> <i class='ti ti-world'></i> {{($record->language)?getConfig('ticket.language_text')[$record->language]:'-'}} </p>
                            <p> <i class='ti ti-timer'></i> {{formatDate($record->created_at)}} </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
</div>

@stop