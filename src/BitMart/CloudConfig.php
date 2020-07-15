<?php


namespace BitMart;



class CloudConfig
{
    public $url;
    public $accessKey = '';
    public $secretKey = '';
    public $memo = '';
    public $timeoutSecond = 20;
    public $xdebug = true;

    function __construct(){
        $a=func_get_args();
        $i=func_num_args();
        if(method_exists($this,$f='__construct'.$i)){
            call_user_func_array(array($this,$f),$a);
        }
    }

    public function __construct1($url)
    {
        $this->url = $url;
    }

    public function __construct4($url, $accessKey, $secretKey, $memo)
    {
        $this->url = $url;
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
        $this->memo = $memo;
    }


}