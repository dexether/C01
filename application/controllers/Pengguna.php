
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('message_lang', 'indonesia');
        $this->load->model('Shop_model', 'basicmodel');
        $this->load->helper('form');
        $this->load->helper('url');
        date_default_timezone_set('Asia/Jakarta');
        // $this->load->library('session');
        $this->load->library('nativesession');
        $this->load->library('format');
        $this->load->library('encrypt');
        $this->load->library('rajaongkir');
        if (!$this->nativesession->getObject('username')) {
            // code...
            redirect(base_url().'web2/index.php?redirect='.urlencode(current_url()));
        }
    }
    public function settings()
    {
        $this->load->library('rajaongkir');
        $this->load->model('penjual');
        $provinces = json_decode($this->rajaongkir->province());
        $dataProvinsi = $provinces->rajaongkir->results;
        $part = array(
            'header' => $this->load->view('mall/mainheader', array(), true),
            'body' => $this->load->view('mall/user/settings', array('dataProvinsi' => $dataProvinsi), true),
            'slider' => '',
        );
        $this->load->view('mall/index', $part);
    }
    public function simpan_alamat()
    {
      $provinsi = $this->input->post('provinsi');
      $kota = $this->input->post('kota');
      $aecodeid = $this->input->post('aecodeid');
      $data = array(
        'province_id' => $provinsi,
        'city_id' => $kota,
        'aecodeid' => $aecodeid,
        'created_on' => date('Y-m-d H:i:s')
      );
      $do = $this->db->insert('client_aecode_address', $data);
      if($do):
        $this->nativesession->set_flashdata('status', 'Data Alamat Sudah berhasil Disimpan');
      else:
        $this->nativesession->set_flashdata('status', 'Data Alamat Sudah Gagal Disimpan');
      endif;
      redirect('user/settings');
    }
}

/* End of file Buy_sell.php */
/* Location: ./application/controllers/Buy_sell.php */
