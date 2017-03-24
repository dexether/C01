<?php
use Carbon\Carbon;
class Latihan extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->module('mod_ecommerce_invoice/email');
  }
  public function index()
  {  
    die(DIRECTORY_SEPARATOR);
      // $image = new Imagick('E:\www\cabinet-stable\assets\ktp.jpg');    

    

      // echo $this->image_lib->display_errors();

      $metaImage = getimagesize('E:\www\cabinet-stable\assets\ktp.jpg');
      $fileData['image_width'] = $metaImage[0];
      $fileData['image_height'] = $metaImage[1];
      $config['source_image'] = 'E:\www\cabinet-stable\assets\ktp.jpg';
      $config['image_library'] = 'gd2';      
      $config['maintain_ratio'] = false;

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

      //Load image library and crop
      $this->load->library('image_lib', $config);
      $this->image_lib->initialize($config);
      if ($this->image_lib->crop()) {
          
      }else{
        $error = $this->image_lib->display_errors();
      }
      
      echo $error;
      //Clear image library settings so we can do some more image 
      //manipulations if we have to
      $this->image_lib->clear();
      unset($config);

  }
}
