<?php

namespace SaasRunner\Resources;

/**
* SaasRunner\Resources\Activation
*
* Responsible for sending requests to create activations
*
* Example:
*
*   $client = new SaasRunner\Client('5201bad4-014a-4eb6-b18c-35b18c6b4249');
*
*   $client->activations->create(['subscriber_uid' => 'SB*012743']);
*   // array(
*   //   'activation' => array(
*   //     'id' => 5065,
*   //     'subscriber_uid' => 'SB*012743',
*   //     'dated_at' => '2014-02-12',
*   //     'meta' => NULL
*   //   )
*   // )
*/
class Activation
{
    /**
    * Create a new instance of SaasRunner\Resources\Activation
    *
    * @param Client $client SaasRunner\Client with API key
    *
    * @return SaasRunner\Resources\Activation
    */
    public function __construct(\SaasRunner\Client $client)
    {
        $this->client = $client;
    }

    /**
    * Attempt to create a new activation event
    *
    * @param array $params Activation params
    *
    * @return array
    */
    public function create($params = [])
    {
        $response = $this->client->post('/activations', ['activation' => $params]);
        $data = $response->json();

        return $data;
    }
}
