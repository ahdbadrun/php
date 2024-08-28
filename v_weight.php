<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?= session()->getFlashdata('pesan') ?>
<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Data Bobot</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="/dashboard">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Data Bobot</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <h4 class="card-title">Data Bobot</h4>
                        </div>
                        <div class="float-right">
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#TambahModal" title="Tambah latih data klasifikasi">
                                <i class="fa fa-plus mr-2"></i>
                                Latih Data
                            </button>
                            <button class="btn btn-info btn-round ml-auto" type="button" data-toggle="collapse" data-target="#info" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-info-circle mr-1"></i>Informasi
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="collapse px-3 pb-3" id="info">
                            <h5>
                                <strong>Informasi :</strong>
                            </h5>
                            <p class="mx-3 text-muted">1. Di bawah ini merupakan kumpulan data bobot yang dapat digunakan untuk perhitungan klasifikasi ketrgantungan Gadget.</p>
                            <p class="mx-3 text-muted">2. Tekan tombol &nbsp;&nbsp; <button data-nama=" Bobot ini" class="btn btn-primary btn-sm active_status">Aktifkan</button> &nbsp;&nbsp;
                                pada kolom Status untuk mengaktifkan bobot yang akan dipakai pada perhitungan klasifikasi ketergantungan Gadget.</p>
                            <p class="mx-3 text-muted">3. Tekan tombol &nbsp;&nbsp; <button type="button" data-tooltip="tooltip" title="Detail Data" class="btn btn-info btn-sm"><i class="fa fa-info"></i></button>&nbsp;&nbsp;
                                pada kolom Aksi untuk menampilkan detail bobot.</p>
                            <p class="mx-3 text-muted">4. Tekan tombol &nbsp;&nbsp; <button data-tooltip="tooltip" title="Hapus Data" type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>&nbsp;&nbsp;
                                pada kolom Aksi untuk menghapus data.</p>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="display table table-striped table-hover">
                                <thead>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Maks. Iterasi (Epoch)</th>
                                    <th>Alpha</th>
                                    <th>Akurasi</th>
                                    <th>Rasio Data</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($weight as $data) { ?>
                                        <tr>
                                            <td width="20"><?= $i++; ?>.</td>
                                            <td><?= $data['datetime_weight']; ?></td>
                                            <td><?= $data['max_epoch']; ?></td>
                                            <td><?= $data['alpha']; ?></td>
                                            <td><?= substr($data['prosentase'], 0, 5) ?>%</td>
                                            <td><?= $data['data_ratio']; ?></td>
                                            <td>
                                                <?php if ($data['status_weight'] == 1) { ?>
                                                    <span class="badge badge-pill badge-danger px-3"><b>Aktif</b></span>
                                                <?php } else { ?>
                                                    <button data-id="<?= $data['id_weight'] ?>" data-link="/weight/active/" data-nama=" Bobot ini" class="btn btn-primary btn-sm active_status"><b>Aktifkan</b></button>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-toggle="modal" data-tooltip="tooltip" title="Detail Data" data-target="#DetailModal<?= $data['id_weight'] ?>" title="" class="btn btn-info btn-sm mb-1" data-original-title="Detail">
                                                        <i class="fa fa-info"></i>
                                                    </button>&nbsp;
                                                    <button data-tooltip="tooltip" title="Hapus Data" type="button" data-id="<?= $data['id_weight'] ?>" data-link="/Weight/delete/" data-nama=" Weight <?= $data['id_weight'] ?>" id="hapus_crud" class="btn btn-danger btn-sm mb-1 hapus_crud"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </td>
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
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h3 class="modal-title">
                    <span class="fw-mediumbold">
                        Latih Data Klasifikasi</span>
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url() ?>/weight/latih" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Tanggal</label>
                                <input id="datetime" type="text" name="datetime" readonly value="<?= date('Y-m-d H:i:s') ?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default mx-0">
                                <label>Maks. Iterasi (Epoch)</label>
                                <select class="form-control" name="max_epoch" id="max_epoch" required>
                                    <option value="">-- Pilih Maksimum Iterasi --</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                    <option value="1000">1000</option>
                                    <option value="1500">1500</option>
                                    <option value="3000">3000</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default mx-0">
                                <label>Alpha</label>
                                <input id="alpha" type="number" name="alpha" pattern="^(?:0*(?:\.\d+)?|1(\.0*)?)$" class="form-control" value="0.00" step="0.01" min="0" max="1.00" placeholder="Masukkan nilai antara 0.0 - 0.1" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Rasio Pembagian Data (Latih/Uji)</label>
                                <select class="form-control" name="data_ratio" id="data_ratio" required>
                                    <option value="">-- Pilih Rasio Data --</option>
                                    <option value="90:10">90:10</option>
                                    <option value="80:20">80:20</option>
                                    <option value="70:30">70:30</option>
                                    <option value="60:40">60:40</option>
                                    <option value="50:50">50:50</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-bd">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="DetailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h3 class="modal-title">
                    <span class="fw-mediumbold">
                        Detail Hasil Klasifikasi</span>
                </h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Tanggal</label>
                                <input id="nama_orangtua" type="text" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default mx-0">
                                <label>Maks. Iterasi (Epoch)</label>
                                <input id="kelas" type="text" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default mx-0">
                                <label>Alpha</label>
                                <input id="pertanyaantu" type="text" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-group-default">
                                <label>Status</label>
                                <textarea id="hasil" type="text" readonly class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php
foreach ($weight as $rowWeight) { ?>
    <!-- Modal Detail -->
    <div class="modal fade" id="DetailModal<?= $rowWeight['id_weight'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        <span class="fw-mediumbold">
                            Detail Data Bobot Terbaik</span>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mb-0">
                    <form role="form">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mx-0">
                                    <div class="form-group">
                                        <table id="result" class="display table table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <td>ID Bobot</td>
                                                    <td><?= $rowWeight['id_weight'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td><?= $rowWeight['datetime_weight'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Maks. Iterasi (Epoch)</td>
                                                    <td><?= $rowWeight['max_epoch'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Alpha</td>
                                                    <td><?= $rowWeight['alpha'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Rasio Data</td>//penambahan
                                                    <td><?= $rowWeight['data_ratio'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td>
                                                        <?php if ($data['status_weight'] == 1) { ?>
                                                            <span class="badge badge-pill badge-danger px-3">Aktif</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-pill badge-danger px-3">Nonaktif</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Akurasi</td>
                                                    <td><span class="badge badge-pill badge-primary px-3"><?= substr($rowWeight['prosentase'], 0, 5) ?>%</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <table id="result" class="display table table-bordered-bd-info table-hover">
                                            <thead class="bg-info text-light text-bold text-center">
                                                <th>Bobot Kelas Tinggi</th>
                                                <th>Nilai</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Waktu bermain gadget anak saya bisa dikontrol.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_satu'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya selalu menggunakan gadget saat mau bermain dengan teman-temannya.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_dua'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya cenderung diam ketika diambil gadget nya, meskipun anak saya sedang asik menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_tiga'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya sering bermain gadget saat makan.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_empat'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya jujur jika ditanya orang tua berapa lama anak saya menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_lima'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Prestasi anak saya sangat buruk di sekolah.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_enam'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Permainan edukasi lebih banyak di dalam gadget anak saya.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_tujuh'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya lebih sering berbicara terkait permainan game dan apa yang dilihat di dalam gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_delapan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya tidak mengalami penyakit mata walaupun anak saya menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_sembilan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya lebih sering menggunakan gadget daripada membaca buku pada saat waktu senggang.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_sepuluh'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu bermain gadget anak saya kurang dari 6 jam/hari pada saat liburan.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_sebelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya percaya diri ketika membicarakan permainan yang ada di dalam game nya.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_duabelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Gadget tidak mengganggu rutinitas mandi/makan anak saya saat liburan / weekend.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_tigabelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya jarang menyapa orang tua ketika fokus dengan gadget nya.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_empatbelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya tetap sibuk dengan aktifitas nya tanpa merengek ke orangtua karena ingin menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_limabelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu bermain gadget anak saya berlebihan/susah dikontrol.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_enambelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya tergolong anak saya yang mudah untuk bersosialisasi.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_tujuhbelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya marah ketika diambil gadget nya, pada saat anak saya sedang asik menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_delapanbelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya selalu tidur tepat waktu walaupun anak saya menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_sembilanbelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya berbohong jika ditanya orang tua berapa lama anak saya menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_duapuluh'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya menyapa orang tua meskipun sedang fokus dengan gadget nya.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_duasatu'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Permainan game selain permainan banyak di dalam gadget anak saya.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_duadua'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya menghindari teman-temannya yang sedang membicarakan game yang ada di dalam gadget nya.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_duatiga'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya mengalami penyakit mata yang disebabkan penggunaan gadget berlebihan.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_duaempat'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya lebih sering membaca buku dari pada menggunakan gadget saat waktu senggang.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_dualima'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu bermain gadget anak saya lebih dari 6 jam/hari pada saat liburan.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_duaenam'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya lebih sering berbicara terkait kegiatan di sekolah atau pelajaran daripada game yang ada di gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_duatujuh'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Gadget mengganggu rutinitas mandi/makan anak saya saat liburan / weekend.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_duadelapan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Prestasi anak saya cukup baik di sekolah.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_duasembilan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya gelisah/merengek saat tidak menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_tigapuluh'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya langsung makan tanpa sibuk menggunakan Gadget nya.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_tigasatu'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya susah untuk bersosialisasi.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_tigadua'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya langsung bermain bersama tanpa sibuk bermain gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_tigatiga'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Pola tidur anak saya terganggu karena menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wa_pertanyaan_tigaempat'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <table id="result" class="display table table-bordered-bd-success table-hover">
                                            <thead class="bg-success text-light text-bold text-center">
                                                <th>Bobot Kelas Negatif</th>
                                                <th>Nilai</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Waktu bermain gadget anak saya bisa dikontrol.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_satu'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya selalu menggunakan gadget saat mau bermain dengan teman-temannya.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_dua'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya cenderung diam ketika diambil gadget nya, meskipun anak saya sedang asik menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_tiga'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya sering bermain gadget saat makan.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_empat'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya jujur jika ditanya orang tua berapa lama anak saya menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_lima'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Prestasi anak saya sangat buruk di sekolah.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_enam'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Permainan edukasi lebih banyak di dalam gadget anak saya.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_tujuh'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya lebih sering berbicara terkait permainan game dan apa yang dilihat di dalam gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_delapan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya tidak mengalami penyakit mata walaupun anak saya menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_sembilan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya lebih sering menggunakan gadget daripada membaca buku pada saat waktu senggang.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_sepuluh'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu bermain gadget anak saya kurang dari 6 jam/hari pada saat liburan.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_sebelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya percaya diri ketika membicarakan permainan yang ada di dalam game nya.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_duabelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Gadget tidak mengganggu rutinitas mandi/makan anak saya saat liburan / weekend.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_tigabelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya jarang menyapa orang tua ketika fokus dengan gadget nya.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_empatbelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya tetap sibuk dengan aktifitas nya tanpa merengek ke orangtua karena ingin menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_limabelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu bermain gadget anak saya berlebihan/susah dikontrol.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_enambelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya tergolong anak saya yang mudah untuk bersosialisasi.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_tujuhbelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya marah ketika diambil gadget nya, pada saat anak saya sedang asik menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_delapanbelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya selalu tidur tepat waktu walaupun anak saya menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_sembilanbelas'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya berbohong jika ditanya orang tua berapa lama anak saya menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_duapuluh'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya menyapa orang tua meskipun sedang fokus dengan gadget nya.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_duasatu'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Permainan game selain permainan banyak di dalam gadget anak saya.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_duadua'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya menghindari teman-temannya yang sedang membicarakan game yang ada di dalam gadget nya.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_duatiga'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya mengalami penyakit mata yang disebabkan penggunaan gadget berlebihan.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_duaempat'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya lebih sering membaca buku dari pada menggunakan gadget saat waktu senggang.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_dualima'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu bermain gadget anak saya lebih dari 6 jam/hari pada saat liburan.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_duaenam'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya lebih sering berbicara terkait kegiatan di sekolah atau pelajaran daripada game yang ada di gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_duatujuh'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Gadget mengganggu rutinitas mandi/makan anak saya saat liburan / weekend.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_duadelapan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Prestasi anak saya cukup baik di sekolah.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_duasembilan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya gelisah/merengek saat tidak menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_tigapuluh'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya langsung makan tanpa sibuk menggunakan Gadget nya.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_tigasatu'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya susah untuk bersosialisasi.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_tigadua'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Anak saya langsung bermain bersama tanpa sibuk bermain gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_tigatiga'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Pola tidur anak saya terganggu karena menggunakan gadget.</td>
                                                    <td><?= $rowWeight['wb_pertanyaan_tigaempat'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete"> <i class="fa fa-times"></i> </button> </div> </td>';
        <?= session()->getFlashdata('pesan'); ?>
    });
</script>
<?= $this->endSection(); ?>