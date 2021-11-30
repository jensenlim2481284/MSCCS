@extends("pages.msccs.layout.empty")

@section('head')

<title> Smart Record Embed | MSCCS</title>

@endsection

@section('content')


<div class="app row">
  
    <div class='col-12 form-group text-left'>
        <canvas id="recordCanvas" width="200" height="300" class='slow-beat-animation'></canvas>
    </div>  
    <div class='col-12 form-group text-left mt-4' style='max-width:350px;margin:auto;'>
        <p style="margin-bottom:5px; font-size:13px;"> Audio Input </p>
        <select class='form-control' id="micSelect"></select>
    </div>    
    <div class='col-12 text-center mt-4'>
        <button class='btn btn-primary start-record'> Start record </button>
        <button class='btn btn-primary end-record hide'> End record </button>
    </div>
<div>


@stop
