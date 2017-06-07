<?php
use App\Models\Review;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
class View_product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mod_ecommerce_product_model', 'mymodel');
    }
    public function show_product($product_category = null, $product_name = null)
    {

      /* get product details */
      $product_details = $this->mymodel->get_product_details($product_name);
      /* Get Product Review */
      $reviews = Review::where('prod_id', $product_details->id)->orderBy('created_at', 'DESC');
      /* get new product by category */
      $product_list = $this->mymodel->get_product_list($product_category, $product_name);
      /* Meta Tags */
      $data['meta']['title'] = $product_details->prod_alias;
      $data['meta']['desc'] = $this->format->clean_html($product_details->prod_desc);
      $data['product_list'] = $product_list;
      $data['product'] = $product_details;
      $data['page'] = 'category-page';
      $data['reviews'] = $reviews->get();
      $data['content'] = 'mod_ecommerce_product/product_detail_v';
      $this->breadcrumb->clear();
      $this->breadcrumb->add_crumb('Home', '/');
      $this->breadcrumb->add_crumb('Category', '/c');
      $this->breadcrumb->add_crumb($product_details->cat_alias, '/c/'. $product_details->cat_name);
      $this->breadcrumb->add_crumb($product_details->prod_alias);
      $this->breadcrumb->change_link('<span class="navigation-pipe">&nbsp;</span>'); // you can change what joins the crumbs
      $data['breadcrumb'] = $this->breadcrumb->output();
      $this->template->get_main($data);
    }
    public function set_review($product_id)
    {
      $request = new Request(
          $_GET,
          $_POST,
          array(),
          $_COOKIE,
          $_FILES,
          $_SERVER
      );
      try {
        Review::create([
          'aecodeid'    => $this->session->aecodeid,
          'prod_id'     => $product_id,
          'rating_comm' => $request->request->get('rating_comm'),
          'rating_star' => $request->request->get('rating'),
        ]);
        $this->session->set_flashdata('success', 'Berhasil Menambahkan Rating');
        redirect($_SERVER['HTTP_REFERER']);
      } catch (Exception $e) {
        $this->session->set_flashdata('success', $e->getMessage());
        redirect($_SERVER['HTTP_REFERER']);
      }


    }
}
