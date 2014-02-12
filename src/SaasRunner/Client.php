<?php

namespace SaasRunner;

use Guzzle;

class Client {

    public function __construct($apiKey, $apiHost = 'api.saasrunner.com') {
        $this->client = new Guzzle\Http\Client('http://' . $apiHost);
        $this->setApiKey($apiKey);
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
