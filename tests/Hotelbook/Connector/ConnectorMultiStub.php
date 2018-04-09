<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Connector;

class ConnectorMultiStub extends ConnectorStub
{
    protected $responseNames;
    protected $iterator = 1;

    public function __construct($responseNames)
    {
        parent::__construct(current($responseNames));
    }

    public function request(string $method, string $uri = '', $body = null, array $options = [])
    {
        if (!empty($this->responseName)) {
            parent::request($method, $uri, $body, $options);

            $this->responseName = $this->responseNames[$this->iterator];
            $this->iterator++;
        }
    }
}