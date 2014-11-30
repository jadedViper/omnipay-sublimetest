<?php
namespace Omnipay\SublimeTest;

use Omnipay\Omnipay;
use Omnipay\SublimeTest\Message\Response;
use Omnipay\Tests\GatewayTestCase;
use Omnipay\Common\CreditCard;

class SublimeGatewayTest extends GatewayTestCase{
    protected $options;
    protected $gateway;
    
    public function setUp(){
        parent::setUp();
        
        $this->gateway = new SublimeGateway($this->getHttpClient(), $this->getHttpRequest());
      
        
        $this->options = [
            'sid' => 'omnipaytest',
            'rcode' => 'TEXTRCODE',
            'country' => 'AU',
            'addfee' => true,
            'summary' => 'Purchase Items',
            'currencycode' => 'AUD',
            'items' => [
                ['name' => 'Item One', 'quantity' => 2, 'amount_unit' => '19.99', 'item_no' => '012312', 'item_desc' => 'Item One'],
                ['name' => 'Item Two', 'quantity' => 1, 'amount_unit' => '24.99', 'item_no' => '527595', 'item_desc' => 'Item Two']
            ]
        ]; 
    }

    public function testPurchaseSuccess(){
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertJsonStringEqualsJsonFile(dirname(__FILE__).'/Asserts/success.json', $response->getResponseJson());
        $this->assertEquals($response->getMessage(),null);
    }

    public function testPurchaseFail() {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        
        $response = $this->gateway->purchase($this->options)->send();
        
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('EXC', $response->getStatus());
        $this->assertNotNull($response->getMessage());
    }
}

