<?php

class ProductUploadController extends AuthController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {  
        $data['page'] = "category-page";
        $data['categories'] = Category::all();
        $data['contentDashboard'] = "product/ProductUploadView";
        $this->template->get_user_dashboard($data);
    }
    public function postUpload()
    {
        $product_name = $this->input->post('product_name');
        $product_weight = $this->input->post('product_weight');
        $product_price = $this->input->post('product_price');
        $product_desc = $this->input->post('product_desc');
        $id_cat = $this->input->post('id_cat');
        $create = Product::create([
            'aecodeid' => $this->session->aecodeid,
            'id_cat' => $id_cat,
            'prod_alias' => $product_name,
            'prod_name' => url_title($product_name),
            'prod_desc_long' => $product_desc,
            'prod_price' => $product_price,
            'prod_weight' => $product_weight,
            'is_active' => true
        ]);

        $response = [
            "id" => $create->id,
            "message" => "success upload details"
        ];
        $this->output->set_content_type('application/json')
        ->set_status_header(200)
        ->set_output(json_encode($response, JSON_PRETTY_PRINT));
    }
}