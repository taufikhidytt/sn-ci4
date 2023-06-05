<?php 

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_Siswa;

class Siswa extends Controller{

	public function __construct()
	{
		$this->model = new M_Siswa;
	}

    public function index(){
        
        $data = [
			'judul' => 'Data Siswa',
			'siswa' => $this->model->getAllData()
		];
		echo view('templates/v_header', $data);
		echo view('templates/v_sidebar');
		echo view('templates/v_topbar');
		echo view('siswa/index', $data);
		echo view('templates/v_footer');
    }

	public function tambah(){

		if (isset($_POST['tambah'])) {

			$validate = $this->validate([
				'nisn' => [
					'label'  => 'Nomor Induk Siswa Nasional',
					'rules'  => 'required|numeric|max_length[10]|is_unique[siswa.nisn]',
					'errors' =>	[
						'required' => '{field} Tidak Boleh Kosong',
						'numeric'  => '{field} Hanya Berisi Angka',
						'max_length' => '{field} Maksimal Panjang 10 Number',
						'is_unique'=> '{field} Sudah Terdaftar, Silahkan Cek Kembali NISN Anda'
					]
				],
				'nama' => [
					'label' => 'Nama Siswa',
					'rules' => 'required',
					'errors'=> [
						'required' => '{field} Tidak Boleh Kosong'
					]
				]
			]);

			if (!$validate) {
				session()->setFlashdata('err', \Config\Services::validation()->listErrors());

				$data = [
					'judul' => 'Data Siswa',
					'siswa' => $this->model->getAllData()
				];

			echo view('templates/v_header', $data);
			echo view('templates/v_sidebar');
			echo view('templates/v_topbar');
			echo view('siswa/index', $data);
			echo view('templates/v_footer');

			}else{

				$data = [
					'nisn' => $this->request->getPost('nisn'),
					'nama' => $this->request->getPost('nama'),
				];
		
				// Insert Data
				$success = $this->model->tambah($data);
		
				if($success){
					session()->setFlashdata('pesan', 'Di Tambahkan');
					return redirect()->to(base_url('siswa'));
				}
			}
		}else{
			return redirect()->to(base_url('siswa'));
		}
	}

	public function hapus(){
		$id = $this->request->getPost('id');
        $this->model->hapus($id);

        session()->setFlashdata('hapus', 'Dihapus!');
        return redirect()->to('/siswa');
	}

	public function ubah(){

		if (isset($_POST['ubah'])) {

		$id = $this->request->getPost('id');
		$nisn = $this->request->getPost('nisn');

		// mengambil semua data dengan parameter id dan mengambil nisn yg unik
		$db_nisn = $this->model->getDataById($id)['nisn'];
		
		// mengecek jika ada yg mengubah dengan nisn yg sudah terdaftar
		if ($nisn === $db_nisn) {
			
			$validate = $this->validate([
				'nisn' => [
					'label'  => 'Nomor Induk Siswa Nasional',
					'rules'  => 'required|numeric|max_length[10]',
					'errors' =>	[
						'required' => '{field} Tidak Boleh Kosong',
						'numeric'  => '{field} Hanya Berisi Angka',
						'max_length' => '{field} Maksimal Panjang 10 Number',
						'is_unique'=> '{field} Sudah Terdaftar, Silahkan Cek Kembali NISN Anda'
					]
				],
				'nama' => [
					'label' => 'Nama Siswa',
					'rules' => 'required',
					'errors'=> [
						'required' => '{field} Tidak Boleh Kosong'
					]
				]
			]);
		}else{

			$validate = $this->validate([
				'nisn' => [
					'label'  => 'Nomor Induk Siswa Nasional',
					'rules'  => 'required|numeric|max_length[10]|is_unique[siswa.nisn]',
					'errors' =>	[
						'required' => '{field} Tidak Boleh Kosong',
						'numeric'  => '{field} Hanya Berisi Angka',
						'max_length' => '{field} Maksimal Panjang 10 Number',
						'is_unique'=> '{field} Sudah Terdaftar, Silahkan Cek Kembali NISN Anda'
					]
				],
				'nama' => [
					'label' => 'Nama Siswa',
					'rules' => 'required',
					'errors'=> [
						'required' => '{field} Tidak Boleh Kosong'
					]
				]
			]);
		}

			if (!$validate) {
				session()->setFlashdata('err', \Config\Services::validation()->listErrors());

				$data = [
					'judul' => 'Data Siswa',
					'siswa' => $this->model->getAllData()
				];

			echo view('templates/v_header', $data);
			echo view('templates/v_sidebar');
			echo view('templates/v_topbar');
			echo view('siswa/index', $data);
			echo view('templates/v_footer');

			}else{

				$id = $this->request->getPost('id');

				$data = [
					'nisn' => $this->request->getPost('nisn'),
					'nama' => $this->request->getPost('nama'),
				];
		
				// Update Data
				$success = $this->model->ubah($data, $id);
		
				if($success){
					session()->setFlashdata('pesan', 'Di Ubah');
					return redirect()->to(base_url('siswa'));
				}
			}
		}else{
			return redirect()->to(base_url('siswa'));
		}
	}
}

?>