$(document).ready(function(){

	$.ajax({
		url: "http://localhost:8888/chartjs/data.php",
		method: "GET",
		success: function(data) {
			//document.getElementById("output").innerHTML = "success";
			console.log(data);
		
			var fundsGathered = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
			var month = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
			//JanuaryFunds = data
			
			for (var i in data) {
				for (var j in month) {
					console.log(data[i].MONTH, month[j]);

					if (data[i].MONTH === month[j]) {
						fundsGathered[j] = data[i].fundsGathered;
					}
				}
			
			}
			
			var chartdata = {
				labels: month,
				datasets : [
					{
						label: 'Fund Gathered For Year 2018',
						backgroundColor: 'rgba(255, 99, 132, 0.2)',
						borderColor: 'rgba(255,99,132,1)',
						data: fundsGathered
					}
				]
			};


			var ctx = document.getElementById("mycanvas").getContext('2d');

			var barGraph = new Chart(ctx, {
				type: 'bar',

				data: chartdata,

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
		},
		error: function(data) {
			document.getElementById("output").innerHTML = JSON.stringify(data)
			console.log(data);
		}
	});
});