@extends("pages.msccs.layout.index")

@section('head')

<title>  Customer Management | MSCCS </title>
<link href="/css/page/msccs/customer.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<link href="/css/prod/component/table.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
<script defer type="text/javascript" src="/js/prod/component/table.min.js{{ config('app.link_version') }}"></script>

@endsection

@section('content')


<button class='btn circle-btn ' >
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
    @include('pages.msccs.customer.item', ['index'=>1, 'type'=> 'Purchased', 'name'=>'Jensen Lim', 'email'=>'lim@gmail.com', 'phone'=>'60162545885' , 'date'=>'15-11-2021', 'badge'=>'primary'])
    </div>
    
</div>

@include('pages.msccs.modal.customer')

@stop