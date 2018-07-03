<?php
include 'kelas.php';
include 'db.php';
$db = new database();
$imap = new Imap();

$connection_result = $imap->connect('{mail.si.co.id:993/imap/ssl/novalidate-cert}INBOX', 'irvan@si.co.id', 'irvan008');
    if ($connection_result !== true) {
        echo $connection_result; //Error message!
        exit;
    }

$messages = $imap->getMessages('text'); //Array of messages

ini_set("SMTP", "mail.si.co.id");
ini_set("sendmail_from", "irvan@si.co.id");

foreach ($messages as $key => $value) {
    $body = imap_body($imap->ambilstream(),$value['uid'],FT_UID);
    preg_match_all('!\d+!', $body, $matches);
    $idlogin = $matches[0][10];
    $email = $db->emailnya($idlogin);
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail($email, $value['subject'], $body, $headers);
}

?>

<META HTTP-EQUIV="refresh" CONTENT="86400">