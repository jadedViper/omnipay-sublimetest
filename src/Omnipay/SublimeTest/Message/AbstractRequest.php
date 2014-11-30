<?php
namespace Omnipay\SublimeTest\Message;

use Omnipay\SublimeTest\Message\Response;
use Omnipay\Common\CreditCard;

/**
 * NetBanx Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /**
     * Live EndPoint
     *
     * @var string
     */
    protected $liveEndpoint = '';

    /**
     * Developer EndPoint
     *
     * @var string
     */
    protected $developerEndpoint = '';

    /**
     * Setter for Account Number
     *
     * @param string $value
     * @return $this
     */
    
    public function setSid($value) {
        $this->setParameter('sid', $value);
        return $this;
    }
    
    public function getSid() {
        return $this->getParameter('sid');
    }

    public function setRcode($value) {
        $this->setParameter('rcode', $value);
    
        return $this;
    }
    
    public function getRcode() {
        return $this->getParameter('rcode');
    }

    public function setCountry($value) {
        $this->setParameter('country', $value);
    
        return $this;
    }
    
    public function getCountry() {
        return $this->getParameter('country');
    }
        
    public function setAddfee($value) {
        $this->setParameter('addfee', $value);
    
        return $this;
    }

    public function getAddfee() {
        return $this->getParameter('addfee');
    }
       
    public function getCart(){
        return $this->getParameter('cart');
    }

    public function setCurrencycode($value) {
        $this->setParameter('currencycode', $value);
        return $this;
    }

    public function getCurrencycode() {
        return $this->getParameter('currencycode');
    }

    public function setCart($value) {
        $this->setParameter('cart', $value);
        
        return $this;
    }
      
    public function getSummary(){
        return $this->getParameter('summary');
    }
    
    public function setSummary($value) {
        $this->setParameter('summary', $value);
        
        return $this;
    }
   
    public function getItems(){
        return $this->getParameter('items');
    }
    
    public function setItems($value) {
        $this->setParameter('items', $value);
        
        return $this;
    }   
    protected function getEndPont(){
        return 'http://dev.revolutionsmultimedia.com';
    }
    public function sendData($data) {
        $url = $this->getEndpoint().'?'.http_build_query($data, '', '&');
        $httpResponse = $this->httpClient->get($url)->send();

        return $this->createResponse($httpResponse->getBody());
    }

    public function getEndpoint() {
        return $this->getTestMode() ? $this->developerEndpoint : $this->liveEndpoint;
    }
   
    public function getData(){
        $data['sid'] = $this->getSID();
        $data['rcode'] = $this->getRCode();
        $data['country'] = $this->getCountry();
        $data['summary'] = $this->getSummary();
        $data['currency_code'] = $this->getCurrencycode();
        $data['addfee'] = $this->getAddFee();
        if(!$data['addfee']) {
            $data['cart'] = $this->getCart();    
        }
        $data['items'] = $this->getItems();
        
        return $data;
    }
    
    protected function createResponse($data)    {
        return $this->response = new Response($this, $data);
    }
}
