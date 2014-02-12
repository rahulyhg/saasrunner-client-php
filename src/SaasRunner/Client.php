<?php

namespace SaasRunner;

use Guzzle;

class Client {

    public function __construct($apiKey, $apiHost = 'api.saasrunner.com') {
        $this->client = new Guzzle\Http\Client('http://' . $apiHost);
        $this->setApiKey($apiKey);
    }



    protected function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
        $this->client->setDefaultOption('headers', ['X-API-Key' => $apiKey]);

        return $this;
    }
}
