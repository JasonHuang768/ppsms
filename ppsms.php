<?php
/**
 *	This file is part of sms. (智邦)
 *  http://pp.url.com.tw/option/api
 * @author JasonHuang <>
 *
 * @package sms
 * @since sms Ver 1.0
**/

namespace sms;

class ppsms{

    protected $Host = "http://pp.url.com.tw/api/msg"; 

    public function __construct($apiKey, $userName, $passWord){
        $this->parameters = array(
            'api_key'   => $apiKey,
            'user_name' => $userName,
            'password'  => $passWord,
            'sms_list'  => "",
            'sms_body'  => "",
            'sms_time'  => "",
        );
    }

    public function setKey($code){
        $this->apiKey = $code;
    }

	public function setUser($id){
		$this->userName = $id;
	}

	public function setPsw($id){
		$this->passWord = $id;
	}

    public function checkOut($params){

        if (!preg_match("/^[0-9]{10}$/", $params['sms_list'])){
            throw new Exception('list are not set.');
        }

        if ($params['sms_body'] == null){
            throw new Exception('body are not set.');
        }

        $params['sms_time'] = date("Y-m-d 00:00:00");

        $params = array_merge($this->parameters, $params);

        return $this->makeHttpRequest($this->Host, $params);

    }

    protected function makeHttpRequest($url, $data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->Host);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $response = curl_exec($ch);
        curl_close ($ch);
        return $response;
    }
}

?>