<script>



    // Get data 
    window['{{$id}}_label']  = [], window['{{$id}}_background'] = [], window['{{$id}}_value'] = [], window['{{$id}}_tooltips'] = [];
    @foreach($data as $item)
        window['{{$id}}_label'] .push("{{$item['title']}}"),
        window['{{$id}}_background'].push("{{$item['color']}}"),
        window['{{$id}}_value'].push("{{$item['value']}}"),
        @if(isset($customTooltips))            
            window['{{$id}}_tooltips'].push("{{$item['tooltips']}}"),
        @endif
    @endforeach

        
	$(document).ready(function(){
        
        new Chart(document.getElementById("{{$id}}").getContext("2d"), {
            type: 'horizontalBar',
            data: {
                labels: window['{{$id}}_label'] ,
                datasets: [{
                    data: window['{{$id}}_value'],
                    backgroundColor: window['{{$id}}_background'],
                    @if(isset($customTooltips))
                    tooltips: window['{{$id}}_tooltips'],
                    @endif
                }]
            },
            options: {
                legend: {
                    display: false,
                },
                tooltips: {
					callbacks: {
						label: function(tooltipItem, data) {                         
                            @if(isset($customTooltips))
                            console.log(data);
                                return data.labels[tooltipItem.index] + " : " + data.datasets[0].tooltips[tooltipItem.index];                                
                            @else 
							    return data.datasets[0].data[tooltipItem.index] + "{{isset($format)?$format:'%'}}";
                            @endif                               
						}
					}
				},
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            @if(isset($max))
                                max: {{$max}},
                            @endif
                            beginAtZero: true,      
                            precision:0      
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {             
                            @if(isset($isIcon))
                                fontSize: 16,
                            @endif
                    
                        }
                    }],

                },
            }
        });

    });
    
</script>