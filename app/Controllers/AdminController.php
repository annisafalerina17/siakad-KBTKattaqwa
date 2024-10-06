<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Database\Migrations\Laporanerkembangan;
use App\Models\AnggotaEkstrakurikuler;
use App\Models\AnggotaKelas;
use App\Models\BiodataGuru;
use App\Models\BiodataSiswa;
use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\LaporanPerkembangan;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\User;

class AdminController extends BaseController
{
    public function index() //dashboard admin dan guru
    {
        //login memastikan pengguna sudah login dan bukan role 3(siswa)
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        // Memuat Data dari Database
        $guruModel = new BiodataGuru();
        $siswaModel = new BiodataSiswa();
        $ekstrakurikulerModel = new Ekstrakurikuler();
        $kelasModel = new Kelas();

        // Mengambil jumlah total data guru, siswa, ekstrakurikuler, dan kelas dari masing2 model
        $jumlahDataGuru = $guruModel->countAll();
        $jumlahDataSiswa = $siswaModel->countAll();
        $jumlahDataEkstrakurikuler = $ekstrakurikulerModel->countAll();
        $jumlahKelas = $kelasModel->countAll();

        // Menyiapkan data untuk dikirim ke view untuk ditampilkan 
        $data = [
            'title' => 'Dashboard',
            'jumlahDataGuru' => $jumlahDataGuru,
            'jumlahDataSiswa' => $jumlahDataSiswa,
            'jumlahDataEkstrakurikuler' => $jumlahDataEkstrakurikuler,
            'jumlahDataKelas' => $jumlahKelas,
        ];

        // Menampilkan halaman dashboard
        return view('admin/dashboard', compact('data'));
    }

    public function profil() //menampilkan profil admin dan guru
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        //Koneksi ke db
        $db = \Config\Database::connect();

        //Mengambil data pengguna
        $builder = $db->table('users');
        $builder->select('users.*, biodatagurus.*');
        $builder->join('biodatagurus', 'users.id = biodatagurus.teacher_id', 'left');
        $builder->where('users.id', session('id'));
        $query = $builder->get();
        $user = $query->getRow();

        //Menampilkan profile
        $data = [
            'title' => 'Profil',
            'user' => $user
        ];

        return view('admin/profil', compact('data'));
    }

    public function dataGuru() //menampilkan table data guru 
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        //Mengambil data guru dan staf
        $userModel = new User();
        $teachersAndStaff = $userModel->getTeachersAndStaff();

        // Menyiapkan data untuk ditampilkan 
        $data = [
            'title' => 'Data Guru',
            'dataGuru' => $teachersAndStaff
        ];

        return view('admin/dataGuru', compact('data'));
    }

    // DEV ONLY
    // public function profilGuru($id) //menampilkan profile guru oleh admin (http://localhost:8080/admin/profilGuru/{id})
    // {
    //     if (!session()->has('id')) {
    //         return redirect()->to('/');
    //     }
    //     if (session('role') == 3) {
    //         return redirect()->to('/');
    //     }

    //     $db = \Config\Database::connect();

    //     $builder = $db->table('users');
    //     $builder->select('users.*, biodatagurus.*');
    //     $builder->join('biodatagurus', 'users.id = biodatagurus.teacher_id', 'left');
    //     $builder->where('users.id', $id);
    //     $query = $builder->get();
    //     $user = $query->getRow();


    //     $data = [
    //         'title' => 'Data Guru',
    //         'user' => $user
    //     ];

    //     return view('admin/profilGuru', compact('data'));
    // }

    public function dataSiswa() //menampilkan tabel data siswa
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $builder = $db->table('users');
        $builder->select('users.*, biodatasiswas.*');
        $builder->join('biodatasiswas', 'users.id = biodatasiswas.student_id', 'left');
        $builder->where('users.role', 3);
        $query = $builder->get();
        $students = $query->getResult();

        $data = [
            'title' => 'Data Siswa',
            'dataSiswa' => $students
        ];

        return view('admin/dataSiswa', compact('data'));
    }

    // DEV ONLY
    // public function profilSiswa($id) //menampilkan profile guru oleh admin (http://localhost:8080/admin/profilSiswa/{id})
    // {
    //     if (!session()->has('id')) {
    //         return redirect()->to('/');
    //     }
    //     if (session('role') == 3) {
    //         return redirect()->to('/');
    //     }

    //     $db = \Config\Database::connect();

    //     $builder = $db->table('users');
    //     $builder->select('users.*, biodatasiswas.*');
    //     $builder->join('biodatasiswas', 'users.id = biodatasiswas.student_id', 'left');
    //     $builder->where('users.id', $id);
    //     $query = $builder->get();
    //     $user = $query->getRow();
    //     $data = [
    //         'title' => 'Data Siswa',
    //         'user' => $user
    //     ];

    //     return view('admin/profilSiswa', compact('data'));
    // }

    public function pembagianGuruKelas() //menampilkan daftar kelasnya pada fitur pembagian guru dan kelas
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') != 1) {
            return redirect()->to('/');
        }

        $kelasModel = new Kelas();
        $data = [
            'title' => 'Pembagian Guru dan Kelas',
            'kelas' => $kelasModel->findAll()
        ];
        return view('admin/pembagianGuruKelas', compact('data'));
    }

    public function pembagianGuruKelasGuru() //info pembagian Guru dan Kelas pd guru
    {
        //cek sesi pengguna
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') != 2) {
            return redirect()->to('/');
        }

        $kelasModel = new Kelas();
        $anggotaKelasModel = new AnggotaKelas();
        $biodataGuruModel = new BiodataGuru();
        $biodataSiswaModel = new BiodataSiswa();
        // CARI ID KELAS
        $dataKelas = $anggotaKelasModel->where('user_id', session('id'))->first();
        if (!$dataKelas) {
            $data = [
                'title' => 'Pembagian Guru dan Kelas',
                'kelas' => null,
                'guru' => null,
                'siswa' => null,
            ];
            return view('admin/pembagianGuruKelasGuru', compact('data'));
        }
        $id = $dataKelas['class_id'];

        // Mengambil data kelas
        $kelas = $kelasModel->where('id', $id)->first();

        // Mengambil data guru berdasarkan join dengan tabel anggotaKelas
        $guru = $anggotaKelasModel->select('biodatagurus.*')
            ->join('biodatagurus', 'anggotakelas.user_id = biodatagurus.teacher_id')
            ->where('anggotakelas.class_id', $id)
            ->findAll();

        // Mengambil data siswa berdasarkan join dengan tabel anggotaKelas
        $siswa = $anggotaKelasModel->select('biodatasiswas.*')
            ->join('biodatasiswas', 'anggotakelas.user_id = biodatasiswas.student_id')
            ->where('anggotakelas.class_id', $id)
            ->findAll();

        $data = [
            'title' => 'Pembagian Guru dan Kelas',
            'kelas' => $kelas,
            'guru' => $guru,
            'siswa' => $siswa,
        ];
        return view('admin/pembagianGuruKelasGuru', compact('data'));
    }

    public function laporanPerkembangan() //menampilkan halaman laporan perkembangan seluruh siswa
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        $kelasModel = new Kelas();
        $anggotaKelasModel = new AnggotaKelas();
        $biodataGuruModel = new BiodataGuru();
        $biodataSiswaModel = new BiodataSiswa();
        // CARI ID KELAS
        $dataKelas = $anggotaKelasModel->where('user_id', session('id'))->first();
        if (!$dataKelas) {
            $data = [
                'title' => 'Laporan Perkembangan',
                'kelas' => null,
                'siswa' => null,
            ];
            return view('admin/laporanPerkembangan', compact('data'));
        }
        $id = $dataKelas['class_id'];

        // Mengambil data kelas
        $kelas = $kelasModel->where('id', $id)->first();

        // Mengambil data siswa berdasarkan join dengan tabel anggotaKelas
        $siswa = $anggotaKelasModel->select('biodatasiswas.*')
            ->join('biodatasiswas', 'anggotakelas.user_id = biodatasiswas.student_id')
            ->where('anggotakelas.class_id', $id)
            ->findAll();

        $data = [
            'title' => 'Laporan Perkembangan',
            'kelas' => $kelas,
            'siswa' => $siswa,
        ];
        return view('admin/laporanPerkembangan', compact('data'));
    }

    public function anggotaKelas($id) //menampilkan data guru dan siswa yang sudah diinput kedlm kelas tertentu
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') != 1) {
            return redirect()->to('/');
        }

        $kelasModel = new Kelas();
        $anggotaKelasModel = new AnggotaKelas();
        $biodataGuruModel = new BiodataGuru();
        $biodataSiswaModel = new BiodataSiswa();

        // Mengambil data kelas
        $kelas = $kelasModel->where('id', $id)->first();

        // Mengambil data guru berdasarkan join dengan tabel anggotaKelas
        $guru = $anggotaKelasModel->select('biodatagurus.*')
            ->join('biodatagurus', 'anggotakelas.user_id = biodatagurus.teacher_id')
            ->where('anggotakelas.class_id', $id)
            ->findAll();

        // Mengambil data siswa berdasarkan join dengan tabel anggotaKelas
        $siswa = $anggotaKelasModel->select('biodatasiswas.*')
            ->join('biodatasiswas', 'anggotakelas.user_id = biodatasiswas.student_id')
            ->where('anggotakelas.class_id', $id)
            ->findAll();

        // Mengambil seluruh data user yang id-nya belum ada di dalam tabel anggotaKelas
        $userIdsInClass = $anggotaKelasModel->select('user_id')->findAll();
        $userIdsInClassArray = array_column($userIdsInClass, 'user_id');

        // Mengambil data guru yang belum ada di kelas
        $nonClassGuru = $biodataGuruModel->whereNotIn('teacher_id', function ($builder) use ($id) {
            $builder->select('user_id')->from('anggotakelas');
        })->findAll();

        // Mengambil data siswa yang belum ada di kelas
        $nonClassSiswa = $biodataSiswaModel->whereNotIn('student_id', function ($builder) use ($id) {
            $builder->select('user_id')->from('anggotakelas');
        })->findAll();

        $data = [
            'title' => 'Pembagian Guru dan Kelas',
            'kelas' => $kelas,
            'guru' => $guru,
            'siswa' => $siswa,
            'nonClassGuru' => $nonClassGuru,
            'nonClassSiswa' => $nonClassSiswa
        ];

        return view('admin/anggotaKelas', compact('data'));
    }

    public function tambahAnggotaKelas() //input guru/siswa kedlm kelas
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') != 1) {
            return redirect()->to('/');
        }

        $anggotaKelasModel = new AnggotaKelas();

        // Mengambil data yang dikirim melalui form
        $classId = $this->request->getPost('class_id');
        $userId = $this->request->getPost('user_id');

        // Menambahkan anggota kelas baru
        $anggotaKelasModel->insert([
            'class_id' => $classId,
            'user_id' => $userId
        ]);

        return redirect()->back()->with('tambahAnggotaKelasSuccess', 'Anggota kelas berhasil ditambahkan');
    }

    public function deleteAnggotaKelas($id) //delete guru/siswa didlm kelas
    {
        // Pastikan hanya pengguna yang sudah login yang bisa menghapus data
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Pastikan hanya pengguna dengan role 1 yang bisa menghapus data
        if (session('role') != 1) {
            return redirect()->to('/');
        }

        $anggotaKelasModel = new AnggotaKelas();
        $anggota = $anggotaKelasModel->where('user_id', $id)->first();

        if ($anggota) {
            $anggotaKelasModel->where('user_id', $id)->delete();
            return redirect()->back()->with('deleteAnggotaKelasSuccess', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function jadwalEkstrakurikuler() //menampilkan info jadwal ekskul
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        $ekstrakurikulerModel = new Ekstrakurikuler();
        $ekstrakurikuler = $ekstrakurikulerModel->findAll();

        $data = [
            'title' => 'Jadwal Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler
        ];

        return view('admin/jadwalEkstrakurikuler', compact('data'));
    }

    public function tambahJadwalEkstrakurikuler() //menginput jadwal ekskul
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        if (session('role') != 1) {
            return redirect()->to('/');
        }

        $ekstrakurikulerModel = new Ekstrakurikuler();

        $data = [
            'name' => $this->request->getVar('name'),
            'coach' => $this->request->getVar('coach'),
            'day' => $this->request->getVar('day'),
            'time_start' => $this->request->getVar('time_start'),
            'time_end' => $this->request->getVar('time_end')
        ];

        if ($ekstrakurikulerModel->insert($data)) {
            return redirect()->back()->with('tambahJadwalEkstrakurikulerSuccess', 'Data ekstrakurikuler berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data ekstrakurikuler.');
        }
    }

    public function editJadwalEkstrakurikuler() //mengedit jadwal ekskul
    {
        // Pastikan hanya pengguna yang sudah login yang bisa mengedit data
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Pastikan hanya pengguna dengan role yang sesuai yang bisa mengedit data
        if (session('role') != 1) {
            return redirect()->to('/');
        }

        // Validasi input form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'coach' => 'required',
            'day' => 'required',
            'time_start' => 'required',
            'time_end' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $ekstrakurikulerModel = new Ekstrakurikuler();
        $id = $this->request->getPost('id'); // Pastikan Anda mendapatkan ID dengan benar

        $data = [
            'name' => $this->request->getPost('name'),
            'coach' => $this->request->getPost('coach'),
            'day' => $this->request->getPost('day'),
            'time_start' => $this->request->getPost('time_start'),
            'time_end' => $this->request->getPost('time_end')
        ];

        // Update data di database menggunakan set dan where
        $updateStatus = $ekstrakurikulerModel->set($data)->where('id', $id)->update();

        if ($updateStatus) {
            return redirect()->back()->with('editJadwalEkstrakurikulerSuccess', 'Data berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Data gagal diperbarui');
        }
    }

    public function deleteJadwalEkstrakurikuler($id) //delete jadwal ekskul
    {
        // Pastikan hanya pengguna yang sudah login yang bisa menghapus data
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Pastikan hanya pengguna dengan role 1 yang bisa menghapus data
        if (session('role') != 1) {
            return redirect()->to('/');
        }

        $ekstrakurikulerModel = new Ekstrakurikuler();
        $ekstrakurikuler = $ekstrakurikulerModel->where('id', $id)->first();

        if ($ekstrakurikuler) {
            $ekstrakurikulerModel->where('id', $id)->delete();
            return redirect()->back()->with('deleteJadwalEkstrakurikulerSuccess', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function detailLppd($id, $className) //melihat detail rapor salah satu siswa
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        //Mengambil data dari database
        $lppdModel = new LaporanPerkembangan();
        $siswaModel = new BiodataSiswa();
        $lppd = $lppdModel->where('student_id', $id)->findAll();
        $siswa = $siswaModel->where('student_id', $id)->first();

        if (is_null($siswa) || is_null($lppd)) {
            return redirect()->back()->with('error', 'Data siswa atau LPPD tidak ditemukan.');
        }

        $classNameCount = 0;
        $classNameExists = false;
        foreach ($lppd as $item) {
            if ($item['className'] === $className) {
                $classNameCount++;
                if ($classNameCount == 4) {
                    $classNameExists = true;
                    break;
                }
            }
        }

        if ($classNameExists == false) {
            // Get existing semesters for this student
            $lppdbyclass = $lppdModel->where('student_id', $id)->where('className', $className)->findAll();
            $semesters = array_column($lppdbyclass, 'semester');

            // Determine the unset semesters
            $allSemesters = range(1, 4);
            $semesterUnset = array_diff($allSemesters, $semesters);
        } else {
            $semesters = null;

            // Determine the unset semesters
            $allSemesters = null;
            $semesterUnset = [];
        }
        $data = [
            'title' => 'Detail LPPD',
            'lppd' => $lppd,
            'siswa' => $siswa,
            'semesterUnset' => $semesterUnset,
            'className' => $className
        ];

        return view('admin/detailLppd', compact('data'));
    }

    public function tambahLppd() //input rapor
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        if (session('role') == 3) {
            return redirect()->to('/');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'semester' => 'required|integer',
            'lppd' => 'uploaded[lppd]|mime_in[lppd,application/pdf]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // If validation fails, return to the previous page with error messages
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $lppdModel = new LaporanPerkembangan();

        // Handle the file upload
        $lppdFile = $this->request->getFile('lppd');
        if ($lppdFile->isValid() && !$lppdFile->hasMoved()) {
            $newName = $lppdFile->getRandomName();
            $lppdFile->move(FCPATH . 'lppd', $newName);
        }

        // Prepare data for insertion
        $data = [
            'student_id' => $this->request->getPost('student_id'),
            'semester' => $this->request->getPost('semester'),
            'className' => $this->request->getPost('className'),
            'lppd' => $newName,
        ];

        // Insert data into the database
        $lppdModel->save($data);

        // Redirect to a success page
        return redirect()->back()->with('tambahLppdSuccess', 'Data berhasil ditambahkan!');
    }

    public function deleteLppd($id) //delete rapor
    {
        // Pastikan hanya pengguna yang sudah login yang bisa menghapus data
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Pastikan hanya pengguna dengan role 1 yang bisa menghapus data
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        $LaporanPerkembanganModel = new LaporanPerkembangan();
        $lppd = $LaporanPerkembanganModel->find($id);

        if ($lppd) {
            // Hapus file yang terkait dengan LPPD
            unlink('lppd/' . $lppd['lppd']);
            // Hapus data dari database
            $LaporanPerkembanganModel->delete($id);
            return redirect()->back()->with('deleteLppdSuccess', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function pendaftarEkstrakurikuler() //menampilkan data siswa pendaftar ekskul
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        $anggotaEkstrakurikulerModel = new AnggotaEkstrakurikuler();
        $siswaModel = new BiodataSiswa();
        $ekstrakurikulerModel = new Ekstrakurikuler();

        // Mengambil data siswa yang mendaftar ekstrakurikuler
        $pendaftar = $anggotaEkstrakurikulerModel
            ->select('anggotaekstrakurikulers.*, biodatasiswas.nisn, biodatasiswas.name, ekstrakurikulers.name as ekstrakurikuler_name')
            ->join('biodatasiswas', 'anggotaekstrakurikulers.student_id = biodatasiswas.student_id')
            ->join('ekstrakurikulers', 'anggotaekstrakurikulers.ekstrakurikuler_id = ekstrakurikulers.id')
            ->findAll();

        $data = [
            'title' => 'Data Siswa Pendaftar Ekstrakurikuler',
            'pendaftar' => $pendaftar,
        ];

        return view('admin/pendaftarEkstrakurikuler', compact('data'));
    }
}
