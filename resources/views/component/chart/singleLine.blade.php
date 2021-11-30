<script>

  
// Get data
window['{{$id}}_label'] = [], window['{{$id}}_value'] = [];
@foreach($data as $item)
    window['{{$id}}_label'].push("{{$item['label']}}"),
    window['{{$id}}_value'].push("{{$item['value']}}"),    
@endforeach
window['{{$id}}_ctx'] = document.getElementById("{{$id}}").getContext("2d")

var gradientStroke = window['{{$id}}_ctx'].createLinearGradient(500, 0, 100, 0);
gradientStroke.addColorStop(0, '{{$lineStart}}');
gradientStroke.addColorStop(1, '{{$lineEnd}}');

var gradientFill = window['{{$id}}_ctx'].createLinearGradient(500, 0, 100, 0);
gradientFill.addColorStop(0, "{{$bgStart}}");
gradientFill.addColorStop(1, "{{$bgEnd}}");


var myChart = new Chart(window['{{$id}}_ctx'], {
    type: 'line',
    data: {
        labels: window['{{$id}}_label'],
        datasets: [{
            label: "Data",
            borderColor: gradientStroke,
            pointBorderColor: gradientStroke,
            pointBackgroundColor: gradientStroke,
            pointHoverBackgroundColor: gradientStroke,
            pointHoverBorderColor: gradientStroke,
            pointBorderWidth: 0,
            pointHoverRadius: 8,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            fill: true,
            backgroundColor: gradientFill,
            borderWidth: 3,
            data: window['{{$id}}_value']
        }]
    },
    options: {
        title: {
            @if(isset($no_title))  
                display: false ,
            @else              
                display: true,
                text: '{{$chartTitle}}',                
            @endif                     
        },
        maintainAspectRatio: false,
        animation: {
            easing: "easeInOutBack"
        },
        legend: {
            display:false
        },
        scales: {
            yAxes: [{
                ticks: {
                    fontColor: 'rgb(255,255,255)',
                    fontStyle: "normal",
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    padding: 20
                },
                gridLines: {
                    drawTicks: false,
                    display: false
                }

            }],
            xAxes: [{
                gridLines: {
                    drawTicks: false,
                    display: false
                },
                ticks: {
                    padding: 20,
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "normal"
                }
            }]
        }
    }
});
</script>