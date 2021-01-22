<?= $this->extend('templates/index'); ?>
<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <?php if (session()->getFlashdata('massage')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('massage') ?>
        </div>
    <?php endif; ?>

    <!-- Page Heading -->

    <h1 class="h3 mb-2 text-gray-800">Tables Konsultasi</h1>
    <p class="mb-4">Hasil data Konsultasi</a>.</p>


    <div class="row">
        <div class="col-md-8">
            <?php
            if (session()->get('err')) {
                echo "<div class='alert alert-danger' role='alert'>" . session()->get('err') . "</div>";
                session()->remove('err');
            }

            ?>
        </div>
    </div>

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
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection(); ?>