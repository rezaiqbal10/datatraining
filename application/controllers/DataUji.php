<?php

/**
 * 
 */
class DataUji extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Uji_Model');
		$this->load->model('Training_Model');
		$this->load->library('form_validation');
	}

	function index()
	{

		$data['training'] = $this->Training_Model->getAllData();
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('uji/index', $data);
		$this->load->view('templates/footer');
	}

	public function hapus($id)
	{
		$this->Uji_Model->hapus_data($id);
		$this->session->set_flashdata('flash_uji', 'Dihapus');
		redirect('DataUji');
	}

	public function ubah($id)
	{

		$this->form_validation->set_rules("nama", "Nama ", "required");
		$this->form_validation->set_rules("tempat_tinggal", "tempat tinggal", "required");
		$this->form_validation->set_rules("komp_kes", "komponen kesehatan ", "required");
		$this->form_validation->set_rules("komp_pend", "komponen pendidikan ", "required");
		$this->form_validation->set_rules("komp_lain", "komponen lainya", "required");
		$this->form_validation->set_rules("jml_penghasilan", "Jumlah Penghasilan", "required");
		$this->form_validation->set_rules("kondisi_rumah", "Kondisi Rumah", "required");


		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->Uji_Model->detail_data($id);
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('uji/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$this->Uji_Model->ubah_data();
			$this->session->set_flashdata('flash_uji', 'DiUbah');
			redirect('DataUji');
		}
	}

	function hitung()
	{
		$output = "";
		$this->form_validation->set_rules("nama", "Nama ", "required");
		$this->form_validation->set_rules("tempat_tinggal", "tempat tinggal", "required");
		$this->form_validation->set_rules("komp_kes", "komponen kesehatan ", "required");
		$this->form_validation->set_rules("komp_pend", "komponen pendidikan ", "required");
		$this->form_validation->set_rules("komp_lain", "komponen lainya", "required");
		$this->form_validation->set_rules("jml_penghasilan", "Jumlah Penghasilan", "required");
		$this->form_validation->set_rules("kondisi_rumah", "Kondisi Rumah", "required");
		if ($this->form_validation->run() == FALSE) {
			$data['ubah'] = $this->Uji_Model->detail_data();
			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('uji/ubah', $data);
			$this->load->view('templates/footer');
		} else {
			$tempat_tinggal = array();
			$komp_kes = array();
			$komp_pend = array();
			$komp_lain = array();
			$jml_penghasilan = array();
			$kondisi_rumah = array();

			$jumlah_layak = $this->Training_Model->count_layak();
			$jumlah_tidak_layak = $this->Training_Model->count_tidaklayak();
			$total_training = $jumlah_layak + $jumlah_tidak_layak;
			$tempat_tinggal = $this->Training_Model->tempat_tinggal($this->input->post('tempat_tinggal'));
			$komp_kes = $this->Training_Model->komp_kes($this->input->post('komp_kes'));
			$komp_pend = $this->Training_Model->komp_pend($this->input->post('$komp_pend'));
			$komp_lain = $this->Training_Model->komp_lain($this->input->post('$komp_lain'));
			$jml_penghasilan = $this->Training_Model->jml_penghasilan($this->input->post('jml_penghasilan'));
			$kondisi_rumah = $this->Training_Model->kondisi_rumah($this->input->post('kondisi_rumah'));



			//perhitungan //Step 1

			$output .= "
			<table id='example1' class='table table-bordered table-striped'>
			<thead>
			<tr>
			<th>Jumlah Data</th>
			<th>Kelas PC1(Layak)</th>
			<th>Kelas PC2(Tidak Layak)</th>
			</tr>
			<tr>
			<td>" . $total_training . "</td>
			<td>" . $jumlah_layak . "</td>
			<td>" . $jumlah_tidak_layak . "</td>
			</tr>
			</thead>
			</table>";



			//Step 1
			//tampil
			$PC1 = round($jumlah_layak / ($jumlah_tidak_layak + $jumlah_layak), 2);
			$PC2 = round($jumlah_tidak_layak / ($jumlah_tidak_layak + $jumlah_layak), 2);

			$kelas_layak = round($tempat_tinggal['layak'], 2) * round($komp_kes['layak'], 2) * round($komp_pend['layak'], 2) * round($komp_lain['layak'], 2) * round($jml_penghasilan['layak'], 2) * round($kondisi_rumah['layak'], 2) * $PC1;

			$kelas_tidak_layak = round($tempat_tinggal['tidaklayak'], 2) * round($komp_kes['tidaklayak'], 2) * round($komp_pend['tidaklayak'], 2) * round($komp_lain['tidaklayak'], 2) * round($jml_penghasilan['tidaklayak'], 2) * round($kondisi_rumah['tidaklayak'], 2) * $PC2;

			$output .= "----Probabilitas Prior----<br>";
			$output .= "
			<table id='example1' class='table table-bordered table-striped'>
			<thead>
			<tr>
			<th>Kelas PC1(Layak)</th>
			<th>Kelas PC2(Tidak Layak)</th>
			</tr>
			<tr>
			<td>" . $PC1 . "</td>
			<td>" . $PC2 . "</td>
			</tr>
			</thead>
			</table>";




			// //STEP 2

			$output .= "----Probabilitas Posterior----<br>";

			$output .= "tempat_tinggal : ";
			$output .= var_dump($tempat_tinggal);
			$output .= "<br>";
			$output .= "komp_kes : ";
			$output .= var_dump($komp_kes);
			$output .= "<br>";
			$output .= "komp_pend : ";
			$output .= var_dump($komp_pend);
			$output .= "<br>";
			$output .= "komp_lain : ";
			$output .= var_dump($komp_lain);
			$output .= "<br>";
			$output .= "jml_penghasilan : ";
			$output .= var_dump($jml_penghasilan);
			$output .= "<br>";
			$output .= "kondisi_rumah : ";
			$output .= var_dump($kondisi_rumah);
			$output .= "<br><br>";


			//step 3
			$output .= "----Probabilitas Data Uji----<br>";
			$output .= " PC1 (Layak) <br> 
			<table id='example1' class='table table-bordered table-striped'>
			<thead>
			<tr>
			<th> </th>
			<th>Tempat Tinggal</th>
			<th>Komponen Kesehatan</th>
			<th>Komponen Pendidikan</th>
			<th>Komponen Lain</th>
			<th>Jml Penghasilan</th>
			<th>Kondisi rumah</th>
			<th>Hasil Probabilitas</th>
			</tr>
			<tr>
			<td>PC1 (Layak)</th>
			<td>" . round($tempat_tinggal['layak'], 2) . "</td>
			<td>" . round($komp_kes['layak'], 2) . "</td>
			<td>" . round($komp_pend['layak'], 2) . "</td>
			<td>" . round($komp_lain['layak'], 2) . "</td>
			<td>" . round($jml_penghasilan['layak'], 2) . "</td>
			<td>" . round($kondisi_rumah['layak'], 2) . "</td>
			
			
			<td>" . $kelas_layak . "</td>
			</tr>

			<tr>
			<td>PC0 (Tidak Layak)</th>
			<td>" . round($tempat_tinggal['tidaklayak'], 2) . "</td>
			<td>" . round($komp_kes['tidaklayak'], 2) . "</td>
			<td>" . round($komp_pend['tidaklayak'], 2) . "</td>
			<td>" . round($komp_lain['tidaklayak'], 2) . "</td>
			<td>" . round($jml_penghasilan['tidaklayak'], 2) . "</td>
			<td>" . round($kondisi_rumah['tidaklayak'], 2) . "</td>

			<td>" . $kelas_tidak_layak . "</td>
			</tr>
			</thead>
			</table>";


			$output .= "----Probabilitas Data Uji----<br>";
			$output .= "-PC1 (Layak) <br> ";
			$output .= "Tempat Tinggal: " . round($tempat_tinggal['tidaklayak'], 2);
			$output .= "<br>Komponen Kesehatan: " . round($komp_kes['tidaklayak'], 2);
			$output .= "<br>Komponen Pendidikan: " . round($komp_pend['tidaklayak'], 2);
			$output .= "<br>Komponen Lain: " . round($komp_lain['tidaklayak'], 2);
			$output .= "<br>Jumlah Penghasilan: " . round($jml_penghasilan['tidaklayak'], 2);
			$output .= "<br>Kondisi Rumah: " . round($kondisi_rumah['tidaklayak'], 2);
			$output .= "<br>Hasil Probabilitas: ";

			$output .= $kelas_tidak_layak = round($tempat_tinggal['tidaklayak'], 2) * round($komp_kes['tidaklayak'], 2) * round($komp_pend['tidaklayak'], 2) * round($komp_lain['tidaklayak'], 2) * round($jml_penghasilan['tidaklayak'], 2) * round($kondisi_rumah['tidaklayak'], 2) * $PC2;

			$output .= " </br><br>";
			$output .= "-PC2 (tidak Layak)<br>";

			$output .= "Tempat Tinggal: " . round($tempat_tinggal['layak'], 2);
			$output .= "<br>Komponen Kesehatan: " . round($komp_kes['layak'], 2);
			$output .= "<br>Komponen Pendidikan: " . round($komp_pend['layak'], 2);
			$output .= "<br>komponen Lain: " . round($komp_lain['layak'], 2);
			$output .= "<br>Jumlah Penghasilan: " . round($jml_penghasilan['layak'], 2);
			$output .= "<br>Kondisi Rumah: " . round($kondisi_rumah['layak'], 2);
			$output .= "<br> Hasil Probabilitas: ";

			$output .= $kelas_layak = round($tempat_tinggal['layak'], 2) * round($komp_kes['layak'], 2) * round($komp_pend['layak'], 2) * round($komp_lain['layak'], 2) * round($jml_penghasilan['layak'], 2) * round($kondisi_rumah['layak'], 2) * $PC1;

			$kesimpulan = "";
			$operator = "";

			echo "kelas layak" . $kelas_layak . "<br>";
			echo "kelas tidak layak" . $kelas_tidak_layak . "<br>";

			echo "<br>";
			if ($kelas_layak >= $kelas_tidak_layak) {
				$kesimpulan = "layak";
				$operator = ">=";
			} else {
				$kesimpulan = "Tidak layak";
				$operator = "<=";
			}

			$output .= "<br>Dapat disimpulkan Bahwa Data Uji tersebut <b><u>" . $kesimpulan . "</u></b> Sebagai Penerima PKH";

			// masukan hasil kesimpulan dalam parameter untuk di save
			$this->Uji_Model->tambah_data($kesimpulan);
			$this->session->set_flashdata('flash_uji', 'dihitung');
			$this->session->set_flashdata('flash_hitung', $output);
			redirect('DataUji');
			echo $output;
		}
	}
}
