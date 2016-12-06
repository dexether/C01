<?php

class Dashboard_m extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function homeData()
    {
        $tgl = date('Y-m-d H:i:s', time());

        $on = array(
          array('table' => 'master_cat', 'on' => 'master_product.id_cat = master_cat.id', 'type' => 'left'),
          array('table' => 'master_product_promo', 'on' => 'master_product.id = master_product_promo.id_product', 'type' => 'left'),
          array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
          // array('table' => 'master_product', 'on' => 'master_product_promo.id_product = master_product.id AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),

      );
        $where = array(
          array('col' => 'master_product.is_active', 'val' => true),
      );
        $datas = $this->getDataPromoOrder('prod_star, promo_alias, prod_images, prod_name, prod_alias, prod_price, cat_name, promo_name, promo_value', 'master_product', $on, $where, 'master_product.timestamp', 'DESC');
        $datas2 = array();
        foreach ($datas as $key => $value) {
            // code...
          $datas2[$value['cat_name']][$key] = $value;
            $datas2[$value['cat_name']][$key]['final_price'] = $this->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);
        }

        return $datas2;
    }
    public function getDataPromoOrder($select, $from, $join, $where, $order, $act)
    {
        $this->db->select($select);
        $this->db->from($from);
        foreach ($join as $key1 => $value1) {
            // code...
            $this->db->join($value1['table'], $value1['on'], $value1['type']);
        }
        foreach ($where as $key => $value) {
            $this->db->where($value['col'], $value['val']);
        }
        $this->db->order_by($order, $act);
        $query = $this->db->get();

        return $query->result_array();
    }
    public function cekPromo($promoname, $promo_value, $price)
    {
        switch ($promoname) {
            case null:
                // code...
                $amount = $price;
                break;
            case '%':
                // code...
                $amount = $price - ($price * ($promo_value / 100));
                break;

            default:
                // code...
                $amount = $price;
                break;

        }

        return $amount;
    }
    public function list_barang()
    {
      $tgl = date('Y-m-d H:i:s', time());

      $on = array(
          array('table' => 'master_promo', 'on' => 'master_product_promo.id_promo = master_promo.id', 'type' => 'left'),
          array('table' => 'master_product', 'on' => 'master_product_promo.id_product = master_product.id AND master_product_promo.datefrom <= ' . $this->db->escape($tgl) . ' AND master_product_promo.dateto >= ' . $this->db->escape($tgl) . '', 'type' => 'left'),
          array('table' => 'master_cat', 'on' => 'master_product.id_cat = master_cat.id', 'type' => 'left'),
      );
      $where = array(
          array('col' => 'master_product.is_active', 'val' => true)
      );
      $datas = $this->getDataPromo('prod_star, promo_alias, prod_images, prod_name, prod_alias, prod_price, cat_name, promo_name, promo_value', 'master_product_promo', $on, $where);
      $datas2 = array();
      foreach ($datas as $key => $value) {
          # code...
          $datas2[$key]                = $value;
          $datas2[$key]['final_price'] = $this->cekPromo($value['promo_name'], $value['promo_value'], $value['prod_price']);
      }
      return $datas2;
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
}
