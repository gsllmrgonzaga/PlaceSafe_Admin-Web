<div class="col-12" style="height:415px;">
<h4 class="border-0 border-top border-3 border-white py-3 mt-4 mx-3 text-white">
    Region 7 - Comparative Covid-Statistic Analysis</h4>
<h6 class="mx-3 text-start fst-italic lh-sm mt-0" style="color:antiquewhite;">Last Updated: {{ $lastUpdate }}</h6>
<script>
window.onload = function () {
const BASE_URL = "{{Config('app.url')}}";
var url = BASE_URL+'psAdmin/totalcases';
axios.get(url).then((res) => {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        title:{
            text: 'As of {{ $latestDate }}'
            
            
        },
        axisY: {
            title: "Total Confirmed Cases",
            titleFontSize: 20,
            labelFontColor: "black",
            labelFontSize: 15,
        },
        axisX:{
            labelFontSize: 15,
            labelFontColor: "black",
            titleFontSize: 40,
        },
        legend: {
            fontSize: 18
        },
        data: [{        
            type: "column",  
            showInLegend: true, 
            legendMarkerColor: "grey",
            legendText: "Provinces",
            dataPoints: [     
                { y: res.data[0], label: "Cebu", color:"#4742a1" },
                { y: res.data[1],  label: "Bohol",color:"#E9A19B"},
                { y: res.data[2],  label: "Siquijor",color:"green" },
                { y: res.data[3],  label: "Negros Oriental",color:"#702963"}
            ]
        }]
    });
    chart.render();
});

}
</script>


<div id="chartContainer" style="height: 370px;width:100%" class="px-3"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>