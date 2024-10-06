<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaEkstrakurikuler;
use App\Models\AnggotaKelas;
use App\Models\BiodataGuru;
use App\Models\BiodataSiswa;
use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\LaporanPerkembangan;
use CodeIgniter\HTTP\ResponseInterface;

class SiswaController extends BaseController
{
    public function profil()
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') != 3) {
            return redirect()->to('/');
        }

        $db = \Config\Database::connect();

        $builder = $db->table('users');
        $builder->select('users.*, biodatasiswas.*');
        $builder->join('biodatasiswas', 'users.id = biodatasiswas.student_id', 'left');
        $builder->where('users.id', session('id'));
        $query = $builder->get();
        $user = $query->getRow();


        $data = [
            'title' => 'Profil',
            'user' => $user
        ];

        return view('siswa/profil', compact('data'));
    }

    public function pembagianGuruKelasSiswa()
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') != 3) {
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
            return view('siswa/pembagianGuruKelasSiswa', compact('data'));
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
        return view('siswa/pembagianGuruKelasSiswa', compact('data'));
    }

    public function detailLppd($id)
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') != 3) {
            return redirect()->to('/');
        }

        $lppdModel = new LaporanPerkembangan();
        $siswaModel = new BiodataSiswa();
        $lppd = $lppdModel->where('student_id', $id)->findAll();
        $siswa = $siswaModel->where('student_id', $id)->first();

        if (is_null($siswa) || is_null($lppd)) {
            return redirect()->back()->with('error', 'Data siswa atau LPPD tidak ditemukan.');
        }

        // Get existing semesters for this student
        $semesters = array_column($lppd, 'semester');

        // Determine the unset semesters
        $allSemesters = range(1, 2);
        $semesterUnset = array_diff($allSemesters, $semesters);

        $data = [
            'title' => 'Detail LPPD',
            'lppd' => $lppd,
            'siswa' => $siswa,
            'semesterUnset' => $semesterUnset
        ];

        return view('siswa/detailLppd', compact('data'));
    }

    public function jadwalEkstrakurikuler()
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') != 3) {
            return redirect()->to('/');
        }

        $ekstrakurikulerModel = new Ekstrakurikuler();
        $ekstrakurikuler = $ekstrakurikulerModel->findAll();

        $data = [
            'title' => 'Jadwal Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler
        ];

        return view('siswa/jadwalEkstrakurikuler', compact('data'));
    }

    public function daftarEkstrakurikuler()
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') != 3) {
            return redirect()->to('/');
        }

        $ekstrakurikulerModel = new Ekstrakurikuler();
        $anggotaEkstrakurikulerModel = new AnggotaEkstrakurikuler();

        // Mengambil daftar semua ekstrakurikuler
        $ekstrakurikuler = $ekstrakurikulerModel->findAll();

        // Mengambil daftar ekstrakurikuler yang diikuti oleh siswa
        $ekstrakurikulerSaya = $anggotaEkstrakurikulerModel
            ->select('ekstrakurikulers.*')
            ->join('ekstrakurikulers', 'anggotaekstrakurikulers.ekstrakurikuler_id = ekstrakurikulers.id')
            ->where('anggotaekstrakurikulers.student_id', session('id'))
            ->findAll();

        if (!$ekstrakurikulerSaya) {
            $bukanEkstrakurikulerSaya = $ekstrakurikulerModel->findAll();
        } else {
            // Mengambil daftar ekstrakurikuler yang belum diikuti oleh siswa
            $bukanEkstrakurikulerSaya = $ekstrakurikulerModel
                ->whereNotIn('id', array_column($ekstrakurikulerSaya, 'id'))
                ->findAll();
        }

        $data = [
            'title' => 'Jadwal Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler,
            'dataEkstrakurikulerSaya' => $ekstrakurikulerSaya,
            'bukanEkstrakurikulerSaya' => $bukanEkstrakurikulerSaya
        ];

        return view('siswa/daftarEkstrakurikuler', compact('data'));
    }

    public function masukEkstrakurikuler()
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        if (session('role') != 3) {
            return redirect()->to('/');
        }

        $anggotaEkstrakurikulerModel = new AnggotaEkstrakurikuler();

        $data = [
            'ekstrakurikuler_id' => $this->request->getVar('ekstrakurikuler_id'),
            'student_id' => $this->request->getVar('id')
        ];

        if ($anggotaEkstrakurikulerModel->insert($data)) {
            return redirect()->back()->with('daftarEkstrakurikulerSuccess', 'Berhasil daftar ekstrakurikuler.');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data ekstrakurikuler.');
        }
    }

    public function keluarEkstrakurikuler($ekstrakurikuler_id, $student_id)
    {
        // Pastikan hanya pengguna yang sudah login yang bisa menghapus data
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        $anggotaEkstrakurikulerModel = new AnggotaEkstrakurikuler();
        $anggotaEkstrakurikuler = $anggotaEkstrakurikulerModel
            ->where('ekstrakurikuler_id', $ekstrakurikuler_id)
            ->where('student_id', $student_id)
            ->first();

        if ($anggotaEkstrakurikuler) {
            $anggotaEkstrakurikulerModel->where('ekstrakurikuler_id', $ekstrakurikuler_id)
                ->where('student_id', $student_id)->delete();
            return redirect()->back()->with('deleteEkstrakurikulerSayaSuccess', 'Data berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    }
}
