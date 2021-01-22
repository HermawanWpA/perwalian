<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <?php if (session()->getFlashdata('massage')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('massage') ?>
        </div>
    <?php endif; ?>


    <!-- Page Heading -->


    <h1 class="h3 mb-2 text-gray-800">Input Data</h1>
    <div class="card-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaltambah">
            <i class="fa fa-plus"> Tambah Data</i>
        </button>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?php
            if (session()->get('err')) {
                echo "<div class='alert alert-danger p-0 pt-2' role='alert'>" . session()->get('err') . "</div>";
                session()->remove('err');
            }

            ?>
        </div>
    </div>

    <br>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NID</th>
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Materi Konsultasi</th>
                            <th>Tanggal</th>
                            <th>Hail Konsultasi</th>
                            <th>Edit</th>
                            <th>Del</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>NID</th>
                            <th>Nama Mahasiswa</th>
                            <th>Prodi</th>
                            <th>Materi Konsultasi</th>
                            <th>Tanggal</th>
                            <th>Hail Konsultasi</th>
                            <th>Edit</th>
                            <th>Del</th>
                        </tr>
                    </tfoot>
                    <?php
                    $i = 1; ?>
                    <?php foreach ($tblkonsultasi->getResultArray() as $row) : ?>

                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row['nid']; ?></td>
                            <td><?= $row['mhs_nama']; ?></td>
                            <td><?= $row['prodi']; ?></td>
                            <td><?= $row['materi_konsultasi']; ?></td>
                            <td><?= $row['tanggal']; ?></td>
                            <td><?= $row['hasil_konsultasi']; ?></td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#modalubah" id="btn-edit" class="btn btn-sm btn-warning" data-nid="<?= $row['nid']; ?>" data-mhs_nama="<?= $row['mhs_nama']; ?>" data-prodi="<?= $row['prodi']; ?>" data-materi_konsultasi="<?= $row['materi_konsultasi']; ?>" data-tanggal="<?= $row['tanggal']; ?>" data-hasil_konsultasi="<?= $row['hasil_konsultasi']; ?>">
                                    <i class="fa fa-edit"></i></button>
                            <td>
                                <a href="<?php echo base_url('konsultasi/hapus/' . $row['nid']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin menghapus data ini?')">
                                    <i class="fa fa-trash"></i>
                                </a></td>
                            </td>
                            </td>
                        </tr>

                        <?php $i++; ?>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal simpan data -->
<div class="modal fade" id="modaltambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('konsultasi/tambah'); ?>" method="post">
                    <div class="form-grup mb-0">
                        <label for="mhs_nim"></label>
                        <input type="text" name="nid" id="nid" class="form-control" placeholder="Masukan NID">
                    </div>
                    <div class="form-grup mb-0">
                        <label for="mhs_nama"></label>
                        <input type="text" name="mhs_nama" id="mhs_nama" class="form-control" placeholder="Masukan Nama">
                    </div>
                    <br>
                    <div class="col-md-12">

                        <select id="prodi" name="prodi" class="form-select">
                            <option selected>Prodi</option>
                            <option>Teknik Informatika</option>
                            <option>Sistem Informasi</option>
                            <option>Komputerisasi Akutansi</option>
                            <option>Manajemen Informatika</option>
                        </select>
                    </div>
                    <br>

                    <div class="form-grup mb-0">
                        <textarea name="materi_konsultasi" rows="5" cols="25" placeholder="Materi Konsultasi"></textarea>
                    </div>

                    <div class="form-grup mb-0">
                        <label for="tanggal"></label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Masukan Tanggal">

                    </div>
                    <br>
                    <div class="form-grup mb-0">
                        <textarea name="hasil_konsultasi" rows="5" cols="25" placeholder="Hasil Konsultasi"></textarea>
                        </textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- modal ubah data -->
<div class="modal fade" id="modalubah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('konsultasi/ubah'); ?>" method="post">
                    <input type="hidden" name="id" id="id-konsultasi">
                    <div class="form-grup mb-0">
                        <label for="nid"></label>
                        <input type="text" name="nid" id="nid" class="form-control" placeholder="Masukan NID" value="<?php echo $row['nid'] ?>" readonly>
                    </div>
                    <div class=" form-grup mb-0">
                        <label for="mhs_nama"></label>
                        <input type="text" name="mhs_nama" id="mhs_nama" class="form-control" placeholder="Masukan Nama" value="<?= $row['mhs_nama'] ?>">
                    </div>
                    <br>
                    <div class="col-md-12" value="<?= $row['prodi'] ?>">

                        <select id="prodi" name="prodi" class="form-select">
                            <option <?php echo $row['prodi']; ?>>Teknik Informatika</option>
                            <option <?php echo $row['prodi']; ?>>Sistem Informasi</option>
                            <option <?php echo $row['prodi']; ?>>Komputerisasi Akutansi</option>
                            <option <?php echo $row['prodi']; ?>>Manajemen Informatika</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="description">Materi Konsultasi</label><textarea name="materi_konsultasi" class="form-control" id="materi_konsultasi" cols="66" rows="2"><?php echo $row['materi_konsultasi'] ?></textarea></div>
                    <div class="form-group">

                        <div class="form-grup mb-0">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" placeholder="Masukan Tanggal" <?php echo $row['tanggal']; ?>>

                        </div>
                        <br>
                        <div class="form-group">
                            <label for="description">Hasil Konsultasi</label><textarea name="hasil_konsultasi" class="form-control" id="hasil_konsultasi" cols="66" rows="2"><?php echo $row['hasil_konsultasi'] ?></textarea></div>
                        <div class="form-group">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="ubah" class="btn btn-primary">Ubah Data</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>







        <?= $this->endSection(); ?>