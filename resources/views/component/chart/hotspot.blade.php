<script>



	$(document).ready(function(){
		
        const DATA_COUNT = 7;
        const NUMBER_CFG = {count: DATA_COUNT, rmin: 5, rmax: 15, min: 0, max: 100};

        const labels = Utils.months({count: 7});
        const data = {
        labels: labels,
        datasets: [
            {
            label: 'Dataset 1',
            data: Utils.bubbles(NUMBER_CFG),
            borderColor: Utils.CHART_COLORS.red,
            backgroundColor: Utils.transparentize(Utils.CHART_COLORS.red, 0.5),
            },
            {
            label: 'Dataset 2',
            data: Utils.bubbles(NUMBER_CFG),
            borderColor: Utils.CHART_COLORS.orange,
            backgroundColor: Utils.transparentize(Utils.CHART_COLORS.orange, 0.5),
            }
        ]
        };

		// Config
		const config = {
            type: 'bubble',
            data: data,
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Bubble Chart'
                }
                }
            },
        };
		
		var myChart = new Chart(document.getElementById("{{$id}}").getContext("2d"), config);
	});

</script>