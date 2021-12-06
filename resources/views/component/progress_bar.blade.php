<div id="{{$id}}" class='custom-progressbar' data-current ="{{$currentValue}}"  data-target="100"></div>
<div class='progressbar-text d-flex justify-content-between'>
    <small class='custom-progressbar-text stage-name'>{{$stage}}</small>
    <small class='custom-progressbar-text stage-percent'>{{ filterNumber($currentValue / 100 * 100) }}%</small>
</div>
