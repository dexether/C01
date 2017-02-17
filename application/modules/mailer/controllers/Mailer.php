<?php

class Mailer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->config('mailer');
    }
    public function send($to, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $this->config->item('m_host');
        $mail->SMTPAuth = true;
        /* For debug */
        // $mail->SMTPDebug = 2;
        // $mail->Debugoutput = 'html';
        $mail->Username = $this->config->item('m_username');
        $mail->Password = $this->config->item('m_password');
        $mail->SMTPSecure = $this->config->item('m_smtp_secure');
        $mail->Port = $this->config->item('m_port');
        $mail->setFrom($this->config->item('m_username'), $this->config->item('app_name'));
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $send = $mail->send();
        if($send == true):
          return true;
        else:

          // use quenque
          log_message('error', 'Error Send Email : '.  $mail->ErrorInfo);
          $do = $this->quenque($to, $subject, $body);
          return $mail->ErrorInfo;
        endif;

    }
    public function test()
    {
      $this->send("tarikh@si.co.id", "Testing", "Body");
    }
    public function quenque($to, $subject, $body, $cc = 0)
    {
        $data = [
          'timesend' => '1970-01-31 00:00:00',
          'timeupdate' => date('Y-m-d H:i:s'),
          'email_to' => $to,
          'email_cc' => $cc,
          'email_subject' => $subject,
          'email_body' => base64_encode($body)
        ];
        $do = $this->db->insert('email', $data);
        return $do;

    }
}
