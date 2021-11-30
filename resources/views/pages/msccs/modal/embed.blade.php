<div id="embedRecording" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
                <input name='actionID' id='actionID' type='hidden' />
                <div class="modal-header">
                    <h4 class="modal-title">  Embed Smart Recording </h4>
                </div>
                <div class="modal-body row">
                    <div class='col-sm-12 form-group '>       
                        <textarea rows="6" class='form-control' id="recordCode" readonly><iframe  frameBorder="0" allow="microphone" type="text/html" src="{{env('APP_URL')}}/embed/recording?token={{simpleEncryption(getCompany()->uid)}}&access={{simpleEncryption(Auth::user()->uid)}}" width="800" height="500"></textarea>
                    </div>
                </div>
                <div class="modal-footer">               
                    <button type="button" class="btn btn-default copy-btn" onclick="copyClip('recordCode')">Copy</button>
                </div>
        </div>
    </div>
</div>