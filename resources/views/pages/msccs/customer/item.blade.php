    <div class='col-sm-4'>
        <div class='grid-box-item'>
            <div role="group">
                <button id="btnGroupDrop{{$index}}" type="button" aria-haspopup="true" aria-expanded="false" class="btn btn-default menu-tooltip" data-tooltip-content="#tooltip_menu{{$index}}">
                    <i class='ti-more-alt'></i>
                </button>
                <div class="tooltip_templates">
                    <span id="tooltip_menu{{$index}}" class='tooltip_menus'>
                        <a href='/customer/view'>
                            <button  class='btn btn-default' >
                                <i class='ti-eye'></i> View Details
                            </button>        
                        </a>
                    </span>
                </div>
            </div>         
            <div class='img-section'> <img src='/img/icon/customer.png'/> </div>
            <div class='content-section'>
                <span class='badge badge-{{$badge}}'> 3 Call</span>
                <h1> {{$name}} </h1>
                <div class='detail d-flex justify-content-around align-items-center mt-5'>
                    <p> <i class='ti ti-world'></i> Chinese </p>
                    <p> <i class='ti ti-location-pin'></i> Malaysia </p>
                    <p> <i class='ti ti-timer'></i> {{$date}} </p>
                </div>
            </div>
        </div>
    </div>