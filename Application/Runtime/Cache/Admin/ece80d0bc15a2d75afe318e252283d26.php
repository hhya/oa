<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>部门用户统计信息</title>

  <style type="text/css">

</style>
</head>
<body>
    <script src="/Public/Admin/plugin/charts/code/highcharts.js"></script>
    <script src="/Public/Admin/plugin/charts/code/modules/exporting.js"></script>
    <script src="/Public/Admin/plugin/charts/code/modules/export-data.js"></script>

    <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

    <script type="text/javascript">

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: '移动部门用户信息统计表'
            },
            subtitle: {
                // text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
                text: '数据来源: <a href="http://www.baidu.com">百度</a>'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '16px',
                        fontWeight: '900',
                        color: 'olive',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '人数（个）'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: '当前: <b>{point.y:.0f} 人</b>'
            },
            series: [{
                name: 'Population',
                data: <?php echo ($data); ?>,
                // data: [
                // ['Shanghai', 24.2],
                // ['Beijing', 20.8],
                // ['Karachi', 14.9],
                // ['Shenzhen', 13.7],
                // ['Guangzhou', 13.1],
                // ['Istanbul', 12.7],
                // ['Mumbai', 12.4],
                // ['Moscow', 12.2],
                // ['São Paulo', 12.0],
                // ['Delhi', 11.7],
                // ['Kinshasa', 11.5],
                // ['Tianjin', 11.2],
                // ['Lahore', 11.1],
                // ['Jakarta', 10.6],
                // ['Dongguan', 10.6],
                // ['Lagos', 10.6],
                // ['Bengaluru', 10.3],
                // ['Seoul', 9.8],
                // ['Foshan', 9.3],
                // ['Tokyo', 9.3]
                // ],
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
            format: '{point.y:.0f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
</script>
</body>
</html>