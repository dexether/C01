<?php
use Facebook\Facebook;
class Oauth2Controller extends MY_Controller
{

    protected $core;
    protected $access_token;
    protected $refersh_token;
    protected $user_data;
    protected $auth;

    public function __construct()
    {
        parent::__construct();
        $this->core = new Facebook([
          'app_id' => "1795647367393230",
          'app_secret' => "f8a0a2bafa8a18f4a2b9027606c98d6e",
          'default_graph_version' => 'v2.2',
        ]);

        $this->load->module('mod_authentication');
        $this->auth = $this->mod_authentication;

    }
    public function getLink()
    {
      $fb = $this->core;
      $helper = $fb->getRedirectLoginHelper();

      $permissions = ['email']; // Optional permissions
      $loginUrl = $helper->getLoginUrl(base_url('oauth2/callback/facebook'), $permissions);

      return htmlspecialchars($loginUrl);
    }

    public function callback()
    {
      $fb = $this->core;
      $helper = $fb->getRedirectLoginHelper();
      try {
        $accessToken = $helper->getAccessToken();
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }



      $oAuth2Client = $fb->getOAuth2Client();

      // Get the access token metadata from /debug_token
      $tokenMetadata = $oAuth2Client->debugToken($accessToken);


      // Validation (these will throw FacebookSDKException's when they fail)
      $tokenMetadata->validateAppId("1795647367393230"); // Replace {app-id} with your app id
      // If you know the user ID this access token belongs to, you can validate it here
      //$tokenMetadata->validateUserId('123');
      $tokenMetadata->validateExpiration();

      if (! $accessToken->isLongLived()) {
        // Exchanges a short-lived access token for a long-lived one
        try {
          $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
          echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
          exit;
        }

        echo '<h3>Long-lived</h3>';
        var_dump($accessToken->getValue());
      }
      $this->setAccessToken($accessToken);
      $this->getUserData();
    }
    private function setAccessToken($token)
    {
      $this->access_token = $token;
      $this->session->set_userdata(['access_token' => $token]);
    }
    public function getUserData()
    {
      $fb = $this->core;
          try {
            $response = $fb->get('/me?fields=id,name,email,picture.type(large)', $this->session->access_token);
          } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          $me = $response->getGraphUser();

          $this->user_data = [
            "name" => $me->getName(),
            "email" => $me->getEmail(),
            "profile_picture" => $me->getPicture()->getUrl()
          ];
          if($this->checkRegisteredUser($me->getEmail())):
            $user = $this->auth->get_user_data($me->getEmail());
            $this->auth->set_user_data($user);
            redirect('/');
          else:
            $sql = new Users;
            $sql->username = $this->user_data['email'];
            $sql->password = md5(123456);
            $sql->groupid = 1;
            $sql->save();

            $sql = new Client_aecode;
            $sql->aecode = $this->user_data['email'];
            $sql->name = $this->user_data['name'];
            $sql->email = $this->user_data['email'];
            $sql->save();

            $user = $this->auth->get_user_data($me->getEmail());
            $this->auth->set_user_data($user);
            redirect('/');
          endif;
    }
    private function checkRegisteredUser($email)
    {
      $find = Users::where('username', $email)->first();
      if($find):
        return true;
      else:
        return false;
      endif;
    }
    private function register()
    {

    }
}
