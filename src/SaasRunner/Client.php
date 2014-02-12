<?php

namespace SaasRunner;

use Guzzle;

# SaasRunner\Client
#
# Responsible for sending requests and processing responses from the API.
# Delegates resources to the relevant Resource class.
#
# Example:
#
#   $client = new SaasRunner\Client('5201bad4-014a-4eb6-b18c-35b18c6b4249');
#
#   $client->subscribers->create(['subscriber_uid' => 'SB#012743']);
#   // array(
#   //   'subscriber' => array(
#   //     'id' => 5065,
#   //     'subscriber_uid' => 'SB#012743',
#   //     'dated_at' => '2014-02-12',
#   //     'meta' => NULL
#   //   )
#   // )
#
class Client {

    # Public: create a new instance of SaasRunner\Client
    #
    #   string $apiKey  - Your Saas Runner dashboard API key
    #   string $apiHost - Alternate API hostname ("api.saarunner.com")
    #
    # Returns instance of SaasRunner\Client
    public function __construct($apiKey, $apiHost = 'api.saasrunner.com') {
        $this->client = new Guzzle\Http\Client('http://' . $apiHost);

        $this->setApiKey($apiKey);

        $this->subscribers  = new \SaasRunner\Resources\Subscriber($this);
    }

    # Public: perform an HTTP GET request
    #
    #   string $path - URL path to send the request to
    #
    # Return instance of Guzzle\Http\Message\Response
    public function get($path) {
        return $this->request('get', $path);
    }

    # Public: perform an HTTP POST request
    #
    #   string $path - URL path to send the request to
    #   array $params - Parameters to send as the POST body
    #
    # Return instance of Guzzle\Http\Message\Response
    public function post($path, $params = []) {
        return $this->request('post', $path, $params);
    }

    # Public: perform an HTTP DELETE request
    #
    #   string $path - URL path to send the request to
    #
    # Return instance of Guzzle\Http\Message\Response
    public function delete($path) {
        return $this->request('delete', $path);
    }

    # Internal: perform an HTTP request
    #
    #   string $httpMethod - HTTP request method to perform (eg. "post")
    #   string $path - URL path to send the request to
    #   array $params - Parameters to send as the POST body
    #
    # Return instance of Guzzle\Http\Message\Response
    protected function request($httpMethod, $path, $params = []) {
        $request = $this->client->createRequest($httpMethod, $path, [], $params, []);
        $response = $request->send();

        return $response;
    }

    # Internal: store the API key and add it as a default header
    #
    #   string $apiKey  - The API key to store
    #
    # Returns this
    protected function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
        $this->client->setDefaultOption('headers', ['X-API-Key' => $apiKey]);

        return $this;
    }
}
