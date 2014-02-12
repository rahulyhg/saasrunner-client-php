<?php

namespace SaasRunner\Resources;

/**
* SaasRunner\Resources\Subscriber
*
* Responsible for sending requests to create subscribers
*
* Example:
*
*   $client = new SaasRunner\Client('5201bad4-014a-4eb6-b18c-35b18c6b4249');
*
*   $client->subscribers->create(['subscriber_uid' => 'SB*012743']);
*   // array(
*   //   'subscriber' => array(
*   //     'id' => 5065,
*   //     'subscriber_uid' => 'SB*012743',
*   //     'dated_at' => '2014-02-12',
*   //     'meta' => NULL
*   //   )
*   // )
*/
class Subscriber
{
    /**
    * Create a new instance of SaasRunner\Resources\Subscriber
    *
    * @param Client $client SaasRunner\Client with API key
    *
    * @return SaasRunner\Resources\Subscriber
    */
    public function __construct(\SaasRunner\Client $client)
    {
        $this->client = $client;
    }

    /**
    * Attempt to create a new subscriber event
    *
    * @param array $params Subscriber params
    *
    * @return array
    */
    public function create($params = [])
    {
        $response = $this->client->post('/subscribers', ['subscriber' => $params]);
        return $response->json();
    }
}
