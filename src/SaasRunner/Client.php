<?php

namespace SaasRunner;

use Guzzle;

class Client {

    public function __construct($apiKey, $apiHost = 'api.saasrunner.com') {
        $this->setApiKey($apiKey);

        $this->client = new Guzzle\Http\Client('http://' . $apiHost);
    }



    protected function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
        $this->client->setDefaultOption('header', array('X-API-Key' => $apiKey));

        return $this;
    }
}
