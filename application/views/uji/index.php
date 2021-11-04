<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Uji</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Data Uji</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- NOTIFIKASI -->
    <?php
    if ($this->session->flashdata('flash_uji')) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i>
          Data Berhasil
          <strong>
            <?= $this->session->flashdata('flash_uji');   ?>
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
                <form action="<?= base_url() ?>DataUji/hitung" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <!--  -->
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
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Training</th>
                  <th>Nama</th>
                  <th>Tempat Tinggal</th>
                  <th>Komponen Kesehatan</th>
                  <th>Komponen Pendidikan</th>
                  <th>Komponen Lain</th>
                  <th>Jumlah Penghasilan</th>
                  <th>Kondisi Rumah</th>
                  <th>Status Kelayakan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($training as $row) { ?>
                  <tr>
                    <td><?= $no ?></td>
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
                      <div class="btn-group">
                        <a href="<?= base_url() ?>DataUji/hapus/<?= $row->id_training ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                        <a href="<?= base_url() ?>DataUji/ubah/<?= $row->id_training ?>" class="btn btn-warning">update</a>
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
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hasil data Uji </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $this->session->flashdata('flash_hitung'); ?>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>