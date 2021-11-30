<script>


	// Get data
	window['{{$id}}_label'] = [], window['{{$id}}_background'] = [], window['{{$id}}_hover'] = [], window['{{$id}}_value'] = [], window['{{$id}}_tooltips'] = [];
	@foreach($data as $item)
		window['{{$id}}_label'].push("{{$item['title']}}"),
		window['{{$id}}_background'].push("{{$item['color']}}"),
		window['{{$id}}_hover'].push("{{$item['hover']}}"),
		window['{{$id}}_value'].push("{{$item['value']}}"),
		window['{{$id}}_tooltips'].push("{{$item['tooltips']}}"),
	@endforeach


	$(document).ready(function(){
		
		// Config
		var config = {
			type: '{{($type)??"RoundedDoughnut"}}',
			data: {
				labels: window['{{$id}}_label'],
				datasets: [{
					data:  window['{{$id}}_value'],
					backgroundColor: window['{{$id}}_background'],
					hoverBackgroundColor: window['{{$id}}_hover'],
					tooltips: window['{{$id}}_tooltips']
				}]
			},
			options: {
				@if(isset($isHalf))
					rotation: 1 * Math.PI,
					circumference: 1 * Math.PI,
				@endif
				aspectRatio: 1,
				cutoutPercentage: 80,
				elements: {
					arc: {
						roundedCornersFor: 0
					}
				},
				tooltips: {
					callbacks: {
						label: function(tooltipItem, data) {
							return data.labels[tooltipItem.index] + " : " + data.datasets[0].tooltips[tooltipItem.index];
						}
					}
				},
				legend: {
					@if(isset($item['no_legend'])) display:false, @endif
					position: "bottom",
					align: "start",
					labels: {
						usePointStyle: true,
					},
				},
			}
		};
		
		var myChart = new Chart(document.getElementById("{{$id}}").getContext("2d"), config);
	});

</script>