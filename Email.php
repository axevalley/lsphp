<?php
namespace LSPHP;

set_include_path("." . PATH_SEPARATOR . ($UserDir = dirname($_SERVER['DOCUMENT_ROOT'])) . "/pear/php" . PATH_SEPARATOR . get_include_path());
require_once "Mail.php";

class Email
{

    public function __construct($host, $username, $password, $port, $from)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
        $this->from = $from;
    }

    public function sendMail($to, $subject, $body, $reply = null)
    {
        if (is_null($reply)) {
            $reply = $this->from;
        }

        $headers = array (
            'From' => $this->from,
            'To' => $to,
            'Subject' => $subject,
            'Reply-To' => $reply
        );
        $smtp = \Mail::factory(
            'smtp',
            array (
                'host' => $this->host,
                'port' => $this->port,
                'auth' => true,
                'username' => $this->username,
                'password' => $this->password
            )
        );

        $mail = $smtp->send($to, $headers, $body);

        if (\PEAR::isError($mail)) {
            return $mail->getMessage();
        } else {
            return 0;
        }
    }
}
