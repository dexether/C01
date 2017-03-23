<?php

class ProductRESTController extends AuthController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function checkName()
    {
        $product_name = $this->input->get('product_name');

        $product = Product::where('prod_alias' , $product_name);
        if($product->count() > 0 ):
            return $this->output->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['valid' => false]));
        else:
            return $this->output->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['valid' => true]));
        endif;
    }
}