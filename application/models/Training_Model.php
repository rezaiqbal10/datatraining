<?php

/**
 * 
 */
class Training_Model extends CI_Model
{
	public function getAllData()
	{

		return $this->db->get('tbl_training')->result();
	}
	public function get_cari($cari)
	{
		$this->db->SELECT('*');
		$this->db->from('tbl_training');
		$this->db->like('nama', $cari);
		$this->db->or_like('tempat_tinggal', $cari);
		$this->db->or_like('komp_kes', $cari);
		$this->db->or_like('komp_pend', $cari);
		$this->db->or_like('komp_lain', $cari);
		$this->db->or_like('jml_penghasilan', $cari);
		$this->db->or_like('kondisi_rumah', $cari);
		$this->db->or_like('status_kelayakan', $cari);
		return $this->db->get()->result();
	}


	public function tambah_data()
	{
		// $jumlah_penghasilan = $this->input->post('jml_penghasilan', true);

		// if ($jumlah_penghasilan > 2500000) {
		// 	$kat = "tinggi";
		// }else if($jumlah_penghasilan >= 1500000 && $jumlah_penghasilan <= 2500000){
		// 	$kat = "sedang";
		// }else if($jumlah_penghasilan < 1500000){
		// 	$kat = "rendah";
		// }

		$data = array(
			// 'id_training' => $this->input->post('id_training', true),
			'nama' => $this->input->post('nama', true),
			'tempat_tinggal' => $this->input->post('tempat_tinggal', true),
			'komp_kes' => $this->input->post('komp_kes', true),
			'komp_pend' => $this->input->post('komp_pend', true),
			'komp_lain' => $this->input->post('komp_lain', true),
			'jml_penghasilan' => $this->input->post('jml_penghasilan', true),
			'kondisi_rumah' => $this->input->post('kondisi_rumah', true),
			'status_kelayakan' => $this->input->post('status_kelayakan', true)
		);

		$this->db->insert('tbl_training', $data);
	}

	public function ubah_data()
	{
		$data = array(
			'nama' => $this->input->post('nama', true),
			'tempat_tinggal' => $this->input->post('tempat_tinggal', true),
			'komp_kes' => $this->input->post('komp_kes', true),
			'komp_pend' => $this->input->post('komp_pend', true),
			'komp_lain' => $this->input->post('komp_lain', true),
			'jml_penghasilan' => $this->input->post('jml_penghasilan', true),
			'kondisi_rumah' => $this->input->post('kondisi_rumah', true),
			'status_kelayakan' => $this->input->post('status_kelayakan', true)
		);
		$this->db->where('id_training', $this->input->post('id_training', true));
		$this->db->update('tbl_training', $data);
	}

	public function hapus_data($id)
	{
		$this->db->delete('tbl_training', ['id_training' => $id]);
	}

	public function detail_data($id)
	{
		return $this->db->get_where('tbl_training', ['id_training' => $id])->row_array();
	}

	public function count_layak()
	{
		$this->db->where('status_kelayakan', 'Layak');
		$this->db->from('tbl_training');
		return $this->db->count_all_results();
	}

	public function count_tidaklayak()
	{
		$this->db->where('status_kelayakan', 'Tidak Layak');
		$this->db->from('tbl_training');
		return $this->db->count_all_results();
	}

	// ambil probabilitas PKH
	public function tempat_tinggal($status)
	{
		// $status = "layak";
		$this->db->where('tempat_tinggal', $status);
		$this->db->where('status_kelayakan', "Layak");
		$this->db->from('tbl_training');
		$layak = $this->db->count_all_results() / $this->count_layak();
		$this->db->where('tempat_tinggal', $status);
		$this->db->where('status_kelayakan', "Tidak Layak");
		$this->db->from('tbl_training');
		$tidak = $this->db->count_all_results() / $this->count_tidaklayak();
		return array('layak' => $layak, 'tidaklayak' => $tidak);
	}

	public function komp_kes($status)
	{
		// $status = "ibu hamil";
		$this->db->where('komp_kes', $status);
		$this->db->where('status_kelayakan', "Layak");
		$this->db->from('tbl_training');
		$layak = $this->db->count_all_results() / $this->count_layak();
		$this->db->where('komp_kes', $status);
		$this->db->where('status_kelayakan', "Tidak Layak");
		$this->db->from('tbl_training');
		$tidak = $this->db->count_all_results() / $this->count_tidaklayak();
		return array('layak' => $layak, 'tidaklayak' => $tidak);
	}

	public function komp_pend($status)
	{
		// $status = "SMP";
		$this->db->where('komp_pend', $status);
		$this->db->where('status_kelayakan', "Layak");
		$this->db->from('tbl_training');
		$layak = $this->db->count_all_results() / $this->count_layak();
		$this->db->where('komp_pend', $status);
		$this->db->where('status_kelayakan', "Tidak Layak");
		$this->db->from('tbl_training');
		$tidak = $this->db->count_all_results() / $this->count_tidaklayak();
		return array('layak' => $layak, 'tidaklayak' => $tidak);
	}

	public function komp_lain($status)
	{
		// $status = "Disabilitas";
		$this->db->where('kondisi_rumah', $status);
		$this->db->where('status_kelayakan', "Layak");
		$this->db->from('tbl_training');
		$layak = $this->db->count_all_results() / $this->count_layak();
		$this->db->where('kondisi_rumah', $status);
		$this->db->where('status_kelayakan', "Tidak Layak");
		$this->db->from('tbl_training');
		$tidak = $this->db->count_all_results() / $this->count_tidaklayak();
		return array('layak' => $layak, 'tidaklayak' => $tidak);
	}

	public function jml_penghasilan($status)
	{
		$kat = "";
		if ($status > 2500000) {
			$kat = "tinggi";
		} else if ($status >= 1500000 && $status <= 2500000) {
			$kat = "sedang";
		} else if ($status < 1500000) {
			$kat = "rendah";
		}
		$q_layak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT jml_penghasilan,  status_kelayakan,
			CASE
			WHEN jml_penghasilan > 2500000 THEN 'tinggi'
			WHEN jml_penghasilan >= 1500000 AND jml_penghasilan <= 2500000 THEN 'sedang'
			WHEN jml_penghasilan < 1500000 THEN 'rendah'
			ELSE ''
			END AS c_jml_penghasilan
			FROM tbl_training 
			) as conversi_jml_penghasilan  WHERE c_jml_penghasilan ='$kat' AND status_kelayakan = 'layak'
			")->row();
		$layak = $q_layak->jml / $this->count_layak();
		$q_tidak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT jml_penghasilan,  status_kelayakan,
			CASE
			WHEN jml_penghasilan > 2500000 THEN 'tinggi'
			WHEN jml_penghasilan >= 1500000 AND jml_penghasilan <= 2500000 THEN 'sedang'
			WHEN jml_penghasilan < 1500000 THEN 'rendah'
			ELSE ''
			END AS c_jml_penghasilan
			FROM tbl_training 
			) as conversi_jml_penghasilan  WHERE c_jml_penghasilan ='$kat' AND status_kelayakan = 'tidak layak'
			")->row();
		$tidak = $q_tidak->jml / $this->count_tidaklayak();

		return array('layak' => $layak, 'tidaklayak' => $tidak);
	}

	public function kondisi_rumah($status)
	{
		// $status = "Batu permanen";
		$this->db->where('kondisi_rumah', $status);
		$this->db->where('status_kelayakan', "Layak");
		$this->db->from('tbl_training');
		$layak = $this->db->count_all_results() / $this->count_layak();
		$this->db->where('kondisi_rumah', $status);
		$this->db->where('status_kelayakan', "Tidak Layak");
		$this->db->from('tbl_training');
		$tidak = $this->db->count_all_results() / $this->count_tidaklayak();
		return array('layak' => $layak, 'tidaklayak' => $tidak);
	}
}
