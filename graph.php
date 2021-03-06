<!DOCTYPE html>
<html style="height: 100%">
   <head>
       <meta charset="utf-8">
   </head>
   <body style="height: 100%; margin: 0">
       <div id="container" style="height: 100%"></div>
       <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts-gl/dist/echarts-gl.min.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts-stat/dist/ecStat.min.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/extension/dataTool.min.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/map/js/china.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/map/js/world.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/extension/bmap.min.js"></script>
       <script type="text/javascript">
           var dom = document.getElementById("container");
           var myChart = echarts.init(dom);
           var app = {};
           option = null;
           myChart.showLoading();
           $.get('https://www.computercau.top/wh_pneumonia/les-miserables.gexf', function (xml) {
               myChart.hideLoading();

               var graph = echarts.dataTool.gexf.parse(xml);
               var categories = [];
               for (var i = 0; i < 9; i++) {
                   categories[i] = {
                       name: '类目' + i
                   };
               }
               graph.nodes.forEach(function (node) {
                   node.itemStyle = null;
                   node.value = node.symbolSize;
                   node.symbolSize /= 1.5;
                   node.label = {
                       show: node.symbolSize > 30
                   };
                   node.category = node.attributes.modularity_class;
               });
               option = {
                   title: {
                       text: 'Les Miserables',
                       subtext: 'Default layout',
                       top: 'bottom',
                       left: 'right'
                   },
                   tooltip: {},
                   legend: [{
                       // selectedMode: 'single',
                       data: categories.map(function (a) {
                           return a.name;
                       })
                   }],
                   animationDuration: 1500,
                   animationEasingUpdate: 'quinticInOut',
                   series : [
                       {
                           name: 'Les Miserables',
                           type: 'graph',
                           layout: 'none',
                           data: graph.nodes,
                           links: graph.links,
                           categories: categories,
                           roam: true,
                           focusNodeAdjacency: true,
                           itemStyle: {
                               borderColor: '#fff',
                               borderWidth: 1,
                               shadowBlur: 10,
                               shadowColor: 'rgba(0, 0, 0, 0.3)'
                           },
                           label: {
                               position: 'right',
                               formatter: '{b}'
                           },
                           lineStyle: {
                               color: 'source',
                               curveness: 0.3
                           },
                           emphasis: {
                               lineStyle: {
                                   width: 10
                               }
                           }
                       }
                   ]
               };

               myChart.setOption(option);
           }, 'xml');;
           if (option && typeof option === "object") {
               myChart.setOption(option, true);
           }
       </script>
   </body>
</html>