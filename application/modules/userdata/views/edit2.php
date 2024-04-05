<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php
                    foreach ($data2 as $d) { //untuk menampilkan variabel data yang diangkut dari controller
                    ?>
                        <h2 class="card-title">Change User</h4>
                            <?php
                            echo form_open_multipart('userdata/edit', 'role="form" class="form-horizontal"');
                            echo form_hidden('id', $d->id);
                            ?>
                            <div class="form-group input-rounded">
                                <label>Name</label>
                                <input type="text" value="<?php echo $d->name ?>" class="form-control" name="name">
                            </div>
                            <div class="form-group input-rounded">
                                <label>Email</label>
                                <input type="text" value="<?php echo $d->email ?>" class="form-control" name="email" readonly>
                            </div>
                            <div class="form-group input-rounded">
                                <label>Image</label>
                                <div class="col-md-4">
                                    <img src="<?= base_url('assets/img/profile/') . $d->image; ?>" class="card-img">
                                </div>
                            </div>
                            <div class="form-group input-rounded">
                                <label>Change Image</label>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group input-rounded">
                                <label>Role Id</label>
                                <div class="input-group mb-3">
                                    <select class="form-select custom-select" aria-label="role_id" name="role_id">
                                        <option value="2">User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group input-rounded">
                                <label for="is_active">Is Active</label>
                                <select class="form-select custom-select" id="is_active" name="is_active">
                                    <option value="0">Not Active</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>

                            <div class="form-group input-rounded">
                                <label>Token Hardware</label>
                                <input type="text" value="<?php echo $d->token ?>" class="form-control" name="token">
                            </div>
                            <div class="form-group input-rounded">
                                <label>HWID</label>
                                <input type="text" value="<?php echo $d->HWID ?>" class="form-control" name="HWID" readonly>
                            </div>
                            <div class="form-group input-rounded">
                                <label>Created</label>
                                <?= date('d F Y', $d->date_created); ?>
                            </div>
                            <div class="form-inline">
                            </div>
                            <div class="form-group" style="text-align:center;">

                                <?= anchor('userdata/', '<button type="button" class="btn btn-secondary text-center">kembali</button>'); ?>
                                <button type="submit" name="submit" value="submit" class="btn btn-success">Ubah</button>
                            </div>
                            </br>
                            </br>
                            </br>
                        <?php } ?>
                </div>
            </div>