<?php

namespace Omnipay\SublimeTest\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * PayPal Response
 */
class Response extends AbstractResponse
{
    private $request;
    private $data;
    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = json_decode($data, true);
    }

    public function isSuccessful(){
        return !isset($this->data['status']) && isset($this->data['mxsid']);
    }

    public function getResponseJson(){
        return json_encode($this->data);
    }

    public function getMessage(){
        return $this->data['status']=='EXC' && isset($this->data['msg']) ? $this->data['msg'] : null;
    }
}
