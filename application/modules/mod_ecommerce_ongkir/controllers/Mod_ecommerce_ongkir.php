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
        $province = $this->input->get('province_id');
        $cities = $this->rajaongkir->city($province);
        // dd($cities);
        $array = json_decode($cities);
        $datakota = $array->rajaongkir->results;
        foreach ($datakota as $key => $value) {
            $datakotas[$value->city_id] = $value->type.' '.$value->city_name;
        }
        echo json_encode($datakotas, JSON_PRETTY_PRINT);
    }
    public function getOngkos($origin, $destination, $weight, $courier = "jne")
    {
      $data = json_decode($this->rajaongkir->cost($origin, $destination, $weight, $courier));
      $i = 0;
      foreach ($data->rajaongkir->results as $key => $value) {
        $courier_name = $value->name;
        foreach ($value->costs as $key2 => $costs) {
            $cost_array = (array) $costs;
            $result[$i] = $cost_array;
            $result[$i]['harga'] = $cost_array['cost'][0]->value;
            // var_dump($costs);
            $i++;
        }
      }
      return $result;
    }
    public function getPostApi($city_id , $courier = "jne")
    {
      $hasil_akhir = 0;
      $data = json_decode(file_get_contents('php://input'));
      foreach($data as $key => $value):
        $destiny = $this->getOngkos($value->city_id, $city_id, 1.00);
        foreach($destiny as $row):
          $data_hasil[$row['service']]['service'] = $row['service'];
          $data_hasil[$row['service']]['description'] = $row['description'];
          $data_hasil[$row['service']]['harga_akhir'] = @$data_hasil[$row['service']]['harga_akhir'] + $row['harga'];
        endforeach;
      endforeach;
      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data_hasil, JSON_PRETTY_PRINT));
    }
}
