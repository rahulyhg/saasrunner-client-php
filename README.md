# Saas Runner PHP client library

PHP client library for the Saas Runner REST API

## Installation

Use [Composer](https://getcomposer.org/) to install `saasrunner-client-php`

Add `simpleweb/saasrunner-client-php` to your `composer.json` file

```json
# composer.json
{
  "require": {
    "simpleweb/saasrunner-client-php": "~0.1"
  }
}
```

and then run

    $ composer install

## Usage

First create a client object with your Saas Runner API key

```php
$client = new SaasRunner\Client('5201bad4-014a-4eb6-b18c-35b18c6b4249');
```

And then call the relevant resource

#### Subscribers

Create a new subscriber

```php
$params = [
  'subscriber_uid' => 'SB#013473',
  'meta' => [
    'name' => 'J Bloggs'
  ]
];

$client->subscribers->create($params);
```

#### Transactions

Create a new transaction charge

```php
$params = [
  'subscriber_uid' => 'SB#013473',
  'transaction_uid' => 'TX#827473',
];

$client->transactions->charge($params);
```

Create a new transaction refurd

```php
$params = [
  'subscriber_uid' => 'SB#013473',
  'transaction_uid' => 'TX#827474',
];

$client->transactions->refund($params);
```

#### Events

List all events

```php
$client->events->index();
```

List an individual event

```php
$client->events->show(3732);
```

Delete an event

```php
$client->events->destroy(3732);
```

## Built-in Saas Runner REPL

A REPL for experimenting and debugging is provided, powered by [boris](https://github.com/d11wtq/boris).

To start it, run the following command (replacing `API_KEY` with your API key)

    $ sr-repl API_KEY
    [1] sr-repl > $client;
    // object(SaasRunner\Client)(
    //   'client' => object(Guzzle\Http\Client)(
    //
    //   ),
    //   'apiKey' => '5e0130d4-034a-4eb6-b1cc-31b1876ba249',
    //   ...
    // )

The `$client` object is preloaded for you, using the API key you gave.
