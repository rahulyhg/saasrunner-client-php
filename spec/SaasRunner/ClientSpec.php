<?php

namespace spec\SaasRunner;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('a78b34cfa82');
        $this->shouldBeAnInstanceOf('SaasRunner\Client');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('SaasRunner\Client');
    }

    public function it_should_assign_the_api_key()
    {
        $this->apiKey->shouldBe('a78b34cfa82');
    }

    public function it_should_instantiate_a_guzzle_client()
    {
        $this->client->shouldBeAnInstanceOf('Guzzle\Http\Client');
    }

    public function it_should_the_api_key_in_the_default_headers()
    {
        $this->client->getDefaultOption('headers')->shouldBe(['X-API-Key' => 'a78b34cfa82']);
    }

    public function it_should_perform_a_get_request(
        \Guzzle\Http\Client $guzzle,
        \Guzzle\Http\Message\Request $request
    ) {
        $guzzle->createRequest("get", "/events", [], [], [])->willReturn($request);
        $this->client = $guzzle;

        $this->get('/events')->shouldReturn(null);
    }

    public function it_should_perform_a_post_request(
        \Guzzle\Http\Client $guzzle,
        \Guzzle\Http\Message\Request $request
    ) {
        $guzzle->createRequest("post", "/events", [], [], [])->willReturn($request);
        $this->client = $guzzle;

        $this->post('/events')->shouldReturn(null);
    }

    public function it_should_perform_a_delete_request(
        \Guzzle\Http\Client $guzzle,
        \Guzzle\Http\Message\Request $request
    ) {
        $guzzle->createRequest("delete", "/events/123", [], [], [])->willReturn($request);
        $this->client = $guzzle;

        $this->delete('/events/123')->shouldReturn(null);
    }
}
