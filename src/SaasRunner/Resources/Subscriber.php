<?php

namespace SaasRunner\Resources;

# SaasRunner\Resources\Subscriber
#
# Responsible for sending requests to create subscribers
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
class Subscriber {

    # Public: create a new instance of SaasRunner\Resources\Subscriber
    #
    #   Client $client - SaasRunner\Client with API key
    #
    # Returns instance of SaasRunner\Resources\Subscriber
    public function __construct(\SaasRunner\Client $client) {
        $this->client = $client;
    }

    # Public: attempt to create a new subscriber event
    #
    #   array $params - Subscriber params
    #
    # Returns an Array
    public function create($params = []) {
        $response = $this->client->post('/subscribers', ['subscriber' => $params]);
        return $response->json();
    }
}
