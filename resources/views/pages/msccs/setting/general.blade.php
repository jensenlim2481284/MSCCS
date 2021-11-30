@extends("pages.msccs.layout.index")

@section('head')

<title> General Setting | MSCCS </title>
<link href="/css/page/msccs/general.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<link href="/css/prod/component/table.min.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<script defer type="text/javascript" src="/js/prod/component/table.min.js{{ config('app.link_version') }}"></script>

@endsection

@section('content')

<a class="info-back-btn" href='/setting'><button class='btn circle-btn back-btn'> <i class='ti-arrow-left'> </i> <span>Back</span></button></a>

<div class='row info-row'>       
    <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8'>
        <div class='form-section'>
            <h1> Keyword Management </h1>
            <p class='title-desc mb-5'> Audio keyword spotting will based on the active keyword setting here. Keyword can be word that express feeling, your service name or any keyword that you would like to keep track.</p>
            <div class="form-group mb-5">   
                <table class="table keyword-table">
                    <thead class="thead-light">
                        <tr>                    
                            <th>Keyword</th>
                            <th>Spot Rate</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($company->keyword as $index=>$key)
                            <tr>
                                <td> {{$key->value}} </td>
                                <td>{{$key->spot_rate}} </td>
                                <td>  <span class='badge badge-success'>Active</span> </td>
                                <td>
                                    <div role="group">
                                        <button id="btnGroupDrop{{$index}}" type="button" class="btn btn-default menu-tooltip" data-tooltip-content="#tooltip_menu{{$index}}">
                                            <i class='ti-more-alt'></i>
                                        </button>
                                        <div class="tooltip_templates">
                                            <span id="tooltip_menu{{$index}}" class='tooltip_menus'>  
                                                <button class='btn btn-danger action-btn' data-toggle="modal"
                                                    data-target="#actionModel" 
                                                    target-id="actionID"
                                                    data-route="{{route('setting.general.keyword.delete')}}"
                                                    value="{{$key->id}}">
                                                    <i class='ti-trash'></i> Delete
                                                </button>
                                            </span>
                                        </div>
                                    </div>  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
                <div class='text-center mt-5'>
                    <button type='button' class="btn btn-primary shake-slow-animation keyword-btn" data-toggle="modal" data-target="#addModal" >
                        Add Keyword <i class="pl-2 ti ti-target" ></i>
                    </button>                    
                </div>
            </div>   
        </div>
    </div>
    <div class='col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4'>
        <div class='form-section company-form'>
            <h1> Company Info </h1>
            <p class='title-desc'> Company basic info </p>
            <div class="form-group mb-5 store-name-section">
                <div class='row'>
                    <div class='col-12'>
                        <p>Company Name</p>
                        <input type="text" class="form-control mb-4"  value="{{$company->name}}" disabled>
                    </div>
                    <div class='col-12'>
                        <p>Company ID</p>
                        <input type="text" class="form-control mb-4"  value="{{$company->uid}}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('pages.msccs.modal.general')


@stop