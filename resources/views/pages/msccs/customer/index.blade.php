@extends("pages.msccs.layout.index")

@section('head')

<title>  Customer Management | MSCCS </title>
<link href="/css/page/msccs/customer.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/plugin/multiselect.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/prod/component/table.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/page/msccs/customer.js{{ config('app.link_version') }}"></script>
<script defer type="text/javascript" src="/js/prod/component/table.min.js{{ config('app.link_version') }}"></script>
<script type="text/javascript" src="/js/plugin/multiselect.min.js{{ config('app.link_version') }}"></script>

@endsection

@section('content')

<button class='btn circle-btn add-customer' data-toggle="modal" data-target="#addModal" >
    <i class='ti-plus'> </i>
    <span>Create</span>
</button>

<div class='table-section'>
    <div class='inline-table-form-section'>
        @include('component.table_top_section',[
            'title'=> 'Customer Management',
            'data'=>[
                ['type'=>'date','name'=>'startDate','title'=> 'Start Date'],
                ['type'=>'date','name'=>'endDate','title'=> 'End Date'],
            ]
        ])
    </div>
    <div class='row'>
        @foreach($customers as $index=>$customer)
        <div class='col-sm-4'>
            <div class='grid-box-item'>
                <div role="group">
                    <button id="btnGroupDrop{{$index}}" type="button" aria-haspopup="true" aria-expanded="false" class="btn btn-default menu-tooltip" data-tooltip-content="#tooltip_menu{{$index}}">
                        <i class='ti-more-alt'></i>
                    </button>
                    <div class="tooltip_templates">
                        <span id="tooltip_menu{{$index}}" class='tooltip_menus'>
                            @if($customer->call->count()>0)
                            <a href='/customer/{{$customer->uid}}'>
                                <button  class='btn btn-default' >
                                    <i class='ti-bar-chart'></i> Analysis Overview
                                </button>        
                            </a>
                            @endif
                            <button class='btn btn-default edit-customer' data-toggle="modal" data-target="#addModal" data-value="{{$customer}}" >
                                <i class='ti-pencil-alt'></i>
                                <span>Edit</span>
                            </button>
                            <button class='btn btn-default bind-btn' data-toggle="modal" data-target="#bindModal" data-uid="{{$customer->uid}}" >
                                <i class='ti-headphone-alt'></i>
                                <span>Bind Call</span>
                            </button>
                            <button class='btn btn-default action-btn' data-toggle="modal"
                                data-target="#actionModel" 
                                target-id="actionID"
                                data-route="{{route('customer.delete')}}"
                                value="{{$customer->uid}}">
                                <i class='ti-trash'></i> Delete
                            </button>
                        </span>
                    </div>
                </div>         
                <div class='img-section'> <img src='/img/icon/customer.png'/> </div>
                <div class='content-section'>
                    <span class='badge badge-primary'>{{$customer->call->count()}} Call</span>
                    <h1> {{$customer->name??'-'}} </h1>
                    <div class='detail d-flex justify-content-around align-items-center mt-5'>
                        <p> <i class='ti ti-world'></i> {{$customer->language??' -'}} </p>
                        <p> <i class='ti ti-location-pin'></i> {{$customer->country??' -'}}  </p>
                        <p> <i class='ti ti-timer'></i> {{formatDate($customer->created_at)}} </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('pages.msccs.modal.customer')
@include('component.multiselect_script',['key'=>'bind', 'nonSelectedHeader'=>'Call Record','selectedHeader' => 'Selected Record'])

@stop