<?php

class Mod_ecommerce_ongkir extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('rajaongkir');
    }
    public function index()
    {
        $cities = $this->rajaongkir->city();
    }
    public function getCity()
    {
        $province = $this->input->get('provinsi');
        $cities = $this->rajaongkir->city($province);
        $array = json_decode($cities);
        $datakota = $array->rajaongkir->results;
        foreach ($datakota as $key => $value) {
            $datakotas[$value->city_id] = $value->type.' '.$value->city_name;
        }
        echo json_encode($datakotas, JSON_PRETTY_PRINT);
    }
    public function getOngkos($provinsi, $kota, $invoice = 'AGFX2016102101392569')
    {
        // Pilih Harga dan Orangnya
      // 152 jakarta Pusat
        $this->db->select('master_invoice.invoice, master_product.prod_name, client_aecode.name, email, client_aecode_address.city_id, master_product.prod_weight');
        $this->db->from('master_invoice');
        $this->db->join('master_cart', 'master_invoice.invoice = master_cart.invoice');
        $this->db->join('master_product', 'master_cart.id_prod = master_product.id');
        $this->db->join('client_aecode', 'master_product.aecodeid = client_aecode.aecodeid');
        $this->db->join('client_aecode_address', 'client_aecode.aecodeid = client_aecode_address.aecodeid', 'left');
        $this->db->group_by('client_aecode.aecodeid');
        $this->db->where('master_invoice.invoice', $invoice);
        $get = $this->db->get();

        foreach ($get->result() as $key => $value) {
            $kota_pengririm = ($value->city_id == null) ? 152 : $value->city_id;
        // var_dump($kota);
        $cities[] = $this->rajaongkir->cost($kota_pengririm, $kota, $value->prod_weight, 'jne');
        }
      // print_r($cities);
      foreach ($cities as $key => $value) {

        // code...
        $decode = json_decode($value);
          $ongkir = array();
          foreach ($decode->rajaongkir->results as $results):
          foreach ($results->costs as $costs):
            $ongkir_int = $costs->cost[0]->value;
          $ongkir[$costs->service] = @$ongkir[$costs->service] + $ongkir_int;
          endforeach;
          endforeach;
      }
        echo json_encode($ongkir, JSON_PRETTY_PRINT);
      // origin=501&destination=114&weight=1700&courier=jne
      // $cities = $this->rajaongkir->cost($kota, $destination, $weight, $courier);
    }
}
