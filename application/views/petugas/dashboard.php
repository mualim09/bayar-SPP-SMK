    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= count($pembayaran); ?></h3>

                <p>Terkonfirmasi</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('petugas/riwayatPembayaran') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= count($konfirmasi); ?></h3>

                <p>Menunggu Konfirmasi</p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
              <a href="<?= base_url('petugas/konfirmasi'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

      <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12 connectedSortable">
            <?= $this->session->flashdata('message'); ?>
                <div class="card">
                    <div class="card-header">
                        tes
                    </div>
                    <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Nomor</th>
                        <td>NISN</td>
                        <td>Nama</td>
                        <td>Bulan</td>
                        <td>Dibayar</td>
                        <td>Status</td>
                        <td>Bukti Pembayaran</td>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;?>
                        <?php foreach($konfirmasi as $k) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $k['nisn']; ?></td>
                        <td><?= $k['nama']; ?></td>
                        <td><?= $k['bulan_dibayar']; ?> <?= $k['tahun_dibayar']; ?></td>
                        <td><?= $k['tgl_bayar']; ?></td>
                        <td><?= $k['status'] ?></td>
                        <td>
                          <img class="img-fluid" style="max-width: 100px;" src="<?= base_url('assets/img/') ?><?= $k['bukti_pembayaran']; ?>" >
                        </td>
                        <td>
                          <a onclick="return confirm('Apakah anda yakin ingin mengkonfirmasi pembayaran ini?');" href="<?= base_url('petugas/accPembayaran/'); ?><?= $k['id_pembayaran']; ?>" class="badge badge-success">Konfirmasi</a>
                          <a onclick="return confirm('Apakah anda yakin ingin mengkonfirmasi pembayaran ini?');" href="<?= base_url('petugas/deletePembayaran/'); ?><?= $k['id_pembayaran']; ?>" class="badge badge-danger">Hapus</a>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </section>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>