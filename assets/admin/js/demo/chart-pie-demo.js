// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var data = $.parseJSON($.ajax({
        url: 'http://resepjajanankekinian.my.id/userlogs?group=type',
        dataType: "json",
        async: false
    }).responseText);
var data_act_ten = $.parseJSON($.ajax({
        url: 'http://resepjajanankekinian.my.id/userlogs?group=action&limit=10',
        dataType: "json",
        async: false
    }).responseText);
var labels = [];
var values = [];
$(data).each(function(i){         
        labels.push(data[i].type); 
        values.push(data[i].count);
    });
var labels_act_ten = [];
var values_act_ten = [];
$(data).each(function(i){         
        labels_act_ten.push(data_act_ten[i].action); 
        values_act_ten.push(data_act_ten[i].count);
    });
var ctx = document.getElementById("myPieChart").getContext('2d');
var ctx_act_ten = document.getElementById("actionterbanyak").getContext('2d');
var myChart = new Chart(ctx, {
        //chart akan ditampilkan sebagai bar chart
        type: 'pie',
        data: {
            //membuat label chart
            labels: labels,
            datasets: [{
                label: 'Data Type Log',
                //isi chart
                data: values,
                //membuat warna pada bar chart
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(57,35,226, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(57,35,226, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    
var myChart_2 = new Chart(ctx_act_ten, {
        //chart akan ditampilkan sebagai bar chart
        type: 'bar',
        data: {
            //membuat label chart
            labels: labels_act_ten,
            datasets: [{
                label: 'Data Action Log',
                //isi chart
                data: values_act_ten,
                //membuat warna pada bar chart
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(57,35,226, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(57,35,226, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });