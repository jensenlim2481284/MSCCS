<div id="actionModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['method'=>'POST','id'=>'actionForm']) !!}
                <input name='actionID' id='actionID' type='hidden' />
                <div class="modal-header">
                    <h4 class="modal-title">  Delete Record  </h4>
                </div>
                <div class="modal-body row">
                    <div class='col-sm-12 form-group ' id="actionContent">       
                        Are you sure ? This action cannot be undo.                                     
                    </div>
                </div>
                <div class="modal-footer">               
                    <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger submit-btn">Confirm</button>                
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>