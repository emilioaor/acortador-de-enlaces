function getData(url) {
    $.ajax({
        type : 'get',
        url : url,
        success : function (data) {
            loadGraphic(data);
        },
        error : function () {
            
        }
    });
}

function loadGraphic(data) {
    $("#spaceGraphic").highcharts({
        chart: {
            zoomType: 'xy'
        },
        title: {
            text: 'Visitas del mes'
        },
        xAxis: [{
            categories: data.categories
        }],
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value}',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
        },
        title: {
            text: 'Visitas',
                style: {

                color: Highcharts.getOptions().colors[1]
            }
        }
        }],
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
                align: 'left',
                x: 100,
                verticalAlign: 'top',
                y: 120,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        series: [{
            name: 'visitas',
            type: 'column',
            data: data.data,
            tooltip: {
                valueSuffix: ''
            }
        }],
            credits: {
            enabled: false
        }
        });
}