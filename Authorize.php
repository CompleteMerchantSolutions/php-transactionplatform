<?php
namespace Authorization;

class Authorize
{
    protected $username;
    protected $password;
    protected $url;

    public function __construct($username, $password, $url)
    {
        $this->username = $username;
        $this->password = $password;
        $this->url = $url;
    }

    public function login()
    {
        $data = json_encode(array("username" => $this->username, "password" => $this->password));

        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Content-Length: " . strlen($data)));
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }

    public function getJWT()
    {

    }
}
