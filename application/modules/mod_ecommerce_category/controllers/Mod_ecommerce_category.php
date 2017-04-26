<?php
class Mod_ecommerce_category extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Shop_model', 'basicmodel');
    $this->load->library('format');
    $this->load->helper('form');
    $this->load->library('encrypt');

    $this->load->model('mod_ecommerce_category_model', 'mymodel');
  }
  public function index()
  {
    echo "Mod Product";
  }
  public function show_product($type = null)
  {



    $hal = $this->input->get('per_page');
    $this->load->library('pagination');
    $category_details = $this->mymodel->get_category_details($type);
    $this->breadcrumb->clear();
    $this->breadcrumb->add_crumb('Home', '/'); // this will be a link
    $this->breadcrumb->add_crumb('Category', '/c'); // this will be a link
    $this->breadcrumb->add_crumb($category_details->cat_alias, '/' . $category_details->cat_name); // this won't be linked and will just be text
    $this->breadcrumb->change_link('<span class="navigation-pipe">&nbsp;</span>'); // you can change what joins the crumbs

    /* paging */
    $config['base_url'] = base_url('c/' . $category_details->cat_name);
    $jml = $this->db->select('*')->from('master_product')
    ->join('master_cat', 'master_product.id_cat = master_cat.id')
    ->where('master_cat.cat_name' , $type)
    ->get();
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['page_query_string'] = TRUE;
    $config['enable_query_string'] = TRUE;
    $config['per_page'] = 9;
    $products_fetch = $this->mymodel->get_product_list($type, $config['per_page'] , $hal);

    if($this->input->get('range_price')):
      $e_range_price = explode('^', $this->input->get('range_price'));

      $filter_min_price = $e_range_price[0];
      $filter_max_price = $e_range_price[1];
      $products_fetch->where("master_product.prod_price BETWEEN '$filter_min_price' AND '$filter_max_price' ");

    endif;

    $products = $products_fetch->get()->result();
    $config['total_rows'] = $jml->num_rows();
    $this->pagination->initialize($config);

    $data['paging'] = $this->pagination->create_links();
    $data['products'] = $products;
    $data['meta']['title'] = $category_details->cat_alias;
    $data['meta']['desc'] = $category_details->cat_desc;
    $data['category_details'] = $category_details;
    $data['breadcrumb'] = $this->breadcrumb->output();
    $data['page'] = "category-page";
    $data['content'] = "mod_ecommerce_category/category_v.php";
    $max = @max(array_map(function($e) {
        return $e->prod_price;
    }, $products));
    $min = @min(array_map(function($e) {
        return $e->prod_price;
    }, $products));
    $limit = $this->getPriceFilter(1000, $max);
    $data['filter_limit_price']['range'] = $limit;
    $data['filter_limit_price']['max'] = $max;
    $data['filter_limit_price']['min'] = $min;
    $this->template->get_main($data);
  }
  function getPriceFilter( $min, $max ) {
    $min = ( int ) str_replace( ',', '', $min );
    $max = ( int ) str_replace( ',', '', $max );

    $result = array();

    $limit = array(
        100000 => array(
            'kurang dari Rp. 100.000',
            '0^100000'),
        250000 => array(
            'Rp. 100,000 to Rp. 250,000',
            '100001^250000'),
        500000 => array(
            'Rp. 250,000 to Rp. 500,000',
            '250001^500000'),
        1500000 => array(
            'Rp. 500,000 to Rp. 1,500,000',
            '500001^1500000'),
        3000000 => array(
            'Rp. 1,500,000 to Rp. 3,000,000',
            '1500001^3000000'),
        4500000 => array(
            'Rp. 3,000,000+',
            '3000001^100000000')
    );

    $minCheck = 0;
    foreach( $limit as $key => $check ) {
        if( ! $minCheck ) {
            if( $min <= $key ) {
                $result[] = $check;
                $minCheck = 1;
            }
        } else {
            if( $max >= $key ) {
                $result[] = $check;
            }
        }
    }

    return $result;
}
}

 ?>
