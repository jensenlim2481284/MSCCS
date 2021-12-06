

<div id="ticketModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <img src='/img/picture/record.png'/>
            </div>
            <div class="modal-body row">
                <div class='col-12 form-group'>
                    <h1> Smart Recording </h1>
                    <p> Click the start button below to start the recording session. A ticket will be automatically generated after the recording session ends.</p>
                    <p class='mt-4'><span>-</span> Currently only support Chinese, English and Russian <span>-</span></p>
                </div>       
            </div>
            <div class="modal-footer">               
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <button class="btn btn-success submit-btn record-btn"> Start </button>                           
            </div>
        </div>
    </div>
</div>


<div id="uploadAudioModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' =>'call.upload','id'=>'uploadAudio','files'=>true ]) !!}
                <div class="modal-header">
                    <h4 class="modal-title"> Upload Audio  </h4>
                </div>
                <div class="modal-body">
                    <div class="file-upload-wrapper" data-text="Select your file!">
                        <input name="audio" type="file" accept=".wav" class="file-upload-field" value="">
                    </div>
                </div>
                <div class="modal-footer text-center">   
                    <button class="btn btn-success " style="margin:auto;"> Upload Audio </button>                      
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div id="recordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body row">
                <div class='col-12 form-group text-center'>
                    <canvas id="recordCanvas" width="200" height="300" class='slow-beat-animation'></canvas>
                    <div class='mt-3'><small> Recording ... </small></div>
                </div>  
                <div class='col-12 form-group text-left mt-4'>
                    <p> Audio Input </p>
                    <select class='form-control' id="micSelect"></select>
                </div>    
            </div>
            <div class="modal-footer">               
                <button class="btn btn-success end-record"> End Session </button>                           
            </div>
        </div>
    </div>
</div>



<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'call.update']) !!}
            <input type='hidden' name='uid' />
            <div class="modal-header">
                <h4 class="modal-title">Edit Call Record</h4>
            </div>
            <div class="modal-body row">
                <div class='col-sm-12 form-group'>
                    <p>Title </p>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class='col-sm-12 form-group'>
                    <p> Description </p>
                    <input type="text" class="form-control" name="description">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class='btn btn-success update-btn'> Update </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
