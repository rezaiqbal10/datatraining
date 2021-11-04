Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Training</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Training</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_training')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_training');   ?>
          </strong>
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Tambah Data</h5>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="<?= base_url() ?>DataTraining/validation_form" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Id Training</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="id_training">
                    </div> -->
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama Penduduk</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="nama" autofocus>
                    </div>
                    <div class="form-group">
                      <label>Tempat tiggal</label>
                      <select class="form-control" name="tempat_tinggal">
                        <option value="kontrak">Kontrak</option>
                        <option value="miliksendiri">Milik Sendiri</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Komponen Kesehatan</label>
                      <select class="form-control" name="komp_kes">
                        <option value="usiadini">Ibu Hamil</option>
                        <option value="usiadini">Usia Dini</option>
                        <option value="tidakada">Tidak ada</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Komponen Pendidikan</label>
                      <select class="form-control" name="komp_pend">
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Komponen Lain</label>
                      <select class="form-control" name="komp_lain">
                        <option value="disabilitas">Disabilitas</option>
                        <option value="lansia">Lansia</option>
                        <option value="tidakada">Tidak ada</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Jumlah Penghasilan</label>
                      <select class="form-control" name="jml_penghasilan">
                        <option value=">Rp.2.500.000">>RP.2.500.000</option>
                        <option value="Rp.1.500.000">Rp.1.500.000</option>
                        <option value="<RP.1500.000">
                          <=RP.1.500.000 </option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Kondisi Rumah</label>
                      <select class="form-control" name="kondisi_rumah">
                        <option value="batupermanen">Batu Permanen</option>
                        <option value="bambuanyam">Bambu Anyam</option>
                        <option value="papan">papan</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Status Kelayakan</label>
                      <select class="form-control" name="status_kelayakan">
                        <option value="layak">Layak</option>
                        <option value="tidak layak">Tidak Layak</option>
                      </select>
                    </div>

                    <input type="submit" name="save" class="btn btn-primary" value="Save">
                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- list data -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- card-body -->

          <div class="row">
            <div class="col-md-5">
              <div class="navbar-form navbar-right ">
                <?php echo form_open('DataTraining/search') ?>
                <input type="text" class="form-control form-control-navbar" autofocus autocomplete="off" type="search" name="cari" placeholder="Search">
                <!-- <button type="submit" class="btn btn-success btn-right">cari</button> -->
                <button type="submit" class="btn btn-navbar">
                  <i class="fas fa-search"></i>
                </button>

                <?php echo form_close() ?>
              </div>
            </div>

          </div>


          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>

                  <th>Id Training</th>
                  <th>Nama</th>
                  <th>Tempat Tinggal</th>
                  <th>Komponen Kesehatan</th>
                  <th>Komponen Pendidikan</th>
                  <th>Komponen Lainya</th>
                  <th>Jumlah Penghasilan</th>
                  <th>Kondisi rumah</th>
                  <th>Status Kelayakan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($training as $row) { ?>
                  <tr>

                    <td><?= $row->id_training ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->tempat_tinggal ?></td>
                    <td><?= $row->komp_kes ?></td>
                    <td><?= $row->komp_pend ?></td>
                    <td><?= $row->komp_lain ?></td>
                    <td><?= $row->jml_penghasilan ?></td>
                    <td><?= $row->kondisi_rumah ?></td>
                    <td><?= $row->status_kelayakan ?></td>


                    <td>
                      <div class="btn-group-md-7">
                        <a href="<?= base_url() ?>DataTraining/hapus/<?= $row->id_training ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                        <a href="<?= base_url() ?>DataTraining/ubah/<?= $row->id_training ?>" class="btn btn-warning">update</a>
                      </div>
                    </td>
                  </tr>
                <?php
                  $no++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</section>


</div>
</div>
</div>

<!-- /.content -->
</div>
<!-- /.content-wrapper