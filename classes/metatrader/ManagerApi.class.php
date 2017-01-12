  <?php

class ManagerApi
{
    protected $url;
    protected $error;
    protected $module;
    protected $ip;
    protected $username;
    protected $password;
    public function __construct($ip , $username , $password)
    {
        $this->url = 'http://10.10.0.122:8787/mt4service/webapi/mt4services/' . $this->module;
        $this->username = $username;
        $this->password = $password;
        $this->ip = $ip;
    }
    public function display_error()
    {
      return $this->error;
    }
    public function login()
    {
      $this->module = "login";
      $url = $this->url . $this->module;

      $data = array(
        'servername' => $this->ip,
        'adminlogin' => $this->username,
        'adminpasswd' => $this->password
      );
      $data_string = json_encode($data, JSON_PRESERVE_ZERO_FRACTION);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      $result = curl_exec($ch);
      if ($result == 'LOGIN_OK') {
        return true;
      }else{
        return false;
      }
    }
    public function deposit($login, $amount , $comment)
    {
        $this->login();
        // Validation
        if(!is_numeric($amount)):
          $this->error = "Please input Amount in Number only Or Decimal, Do not add Alpa Character";
          return false;
        endif;
        $amount = (float) $amount;
        $this->module = "Deposit";
        $this->url = $this->url . $this->module;
        $data = array(
          'servername' => $this->ip,
          'adminlogin' => $this->username,
          'adminpasswd' => $this->password,
          'login' => $login,
          'amount' => $amount,
          'comment' => $comment
        );
        $data_string = json_encode($data, JSON_PRESERVE_ZERO_FRACTION);
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        if ($result == "" || $result == NULL || $result == "NOT_LOGIN" || $result == "null") {
          $this->error = "This login Not Under manager " . $this->username;
          return false;
        }else{
          return json_decode($result);
        }

    }
    public function withdrawal($login, $amount, $comment)
    {
      $this->login();
      if(!is_numeric($amount)):
        $this->error = "Please input Amount in Number only Or Decimal, Do not add Alpa Character";
        return false;
      endif;
      $amount = (float) $amount;
      $this->module = "Withdrawal";
      $this->url = $this->url . $this->module;
      $data = array(
        "servername" => $this->ip,
        "adminlogin" => $this->username,
        "adminpasswd" => $this->password,
        "login" => $login,
        "amount" => $amount,
        "comment" => $comment
      );
      $data_string = json_encode($data, JSON_PRESERVE_ZERO_FRACTION);
      $ch = curl_init($this->url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      //execute post
      $result = curl_exec($ch);
      //close connection
      curl_close($ch);

      if ($result == "" || $result == NULL || $result == "NOT_LOGIN" || $result == "null") {
        $this->error = "ERROR : ".$result." This login Not Under manager " . $this->username;
        return false;
      }else{
        return json_decode($result);
      }
    }
}
