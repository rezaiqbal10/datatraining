Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Ubah Data Training</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Data Training</li>
            <li class="breadcrumb-item active">Ubah Data Training</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Ubah Data</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">id Training</label>
                      <input type="text" class="form-control disabled" name="id_training" value="<?= $ubah['id_training'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama</label>
                      <input type="text" class="form-control" name="nama" value="<?= $ubah['nama'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Tempat Tinggal</label>
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
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper