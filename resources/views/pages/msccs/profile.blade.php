@extends("pages.msccs.layout.index")

@section('head')

<title>Profile | MSCCS</title>
<link href="/css/page/msccs/account.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />
<link href="/css/page/component/form.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet" />

@endsection

@section('content')

<div class='row'>
    <div class='col-sm-12  merchant-account-col referral-account'>
        <ul class="nav nav-pills flex-column" id="pills-submenu">
            <li class="nav-item">
                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#profile" ><i class='ti-user'></i>My Account</a>
            </li>
        </ul>
    </div>

    <div class='col-12'>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="profile" >
                <div class='form-section account-form-section'>
                    <h1 class='title'> Account Details </h1>
                    <div class='row'>
                        <div class="form-group col-12">
                            <label>Account ID</label>
                            <input type="text" class="form-control" disabled value="{{Auth::user()->uid}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Name</label>
                            <input type="text" class="form-control" disabled value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control email_display" disabled value="{{Auth::user()->email}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@stop
