<?php

namespace SaasRunner;

use Guzzle;

/**
* SaasRunner\Client
*
* Responsible for sending requests and processing responses from the API.
* Delegates resources to the relevant Resource class.
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
class Client
{
    /**
    * Create a new instance of SaasRunner\Client
    *
    * @param string $apiKey Your Saas Runner dashboard API key
    * @param string $apiHost Alternate API hostname ("api.saarunner.com")
    *
    * @return SaasRunner\Client
    */
    public function __construct($apiKey, $apiHost = 'api.saasrunner.com')
    {
        $this->client = new Guzzle\Http\Client('http://' . $apiHost);

        $this->setApiKey($apiKey);

        $this->subscribers  = new \SaasRunner\Resources\Subscriber($this);
        $this->transactions = new \SaasRunner\Resources\Transaction($this);
        $this->events       = new \SaasRunner\Resources\Event($this);
    }

    /**
    * Perform an HTTP GET request
    *
    * @return string $path URL path to send the request to
    *
    * @return Guzzle\Http\Message\Response
    */
    public function get($path)
    {
        return $this->request('get', $path);
    }

    /**
    * Perform an HTTP POST request
    *
    * @param string $path URL path to send the request to
    * @param array $params Parameters to send as the POST body
    *
    * @return Guzzle\Http\Message\Response
    */
    public function post($path, $params = [])
    {
        return $this->request('post', $path, $params);
    }

    /**
    * Perform an HTTP DELETE request
    *
    * @param string $path URL path to send the request to
    *
    * @return Guzzle\Http\Message\Response
    */
    public function delete($path)
    {
        return $this->request('delete', $path);
    }

    /**
    * Perform an HTTP request
    *
    * @param string $httpMethod HTTP request method to perform (eg. "post")
    * @param string $path URL path to send the request to
    * @param array $params Parameters to send as the POST body
    *
    * @throws SaasRunner\Exception\ResponseError for HTTP response starting 4xx
    * @return Guzzle\Http\Message\Response
    */
    protected function request($httpMethod, $path, $params = [])
    {
        $request = $this->client->createRequest($httpMethod, $path, [], $params, []);

        try {
            $response = $request->send();
        } catch (Guzzle\Http\Exception\ClientErrorResponseException $exception) {
            $message = $exception->getMessage();
            $response = $exception->getResponse();

            $e = new \SaasRunner\Exception\ResponseError($message);
            $e->setResponse($response);

            throw $e;
        }

        return $response;
    }

    /**
    * Store the API key and add it as a default header
    *
    * @param string $apiKey The API key to store
    *
    * @return $this
    */
    protected function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client->setDefaultOption('headers', ['X-API-Key' => $apiKey]);

        return $this;
    }
}
