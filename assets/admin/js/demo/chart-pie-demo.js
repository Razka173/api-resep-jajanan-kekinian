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

var data_2 = $.parseJSON($.ajax({
        url: 'http://resepjajanankekinian.my.id/userlogs?group=user_id&limit=7',
        dataType: "json",
        async: false
    }).responseText);
    
var data_3 = $.parseJSON($.ajax({
        url: 'http://resepjajanankekinian.my.id/resep?order=favorit&limit=7',
        dataType: "json",
        async: false
    }).responseText);
    
var data_4 = $.parseJSON($.ajax({
        url: 'http://resepjajanankekinian.my.id/resep?order=dilihat&limit=7',
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
var labels_2 = [];
var values_2 = [];
$(data_2).each(function(i){         
        labels_2.push(data_2[i].user_id); 
        values_2.push(data_2[i].count);
    });
var labels_3 = [];
var values_3 = [];
$(data_3).each(function(i){         
        labels_3.push(data_3[i].nama); 
        values_3.push(data_3[i].favorit);
    });
var labels_4 = [];
var values_4= [];
$(data_4).each(function(i){         
        labels_4.push(data_4[i].nama); 
        values_4.push(data_4[i].dilihat);
    });
    
var ctx = document.getElementById("myPieChart").getContext('2d');
var ctx_act_ten = document.getElementById("actionterbanyak").getContext('2d');
var ctx_2 = document.getElementById("userteraktif").getContext('2d');
var ctx_3 = document.getElementById("resepterfavorit").getContext('2d');
var ctx_4 = document.getElementById("resepterpopuler").getContext('2d');

var chart0 = createChart(ctx,"pie", "Data Type Log", labels, values);
var chart1 = createChart(ctx_act_ten, "bar", "Data Action Log", labels_act_ten, values_act_ten); 
var chart2 = createChart(ctx_2, "doughnut", "User Teraktif", labels_2, values_2); 
var chart3 = createChart(ctx_3, "bar", "Data Resep Terfavorit", labels_3, values_3); 
var chart4 = createChart(ctx_4, "doughnut", "Data Resep Terpopuler", labels_4, values_4); 


function createChart(context, type, label, labels_data, values_data) {
    var myChart = new Chart(context, {
        //chart akan ditampilkan sebagai bar chart
        type: type,
        data: {
            //membuat label chart
            labels: labels_data,
            datasets: [{
                label: label,
                //isi chart
                data: values_data,
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
    return myChart;   
}