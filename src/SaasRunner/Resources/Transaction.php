<?php

namespace SaasRunner\Resources;

# SaasRunner\Resources\Transaction
#
# Responsible for sending requests to create transaction charges and refunds
#
# Example:
#
#   $client = new SaasRunner\Client('5201bad4-014a-4eb6-b18c-35b18c6b4249');
#
#   $client->transactions->charge(['subscriber_uid' => 'SB#012743', 'transaction_uid' => 'TX#837827']);
#   // array(
#   //   'subscriber' => array(
#   //     'id' => 5066,
#   //     'subscriber_uid' => 'SB#012743',
#   //     'transaction_uid' => 'TX#837827',
#   //     'dated_at' => '2014-02-12',
#   //     'meta' => NULL
#   //   )
#   // )
#
class Transaction {

    # Public: create a new instance of SaasRunner\Resources\Transaction
    #
    #   Client $client - SaasRunner\Client with API key
    #
    # Returns instance of SaasRunner\Resources\Transaction
    public function __construct(Client $client) {
        $this->client = $client;
    }

    # Public: attempt to create a new transaction charge
    #
    #   array $params - Transaction params
    #
    # Returns an Array
    public function charge($params = []) {
        $response = $this->client->post('/transactions/charge', ['transaction' => $params]);
        return $response->json();
    }

    # Public: attempt to create a new transaction refund
    #
    #   array $params - Transaction params
    #
    # Returns an Array
    public function refund($params = []) {
        $response = $this->client->post('/transactions/refund', ['transaction' => $params]);
        return $response->json();
    }
}
