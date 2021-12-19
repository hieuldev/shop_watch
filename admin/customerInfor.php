<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://127.0.0.1:8000/cluster',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  
));

$response = curl_exec($curl);

curl_close($curl);
$result=json_decode($response);
foreach($result as $row){
        $data[] = $row;
    }
?>

<style type="text/css">
#chart-container {
    width: 40%;
    height: auto;
    text-align: center;
}
</style>
<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="js/chart.js"></script>

<body>
    <?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
    <div class="grid_10">
            <div class="box round first grid">
                <h2>Thống kê khách hàng</h2>
    <div id="chart-container" style="text-align:center;float:left;">
        <canvas id="graph"></canvas>
    </div><div>
            <a href="customerstatistics.php?id=2">Khách hàng thông thường :</a><?php echo $data[0]; ?><br/>
               <a href="customerstatistics.php?id=0">Khách hàng thân thiết :</a><?php echo $data[1]; ?><br/>
                <a href="customerstatistics.php?id=1">Khách hàng đặc biệt :</a><?php echo $data[2]; ?><br/>
                </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph(){
                    var labels = [];
                    var result = [];
                    labels.push("Khách hàng thông thường");
                    labels.push("Khách hàng thân thiết");
                    labels.push("Khách hàng đặc biệt");
                    result.push("<?php echo $data[0]?>");
                    result.push("<?php echo $data[1]?>");
                    result.push("<?php echo $data[2]?>");
                    var pie = $("#graph");
                    var myChart = new Chart(pie, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    data: result,
                                    borderColor: ["rgba(217, 83, 79,1)","rgba(240, 173, 78, 1)","rgba(92, 184, 92, 1)"],
                                    backgroundColor: ["rgba(217, 83, 79,0.2)","rgba(240, 173, 78, 0.2)","rgba(92, 184, 92, 0.2)"],
                                }
                            ]
                        },
                        options: {
                            title: {
                                display: true,
                                text: "Thống kê"
                            }
                        }
                    });
        }
        </script>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>
</body>