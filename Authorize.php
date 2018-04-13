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
        return $this->curlRequest($this->url, "POST", json_encode(array(
            "username" => $this->username,
            "password" => $this->password)));
    }

    public function refreshJWT($refreshToken)
    {
        return $this->curlRequest($this->url, "POST", json_encode(array("refreshToken" => $refreshToken)));
    }

    private function curlRequest($url, $method, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "$method");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "Content-Length: " . strlen($data)));
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }
}
