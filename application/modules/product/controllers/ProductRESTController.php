<?php

class ProductRESTController extends MY_Controller
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
    public function getPrimaryImages($product_id, $origin = true)
    {
        $productImagesPrimary = ProductImages::where('id_prod', $product_id)
        ->where('image_type', 'primary')
        ->first();
        if($productImagesPrimary != null):
            if($origin):
                echo (filter_var($productImagesPrimary->image_location, FILTER_VALIDATE_URL)) ?  $productImagesPrimary->resize_location :  base_url($productImagesPrimary->image_location);
            else:
                echo (filter_var($productImagesPrimary->image_location, FILTER_VALIDATE_URL)) ?  $productImagesPrimary->image_location :  base_url($productImagesPrimary->image_location);
            endif;
        else:
            $product = Product::find($product_id);
            echo (filter_var($product->prod_images, FILTER_VALIDATE_URL)) ?  $product->prod_images :  base_url($product->prod_images);
        endif;
    }
}