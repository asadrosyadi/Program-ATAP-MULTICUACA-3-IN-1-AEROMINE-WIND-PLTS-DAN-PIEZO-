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
            <h4 class="card-title">Daya Masuk</h4>
            <canvas id="daya_masuk"></canvas>
        </div>
        <center><?php echo anchor('userdata/', '<button type="button" class="btn btn-secondary text-center">Kembali</button>'); ?> &nbsp;</center>
    </div>
</div>






</div>
</div>
</div>
</div>



<?php
foreach ($data as $u) { //untuk menampilkan variabel data yang diangkut dari controller
?>
    <?php $HWID = $u->HWID ?>
<?php } ?>
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
            url: '<?php echo base_url() ?>userdata/grafikjason/' + '<?php echo $HWID ?>',
            async: true,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var label = [];
                var value = [];

                for (var i in data) {
                    label.push(data[i].time);
                    value.push(data[i].daya_masuk);

                }
                // Mulai buat Grafik
                var ctx = document.getElementById('daya_masuk').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: label,
                        datasets: [{
                            label: '%',
                            backgroundColor: '#51acc3',
                            borderColor: '#51acc3',
                            data: value
                        }]
                    }
                });
            }
        });
    }
</script>