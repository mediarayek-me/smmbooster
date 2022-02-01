const labels = ['December', 'November', 'October', 'September', 'August', 'July', 'June', 'May', 'April', 'March', 'February', 'January'].reverse();


var ctx = document.getElementById('chart1');
if(ctx.length){
ctx = ctx.getContext('2d');

var loadWeekReportChart = function()
{

}
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Monthly Earnings Report',
            data: [12, 19, 3, 5, 2, 3,12, 19, 3, 5, 2, 3],
            backgroundColor: [
                '#8d95ec'
            ],
            borderColor: [
                '#8d95ec'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
})
}

var ctx = document.getElementById('chart2')
if(ctx.length){
ctx = ctx.getContext('2d');
    new Chart(ctx, {
       type: 'bar',
       data: {
           labels: labels,
           datasets: [{
               label: 'Monthly Earnings Report',
               data: [12, 19, 3, 5, 2, 3,12, 19, 3, 5, 2, 3],
               backgroundColor: [
                   '#8d95ec'
               ],
               borderColor: [
                   '#8d95ec'
               ],
               borderWidth: 1
           }]
       },
       options: {
           scales: {
               y: {
                   beginAtZero: true
               }
           }
       }
   })
}