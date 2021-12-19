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
    <?php include 'inc/header.php'; ?>
    <?php include 'inc/sidebar.php'; ?>
    <?php include '../classes/product.php';  ?>
    <?php $pd = new product();
    $month1 = $pd->monthlyrevenue(1);
    $month2 = $pd->monthlyrevenue(2);
    $month3 = $pd->monthlyrevenue(3);
    $month4 = $pd->monthlyrevenue(4);
    $month5 = $pd->monthlyrevenue(5);
    $month6 = $pd->monthlyrevenue(6);
    $month7 = $pd->monthlyrevenue(7);
    $month8 = $pd->monthlyrevenue(8);
    $month9 = $pd->monthlyrevenue(9);
    $month10 = $pd->monthlyrevenue(10);
    $month11 = $pd->monthlyrevenue(11);
    $month12 = $pd->monthlyrevenue(12);
    ?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Thống kê doanh thu</h2>
            <div id="chart-container" style="text-align:center;">
                <canvas id="graph"></canvas>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            showGraph();
        });


        function showGraph() {
            var labels = [];
            var result = [];
            labels.push("Tháng 1");
            labels.push("Tháng 2");
            labels.push("Tháng 3");
            labels.push("Tháng 4");
            labels.push("Tháng 5");
            labels.push("Tháng 6");
            labels.push("Tháng 7");
            labels.push("Tháng 8");
            labels.push("Tháng 9");
            labels.push("Tháng 10");
            labels.push("Tháng 11");
            labels.push("Tháng 12");
            result.push(<?php echo $month1; ?>);
            result.push(<?php echo $month2; ?>);
            result.push(<?php echo $month3; ?>);
            result.push(<?php echo $month4; ?>);
            result.push(<?php echo $month5; ?>);
            result.push(<?php echo $month6; ?>);
            result.push(<?php echo $month7; ?>);
            result.push(<?php echo $month8; ?>);
            result.push(<?php echo $month9; ?>);
            result.push(<?php echo $month10; ?>);
            result.push(<?php echo $month11; ?>);
            result.push(<?php echo $month12; ?>);

            var pie = $("#graph");
            var myChart = new Chart(pie, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: result,
                        borderColor: ["rgba(217, 83, 79,1)", "rgba(240, 173, 78, 1)", "rgba(92, 184, 92, 1)", "rgba(51, 0, 0, 1)", "rgba(102, 51, 0, 1)", "rgba(153, 153, 0, 1)", "rgba(102, 204, 0, 1)", "rgba(0, 255, 0, 1)", "rgba(51, 255, 153, 1)", "rgba(102, 255, 255, 1)", "rgba(153,204, 255, 1)", "rgba(204, 204, 255, 1)"],
                        backgroundColor: ["rgba(217, 83, 79,0.2)", "rgba(240, 173, 78, 0.2)", "rgba(92, 184, 92, 0.2)", "rgba(51, 0, 0, 0.2)", "rgba(102, 51, 0, 0.2)", "rgba(153, 153, 0, 0.2)", "rgba(102, 204, 0, 0.2)", "rgba(0, 255, 0, 0.2)", "rgba(51, 255, 153, 0.2)", "rgba(102, 255, 255, 0.2)", "rgba(153, 204, 255, 0.2)", "rgba(204, 204, 255, 0.2)"],
                    }]
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
        $(document).ready(function() {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();
        });
    </script>
    <?php include 'inc/footer.php'; ?>
</body>