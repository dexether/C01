<?php

use App\Models\Discuss;
use App\Models\DiscussReply;

class DiscussController extends AuthController {
  public function __construct()
  {
     $this->load->library('form_validation');
  }


  public function post_discuss($product_id)
  {
    $this->form_validation->set_rules('discuss_message', 'Teks', 'required');
    if($this->form_validation->run() == false){
      $this->session->set_flashdata('error', 'Teks harus diisi');
      redirect($_SERVER['HTTP_REFERER']);
    }


    Discuss::create([
      'aecodeid' => $this->session->aecodeid,
      'product_id' => $product_id,
      'message' => $this->input->post('discuss_message')
    ]);

    redirect($_SERVER['HTTP_REFERER']);

  }

  public function post_discuss_comment($discuss_id)
  {
    $this->form_validation->set_rules('comment', 'Teks', 'required');
    if($this->form_validation->run() == false){
      $this->session->set_flashdata('error', 'Teks harus diisi');
      redirect($_SERVER['HTTP_REFERER']);
    }
    try {
      DiscussReply::create([
        'aecodeid' => $this->session->aecodeid,
        'product_discuss_id' => $discuss_id,
        'message' => $this->input->post('comment')
      ]);
      $this->session->set_flashdata('success', 'Berhasil Menambah discuss');
      redirect($_SERVER['HTTP_REFERER']);
    } catch (Exception $e) {
      $this->session->set_flashdata('error', 'Error while submit');
      redirect($_SERVER['HTTP_REFERER']);
    }
  }
}
