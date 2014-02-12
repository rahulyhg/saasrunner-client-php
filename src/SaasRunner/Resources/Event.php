<?php

namespace SaasRunner\Resources;

# SaasRunner\Resources\Event
#
# Responsible managing Event resources
#
# Example:
#
#   $client = new SaasRunner\Client('5201bad4-014a-4eb6-b18c-35b18c6b4249');
#   $client->events->index();
#
class Event {

    # Public: create a new instance of SaasRunner\Resources\Event
    #
    #   Client $client - SaasRunner\Client with API key
    #
    # Returns instance of SaasRunner\Resources\Event
    public function __construct(Client $client) {
        $this->client = $client;
    }

    # Public: attempt to retrieve all events
    #
    # Returns an Array
    public function index() {
        $response = $this->client->get('/events');
        return $response->json();
    }

    # Public: attempt to retrieve a single event
    #
    #   integer $id - event id
    #
    # Returns an Array
    public function show($id) {
        $response = $this->client->get("/events/$id");
        return $response->json();
    }

    # Public: attempt to destroy a single event
    #
    #   integer $id - event id
    #
    # Returns an Array
    public function destroy($id) {
        $response = $this->client->delete("/events/$id");
        return $response->json();
    }
}
