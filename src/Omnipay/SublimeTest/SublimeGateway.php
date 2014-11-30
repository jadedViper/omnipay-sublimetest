<?php
namespace Omnipay\SublimeTest;

use Omnipay\Common\AbstractGateway;
use Omnipay\SublimeTest\Message\Response;
use Omnipay\SublimeTest\Message\PurchaseRequest;

class SublimeGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Sublime Test';
    }

    public function getDefaultParameters()
    {
        return [
            'sid' => '',
            'rcode' => '',
            'country' => '',
            'addfee' => false,
            'cart' => [],
            'summary' => [],
            'currencycode' => '',
            'items' => [],
        ];
    }

    public function getSid() {
        return $this->getParameter('sid');
    }

    public function setSid($value) {
        $this->setParameter('sid', $value);
    
        return $this;
    }

    public function getRcode() {
        return $this->getParameter('rcode');
    }

    public function setRcode($value) {
        $this->setParameter('rcode', $value);
        return $this;
    }

    
    public function getCountry() {
        return $this->getParameter('country');
    }

    public function setCountry($value) {
        return $this->setParameter('country', $value);
    }
    
    public function setAddfee($value) {
        $this->setParameter('addfee', $value);
        return $this;
    }

    public function getAddfee() {
        return $this->getParameter('addfee');
    }

    public function setCurrencycode($value) {
        $this->setParameter('currencycode', $value);
        return $this;
    }
    
    public function getCurrencycode() {
        $param = $this->getParameter('currencycode');
        return $param;
    }

    public function getCart(){
        return $this->getParameter('cart');
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
    
    public function purchase(array $parameters = array()) {
         return $this->createRequest('\Omnipay\SublimeTest\Message\PurchaseRequest', $parameters);
    }
}
