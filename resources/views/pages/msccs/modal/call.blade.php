

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
                </div>       
            </div>
            <div class="modal-footer">               
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                <button class="btn btn-success submit-btn record-btn"> Start </button>                           
            </div>
        </div>
    </div>
</div>

<div id="recordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="app row">
                    
                    <div class='col-12 form-group text-left'>
                        <canvas id="recordCanvas" width="200" height="300" class='slow-beat-animation'></canvas>
                    </div>  
                    <div class='col-12 form-group text-left mt-4'>
                        <p> Audio Input </p>
                        <select class='form-control' id="micSelect"></select>
                    </div>    
                <div>
            </div>
            <div class="modal-footer">               
                <button class="btn btn-success end-record"> End Session </button>                           
            </div>
        </div>
    </div>
</div>