<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h1 class="page-title text-truncate text-dark font-weight-medium mb-1">&nbsp; &nbsp; &nbsp; <?= $title; ?></h1>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center text-right">
            <?php foreach ($data2 as $u) : ?> <!-- Mulai perulangan di sini -->
                <h7 class="ml-auto">Update Terakhir : <?= $u->time ?> &nbsp; &nbsp; &nbsp;</h7>
            <?php endforeach; ?> <!-- Akhiri perulangan di sini -->
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="table table-hover">
                <div class="card-body">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1 text-center">Charge Controller</h4>
                    <div class="table-responsive">
                        <table id="datatable" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Time</th>
                                    <th>Arus Masuk (mA)</th>
                                    <th>Tegangan Masuk (V)</th>
                                    <th>Daya Masuk (Watt)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $u) { //untuk menampilkan variabel data yang diangkut dari controller
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $u->time ?></td>
                                        <td><?php echo $u->arus_masuk ?></td>
                                        <td><?php echo $u->tegangan_masuk ?></td>
                                        <td><?php echo $u->daya_masuk ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="table table-hover">
                <div class="card-body">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1 text-center">Hasil Pembangkit Listrik</h4>
                    <div class="table-responsive">
                        <table id="datatable2" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Time</th>
                                    <th>Arus Baterai (mA)</th>
                                    <th>Tegangan Baterai (V)</th>
                                    <th>Daya Baterai (Watt)</th>
                                    <th>Presentase Daya Baterai (%)</th>
                                    <th>Arus Keluar (mA)</th>
                                    <th>Tegangan Keluar (V)</th>
                                    <th>Daya Keluar (Watt)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $u) { //untuk menampilkan variabel data yang diangkut dari controller
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $u->time ?></td>
                                        <td><?php echo $u->arus_baterai ?></td>
                                        <td><?php echo $u->tegangan_baterai ?></td>
                                        <td><?php echo $u->daya_baterai ?></td>
                                        <td><?php echo $u->presentase_baterai ?></td>
                                        <td><?php echo $u->arus_keluar ?></td>
                                        <td><?php echo $u->tegnagan_keluar ?></td>
                                        <td><?php echo $u->daya_keluar ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="table table-hover">
                <div class="card-body">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1 text-center">Inverter Pure Sine Wave</h4>
                    <div class="table-responsive">
                        <table id="datatable3" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Time</th>
                                    <th>Arus AC (V)</th>
                                    <th>Tegangan AC (V)</th>
                                    <th>Daya AKtif (Watt)</th>
                                    <th>Daya Reaktif (WAR)</th>
                                    <th>Daya Semu (VA)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $u) { //untuk menampilkan variabel data yang diangkut dari controller
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $u->time ?></td>
                                        <td><?php echo $u->arus_ac ?></td>
                                        <td><?php echo $u->tengangan_ac ?></td>
                                        <td><?php echo $u->daya_aktif ?></td>
                                        <td><?php echo $u->daya_reaktif ?></td>
                                        <td><?php echo $u->daya_semu ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group" style="text-align:center;">

    <?= anchor('userdata/', '<button type="button" class="btn btn-secondary text-center">kembali</button>'); ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'csv'
            ]
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable2').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'csv'
            ]
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable3').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'csv'
            ]
        });
    });
</script>