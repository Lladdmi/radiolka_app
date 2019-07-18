@if(isset($userGenre))
<canvas id="userGenre" width="400" height="400"></canvas>
  <script>
  var ctx = document.getElementById("userGenre");
  var userGenre = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: [<?php echo $userGenre[0][1] ?>],
          datasets: [{
              label: '# of Votes',
              data: [<?php echo $userGenre[0][0] ?>],
              backgroundColor: [
                'rgba(244, 67, 54,0.2)',
                'rgba(233, 30, 99,0.2)',
                'rgba(156, 39, 176,0.2)',
                'rgba(103, 58, 184,0.2)',
                'rgba(63, 81, 181,0.2)',
                'rgba(33, 150, 244,0.2)',
                'rgba(2, 168, 244,0.2)',
                'rgba(0, 188, 212,0.2)',
                'rgba(0, 150, 136,0.2)',
                'rgba(76, 175, 80,0.2)',
                'rgba(139, 195, 74,0.2)',
                'rgba(206, 221, 57,0.2)',
                'rgba(255, 235, 59,0.2)',
                'rgba(255, 193, 6,0.2)',
                'rgba(255, 152, 0,0.2)',
                'rgba(255, 87, 34,0.2)',
                'rgba(121, 85, 72,0.2)',
                'rgba(158, 158, 158,0.2)',
                'rgba(96, 125, 139,0.2)'
              ],
              borderColor: [
                  'rgba(244, 67, 54,1)',
                  'rgba(233, 30, 99,1)',
                  'rgba(156, 39, 176,1)',
                  'rgba(103, 58, 184,1)',
                  'rgba(63, 81, 181,1)',
                  'rgba(33, 150, 244,1)',
                  'rgba(2, 168, 244,1)',
                  'rgba(0, 188, 212,1)',
                  'rgba(0, 150, 136,1)',
                  'rgba(76, 175, 80,1)',
                  'rgba(139, 195, 74,1)',
                  'rgba(206, 221, 57,1)',
                  'rgba(255, 235, 59,1)',
                  'rgba(255, 193, 6,1)',
                  'rgba(255, 152, 0,1)',
                  'rgba(255, 87, 34,1)',
                  'rgba(121, 85, 72,1)',
                  'rgba(158, 158, 158,1)',
                  'rgba(96, 125, 139,1)'
              ],
              borderWidth: 1
          }]
        },
        options: {
          tooltips: {
            callbacks: {
              label: function(tooltipItem, data) {
                var allData = data.datasets[tooltipItem.datasetIndex].data;
                var tooltipLabel = data.labels[tooltipItem.index];
                var tooltipData = allData[tooltipItem.index];
                var total = 0;
                for (var i in allData) {
                  total += allData[i];
                }
                var tooltipPercentage = Math.round((tooltipData / total) * 100);
                return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
              }
            }
          }
        }
  });
  </script>
  @else
  Brak statystyk
  @endif
