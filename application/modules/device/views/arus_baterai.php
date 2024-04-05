<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h2 class="page-title text-truncate text-dark font-weight-medium mb-1"> &nbsp; &nbsp; &nbsp; <?= $title; ?></h2>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">

        </div>
    </div>
</div>

<h1 class="page-title text-truncate text-dark font-weight-medium mb-1">
    <center> </center>
</h1>
<h1 class="page-title text-truncate text-dark font-weight-medium mb-1">
    <center> </center>
</h1>
<h1 class="page-title text-truncate text-dark font-weight-medium mb-1">
    <center> </center>
</h1>
<h1 class="page-title text-truncate text-dark font-weight-medium mb-1">
    <center> </center>
</h1>

<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Arus Baterai</h4>
            <canvas id="arus_baterai"></canvas>
        </div>
        <center><?php echo anchor('device/', '<button type="button" class="btn btn-secondary text-center">Kembali</button>'); ?> &nbsp;</center>
    </div>
</div>






</div>
</div>
</div>
</div>




<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript">
    $(document).ready(function() {
        tabel();
        window.setInterval(function() {
            tabel();
        }, 10000);
    });

    function tabel() {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>device/grafikjason/',
            async: true,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var label = [];
                var value = [];

                for (var i in data) {
                    label.push(data[i].time);
                    value.push(data[i].arus_baterai);

                }
                // Mulai buat Grafik
                var ctx = document.getElementById('arus_baterai').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: label,
                        datasets: [{
                            label: '%',
                            backgroundColor: '#0000ff',
                            borderColor: '#0000ff',
                            data: value
                        }]
                    }
                });
            }
        });
    }
</script>