<?php

namespace Omnipay\SublimeTest\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * PayPal Response
 */
class Response extends AbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = json_decode($data, true);
    }

    public function isSuccessful(){
        return !isset($this->data['status']) && isset($this->data[0]['mxsid']);
    }

    public function getResponse(){
        return $this->data;
    }
    public function getResponseJson(){
        return json_encode($this->data);
    }

    public function getStatus(){
        return isset($this->data['status']) ? $this->data['status'] : null;
    }
    public function getMessage(){
        if(isset($this->data['status'])){
            return $this->data['status']=='EXC' && isset($this->data['msg']) ? $this->data['msg'] : null;    
        }
        return null;
    }
}
