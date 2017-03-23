<?php 

class ProductImagesUploadController extends AuthController
{
    protected $response;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }
    public function index()
    {
        $config['upload_path']          = 'assets/img/product/';
        $config["allowed_types"]        = "*";
        $config['max_size']             = 1000;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_multi_upload('file'))
        {
                $error = array('error' => $this->upload->display_errors());

                print_r($error);
        }
        else
        {
            $data = $this->upload->get_multi_upload_data();
            $response = [];
            foreach($data as $key => $row):
                $response[$key] = $row;
                $response[$key]['url_path'] = reduce_double_slashes(base_url($config['upload_path'] . $row['file_name']));
            endforeach;
            $this->response = $response;

        }
        $this->storeToDatabase();
        return $this;
    }
    private function storeToDatabase()
    {
        $response = $this->response;
        foreach($response as $key => $row):
            $img = new ProductImages;
            $img->id_prod = $this->input->post('product_id');
            $img->is_images = true;
            $img->image_location = $row['url_path'];
            $img->save();
        endforeach;    
    }
    public function apiImagesContent($product_id)
    {
        $images = Product::find($product_id);
        $images = $images->ProductImages; 
        $this->load->view('ApiProductImagesView', ['images' => $images]);
    }
    public function setPrimaryImages()
    {
        $images_id = $this->input->post('images_id');
        $product_id = $this->input->post('product_id');
        
        $img = ProductImages::find($images_id);
        $img->image_type = "primary";
        $img->save();
        $this->session->set_flashdata('success', 'Sukses menambahkan Barang ke Akun anda');
        return redirect('/account/myproduct/');
    }
}