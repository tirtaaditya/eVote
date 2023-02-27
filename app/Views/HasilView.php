	<div class="row gy-5 g-xl-8">
        <div class="col-xxl-12">
    	    <div class="alert alert-custom alert-primary" role="alert">
		    <div class="alert-text">Hasil Pemilihan Pengurus</div>
	    </div>		
            <div class="card card-xxl-stretch">
                <div class="card-header border-0">
                    <h3 class="card-title fw-bolder text-dark"></h3>
                </div>
                <div class="card-body pt-2">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xxl-12">
		    &nbsp;
        </div>
		
        <div class="col-xxl-12">
	    <div class="alert alert-custom alert-primary" role="alert">
		    <div class="alert-text">Hasil Pemilihan Badan Pengawas</div>
	    </div>
	    <div class="card card-xxl-stretch">
                <div class="card-header border-0">
                    <h3 class="card-title fw-bolder text-dark"></h3>
                </div>
                <div class="card-body pt-2">
                    <canvas id="myChart2"></canvas>
                </div>
            </div>
        </div>
    </div>

<script>
	window.setTimeout( function() {
		window.location.reload();
	}, 15000);	
	
	var dataCalon = <?php echo json_encode($dataCalon); ?>;
	var dataHasil = <?php echo json_encode($dataHasil); ?>;

	var dataCalon2 = <?php echo json_encode($dataCalon2); ?>;
	var dataHasil2 = <?php echo json_encode($dataHasil2); ?>;

	var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: dataCalon,
				datasets: [{
					label: 'Pengurus',
					data: dataHasil,
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	
	var ctx = document.getElementById("myChart2").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: dataCalon2,
				datasets: [{
					label: 'Badan Pengawas',
					data: dataHasil2,
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});

		
</script>
