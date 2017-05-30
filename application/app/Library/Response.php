<?php


namespace App\Library;

class Response {
  public function __construct()
  {
    $this->ci = get_instance();
  }

  public static function response($resource = [], $status = 200, $msg = null)
  {
    $ci = new self;
    $response = [
      'status' => ($status == 200) ? true : false,
      'results' => $resource,
      'message' => $msg
    ];
    $ci->ci->output
        ->set_status_header($status)
        ->set_content_type('application/json')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT));
  }
}
