<?php
class Cart extends MY_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->library('cart');
  }
  public function cart_view()
  {
    $data['page'] = "category-page";
    $data['content'] = "cart/cart_v";
    $this->template->get_main($data);
  }
  public function index()
  {
    $this->cart->destroy();
    var_dump($this->cart->contents());
  }
  public function set_item()
  {
    $data = [];
    foreach ($this->cart->contents() as $key => $value) {
      $data[] = [
        'rowid' => $key,
        'name' => $value['name'],
        'url' => $value['name'],
        'img' => $value['img'],
        'city_id' => $value['city_id'],
        'weight' => $value['weight'],
        'price' => (float) $value['price'],
        'quantity' => (int) $value['qty'],
        'subtotal' => (float) $value['subtotal']
      ];
    }
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
  }
  public function remove_item($rowid)
  {
    $this->cart->remove($rowid);
  }
  public function set_items($product_id)
  {
    $result = $this->db->get_where('master_product' , ['id' => $product_id]);
    $datas = $result->row();
    $address = Address::where('aecodeid' , $datas->aecodeid)->first();
    if ($address == null) {
      $city_id = 152;
    }else{
      $city_id = $address->city_id;
    }
    $data = array(
        'id'      => $datas->id,
        'name' => $datas->prod_alias,
        'price' => $datas->prod_price,
        'qty' => 1,
        'city_id' => $city_id,
        'weight' => $datas->prod_weight,
        'img' => $datas->prod_images
    );
    $id = $this->cart->insert($data);
    // print_r($data);
    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($this->cart->contents()[$id], JSON_PRETTY_PRINT));
  }
}
 ?>
