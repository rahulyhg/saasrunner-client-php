<?php

namespace SaasRunner\Resources;

/**
* SaasRunner\Resources\Event
*
* Responsible managing Event resources
*
* Example:
*
*   $client = new SaasRunner\Client('5201bad4-014a-4eb6-b18c-35b18c6b4249');
*   $client->events->index();
*/
class Event
{
    /**
    * Create a new instance of SaasRunner\Resources\Event
    *
    * @param Client $client SaasRunner\Client with API key
    */
    public function __construct(\SaasRunner\Client $client)
    {
        $this->client = $client;
    }

    /**
    * Attempt to retrieve all events
    *
    * @return array
    */
    public function index()
    {
        $response = $this->client->get('/events');
        $data = $response->json();

        return $data;
    }

    /**
    * Attempt to retrieve a single event
    *
    * @param integer $id event id
    *
    * @return array
    */
    public function show($id)
    {
        $response = $this->client->get("/events/$id");
        $data = $response->json();

        return $data;
    }

    /**
    * Attempt to destroy a single event
    *
    * @param integer $id event id
    *
    * @return array
    */
    public function destroy($id)
    {
        $response = $this->client->delete("/events/$id");
        $data = $response->json();

        return $data;
    }
}
