<?php

namespace SaasRunner\Resources;

/**
* SaasRunner\Resources\Transaction
*
* Responsible for sending requests to create transaction charges and refunds
*
* Example:
*
*   $client = new SaasRunner\Client('5201bad4-014a-4eb6-b18c-35b18c6b4249');
*
*   $client->transactions->charge(['subscriber_uid' => 'SB*012743', 'transaction_uid' => 'TX*837827']);
*   // array(
*   //   'subscriber' => array(
*   //     'id' => 5066,
*   //     'subscriber_uid' => 'SB*012743',
*   //     'transaction_uid' => 'TX*837827',
*   //     'dated_at' => '2014-02-12',
*   //     'meta' => NULL
*   //   )
*   // )
*/
class Transaction
{
    /**
    * Create a new instance of SaasRunner\Resources\Transaction
    *
    * @param Client $client SaasRunner\Client with API key
    *
    * @return SaasRunner\Resources\Transaction
    */
    public function __construct(\SaasRunner\Client $client)
    {
        $this->client = $client;
    }

    /**
    * Attempt to create a new transaction charge
    *
    * @param array $params Transaction params
    *
    * @return array
    */
    public function charge($params = [])
    {
        $response = $this->client->post('/transactions/charge', ['transaction' => $params]);
        $data = $response->json();

        return $data;
    }

    /**
    * Attempt to create a new transaction refund
    *
    * @param array $params Transaction params
    *
    * @return array
    */
    public function refund($params = [])
    {
        $response = $this->client->post('/transactions/refund', ['transaction' => $params]);
        $data = $response->json();

        return $data;
    }
}
