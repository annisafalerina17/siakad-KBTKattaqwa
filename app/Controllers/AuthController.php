<?php

namespace App\Controllers;

use App\Models\AnggotaKelas;
use App\Models\BiodataGuru;
use App\Models\BiodataSiswa;
use App\Models\User;
use CodeIgniter\HTTP\Request;
use Config\Validation as validation;

class AuthController extends BaseController
{
    public function index() //arahan tampilan setelah user melakukan login
    {
        if (session()->has('id')) {
            $role = session('role');
            switch ($role) {
                case 1:
                    return redirect()->to('/admin/dashboard');
                case 2:
                    return redirect()->to('/admin/dashboard');
                case 3:
                    return redirect()->to('/siswa/profil');
            }
        }

        $data = [
            'title' => 'Login'
        ];
        return view('auth/login', compact('data'));
    }

    public function registerPage() //menampilkan hal.register
    {
        $data = [
            'title' => 'Register'
        ];

        return view('auth/register', compact('data'));
    }

    public function login() //menampilkan hal.login
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'result' => [
                'label' => 'Jawaban',
                'rules' => 'required|matches[res]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'matches' => 'Jawaban salah.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new User();
        $username = strtolower($this->request->getVar('username'));
        $password = $this->request->getVar('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $this->setUserSession($user);
            return redirect()->to('/');
        } else {
            return redirect()->back()->withInput()->with('errors', ['login' => 'Username atau Password salah!']);
        }
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'username' => $user['username'],
            'name' => $user['name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'position' => $user['position'],
            'role' => $user['role'],
            'avatar' => $user['avatar'],
        ];

        session()->set($data);
        return true;
    }

    public function register() //tambah data admin, guru dan siswa
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'position' => [
                'label' => 'Posisi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        if ($this->request->getVar('position') == "Siswa") {
            $validation->setRules([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah terdaftar.'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'confirm_password' => [
                    'label' => 'Konfirmasi Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'matches' => '{field} tidak cocok dengan Password.'
                    ]
                ],
                'name' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'nisn' => [
                    'label' => 'NISN',
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'is_unique' => '{field} sudah terdaftar.'
                    ]
                ],
                'birthday' => [
                    'label' => 'Tanggal Lahir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'address' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'gender' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
                'avatar' => [
                    'label' => 'Avatar',
                    'rules' => 'uploaded[avatar]|max_size[avatar,1024]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Pilih file {field} terlebih dahulu.',
                        'max_size' => 'Ukuran file {field} tidak boleh lebih dari 1MB.',
                        'is_image' => 'File {field} harus berupa gambar.',
                        'mime_in' => 'Format file {field} harus jpg, jpeg, atau png.'
                    ]
                ]
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            // Proses penyimpanan data ke database
            $userModel = new User();

            // Ambil file avatar
            $avatar = $this->request->getFile('avatar');
            // Generate nama file baru untuk avatar
            $avatarName = $avatar->getRandomName();
            // Pindahkan file avatar ke folder public/avatar
            $avatar->move(ROOTPATH . 'public/avatar', $avatarName);

            $data = [
                'username' => strtolower($this->request->getVar('username')),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'name' => $this->request->getVar('name'),
                'email' => strtolower($this->request->getVar('email')),
                'phone' => $this->request->getVar('phone'),
                'position' => $this->request->getVar('position'),
                'avatar' => $avatarName
            ];

            $data['role'] = 3;
            $userModel->insert($data);

            $latestUser = $userModel->orderBy('id', 'DESC')->first();

            $biodataSiswaModel = new BiodataSiswa();

            $biodataSiswa = [
                'student_id' => $latestUser['id'],
                'nisn' => $this->request->getVar('nisn'),
                'name' => $this->request->getVar('name'),
                'call' => $this->request->getVar('call'),
                'gender' => $this->request->getVar('gender'),
                'birthday' => $this->request->getVar('birthday'),
                'address' => $this->request->getVar('address'),
                'nth_child' => NULL,
                'siblings' => NULL,
                'religion' => NULL,
                'avatar' => $avatarName,
                'fathers_name' => $this->request->getVar('fathers_name'),
                'mothers_name' => $this->request->getVar('mothers_name'),
                'fathers_phone' => $this->request->getVar('fathers_phone'),
                'mothers_phone' => $this->request->getVar('mothers_phone'),
                'fathers_birthday' => NULL,
                'fathers_nik' => NULL,
                'mothers_nik' => NULL,
                'fathers_edu' => NULL,
                'mothers_edu' => NULL,
                'fathers_income' => NULL,
                'mothers_income' => NULL,

            ];
            $biodataSiswaModel->insert($biodataSiswa);

            if (session()->has('id')) {
                return redirect()->to('/admin/dataSiswa')->with('registerSuccess', 'Registrasi berhasil!');
            }
            return redirect()->to('/register')->with('registerSuccess', 'Registrasi berhasil!');
        }

        // NON SISWA INSERT DATA
        $validation->setRules([
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'confirm_password' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'matches' => '{field} tidak cocok dengan Password.'
                ]
            ],
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'valid_email' => '{field} tidak valid.'
                ]
            ],
            'phone' => [
                'label' => 'Telepon',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'avatar' => [
                'label' => 'Avatar',
                'rules' => 'uploaded[avatar]|max_size[avatar,1024]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih file {field} terlebih dahulu.',
                    'max_size' => 'Ukuran file {field} tidak boleh lebih dari 1MB.',
                    'is_image' => 'File {field} harus berupa gambar.',
                    'mime_in' => 'Format file {field} harus jpg, jpeg, atau png.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Proses penyimpanan data ke database
        $userModel = new User();

        // Ambil file avatar
        $avatar = $this->request->getFile('avatar');
        // Generate nama file baru untuk avatar
        $avatarName = $avatar->getRandomName();
        // Pindahkan file avatar ke folder public/avatar
        $avatar->move(ROOTPATH . 'public/avatar', $avatarName);

        $data = [
            'username' => strtolower($this->request->getVar('username')),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'phone' => $this->request->getVar('phone'),
            'position' => $this->request->getVar('position'),
            'avatar' => $avatarName
        ];

        if ($data['position'] == "Kepala Sekolah") {
            $data['role'] = 1;
        } else if ($data['position'] == "Staff") {
            $data['role'] = 1;
        } else if ($data['position'] == "Guru") {
            $data['role'] = 2;
        }

        $userModel->insert($data);

        $latestUser = $userModel->orderBy('id', 'DESC')->first();

        $biodataGuruModel = new BiodataGuru();

        $biodataGuru = [
            'teacher_id' => $latestUser['id'],
            'name' => $this->request->getVar('name'),
            'nik' => NULL,
            'call' => NULL,
            'education' => NULL,
            'avatar' => $latestUser['avatar'],
            'nuptk' => NULL,
            'nrg' => NULL,
            'employee_status' => NULL,
            'position' => $this->request->getVar('position'),
            'institution' => NULL,
            'npsn' => NULL,
            'school_address' => NULL,

        ];
        $biodataGuruModel->insert($biodataGuru);
        if (session()->has('id')) {
            return redirect()->to('/admin/dataGuru')->with('registerSuccess', 'Registrasi berhasil!');
        }
        return redirect()->to('/register')->with('registerSuccess', 'Registrasi berhasil!');
    }

    public function resetPassword() //ganti password
    {
        $id = $this->request->getVar('id');
        $password = $this->request->getVar('password');
        $confirm_password = $this->request->getVar('confirm_password');

        // Validasi bahwa password dan konfirmasi password sesuai
        if ($password !== $confirm_password) {
            if (session('role') != 3) {
                return redirect('admin/dashboard')->with('resetPasswordFailed', 'Password dan Konfirmasi Password tidak sesuai');
            } else {
                return redirect('siswa/profil')->with('resetPasswordFailed', 'Password dan Konfirmasi Password tidak sesuai');
            }
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update password di database
        $userModel = new User();
        $userModel->update($id, ['password' => $hashed_password]);

        if (session('role') != 3) {
            return redirect('admin/dashboard')->with('resetPasswordSuccess', 'Password berhasil diperbarui');
        } else {
            return redirect('siswa/profil')->with('resetPasswordSuccess', 'Password berhasil diperbarui');
        }
    }

    public function delete($id) //delete user
    {
        // Pastikan hanya pengguna yang sudah login yang bisa menghapus data
        if (!session()->has('id')) {
            return redirect()->to('/');
        }

        // Pastikan hanya pengguna dengan role 1 yang bisa menghapus data
        if (session('role') != 1) {
            return redirect()->to('/');
        }

        // Cegah pengguna menghapus dirinya sendiri
        if ($id == session('id')) {
            return redirect()->to('/');
        }

        $userModel = new User();
        $biodataSiswaModel = new BiodataSiswa();
        $biodataGuruModel = new BiodataGuru();
        $anggotaKelasModel = new AnggotaKelas();
        $user = $userModel->getUserById($id);

        if ($user) {
            if ($user['role'] == 3) {
                // Hapus file avatar jika ada
                unlink('avatar/' . $user['avatar']);

                $biodataSiswaModel->where('student_id', $id)->delete();
                $anggotaKelasModel->where('user_id', $id)->delete();
                // Hapus data dari database
                if ($userModel->delete($id)) {
                    return redirect()->back()->with('deleteUserSuccess', 'Data berhasil dihapus');
                } else {
                    return redirect()->back()->with('error', 'Data gagal dihapus');
                }
            } else {
                // Hapus file avatar jika ada
                unlink('avatar/' . $user['avatar']);

                $biodataGuruModel->where('teacher_id', $id)->delete();
                $anggotaKelasModel->where('user_id', $id)->delete();
                // Hapus data dari database
                if ($userModel->delete($id)) {
                    return redirect()->back()->with('deleteUserSuccess', 'Data berhasil dihapus');
                } else {
                    return redirect()->back()->with('error', 'Data gagal dihapus');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
        }
    }

    public function editBiodataGuru() //edit profil staf dan guru oleh masing2
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        $userModel = new User();
        $biodataGuruModel = new BiodataGuru();

        $id = $this->request->getPost('id');
        $user = $userModel->find($id);
        $userBiodata = $biodataGuruModel->where('teacher_id', $id)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'email' => 'required|valid_email',
            'nik' => 'required|numeric',
            'education' => 'required',
            'avatar' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]',
            'nuptk' => 'required|numeric',
            'nrg' => 'required|numeric',
            'employee_status' => 'required',
            'position' => 'required',
            'institution' => 'required',
            'npsn' => 'required|numeric',
            'school_address' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Handle file upload
        $avatar = $this->request->getFile('avatar');
        if ($avatar != "") {
            if ($avatar != session('avatar')) {
                unlink('avatar/' . session('avatar'));
                // Ambil file avatar
                $avatar = $this->request->getFile('avatar');
                // Generate nama file baru untuk avatar
                $avatarName = $avatar->getRandomName();
                // Pindahkan file avatar ke folder public/avatar
                $avatar->move(ROOTPATH . 'public/avatar', $avatarName);
            } else {
                $avatarName = session('avatar');
            }
        } else {
            $avatarName = session('avatar');
        }
        session()->set('avatar', $avatarName);
        $userUpdateData = [
            'username' => $user['username'],
            'password' => $user['password'],
            'name' => $this->request->getPost('name'),
            'email' => strtolower($this->request->getVar('email')),
            'phone' => $user['phone'],
            'position' => $this->request->getPost('position'),
            'role' => $user['role'],
            'avatar' => $avatarName,
        ];

        $userModel->update($id, $userUpdateData);

        $biodataGuruUpdateData = [
            'teacher_id' => $userBiodata['teacher_id'],
            'name' => $this->request->getVar('name'),
            'nik' => $this->request->getVar('nik'),
            'education' => $this->request->getVar('education'),
            'avatar' => $avatarName,
            'nuptk' => $this->request->getVar('nuptk'),
            'nrg' => $this->request->getVar('nrg'),
            'employee_status' => $this->request->getVar('employee_status'),
            'position' => $this->request->getVar('position'),
            'institution' => $this->request->getVar('institution'),
            'npsn' => $this->request->getVar('npsn'),
            'school_address' => $this->request->getVar('school_address'),
        ];

        $biodataGuruModel->set($biodataGuruUpdateData)->where('teacher_id', $id)->update();

        return redirect()->to('/admin/profil')->with('updateSuccess', 'Data berhasil diperbarui');
    }

    public function editBiodataSiswa() //edit profile siswa oleh siswa
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') != 3) {
            return redirect()->to('/');
        }

        $userModel = new User();
        $biodataSiswaModel = new BiodataSiswa();

        $id = $this->request->getPost('id');
        $user = $userModel->find($id);
        $userBiodata = $biodataSiswaModel->where('student_id', $id)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'call' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'nth_child' => 'required',
            'siblings' => 'required',
            'religion' => 'required',
            'avatar' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]',
            'fathers_name' => 'required',
            'mothers_name' => 'required',
            'fathers_birthday' => 'required',
            'mothers_birthday' => 'required',
            'fathers_nik' => 'required',
            'mothers_nik' => 'required',
            'fathers_edu' => 'required',
            'mothers_edu' => 'required',
            'fathers_occupation' => 'required',
            'mothers_occupation' => 'required',
            'fathers_income' => 'required',
            'mothers_income' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Handle file upload
        $avatar = $this->request->getFile('avatar');
        if ($avatar != "") {
            if ($avatar != session('avatar')) {
                unlink('avatar/' . session('avatar'));
                // Ambil file avatar
                $avatar = $this->request->getFile('avatar');
                // Generate nama file baru untuk avatar
                $avatarName = $avatar->getRandomName();
                // Pindahkan file avatar ke folder public/avatar
                $avatar->move(ROOTPATH . 'public/avatar', $avatarName);
            } else {
                $avatarName = session('avatar');
            }
        } else {
            $avatarName = session('avatar');
        }
        session()->set('avatar', $avatarName);
        $userUpdateData = [
            'username' => $user['username'],
            'password' => $user['password'],
            'name' => $this->request->getPost('name'),
            'email' => $user['email'],
            'phone' => $user['phone'],
            'position' => $user['position'],
            'role' => $user['role'],
            'avatar' => $avatarName,
        ];

        $userModel->update($id, $userUpdateData);

        $biodataSiswaUpdateData = [
            'student_id' => $userBiodata['student_id'],
            'nisn' => $userBiodata['nisn'],
            'name' => $this->request->getVar('name'),
            'call' => $this->request->getVar('call'),
            'gender' => $this->request->getVar('gender'),
            'birthday' => $this->request->getVar('birthday'),
            'nth_child' => $this->request->getVar('nth_child'),
            'siblings' => $this->request->getVar('siblings'),
            'religion' => $this->request->getVar('religion'),
            'avatar' => $avatarName,
            'fathers_name' => $this->request->getVar('fathers_name'),
            'mothers_name' => $this->request->getVar('mothers_name'),
            'fathers_birthday' => $this->request->getVar('fathers_birthday'),
            'mothers_birthday' => $this->request->getVar('mothers_birthday'),
            'fathers_nik' => $this->request->getVar('fathers_nik'),
            'mothers_nik' => $this->request->getVar('mothers_nik'),
            'fathers_edu' => $this->request->getVar('fathers_edu'),
            'mothers_edu' => $this->request->getVar('mothers_edu'),
            'fathers_occupation' => $this->request->getVar('fathers_occupation'),
            'mothers_occupation' => $this->request->getVar('mothers_occupation'),
            'fathers_income' => $this->request->getVar('fathers_income'),
            'mothers_income' => $this->request->getVar('mothers_income'),
        ];

        $biodataSiswaModel->set($biodataSiswaUpdateData)->where('student_id', $id)->update();

        return redirect()->to('/siswa/profil')->with('updateSuccess', 'Data berhasil diperbarui');
    }

    public function editRegGuru() //aksi edit data guru 
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        $userModel = new User();
        $biodataGuruModel = new BiodataGuru();

        $id = $this->request->getPost('id');
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required'
        ]);

        if ($this->request->getPost('username') != null) {
            $validation->setRules([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'is_unique[users.username]',
                    'errors' => [
                        'is_unique' => '{field} sudah terdaftar.'
                    ]
                ]
            ]);
        }

        if ($this->request->getPost('password') != null) {
            $validation->setRules([
                'confirm_password' => [
                    'label' => 'Konfirmasi Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'matches' => '{field} tidak cocok dengan Password.'
                    ]
                ]
            ]);
        }

        if ($this->request->getPost('confirm_password') != null) {
            $validation->setRules([
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
            ]);
        }

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userUpdateData = [
            'name' => $this->request->getPost('name'),
            'email' => strtolower($this->request->getVar('email')),
            'phone' => $this->request->getPost('phone'),
        ];

        if ($this->request->getPost('username') != null) {
            $userUpdateData['username'] = strtolower($this->request->getVar('username'));
        }

        if ($this->request->getPost('password') != null) {
            $userUpdateData['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($id, $userUpdateData);

        $biodataGuruUpdateData = [
            'name' => $this->request->getVar('name'),
        ];

        $biodataGuruModel->set($biodataGuruUpdateData)->where('teacher_id', $id)->update();

        return redirect()->to('/admin/dataGuru')->with('updateSuccess', 'Data berhasil diperbarui');
    }

    public function editRegSiswa() //aksi edit data siswa
    {
        if (!session()->has('id')) {
            return redirect()->to('/');
        }
        if (session('role') == 3) {
            return redirect()->to('/');
        }

        $userModel = new User();
        $biodataSiswaModel = new BiodataSiswa();

        $id = $this->request->getPost('id');
        $user = $userModel->find($id);


        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required',
            'call' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'fathers_name' => 'required',
            'mothers_name' => 'required',
            'fathers_phone' => 'required',
            'mothers_phone' => 'required',
        ]);

        if ($this->request->getPost('username') != null) {
            $validation->setRules([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'is_unique[users.username]',
                    'errors' => [
                        'is_unique' => '{field} sudah terdaftar.'
                    ]
                ]
            ]);
        }

        if ($this->request->getPost('password') != null) {
            $validation->setRules([
                'confirm_password' => [
                    'label' => 'Konfirmasi Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} harus diisi.',
                        'matches' => '{field} tidak cocok dengan Password.'
                    ]
                ]
            ]);
        }

        if ($this->request->getPost('confirm_password') != null) {
            $validation->setRules([
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi.'
                    ]
                ],
            ]);
        }

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userUpdateData = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
        ];

        if ($this->request->getPost('username') != null) {
            $userUpdateData['username'] = strtolower($this->request->getVar('username'));
        }

        if ($this->request->getPost('password') != null) {
            $userUpdateData['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($id, $userUpdateData);

        $biodataSiswaUpdateData = [
            'name' => $this->request->getVar('name'),
            'call' => $this->request->getVar('call'),
            'gender' => $this->request->getVar('gender'),
            'birthday' => $this->request->getVar('birthday'),
            'fathers_name' => $this->request->getVar('fathers_name'),
            'mothers_name' => $this->request->getVar('mothers_name'),
            'fathers_phone' => $this->request->getVar('fathers_phone'),
            'mothers_phone' => $this->request->getVar('mothers_phone'),
        ];

        $biodataSiswaModel->set($biodataSiswaUpdateData)->where('student_id', $id)->update();

        return redirect()->to('/admin/dataSiswa')->with('updateSuccess', 'Data berhasil diperbarui');
    }

    public function logout()
    {
        if (session()->has('id')) {
            session()->destroy();
        }

        return redirect()->to('/');
    }
}
