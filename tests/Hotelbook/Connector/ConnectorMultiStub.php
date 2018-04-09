<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Connector;

/**
 * ConnectorMultiStub is a certain wrapper under Connector stub to stub a query sequence
 * Class ConnectorMultiStub
 * @package Neo\Hotelbook\Tests\Hotelbook\Connector
 */
class ConnectorMultiStub extends ConnectorStub
{
    /**
     * @var
     */
    protected $responseNames;
    /**
     * @var int
     */
    protected $iterator = 1;

    /**
     * ConnectorMultiStub constructor.
     * @param $responseNames
     */
    public function __construct($responseNames)
    {
        parent::__construct(current($responseNames));
        $this->responseNames = $responseNames;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param null $body
     * @param array $options
     * @return \SimpleXMLElement
     */
    public function request(string $method, string $uri = '', $body = null, array $options = [])
    {
        if (!empty($this->responseName)) {
            $result = parent::request($method, $uri, $body, $options);

            $this->responseName = $this->responseNames[$this->iterator];
            $this->iterator++;

            return $result;
        }
    }
}