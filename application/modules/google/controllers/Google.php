<?php
class Google extends MY_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->config('google');
  }
  public function validate_recaptcha($response)
  {
    $data = array(
            'secret' => $this->config->item('google_recaptcha_secret_key'),
            'response' => $response
        );

    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = json_decode(curl_exec($verify));
    return $response;
  }
}
?>
