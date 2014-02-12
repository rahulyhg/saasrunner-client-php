<?php

namespace SaasRunner\Tests;

use SaasRunner\Client;

class ClientTest extends \PHPUnit_Framework_TestCase {

  public function provider() {
    $client = new \SaasRunner\Client('a78b34cfa82');

    return array([$client]);
  }

  /**
   * @dataProvider provider
   */
  public function testApiKeySet($client) {
    $this->assertEquals('a78b34cfa82', $client->apiKey);
  }

  /**
   * @dataProvider provider
   */
  public function testGuzzleClientSet($client) {
    $this->assertInstanceOf('Guzzle\Http\Client', $client->client);
  }

  /**
   * @dataProvider provider
   */
  public function testApiKeyHeaderSet($client) {
    $headers = $client->client->getDefaultOption('headers');

    $this->assertEquals(['X-API-Key' => 'a78b34cfa82'], $headers);
  }

  /**
   * @dataProvider provider
   */
  public function testGetCallsGuzzle($client) {
    $guzzle = $this->getMock('\Guzzle\Http\Client', ['createRequest']);

    $guzzle->expects($this->any())
           ->method('createRequest')
           ->will($this->returnValue(true));

    $guzzle->expects($this->once())
           ->method('createRequest')
           ->with($this->equalTo('get'),
                  $this->equalTo('/events'),
                  $this->anything(),
                  $this->anything(),
                  $this->anything());

    $client->get('/events');
  }

}
