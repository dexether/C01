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
    $products = $products_fetch->result();
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
    $this->template->get_main($data);
  }
}
 ?>
