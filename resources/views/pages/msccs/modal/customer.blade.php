
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'customer.update']) !!}
            <input type='hidden' name='uid' />
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body row">
                <div class='col-sm-12 form-group'>
                    <p class='required'>Name </p>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class='col-sm-12 form-group'>
                    <p> Email </p>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class='col-sm-12 form-group'>
                    <p> Language </p>
                    <input type="text" class="form-control" name="language">
                </div>
                <div class='col-sm-12 form-group'>
                    <p> Country </p>
                    <input type="text" class="form-control" name="country">
                </div>
                <div class='col-sm-12 form-group'>
                    <p> Remark </p>
                    <input type="text" class="form-control" name="remark">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class='btn btn-success submit-btn'> Create </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div id="bindModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!! Form::open(['route' => 'customer.bind']) !!}  
            <input type='hidden' name='uid'/>          
            <div class="modal-header">
                <h4 class="modal-title">Bind Call Record</h4>
            </div>
            <div class="modal-body row">
                <div class='col-sm-12 form-group'>
                    <select data-name='bind[]' style='display:none' multiple='multiple' id='bindSelectTemplate'>
                        @foreach($tickets as $index=>$value)
                            <option value="{{$value->uid}}">[{{$value->created_at}}] -  {{$value->title}} </option>
                        @endforeach
                    </select>                  
                    <div id="bindMultiselectSection"></div>                                              
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class='btn btn-success submit-btn'> Update </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>