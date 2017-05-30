<?php
use App\Library\Response;
class WishlistApiController extends AuthApi {
  public function set_wishlist()
  {
      $id = $this->input->post('id');
      if(!$this->session->login){
        Response::response([], 401, 'Anda belum log-in, silahkan login !');
      }else{
        try {
          $sql = Wishlist::create([
            'product_id' => $id,
            'aecodeid' => $this->session->aecodeid
          ]);
          return Response::response($sql);
        } catch (Exception $e) {
          return Response::response([
            'error' => $e->getCode(),
          ], 500, 'Sudah ada dalam daftar keinginan');
        }
      }

  }
}
?>
