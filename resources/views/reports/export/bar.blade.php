<div class="pt-4">
    <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
   
        </p>
    </figure>
</div>



<script src="{{url('lib\HighCharts\code\highcharts.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/exporting.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/export-data.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/accessibility.js')}}"></script>
<script>
    var projects={!! json_encode($summary['project']) !!};
    var progress={!! json_encode($summary['progress']) !!};
    var project_name=[];
    var target=[];
    var progress_total=[];
    var financial=[];
    for(var key in projects ){
        if(typeof(progress[projects[key].id])!='undefined'){
         project_name.push(projects[key].name);
            target.push(parseInt(progress[projects[key].id][0].target_total));
            progress_total.push(parseInt(progress[projects[key].id][0].progress_total));
            financial.push(parseInt(progress[projects[key].id][0].financial_total));

        }
   
    
}


Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Physical and Financial Progress'
    },
    xAxis: {
        categories: project_name,
        crosshair: true
    },
    yAxis: {
        min: 0,
       
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    
    series: [{
        name: 'Target',
        data: target

    }, {
        name: 'Progress',
        data: progress_total

    }, {
        name: 'Financial',
        data: financial

    }]
});

</script>