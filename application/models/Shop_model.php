<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->lang->load('message_lang', 'indonesia');
    }
    public function test()
    {
        return "Haha";
    }
    public function getData($table, $col, $where = array(1 => 1))
    {
        $this->db->select($col);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getDataPromo($select, $from, $join, $where)
    {
        $this->db->select($select);
        $this->db->from($from);
        foreach ($join as $key1 => $value1) {
            # code...
            $this->db->join($value1['table'], $value1['on'], $value1['type']);
        }
        foreach ($where as $key => $value) {
            $this->db->where($value['col'], $value['val']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getDataPromoOrder($select, $from, $join, $where, $order, $act)
    {
        $this->db->select($select);
        $this->db->from($from);
        foreach ($join as $key1 => $value1) {
            # code...
            $this->db->join($value1['table'], $value1['on'], $value1['type']);
        }
        foreach ($where as $key => $value) {
            $this->db->where($value['col'], $value['val']);
        }
        $this->db->order_by($order, $act);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getDataByCat($type = '')
    {
        $query = "SELECT
      master_product.`prod_name`,
      master_product.`prod_alias`,
      master_product.`prod_images`,
      master_product.`prod_price`,
      master_product_promo.`id`,
      master_promo.`promo_name`,
      master_promo.`promo_value`,
      master_cat.cat_name,
      CASE
        master_promo.`promo_name`
        WHEN '%'
        THEN (master_promo.`promo_value` * (master_product.`prod_price` / 100))
        ELSE prod_price
      END AS amount
    FROM
      master_product
      LEFT JOIN master_cat
        ON master_product.`id_cat` = master_cat.`id`
      LEFT JOIN master_product_promo
        ON master_product.`id` = master_product_promo.`id_product`
      LEFT JOIN master_promo
        ON master_product_promo.`id_promo` = master_promo.`id`
        WHERE master_cat.cat_name = '$type'";
        $hasil = $this->db->query($query);
        return $hasil->result_array();
    }
	public function deleteProduct($prod_id = '', $sellerid = '')
    {
        $query = "DELETE
			FROM master_product
			WHERE id = '$prod_id' AND aecodeid = '$sellerid'";
        $hasil = $this->db->query($query);
    }
	
    public function getDataByProd($name = '')
    {
        $query = "SELECT
      master_product.`prod_name`,
      master_product.`prod_star`,
      master_product.`prod_images`,
      master_product.`prod_desc`,
      master_product.`prod_desc_long`,
      master_product.`prod_alias`,
      master_product.`prod_price`,
      master_product_promo.`id`,
      master_promo.`promo_name`,
      master_promo.`promo_value`,
      master_cat.cat_name,
      CASE
        master_promo.`promo_name`
        WHEN '%'
        THEN (master_promo.`promo_value` * (master_product.`prod_price` / 100))
        ELSE prod_price
      END AS amount
    FROM
      master_product
      LEFT JOIN master_cat
        ON master_product.`id_cat` = master_cat.`id`
      LEFT JOIN master_product_promo
        ON master_product.`id` = master_product_promo.`id_product`
      LEFT JOIN master_promo
        ON master_product_promo.`id_promo` = master_promo.`id`
        WHERE master_product.prod_name = '$name'";
        $hasil = $this->db->query($query);
        return $hasil->result_array();
    }
	
	public function myProductDataByCat($type = '', $sellerid = '')
    {
        $query = "SELECT
		master_product.`id`as prod_id,
      master_product.`prod_name`,
      master_product.`prod_star`,
      master_product.`prod_images`,
      master_product.`prod_desc`,
      master_product.`prod_desc_long`,
      master_product.`prod_alias`,
      master_product.`prod_price`,
	  master_product.`is_active`,
      master_product_promo.`id`,
      master_promo.`promo_name`,
      master_promo.`promo_value`,
      master_cat.cat_name,
      CASE
        master_promo.`promo_name`
        WHEN '%'
        THEN (master_promo.`promo_value` * (master_product.`prod_price` / 100))
        ELSE prod_price
      END AS amount
    FROM
      master_product
      LEFT JOIN master_cat
        ON master_product.`id_cat` = master_cat.`id`
      LEFT JOIN master_product_promo
        ON master_product.`id` = master_product_promo.`id_product`
      LEFT JOIN master_promo
        ON master_product_promo.`id_promo` = master_promo.`id`
        WHERE master_cat.cat_name = '$type' AND master_product.aecodeid = '$sellerid'";
        $hasil = $this->db->query($query);
        return $hasil->result_array();
    }	
	public function getDataBySeller($sellerid = '')
    {
        $query = "SELECT
		master_product.`id` as prod_id,
      master_product.`prod_name`,
      master_product.`prod_star`,
      master_product.`prod_images`,
      master_product.`prod_desc`,
      master_product.`prod_desc_long`,
      master_product.`prod_alias`,
      master_product.`prod_price`,
	  master_product.`is_active`,
      master_product_promo.`id`,
      master_promo.`promo_name`,
      master_promo.`promo_value`,
      master_cat.cat_name,
      CASE
        master_promo.`promo_name`
        WHEN '%'
        THEN (master_promo.`promo_value` * (master_product.`prod_price` / 100))
        ELSE prod_price
      END AS amount
    FROM
      master_product
      LEFT JOIN master_cat
        ON master_product.`id_cat` = master_cat.`id`
      LEFT JOIN master_product_promo
        ON master_product.`id` = master_product_promo.`id_product`
      LEFT JOIN master_promo
        ON master_product_promo.`id_promo` = master_promo.`id`
        WHERE master_product.aecodeid = '$sellerid'";
        $hasil = $this->db->query($query);
        return $hasil->result_array();
    }
	
    public function insertData($table, $data)
    {
        $sql = $this->db->insert($table, $data);
        if ($sql) {
            # code...
            return true;
        } else {
            return false;
        }
    }
    public function cekPromo($promoname, $promo_value, $price)
    {

        switch ($promoname) {
            case null:
                # code...
                $amount = $price;
                break;
            case '%':
                # code...
                $amount = $price - ($price * ($promo_value / 100));
                break;

            default:
                # code...
                $amount = $price;
                break;

        }
        return $amount;

    }
    public function deleteData($table, $where)
    {
        $sql = $this->db->delete($table, $where);
        if ($sql) {
            # code...
            return true;
        } else {
            return false;
        }
    }
    public function transcationGet($aecodeid)
    {
        $result = $this->db->query('SELECT
        master_invoice.`invoice`,
        master_invoice.`cmd`,
        master_invoice.`timestamp`,
        master_cart.`id_prod`,
        master_cart.aecodeid,
        master_product.`prod_price`,
        master_promo.`promo_alias`,
        master_promo.`promo_name`,
        master_promo.`promo_value`,
        master_cmd.`cmd_alias`
      FROM
        master_invoice
        LEFT JOIN master_cmd
          ON master_invoice.`cmd` = master_cmd.`cmd`
        LEFT JOIN master_cart
          ON master_cart.`invoice` = master_invoice.`invoice`
        LEFT JOIN master_product
          ON master_cart.`id_prod` = master_product.`id`
        LEFT JOIN master_product_promo
          ON master_product_promo.`id_product` = master_product.`id`
        LEFT JOIN master_promo
          ON master_product_promo.`id_promo` = master_promo.`id`
      WHERE master_cart.aecodeid = "' . $aecodeid . '"');
        return $result->result_array();

    }
    public function getDataTranscation($table, $col, $where)
    {
        $this->db->select($col);
        $this->db->from($table);
        $this->db->join('master_bank', 'client_aecode_bank.banktype = master_bank.id');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function updateData($table, $data, $where, $where_value)
    {
        $this->db->where($where, $where_value);
        $do = $this->db->update($table, $data);
        return $do;
    }
    public function getReviews($productname, $col){
      $this->db->select($col);
      $this->db->from('master_product_rating');
      $this->db->join('client_aecode', 'master_product_rating.aecodeid = client_aecode.aecodeid');
      $this->db->join('master_product', 'master_product_rating.prod_id = master_product.id');
      $this->db->where('master_product.prod_name', $productname);
      $query = $this->db->get();
      return $query->result_array();
    }
    public function getReviesAll($productname){
      $data_avg = $this->db->query("
      SELECT AVG(master_product_rating.rating_star) as rating FROM master_product_rating LEFT JOIN master_product ON master_product_rating.prod_id = master_product.id
      WHERE master_product.prod_name = '".$productname."'
      ");
      foreach ($data_avg->result() as $key => $value) {
        $avg = $value->rating;
      }
      // Query reviews all
      // return $data_avg->result();
      $this->db->from('master_product_rating');
      $this->db->join('master_product', 'master_product_rating.prod_id = master_product.id');
      $this->db->where('master_product.prod_name', $productname);
      $data_count = $this->db->count_all_results();

      return array(
        "avg_rating" => $avg,
        "count_review" => $data_count,
        "percentase" => ($avg/5) * 100
      );
    }
    public function checkStatusOfbuy($productname, $aecodeid){
      $query = $this->db->query("
          SELECT
            master_product.id
          FROM
            master_product_rating,
            master_product
          WHERE master_product_rating.`prod_id` = master_product.`id`
            AND master_product.`prod_name` = '".$productname."'
            AND master_product_rating.`aecodeid` = '".$aecodeid."'
      ");
      if(count($query->result())):
        return true;
      else:
        return false;
      endif;
    }

}

/* End of file shop_model.php */
/* Location: ./application/models/shop_model.php */
