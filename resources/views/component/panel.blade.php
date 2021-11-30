@foreach($data as $box)
    <div class='col-xl-6 col-lg-12 col-sm-12'>
        <a href='{{$box['url']}}' class='under-development' data-title='{{$box["title"]}}' data-desc='{{$box["desc"]}}'>
            <div class='custom-item-box2'>
                <div class='image-section'>
                    <img src='{{$box["img"]}}' />
                </div>
                <div class='content-section'>
                    <h1>{{$box["title"]}}</h1>
                    <p>{{$box["desc"]}}</p>
                    <button class='btn btn-primary-light'>{{$box["btn_desc"]}}</button>
                </div>
            </div>
        </a>
    </div>    
@endforeach