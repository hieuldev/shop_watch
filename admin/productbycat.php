<style type="text/css">
    #chart-container {
        width: 80%;
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
    $list = $pd->totalproductbycat();
    ?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Số lượng sản phẩm theo danh mục</h2>
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
            var formStatusVar = [];
            var total = [];
            <?php
            foreach ($list as $pd) {?>
                formStatusVar.push("<?php echo $pd['_id'];?>");
                total.push("<?php echo $pd['total'];?>");
               // echo $pd['_id'];
           <?php } ?>;
            var options = {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        display: true
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            var myChart = {
                labels: formStatusVar,
                datasets: [{
                    label: 'Tổng số',
                    backgroundColor: '#17cbd1',
                    borderColor: '#46d5f1',
                    hoverBackgroundColor: '#0ec2b6',
                    hoverBorderColor: '#42f5ef',
                    data: total
                }]
            };

            var bar = $("#graph");
            var barGraph = new Chart(bar, {
                type: 'bar',
                data: myChart,
                options: options
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