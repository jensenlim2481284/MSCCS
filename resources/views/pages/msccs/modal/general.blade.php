

<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' =>'setting.general.keyword.create']) !!}
            <div class="modal-header">
                <h4 class="modal-title"> Add Keyword  </h4>
            </div>
            <div class="modal-body row">
                <div class='col-12 form-group'>
                    <p class='required'> Keyword </p>
                    <input type="text" class="form-control" name="keyword"  maxlength="50" required>
                </div>       
            </div>
            <div class="modal-footer">               
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <button class="btn btn-success submit-btn"> Add </button>                           
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>