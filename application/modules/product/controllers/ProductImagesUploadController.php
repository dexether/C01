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

        if (!$this->upload->do_multi_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_content_type('application/json')
            ->set_output(json_encode($data))
            ->set_status_header(403);  
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
        $this->cropImages();
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
            $img->image_type = "secondary";
            $img->resize_location = $row['resize_path'];
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
        // return redirect('/account/myproduct/');
        return redirect('/');
    }
    private function cropImages()
    {
        foreach($this->response as $key => $row):

            $metaImage = getimagesize($row['full_path']);
            $resize_path = $row['file_path'] . "resize/";
            $fileData['image_width'] = $metaImage[0];
            $fileData['image_height'] = $metaImage[1];
            $config['source_image'] = $row['full_path'];
            $config['image_library'] = 'gd2';      
            $config['maintain_ratio'] = false;
            $config['new_image'] = $resize_path . $row['file_name'];

            //Set cropping for y or x axis, depending on image orientation
            if ($fileData['image_width'] > $fileData['image_height']) {
                $config['width'] = $fileData['image_height'];
                $config['height'] = $fileData['image_height'];
                $config['x_axis'] = (($fileData['image_width'] / 2) - ($config['width'] / 2));
            }
            else {
                $config['height'] = $fileData['image_width'];
                $config['width'] = $fileData['image_width'];
                $config['y_axis'] = (($fileData['image_height'] / 2) - ($config['height'] / 2));
            }
            
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            if ($this->image_lib->crop()) {
                $response[$key] = $row;
                $response[$key]['resize_path'] = base_url('assets/img/product/resize/'.$row['file_name']);
            }else{
                $response[$key] = $row;
                $response[$key]['resize_path'] = null;
            }
            $this->image_lib->clear();
            unset($config);
        endforeach;
        $this->response = $response;
        return true;
    }
}