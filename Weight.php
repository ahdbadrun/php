<?php

namespace App\Controllers;

use App\Models\TrainingModel;
use App\Models\WeightModel;
use App\Models\ClassModel;
use App\Models\LoginModel;

class Weight extends BaseController
{
    protected $TrainingModel;
    //3 item di tambah
    protected $weightModel;
    protected $classModel;
    protected $loginModel;

    public function __construct()
    {
        $this->TrainingModel = new TrainingModel;
        $this->weightModel = new WeightModel;
        $this->classModel = new ClassModel;
        $this->loginModel = new LoginModel;
    }

    public function index()
    {
        $username = $this->loginModel->where(['nama_user' => session()->get('username')])->first();
        if ($username == NULL) {
            session()->setFlashdata('pesan', $this->notify('Peringatan!', 'Untuk mengakses halaman data bobot, login terlebih dahulu!', 'warning', 'error'));
            return redirect()->to("/auth");
        }

        $data = [
            'title' => 'Data Bobot',
            'weight' => $this->weightModel->findAll(),
        ];

        echo view('v_weight', $data);
    }

    public function active($id)
    {
        $update = [
            'status_weight' => 1
        ];

        $this->weightModel->nonactive();
        $this->weightModel->update($id, $update);
        session()->setFlashdata('pesan', $this->notify('Selamat!', 'Berhasil mengaktifkan data.', 'success', 'success'));
        return redirect()->to("/weight");
    }

    public function delete($id)
    {
        $this->weightModel->delete(['id' => $id]);
        session()->setFlashdata('pesan', $this->notify('Selamat!', 'Berhasil menghapus data.', 'success', 'success'));
        return redirect()->to("/weight");
    }

    function notify($title, $message, $type, $icon)
    {
        $pesan = "$.notify({
            icon: 'flaticon-$icon',
            title: '$title',
            message: '$message',
        },{
            type: '$type',
            placement: {
                from: 'top',
                align: 'center'
            },
            time: 1000,
        });";
        return $pesan;
    }

    public function latih()
    {
        d($this->request->getPost());

        // Menerima input dari form modal
        $alpha = $this->request->getPost('alpha');
        $max_epoch = $this->request->getPost('max_epoch');
        $data_ratio = $this->request->getPost('data_ratio'); // Rasio data latih:uji (misal: 80:20)
        $classPerhitungan = 0;

        set_time_limit(600); // Untuk mengatur batas waktu perhitungan bobot

        // Ambil semua data
        $train = $this->TrainingModel->findAll();
        $numrow = $this->TrainingModel->countAll();

        // Pembagian data latih dan uji berdasarkan rasio yang dipilih
        list($trainRatio, $testRatio) = explode(':', $data_ratio);
        $trainCount = round(($trainRatio / 100) * $numrow);
        $testCount = $numrow - $trainCount;

        // Mengacak urutan data
        shuffle($train);

        // Memisahkan data menjadi data latih dan data uji
        $trainData = array_slice($train, 0, $trainCount);
        $testData = array_slice($train, $trainCount, $testCount);

        // Perulangan iterasi sesuai nilai max epoch
        for ($i = 1; $i <= $max_epoch; $i++) :
            $j = 1;
            d($trainRatio); // Verifikasi nilai trainRatio
            d($testRatio);  // Verifikasi nilai testRatio
            d($trainCount); // Verifikasi jumlah data latih
            d($testCount);  // Verifikasi jumlah data uji
            d(count($trainData)); // Verifikasi jumlah data latih yang diambil
            d(count($testData));  // Verifikasi jumlah data uji yang diambil
            d($numrow); // Verifikasi total data
            d($trainCount); // Verifikasi jumlah data latih
            d($testCount); // Verifikasi jumlah data uji

            // Perulangan sesuai banyaknya baris data pada dataset latih
            foreach ($trainData as $row) :
                $tr_pertanyaan_satu = $row['tr_pertanyaan_satu'];
                $tr_pertanyaan_dua = $row['tr_pertanyaan_dua'];
                $tr_pertanyaan_tiga = $row['tr_pertanyaan_tiga'];
                $tr_pertanyaan_empat = $row['tr_pertanyaan_empat'];
                $tr_pertanyaan_lima = $row['tr_pertanyaan_lima'];
                $tr_pertanyaan_enam = $row['tr_pertanyaan_enam'];
                $tr_pertanyaan_tujuh = $row['tr_pertanyaan_tujuh'];
                $tr_pertanyaan_delapan = $row['tr_pertanyaan_delapan'];
                $tr_pertanyaan_sembilan = $row['tr_pertanyaan_sembilan'];
                $tr_pertanyaan_sepuluh = $row['tr_pertanyaan_sepuluh'];
                $tr_pertanyaan_sebelas = $row['tr_pertanyaan_sebelas'];
                $tr_pertanyaan_duabelas = $row['tr_pertanyaan_duabelas'];
                $tr_pertanyaan_tigabelas = $row['tr_pertanyaan_tigabelas'];
                $tr_pertanyaan_empatbelas = $row['tr_pertanyaan_empatbelas'];
                $tr_pertanyaan_limabelas = $row['tr_pertanyaan_limabelas'];
                $tr_pertanyaan_enambelas = $row['tr_pertanyaan_enambelas'];
                $tr_pertanyaan_tujuhbelas = $row['tr_pertanyaan_tujuhbelas'];
                $tr_pertanyaan_delapanbelas = $row['tr_pertanyaan_delapanbelas'];
                $tr_pertanyaan_sembilanbelas = $row['tr_pertanyaan_sembilanbelas'];
                $tr_pertanyaan_duapuluh = $row['tr_pertanyaan_duapuluh'];
                $tr_pertanyaan_duasatu = $row['tr_pertanyaan_duasatu'];
                $tr_pertanyaan_duadua = $row['tr_pertanyaan_duadua'];
                $tr_pertanyaan_duatiga = $row['tr_pertanyaan_duatiga'];
                $tr_pertanyaan_duaempat = $row['tr_pertanyaan_duaempat'];
                $tr_pertanyaan_dualima = $row['tr_pertanyaan_dualima'];
                $tr_pertanyaan_duaenam = $row['tr_pertanyaan_duaenam'];
                $tr_pertanyaan_duatujuh = $row['tr_pertanyaan_duatujuh'];
                $tr_pertanyaan_duadelapan = $row['tr_pertanyaan_duadelapan'];
                $tr_pertanyaan_duasembilan = $row['tr_pertanyaan_duasembilan'];
                $tr_pertanyaan_tigapuluh = $row['tr_pertanyaan_tigapuluh'];
                $tr_pertanyaan_tigasatu = $row['tr_pertanyaan_tigasatu'];
                $tr_pertanyaan_tigadua = $row['tr_pertanyaan_tigadua'];
                $tr_pertanyaan_tigatiga = $row['tr_pertanyaan_tigatiga'];
                $tr_pertanyaan_tigaempat = $row['tr_pertanyaan_tigaempat'];

                // Mengambil kode kelas pada dataset (positif atau negatif)
                $classDatabase = $this->classModel->where('id_class', $row['id_class'])->findAll();

                if (!empty($classDatabase) && isset($classDatabase[0]['code_class'])) {
                    $codeClass = $classDatabase[0]['code_class'];
                } else {
                    // Handle the case where no data was found or code_class does not exist
                    $codeClass = null; // Atau Anda bisa melakukan tindakan lain yang sesuai
                }

                // Perulangan dilakukan selama iterasi kurang dari max_epoch dan baris data latih belum sama dengan total data latih
                if (($i < $max_epoch) || ($j < $numrow)) {
                    // Ketika iterasi pertama dan baris data pertama, random antara 0 dan 1 pada weight
                    if (($i == 1) && ($j == 1)) {
                        $wa_pertanyaan_satu = rand(0, 1);
                        $wa_pertanyaan_dua = rand(0, 1);
                        $wa_pertanyaan_tiga = rand(0, 1);
                        $wa_pertanyaan_empat = rand(0, 1);
                        $wa_pertanyaan_lima = rand(0, 1);
                        $wa_pertanyaan_enam = rand(0, 1);
                        $wa_pertanyaan_tujuh = rand(0, 1);
                        $wa_pertanyaan_delapan = rand(0, 1);
                        $wa_pertanyaan_sembilan = rand(0, 1);
                        $wa_pertanyaan_sepuluh = rand(0, 1);
                        $wa_pertanyaan_sebelas = rand(0, 1);
                        $wa_pertanyaan_duabelas = rand(0, 1);
                        $wa_pertanyaan_tigabelas = rand(0, 1);
                        $wa_pertanyaan_empatbelas = rand(0, 1);
                        $wa_pertanyaan_limabelas = rand(0, 1);
                        $wa_pertanyaan_enambelas = rand(0, 1);
                        $wa_pertanyaan_tujuhbelas = rand(0, 1);
                        $wa_pertanyaan_delapanbelas = rand(0, 1);
                        $wa_pertanyaan_sembilanbelas = rand(0, 1);
                        $wa_pertanyaan_duapuluh = rand(0, 1);
                        $wa_pertanyaan_duasatu = rand(0, 1);
                        $wa_pertanyaan_duadua = rand(0, 1);
                        $wa_pertanyaan_duatiga = rand(0, 1);
                        $wa_pertanyaan_duaempat = rand(0, 1);
                        $wa_pertanyaan_dualima = rand(0, 1);
                        $wa_pertanyaan_duaenam = rand(0, 1);
                        $wa_pertanyaan_duatujuh = rand(0, 1);
                        $wa_pertanyaan_duadelapan = rand(0, 1);
                        $wa_pertanyaan_duasembilan = rand(0, 1);
                        $wa_pertanyaan_tigapuluh = rand(0, 1);
                        $wa_pertanyaan_tigasatu = rand(0, 1);
                        $wa_pertanyaan_tigadua = rand(0, 1);
                        $wa_pertanyaan_tigatiga = rand(0, 1);
                        $wa_pertanyaan_tigaempat = rand(0, 1);


                        $wb_pertanyaan_satu = rand(0, 1);
                        $wb_pertanyaan_dua = rand(0, 1);
                        $wb_pertanyaan_tiga = rand(0, 1);
                        $wb_pertanyaan_empat = rand(0, 1);
                        $wb_pertanyaan_lima = rand(0, 1);
                        $wb_pertanyaan_enam = rand(0, 1);
                        $wb_pertanyaan_tujuh = rand(0, 1);
                        $wb_pertanyaan_delapan = rand(0, 1);
                        $wb_pertanyaan_sembilan = rand(0, 1);
                        $wb_pertanyaan_sepuluh = rand(0, 1);
                        $wb_pertanyaan_sebelas = rand(0, 1);
                        $wb_pertanyaan_duabelas = rand(0, 1);
                        $wb_pertanyaan_tigabelas = rand(0, 1);
                        $wb_pertanyaan_empatbelas = rand(0, 1);
                        $wb_pertanyaan_limabelas = rand(0, 1);
                        $wb_pertanyaan_enambelas = rand(0, 1);
                        $wb_pertanyaan_tujuhbelas = rand(0, 1);
                        $wb_pertanyaan_delapanbelas = rand(0, 1);
                        $wb_pertanyaan_sembilanbelas = rand(0, 1);
                        $wb_pertanyaan_duapuluh = rand(0, 1);
                        $wb_pertanyaan_duasatu = rand(0, 1);
                        $wb_pertanyaan_duadua = rand(0, 1);
                        $wb_pertanyaan_duatiga = rand(0, 1);
                        $wb_pertanyaan_duaempat = rand(0, 1);
                        $wb_pertanyaan_dualima = rand(0, 1);
                        $wb_pertanyaan_duaenam = rand(0, 1);
                        $wb_pertanyaan_duatujuh = rand(0, 1);
                        $wb_pertanyaan_duadelapan = rand(0, 1);
                        $wb_pertanyaan_duasembilan = rand(0, 1);
                        $wb_pertanyaan_tigapuluh = rand(0, 1);
                        $wb_pertanyaan_tigasatu = rand(0, 1);
                        $wb_pertanyaan_tigadua = rand(0, 1);
                        $wb_pertanyaan_tigatiga = rand(0, 1);
                        $wb_pertanyaan_tigaempat = rand(0, 1);
                    }

                    // Perhitungan bobot pada kelas positif
                    $result_a = sqrt(
                        pow(($tr_pertanyaan_satu - $wa_pertanyaan_satu), 2) +
                            pow(($tr_pertanyaan_dua - $wa_pertanyaan_dua), 2) +
                            pow(($tr_pertanyaan_tiga - $wa_pertanyaan_tiga), 2) +
                            pow(($tr_pertanyaan_empat - $wa_pertanyaan_empat), 2) +
                            pow(($tr_pertanyaan_lima - $wa_pertanyaan_lima), 2) +
                            pow(($tr_pertanyaan_enam - $wa_pertanyaan_enam), 2) +
                            pow(($tr_pertanyaan_tujuh - $wa_pertanyaan_tujuh), 2) +
                            pow(($tr_pertanyaan_delapan - $wa_pertanyaan_delapan), 2) +
                            pow(($tr_pertanyaan_sembilan - $wa_pertanyaan_sembilan), 2) +
                            pow(($tr_pertanyaan_sepuluh - $wa_pertanyaan_sepuluh), 2) +
                            pow(($tr_pertanyaan_sebelas - $wa_pertanyaan_sebelas), 2) +
                            pow(($tr_pertanyaan_duabelas - $wa_pertanyaan_duabelas), 2) +
                            pow(($tr_pertanyaan_tigabelas - $wa_pertanyaan_tigabelas), 2) +
                            pow(($tr_pertanyaan_empatbelas - $wa_pertanyaan_empatbelas), 2) +
                            pow(($tr_pertanyaan_limabelas - $wa_pertanyaan_limabelas), 2) +
                            pow(($tr_pertanyaan_enambelas - $wa_pertanyaan_enambelas), 2) +
                            pow(($tr_pertanyaan_tujuhbelas - $wa_pertanyaan_tujuhbelas), 2) +
                            pow(($tr_pertanyaan_delapanbelas - $wa_pertanyaan_delapanbelas), 2) +
                            pow(($tr_pertanyaan_sembilanbelas - $wa_pertanyaan_sembilanbelas), 2) +
                            pow(($tr_pertanyaan_duapuluh - $wa_pertanyaan_duapuluh), 2) +
                            pow(($tr_pertanyaan_duasatu - $wa_pertanyaan_duasatu), 2) +
                            pow(($tr_pertanyaan_duadua - $wa_pertanyaan_duadua), 2) +
                            pow(($tr_pertanyaan_duatiga - $wa_pertanyaan_duatiga), 2) +
                            pow(($tr_pertanyaan_duaempat - $wa_pertanyaan_duaempat), 2) +
                            pow(($tr_pertanyaan_dualima - $wa_pertanyaan_dualima), 2) +
                            pow(($tr_pertanyaan_duaenam - $wa_pertanyaan_duaenam), 2) +
                            pow(($tr_pertanyaan_duatujuh - $wa_pertanyaan_duatujuh), 2) +
                            pow(($tr_pertanyaan_duadelapan - $wa_pertanyaan_duadelapan), 2) +
                            pow(($tr_pertanyaan_duasembilan - $wa_pertanyaan_duasembilan), 2) +
                            pow(($tr_pertanyaan_tigapuluh - $wa_pertanyaan_tigapuluh), 2) +
                            pow(($tr_pertanyaan_tigasatu - $wa_pertanyaan_tigasatu), 2) +
                            pow(($tr_pertanyaan_tigadua - $wa_pertanyaan_tigadua), 2) +
                            pow(($tr_pertanyaan_tigatiga - $wa_pertanyaan_tigatiga), 2) +
                            pow(($tr_pertanyaan_tigaempat - $wa_pertanyaan_tigaempat), 2)
                    );

                    // Perhitungan bobot pada kelas negatif
                    $result_b = sqrt(
                        pow(($tr_pertanyaan_satu - $wb_pertanyaan_satu), 2) +
                            pow(($tr_pertanyaan_dua - $wb_pertanyaan_dua), 2) +
                            pow(($tr_pertanyaan_tiga - $wb_pertanyaan_tiga), 2) +
                            pow(($tr_pertanyaan_empat - $wb_pertanyaan_empat), 2) +
                            pow(($tr_pertanyaan_lima - $wb_pertanyaan_lima), 2) +
                            pow(($tr_pertanyaan_enam - $wb_pertanyaan_enam), 2) +
                            pow(($tr_pertanyaan_tujuh - $wb_pertanyaan_tujuh), 2) +
                            pow(($tr_pertanyaan_delapan - $wb_pertanyaan_delapan), 2) +
                            pow(($tr_pertanyaan_sembilan - $wb_pertanyaan_sembilan), 2) +
                            pow(($tr_pertanyaan_sepuluh - $wb_pertanyaan_sepuluh), 2) +
                            pow(($tr_pertanyaan_sebelas - $wb_pertanyaan_sebelas), 2) +
                            pow(($tr_pertanyaan_duabelas - $wb_pertanyaan_duabelas), 2) +
                            pow(($tr_pertanyaan_tigabelas - $wb_pertanyaan_tigabelas), 2) +
                            pow(($tr_pertanyaan_empatbelas - $wb_pertanyaan_empatbelas), 2) +
                            pow(($tr_pertanyaan_limabelas - $wb_pertanyaan_limabelas), 2) +
                            pow(($tr_pertanyaan_enambelas - $wb_pertanyaan_enambelas), 2) +
                            pow(($tr_pertanyaan_tujuhbelas - $wb_pertanyaan_tujuhbelas), 2) +
                            pow(($tr_pertanyaan_delapanbelas - $wb_pertanyaan_delapanbelas), 2) +
                            pow(($tr_pertanyaan_sembilanbelas - $wb_pertanyaan_sembilanbelas), 2) +
                            pow(($tr_pertanyaan_duapuluh - $wb_pertanyaan_duapuluh), 2) +
                            pow(($tr_pertanyaan_duasatu - $wb_pertanyaan_duasatu), 2) +
                            pow(($tr_pertanyaan_duadua - $wb_pertanyaan_duadua), 2) +
                            pow(($tr_pertanyaan_duatiga - $wb_pertanyaan_duatiga), 2) +
                            pow(($tr_pertanyaan_duaempat - $wb_pertanyaan_duaempat), 2) +
                            pow(($tr_pertanyaan_dualima - $wb_pertanyaan_dualima), 2) +
                            pow(($tr_pertanyaan_duaenam - $wb_pertanyaan_duaenam), 2) +
                            pow(($tr_pertanyaan_duatujuh - $wb_pertanyaan_duatujuh), 2) +
                            pow(($tr_pertanyaan_duadelapan - $wb_pertanyaan_duadelapan), 2) +
                            pow(($tr_pertanyaan_duasembilan - $wb_pertanyaan_duasembilan), 2) +
                            pow(($tr_pertanyaan_tigapuluh - $wb_pertanyaan_tigapuluh), 2) +
                            pow(($tr_pertanyaan_tigasatu - $wb_pertanyaan_tigasatu), 2) +
                            pow(($tr_pertanyaan_tigadua - $wb_pertanyaan_tigadua), 2) +
                            pow(($tr_pertanyaan_tigatiga - $wb_pertanyaan_tigatiga), 2) +
                            pow(($tr_pertanyaan_tigaempat - $wb_pertanyaan_tigaempat), 2)
                    );

                    // Menentukan siapakah pemenangnya
                    if ($result_a < $result_b) {
                        $classPerhitungan = 1;
                    } else {
                        $classPerhitungan = 0;
                    }

                    // Update weight
                    // Jika kelas pada perhitungan sebelumnya didapatkan positif, maka akan diupdate weight positif. Update weight memanggil fungsi hitungWeigth()
                    if ($classPerhitungan == 1) {
                        $wa_pertanyaan_satu = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_satu, $tr_pertanyaan_satu, $alpha);
                        $wa_pertanyaan_dua = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_dua, $tr_pertanyaan_dua, $alpha);
                        $wa_pertanyaan_tiga = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_tiga, $tr_pertanyaan_tiga, $alpha);
                        $wa_pertanyaan_empat = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_empat, $tr_pertanyaan_empat, $alpha);
                        $wa_pertanyaan_lima = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_lima, $tr_pertanyaan_lima, $alpha);
                        $wa_pertanyaan_enam = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_enam, $tr_pertanyaan_enam, $alpha);
                        $wa_pertanyaan_tujuh = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_tujuh, $tr_pertanyaan_tujuh, $alpha);
                        $wa_pertanyaan_delapan = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_delapan, $tr_pertanyaan_delapan, $alpha);
                        $wa_pertanyaan_sembilan = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_sembilan, $tr_pertanyaan_sembilan, $alpha);
                        $wa_pertanyaan_sepuluh = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_sepuluh, $tr_pertanyaan_sepuluh, $alpha);
                        $wa_pertanyaan_sebelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_sebelas, $tr_pertanyaan_sebelas, $alpha);
                        $wa_pertanyaan_duabelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_duabelas, $tr_pertanyaan_duabelas, $alpha);
                        $wa_pertanyaan_tigabelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_tigabelas, $tr_pertanyaan_tigabelas, $alpha);
                        $wa_pertanyaan_empatbelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_empatbelas, $tr_pertanyaan_empatbelas, $alpha);
                        $wa_pertanyaan_enambelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_enambelas, $tr_pertanyaan_enambelas, $alpha);
                        $wa_pertanyaan_tujuhbelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_tujuhbelas, $tr_pertanyaan_tujuhbelas, $alpha);
                        $wa_pertanyaan_delapanbelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_delapanbelas, $tr_pertanyaan_delapanbelas, $alpha);
                        $wa_pertanyaan_sembilanbelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_sembilanbelas, $tr_pertanyaan_sembilanbelas, $alpha);
                        $wa_pertanyaan_duapuluh = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_duapuluh, $tr_pertanyaan_duapuluh, $alpha);
                        $wa_pertanyaan_duasatu = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_duasatu, $tr_pertanyaan_duasatu, $alpha);
                        $wa_pertanyaan_duadua = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_duadua, $tr_pertanyaan_duadua, $alpha);
                        $wa_pertanyaan_duatiga = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_duatiga, $tr_pertanyaan_duatiga, $alpha);
                        $wa_pertanyaan_duaempat = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_duaempat, $tr_pertanyaan_duaempat, $alpha);
                        $wa_pertanyaan_dualima = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_dualima, $tr_pertanyaan_dualima, $alpha);
                        $wa_pertanyaan_duaenam = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_duaenam, $tr_pertanyaan_duaenam, $alpha);
                        $wa_pertanyaan_duatujuh = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_duatujuh, $tr_pertanyaan_duatujuh, $alpha);
                        $wa_pertanyaan_duadelapan = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_duadelapan, $tr_pertanyaan_duadelapan, $alpha);
                        $wa_pertanyaan_duasembilan = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_duasembilan, $tr_pertanyaan_duasembilan, $alpha);
                        $wa_pertanyaan_tigapuluh = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_tigapuluh, $tr_pertanyaan_tigapuluh, $alpha);
                        $wa_pertanyaan_tigasatu = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_tigasatu, $tr_pertanyaan_tigasatu, $alpha);
                        $wa_pertanyaan_tigadua = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_tigadua, $tr_pertanyaan_tigadua, $alpha);
                        $wa_pertanyaan_tigatiga = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_tigatiga, $tr_pertanyaan_tigatiga, $alpha);
                        $wa_pertanyaan_tigaempat = $this->hitungWeight($classPerhitungan, $classDatabase, $wa_pertanyaan_tigaempat, $tr_pertanyaan_tigaempat, $alpha);
                    } else {
                        // Jika kelas perhitungan negatif maka weight yang diupdate adalah weight negatif
                        $wb_pertanyaan_satu = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_satu, $tr_pertanyaan_satu, $alpha);
                        $wb_pertanyaan_dua = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_dua, $tr_pertanyaan_dua, $alpha);
                        $wb_pertanyaan_tiga = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_tiga, $tr_pertanyaan_tiga, $alpha);
                        $wb_pertanyaan_empat = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_empat, $tr_pertanyaan_empat, $alpha);
                        $wb_pertanyaan_lima = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_lima, $tr_pertanyaan_lima, $alpha);
                        $wb_pertanyaan_enam = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_enam, $tr_pertanyaan_enam, $alpha);
                        $wb_pertanyaan_tujuh = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_tujuh, $tr_pertanyaan_tujuh, $alpha);
                        $wb_pertanyaan_delapan = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_delapan, $tr_pertanyaan_delapan, $alpha);
                        $wb_pertanyaan_sembilan = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_sembilan, $tr_pertanyaan_sembilan, $alpha);
                        $wb_pertanyaan_sepuluh = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_sepuluh, $tr_pertanyaan_sepuluh, $alpha);
                        $wb_pertanyaan_sebelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_sebelas, $tr_pertanyaan_sebelas, $alpha);
                        $wb_pertanyaan_duabelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_duabelas, $tr_pertanyaan_duabelas, $alpha);
                        $wb_pertanyaan_tigabelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_tigabelas, $tr_pertanyaan_tigabelas, $alpha);
                        $wb_pertanyaan_empatbelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_empatbelas, $tr_pertanyaan_empatbelas, $alpha);
                        $wb_pertanyaan_enambelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_enambelas, $tr_pertanyaan_enambelas, $alpha);
                        $wb_pertanyaan_tujuhbelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_tujuhbelas, $tr_pertanyaan_tujuhbelas, $alpha);
                        $wb_pertanyaan_delapanbelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_delapanbelas, $tr_pertanyaan_delapanbelas, $alpha);
                        $wb_pertanyaan_sembilanbelas = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_sembilanbelas, $tr_pertanyaan_sembilanbelas, $alpha);
                        $wb_pertanyaan_duapuluh = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_duapuluh, $tr_pertanyaan_duapuluh, $alpha);
                        $wb_pertanyaan_duasatu = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_duasatu, $tr_pertanyaan_duasatu, $alpha);
                        $wb_pertanyaan_duadua = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_duadua, $tr_pertanyaan_duadua, $alpha);
                        $wb_pertanyaan_duatiga = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_duatiga, $tr_pertanyaan_duatiga, $alpha);
                        $wb_pertanyaan_duaempat = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_duaempat, $tr_pertanyaan_duaempat, $alpha);
                        $wb_pertanyaan_dualima = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_dualima, $tr_pertanyaan_dualima, $alpha);
                        $wb_pertanyaan_duaenam = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_duaenam, $tr_pertanyaan_duaenam, $alpha);
                        $wb_pertanyaan_duatujuh = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_duatujuh, $tr_pertanyaan_duatujuh, $alpha);
                        $wb_pertanyaan_duadelapan = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_duadelapan, $tr_pertanyaan_duadelapan, $alpha);
                        $wb_pertanyaan_duasembilan = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_duasembilan, $tr_pertanyaan_duasembilan, $alpha);
                        $wb_pertanyaan_tigapuluh = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_tigapuluh, $tr_pertanyaan_tigapuluh, $alpha);
                        $wb_pertanyaan_tigasatu = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_tigasatu, $tr_pertanyaan_tigasatu, $alpha);
                        $wb_pertanyaan_tigadua = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_tigadua, $tr_pertanyaan_tigadua, $alpha);
                        $wb_pertanyaan_tigatiga = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_tigatiga, $tr_pertanyaan_tigatiga, $alpha);
                        $wb_pertanyaan_tigaempat = $this->hitungWeight($classPerhitungan, $classDatabase, $wb_pertanyaan_tigaempat, $tr_pertanyaan_tigaempat, $alpha);
                    }

                    // Untuk keperluan monitor alur proses data
                    $datamonitor = [
                        'iterasi' => $i,
                        'baris' => $j,
                        'result_a' => $result_a,
                        'result_b' => $result_b,
                        'classPerhitungan' => $classPerhitungan,
                        'classDataset' => $classDatabase,
                        'wa_pertanyaan_satu' => $wa_pertanyaan_satu,
                        'wa_pertanyaan_dua' => $wa_pertanyaan_dua,
                        'wa_pertanyaan_tiga' => $wa_pertanyaan_tiga,
                        'wa_pertanyaan_empat' => $wa_pertanyaan_empat,
                        'wa_pertanyaan_lima' => $wa_pertanyaan_lima,
                        'wa_pertanyaan_enam' => $wa_pertanyaan_enam,
                        'wa_pertanyaan_tujuh' => $wa_pertanyaan_tujuh,
                        'wa_pertanyaan_delapan' => $wa_pertanyaan_delapan,
                        'wa_pertanyaan_sembilan' => $wa_pertanyaan_sembilan,
                        'wa_pertanyaan_sepuluh' => $wa_pertanyaan_sepuluh,
                        'wa_pertanyaan_sebelas' => $wa_pertanyaan_sebelas,
                        'wa_pertanyaan_duabelas' => $wa_pertanyaan_duabelas,
                        'wa_pertanyaan_tigabelas' => $wa_pertanyaan_tigabelas,
                        'wa_pertanyaan_empatbelas' => $wa_pertanyaan_empatbelas,
                        'wa_pertanyaan_limabelas' => $wa_pertanyaan_limabelas,
                        'wa_pertanyaan_enambelas' => $wa_pertanyaan_enambelas,
                        'wa_pertanyaan_tujuhbelas' => $wa_pertanyaan_tujuhbelas,
                        'wa_pertanyaan_delapanbelas' => $wa_pertanyaan_delapanbelas,
                        'wa_pertanyaan_sembilanbelas' => $wa_pertanyaan_sembilanbelas,
                        'wa_pertanyaan_duapuluh' => $wa_pertanyaan_duapuluh,
                        'wa_pertanyaan_duasatu' => $wa_pertanyaan_duasatu,
                        'wa_pertanyaan_duadua' => $wa_pertanyaan_duadua,
                        'wa_pertanyaan_duatiga' => $wa_pertanyaan_duatiga,
                        'wa_pertanyaan_duaempat' => $wa_pertanyaan_duaempat,
                        'wa_pertanyaan_dualima' => $wa_pertanyaan_dualima,
                        'wa_pertanyaan_duaenam' => $wa_pertanyaan_duaenam,
                        'wa_pertanyaan_duatujuh' => $wa_pertanyaan_duatujuh,
                        'wa_pertanyaan_duadelapan' => $wa_pertanyaan_duadelapan,
                        'wa_pertanyaan_duasembilan' => $wa_pertanyaan_duasembilan,
                        'wa_pertanyaan_tigapuluh' => $wa_pertanyaan_tigapuluh,
                        'wa_pertanyaan_tigasatu' => $wa_pertanyaan_tigasatu,
                        'wa_pertanyaan_tigadua' => $wa_pertanyaan_tigadua,
                        'wa_pertanyaan_tigatiga' => $wa_pertanyaan_tigatiga,
                        'wa_pertanyaan_tigaempat' => $wa_pertanyaan_tigaempat,

                        'wb_pertanyaan_satu' => $wb_pertanyaan_satu,
                        'wb_pertanyaan_dua' => $wb_pertanyaan_dua,
                        'wb_pertanyaan_tiga' => $wb_pertanyaan_tiga,
                        'wb_pertanyaan_empat' => $wb_pertanyaan_empat,
                        'wb_pertanyaan_lima' => $wb_pertanyaan_lima,
                        'wb_pertanyaan_enam' => $wb_pertanyaan_enam,
                        'wb_pertanyaan_tujuh' => $wb_pertanyaan_tujuh,
                        'wb_pertanyaan_delapan' => $wb_pertanyaan_delapan,
                        'wb_pertanyaan_sembilan' => $wb_pertanyaan_sembilan,
                        'wb_pertanyaan_sepuluh' => $wb_pertanyaan_sepuluh,
                        'wb_pertanyaan_sebelas' => $wb_pertanyaan_sebelas,
                        'wb_pertanyaan_duabelas' => $wb_pertanyaan_duabelas,
                        'wb_pertanyaan_tigabelas' => $wb_pertanyaan_tigabelas,
                        'wb_pertanyaan_empatbelas' => $wb_pertanyaan_empatbelas,
                        'wb_pertanyaan_limabelas' => $wb_pertanyaan_limabelas,
                        'wb_pertanyaan_enambelas' => $wb_pertanyaan_enambelas,
                        'wb_pertanyaan_tujuhbelas' => $wb_pertanyaan_tujuhbelas,
                        'wb_pertanyaan_delapanbelas' => $wb_pertanyaan_delapanbelas,
                        'wb_pertanyaan_sembilanbelas' => $wb_pertanyaan_sembilanbelas,
                        'wb_pertanyaan_duapuluh' => $wb_pertanyaan_duapuluh,
                        'wb_pertanyaan_duasatu' => $wb_pertanyaan_duasatu,
                        'wb_pertanyaan_duadua' => $wb_pertanyaan_duadua,
                        'wb_pertanyaan_duatiga' => $wb_pertanyaan_duatiga,
                        'wb_pertanyaan_duaempat' => $wb_pertanyaan_duaempat,
                        'wb_pertanyaan_dualima' => $wb_pertanyaan_dualima,
                        'wb_pertanyaan_duaenam' => $wb_pertanyaan_duaenam,
                        'wb_pertanyaan_duatujuh' => $wb_pertanyaan_duatujuh,
                        'wb_pertanyaan_duadelapan' => $wb_pertanyaan_duadelapan,
                        'wb_pertanyaan_duasembilan' => $wb_pertanyaan_duasembilan,
                        'wb_pertanyaan_tigapuluh' => $wb_pertanyaan_tigapuluh,
                        'wb_pertanyaan_tigasatu' => $wb_pertanyaan_tigasatu,
                        'wb_pertanyaan_tigadua' => $wb_pertanyaan_tigadua,
                        'wb_pertanyaan_tigatiga' => $wb_pertanyaan_tigatiga,
                        'wb_pertanyaan_tigaempat' => $wb_pertanyaan_tigaempat,
                    ];

                    // echo '<pre>';
                    // print_r($datamonitor);
                    // echo '<br>';


                    // Ketika iterasi terakhir dan baris data terakhir pada data latih, maka akan didapatkan nilai weight terbaik
                } else {
                    // Mencari prosentase akurasi algoritma
                    $akurasi = 0;
                    foreach ($train as $rowTrain) :
                        // Menyimpan nilai tiap attribut pada dataset/database latih
                        $latih_pertanyaan_satu = $rowTrain['tr_pertanyaan_satu'];
                        $latih_pertanyaan_dua = $rowTrain['tr_pertanyaan_dua'];
                        $latih_pertanyaan_tiga = $rowTrain['tr_pertanyaan_tiga'];
                        $latih_pertanyaan_empat = $rowTrain['tr_pertanyaan_empat'];
                        $latih_pertanyaan_lima = $rowTrain['tr_pertanyaan_lima'];
                        $latih_pertanyaan_enam = $rowTrain['tr_pertanyaan_enam'];
                        $latih_pertanyaan_tujuh = $rowTrain['tr_pertanyaan_tujuh'];
                        $latih_pertanyaan_delapan = $rowTrain['tr_pertanyaan_delapan'];
                        $latih_pertanyaan_sembilan = $rowTrain['tr_pertanyaan_sembilan'];
                        $latih_pertanyaan_sepuluh = $rowTrain['tr_pertanyaan_sepuluh'];
                        $latih_pertanyaan_sebelas = $rowTrain['tr_pertanyaan_sebelas'];
                        $latih_pertanyaan_duabelas = $rowTrain['tr_pertanyaan_duabelas'];
                        $latih_pertanyaan_tigabelas = $rowTrain['tr_pertanyaan_tigabelas'];
                        $latih_pertanyaan_empatbelas = $rowTrain['tr_pertanyaan_empatbelas'];
                        $latih_pertanyaan_limabelas = $rowTrain['tr_pertanyaan_limabelas'];
                        $latih_pertanyaan_enambelas = $rowTrain['tr_pertanyaan_enambelas'];
                        $latih_pertanyaan_tujuhbelas = $rowTrain['tr_pertanyaan_tujuhbelas'];
                        $latih_pertanyaan_delapanbelas = $rowTrain['tr_pertanyaan_delapanbelas'];
                        $latih_pertanyaan_sembilanbelas = $rowTrain['tr_pertanyaan_sembilanbelas'];
                        $latih_pertanyaan_duapuluh = $rowTrain['tr_pertanyaan_duapuluh'];
                        $latih_pertanyaan_duasatu = $rowTrain['tr_pertanyaan_duasatu'];
                        $latih_pertanyaan_duadua = $rowTrain['tr_pertanyaan_duadua'];
                        $latih_pertanyaan_duatiga = $rowTrain['tr_pertanyaan_duatiga'];
                        $latih_pertanyaan_duaempat = $rowTrain['tr_pertanyaan_duaempat'];
                        $latih_pertanyaan_dualima = $rowTrain['tr_pertanyaan_dualima'];
                        $latih_pertanyaan_duaenam = $rowTrain['tr_pertanyaan_duaenam'];
                        $latih_pertanyaan_duatujuh = $rowTrain['tr_pertanyaan_duatujuh'];
                        $latih_pertanyaan_duadelapan = $rowTrain['tr_pertanyaan_duadelapan'];
                        $latih_pertanyaan_duasembilan = $rowTrain['tr_pertanyaan_duasembilan'];
                        $latih_pertanyaan_tigapuluh = $rowTrain['tr_pertanyaan_tigapuluh'];
                        $latih_pertanyaan_tigasatu = $rowTrain['tr_pertanyaan_tigasatu'];
                        $latih_pertanyaan_tigadua = $rowTrain['tr_pertanyaan_tigadua'];
                        $latih_pertanyaan_tigatiga = $rowTrain['tr_pertanyaan_tigatiga'];
                        $latih_pertanyaan_tigaempat = $rowTrain['tr_pertanyaan_tigaempat'];

                        // Menghitungnya dengan weight terbaik setelah keseluruhan iterasi
                        $result_aLatih = sqrt(
                            pow(($latih_pertanyaan_satu - $wa_pertanyaan_satu), 2) +
                                pow(($latih_pertanyaan_dua - $wa_pertanyaan_dua), 2) +
                                pow(($latih_pertanyaan_tiga - $wa_pertanyaan_tiga), 2) +
                                pow(($latih_pertanyaan_empat - $wa_pertanyaan_empat), 2) +
                                pow(($latih_pertanyaan_lima - $wa_pertanyaan_lima), 2) +
                                pow(($latih_pertanyaan_enam - $wa_pertanyaan_enam), 2) +
                                pow(($latih_pertanyaan_tujuh - $wa_pertanyaan_tujuh), 2) +
                                pow(($latih_pertanyaan_delapan - $wa_pertanyaan_delapan), 2) +
                                pow(($latih_pertanyaan_sembilan - $wa_pertanyaan_sembilan), 2) +
                                pow(($latih_pertanyaan_sepuluh - $wa_pertanyaan_sepuluh), 2) +
                                pow(($latih_pertanyaan_sebelas - $wa_pertanyaan_sebelas), 2) +
                                pow(($latih_pertanyaan_duabelas - $wa_pertanyaan_duabelas), 2) +
                                pow(($latih_pertanyaan_tigabelas - $wa_pertanyaan_tigabelas), 2) +
                                pow(($latih_pertanyaan_empatbelas - $wa_pertanyaan_empatbelas), 2) +
                                pow(($latih_pertanyaan_limabelas - $wa_pertanyaan_limabelas), 2) +
                                pow(($latih_pertanyaan_enambelas - $wa_pertanyaan_enambelas), 2) +
                                pow(($latih_pertanyaan_tujuhbelas - $wa_pertanyaan_tujuhbelas), 2) +
                                pow(($latih_pertanyaan_delapanbelas - $wa_pertanyaan_delapanbelas), 2) +
                                pow(($latih_pertanyaan_sembilanbelas - $wa_pertanyaan_sembilanbelas), 2) +
                                pow(($latih_pertanyaan_duapuluh - $wa_pertanyaan_duapuluh), 2) +
                                pow(($latih_pertanyaan_duasatu - $wa_pertanyaan_duasatu), 2) +
                                pow(($latih_pertanyaan_duadua - $wa_pertanyaan_duadua), 2) +
                                pow(($latih_pertanyaan_duatiga - $wa_pertanyaan_duatiga), 2) +
                                pow(($latih_pertanyaan_duaempat - $wa_pertanyaan_duaempat), 2) +
                                pow(($latih_pertanyaan_dualima - $wa_pertanyaan_dualima), 2) +
                                pow(($latih_pertanyaan_duaenam - $wa_pertanyaan_duaenam), 2) +
                                pow(($latih_pertanyaan_duatujuh - $wa_pertanyaan_duatujuh), 2) +
                                pow(($latih_pertanyaan_duadelapan - $wa_pertanyaan_duadelapan), 2) +
                                pow(($latih_pertanyaan_duasembilan - $wa_pertanyaan_duasembilan), 2) +
                                pow(($latih_pertanyaan_tigapuluh - $wa_pertanyaan_tigapuluh), 2) +
                                pow(($latih_pertanyaan_tigasatu - $wa_pertanyaan_tigasatu), 2) +
                                pow(($latih_pertanyaan_tigadua - $wa_pertanyaan_tigadua), 2) +
                                pow(($latih_pertanyaan_tigatiga - $wa_pertanyaan_tigatiga), 2) +
                                pow(($latih_pertanyaan_tigaempat - $wa_pertanyaan_tigaempat), 2)
                        );

                        $result_bLatih = sqrt(
                            pow(($latih_pertanyaan_satu - $wb_pertanyaan_satu), 2) +
                                pow(($latih_pertanyaan_dua - $wb_pertanyaan_dua), 2) +
                                pow(($latih_pertanyaan_tiga - $wb_pertanyaan_tiga), 2) +
                                pow(($latih_pertanyaan_empat - $wb_pertanyaan_empat), 2) +
                                pow(($latih_pertanyaan_lima - $wb_pertanyaan_lima), 2) +
                                pow(($latih_pertanyaan_enam - $wb_pertanyaan_enam), 2) +
                                pow(($latih_pertanyaan_tujuh - $wb_pertanyaan_tujuh), 2) +
                                pow(($latih_pertanyaan_delapan - $wb_pertanyaan_delapan), 2) +
                                pow(($latih_pertanyaan_sembilan - $wb_pertanyaan_sembilan), 2) +
                                pow(($latih_pertanyaan_sepuluh - $wb_pertanyaan_sepuluh), 2) +
                                pow(($latih_pertanyaan_sebelas - $wb_pertanyaan_sebelas), 2) +
                                pow(($latih_pertanyaan_duabelas - $wb_pertanyaan_duabelas), 2) +
                                pow(($latih_pertanyaan_tigabelas - $wb_pertanyaan_tigabelas), 2) +
                                pow(($latih_pertanyaan_empatbelas - $wb_pertanyaan_empatbelas), 2) +
                                pow(($latih_pertanyaan_limabelas - $wb_pertanyaan_limabelas), 2) +
                                pow(($latih_pertanyaan_enambelas - $wb_pertanyaan_enambelas), 2) +
                                pow(($latih_pertanyaan_tujuhbelas - $wb_pertanyaan_tujuhbelas), 2) +
                                pow(($latih_pertanyaan_delapanbelas - $wb_pertanyaan_delapanbelas), 2) +
                                pow(($latih_pertanyaan_sembilanbelas - $wb_pertanyaan_sembilanbelas), 2) +
                                pow(($latih_pertanyaan_duapuluh - $wb_pertanyaan_duapuluh), 2) +
                                pow(($latih_pertanyaan_duasatu - $wb_pertanyaan_duasatu), 2) +
                                pow(($latih_pertanyaan_duadua - $wb_pertanyaan_duadua), 2) +
                                pow(($latih_pertanyaan_duatiga - $wb_pertanyaan_duatiga), 2) +
                                pow(($latih_pertanyaan_duaempat - $wb_pertanyaan_duaempat), 2) +
                                pow(($latih_pertanyaan_dualima - $wb_pertanyaan_dualima), 2) +
                                pow(($latih_pertanyaan_duaenam - $wb_pertanyaan_duaenam), 2) +
                                pow(($latih_pertanyaan_duatujuh - $wb_pertanyaan_duatujuh), 2) +
                                pow(($latih_pertanyaan_duadelapan - $wb_pertanyaan_duadelapan), 2) +
                                pow(($latih_pertanyaan_duasembilan - $wb_pertanyaan_duasembilan), 2) +
                                pow(($latih_pertanyaan_tigapuluh - $wb_pertanyaan_tigapuluh), 2) +
                                pow(($latih_pertanyaan_tigasatu - $wb_pertanyaan_tigasatu), 2) +
                                pow(($latih_pertanyaan_tigadua - $wb_pertanyaan_tigadua), 2) +
                                pow(($latih_pertanyaan_tigatiga - $wb_pertanyaan_tigatiga), 2) +
                                pow(($latih_pertanyaan_tigaempat - $wb_pertanyaan_tigaempat), 2)
                        );

                        // Mengambil id class berdasarkan kode kelas yang diperoleh
                        if ($result_aLatih < $result_bLatih) {
                            $classLatih = $this->classModel->where('code_class', 2)->findAll();
                            $classLatih = $classLatih[0]['id_class'];
                        } else {
                            $classLatih = $this->classModel->where('code_class', 1)->findAll();
                            $classLatih = $classLatih[0]['id_class'];
                        }

                        // Jika id_class yang didapatkan dari perhitungan sama dengan id_class pada dataset, maka menambahkan nilai 1 pada akurasi
                        if ($rowTrain['id_class'] == $classLatih) {
                            $akurasi += 1;
                        }
                    endforeach;

                    // Mencari prosentase dengan membagi nilai akumulasi $akurasi dengan total jumlah data latih. Kemudian dikali 100.
                    $prosentase = ($akurasi / $numrow) * 100;
                    $insert = [
                        'alpha' => $alpha,
                        'max_epoch' => $max_epoch,
                        'datetime_weight' => date('Y-m-d H:i:s'),
                        'status_weight' => 0,
                        'prosentase' => $prosentase,
                        // 'akurasi' => $akurasi,
                        // 'numrow' => $numrow,
                        // Menyimpan bobot terbaik yang sudah dihitung
                        'wa_pertanyaan_satu' => $wa_pertanyaan_satu,
                        'wa_pertanyaan_dua' => $wa_pertanyaan_dua,
                        'wa_pertanyaan_tiga' => $wa_pertanyaan_tiga,
                        'wa_pertanyaan_empat' => $wa_pertanyaan_empat,
                        'wa_pertanyaan_lima' => $wa_pertanyaan_lima,
                        'wa_pertanyaan_enam' => $wa_pertanyaan_enam,
                        'wa_pertanyaan_tujuh' => $wa_pertanyaan_tujuh,
                        'wa_pertanyaan_delapan' => $wa_pertanyaan_delapan,
                        'wa_pertanyaan_sembilan' => $wa_pertanyaan_sembilan,
                        'wa_pertanyaan_sepuluh' => $wa_pertanyaan_sepuluh,
                        'wa_pertanyaan_sebelas' => $wa_pertanyaan_sebelas,
                        'wa_pertanyaan_duabelas' => $wa_pertanyaan_duabelas,
                        'wa_pertanyaan_tigabelas' => $wa_pertanyaan_tigabelas,
                        'wa_pertanyaan_empatbelas' => $wa_pertanyaan_empatbelas,
                        'wa_pertanyaan_limabelas' => $wa_pertanyaan_limabelas,
                        'wa_pertanyaan_enambelas' => $wa_pertanyaan_enambelas,
                        'wa_pertanyaan_tujuhbelas' => $wa_pertanyaan_tujuhbelas,
                        'wa_pertanyaan_delapanbelas' => $wa_pertanyaan_delapanbelas,
                        'wa_pertanyaan_sembilanbelas' => $wa_pertanyaan_sembilanbelas,
                        'wa_pertanyaan_duapuluh' => $wa_pertanyaan_duapuluh,
                        'wa_pertanyaan_duasatu' => $wa_pertanyaan_duasatu,
                        'wa_pertanyaan_duadua' => $wa_pertanyaan_duadua,
                        'wa_pertanyaan_duatiga' => $wa_pertanyaan_duatiga,
                        'wa_pertanyaan_duaempat' => $wa_pertanyaan_duaempat,
                        'wa_pertanyaan_dualima' => $wa_pertanyaan_dualima,
                        'wa_pertanyaan_duaenam' => $wa_pertanyaan_duaenam,
                        'wa_pertanyaan_duatujuh' => $wa_pertanyaan_duatujuh,
                        'wa_pertanyaan_duadelapan' => $wa_pertanyaan_duadelapan,
                        'wa_pertanyaan_duasembilan' => $wa_pertanyaan_duasembilan,
                        'wa_pertanyaan_tigapuluh' => $wa_pertanyaan_tigapuluh,
                        'wa_pertanyaan_tigasatu' => $wa_pertanyaan_tigasatu,
                        'wa_pertanyaan_tigadua' => $wa_pertanyaan_tigadua,
                        'wa_pertanyaan_tigatiga' => $wa_pertanyaan_tigatiga,
                        'wa_pertanyaan_tigaempat' => $wa_pertanyaan_tigaempat,

                        'wb_pertanyaan_satu' => $wb_pertanyaan_satu,
                        'wb_pertanyaan_dua' => $wb_pertanyaan_dua,
                        'wb_pertanyaan_tiga' => $wb_pertanyaan_tiga,
                        'wb_pertanyaan_empat' => $wb_pertanyaan_empat,
                        'wb_pertanyaan_lima' => $wb_pertanyaan_lima,
                        'wb_pertanyaan_enam' => $wb_pertanyaan_enam,
                        'wb_pertanyaan_tujuh' => $wb_pertanyaan_tujuh,
                        'wb_pertanyaan_delapan' => $wb_pertanyaan_delapan,
                        'wb_pertanyaan_sembilan' => $wb_pertanyaan_sembilan,
                        'wb_pertanyaan_sepuluh' => $wb_pertanyaan_sepuluh,
                        'wb_pertanyaan_sebelas' => $wb_pertanyaan_sebelas,
                        'wb_pertanyaan_duabelas' => $wb_pertanyaan_duabelas,
                        'wb_pertanyaan_tigabelas' => $wb_pertanyaan_tigabelas,
                        'wb_pertanyaan_empatbelas' => $wb_pertanyaan_empatbelas,
                        'wb_pertanyaan_limabelas' => $wb_pertanyaan_limabelas,
                        'wb_pertanyaan_enambelas' => $wb_pertanyaan_enambelas,
                        'wb_pertanyaan_tujuhbelas' => $wb_pertanyaan_tujuhbelas,
                        'wb_pertanyaan_delapanbelas' => $wb_pertanyaan_delapanbelas,
                        'wb_pertanyaan_sembilanbelas' => $wb_pertanyaan_sembilanbelas,
                        'wb_pertanyaan_duapuluh' => $wb_pertanyaan_duapuluh,
                        'wb_pertanyaan_duasatu' => $wb_pertanyaan_duasatu,
                        'wb_pertanyaan_duadua' => $wb_pertanyaan_duadua,
                        'wb_pertanyaan_duatiga' => $wb_pertanyaan_duatiga,
                        'wb_pertanyaan_duaempat' => $wb_pertanyaan_duaempat,
                        'wb_pertanyaan_dualima' => $wb_pertanyaan_dualima,
                        'wb_pertanyaan_duaenam' => $wb_pertanyaan_duaenam,
                        'wb_pertanyaan_duatujuh' => $wb_pertanyaan_duatujuh,
                        'wb_pertanyaan_duadelapan' => $wb_pertanyaan_duadelapan,
                        'wb_pertanyaan_duasembilan' => $wb_pertanyaan_duasembilan,
                        'wb_pertanyaan_tigapuluh' => $wb_pertanyaan_tigapuluh,
                        'wb_pertanyaan_tigasatu' => $wb_pertanyaan_tigasatu,
                        'wb_pertanyaan_tigadua' => $wb_pertanyaan_tigadua,
                        'wb_pertanyaan_tigatiga' => $wb_pertanyaan_tigatiga,
                        'wb_pertanyaan_tigaempat' => $wb_pertanyaan_tigaempat,
                    ];

                    // dd($insert);

                    // echo '<pre>';
                    // print_r($insert); exit;
                    $this->weightModel->insert($insert);
                    return redirect()->to("/weight");
                }

                // echo 'iterasi ke ' . $i . ' - datalatih ke ' . $j . ' - result a = ' . $result_a . ' - result b = ' . $result_b;
                // echo '<br>';
                // echo 'iterasi ke ' . $i . ' - datalatih ke ' . $j . ' - result a = ' . is_infinite($result_a) . ' - result b = ' . is_infinite($result_b);
                // echo '<br>';

                $j++;
            endforeach;
        endfor;
    }
    

    // Function untuk rumus update bobot
    public function hitungWeight($ClassPerhitunganSebelumnya, $ClassDatasetSebelumnya, $weightSebelumnya, $weightDataset, $alpha)
    {
        if ($ClassDatasetSebelumnya == $ClassPerhitunganSebelumnya) {
            $resultWeight = $weightSebelumnya + ($alpha * ($weightDataset - $weightSebelumnya));
        } else {
            $resultWeight = $weightSebelumnya - ($alpha * ($weightDataset - $weightSebelumnya));
        }

        return $resultWeight;
    }
}
