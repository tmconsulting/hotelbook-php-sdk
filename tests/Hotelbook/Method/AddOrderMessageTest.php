<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;
use Hotelbook\Method\AddOrderMessage;

class AddOrderMessageTest extends TestCase
{
    public function testAddOrderMessageMethodBuildTheSimpleRequest()
    {
        $addOrderMessage = new AddOrderMessage(new ConnectorStub);
        $xml = $addOrderMessage->build([1, 'xxx']);

        $this->assertEquals($this->getRequestProtocol('add-order-message-simple'), $xml);
    }

    public function testsHowAddOrderMessageMethodHandleTheRequest()
    {
        $addOrderMessage = new AddOrderMessage(new ConnectorStub('add-order-message'));
        $results = $addOrderMessage->handle($this->getRequestProtocol('add-order-message-simple'));

        $this->assertInstanceOf(ResultProceeder::class, $results);
        $this->assertNotEmpty($results->getItem());
    }
}
