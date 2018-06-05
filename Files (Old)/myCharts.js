var ctx = document.getElementById("myChart").getContext('2d');
Chart.defaults.line.spanGaps = true;
var myChart = new Chart(ctx, {  

    type: 'bar',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        datasets: [{
            label: 'Monthly Funds Raised For Year 2017',
            data: [1200, 1900, 300, 500, 200, 300, 600, 400, 900, 1500, 700, 2000],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',

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
        responsive: true,
        
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                    fontColor: 'black'
                    
                }
            }],
            xAxes: [{
                ticks: {
                    beginAtZero:true,
                    fontColor: 'black'
                    
                }
            }]

        }
    }

});
