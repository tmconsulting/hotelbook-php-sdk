<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use Hotelbook\Method\ConfirmOrder;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class ConfirmOrderTest extends TestCase
{
    public function testHowConfirmOrderMethodBuildTheRequest()
    {
        $cancelOrder = new ConfirmOrder(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($params, $cancelOrder->build($params));
    }

    public function testHowConfirmOrderMethodHandleRequest()
    {
        $mock = $this->getMockBuilder(ConfirmOrder::class)
            ->setConstructorArgs([new ConnectorStub('confirm-order')])
            ->setMethods(['getErrors'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $result = $mock->handle([1, 2, 3, 'USD']);
        $this->assertInstanceOf(ResultProceeder::class, $result);
        $this->assertNotEmpty($result->getItems(), $result);
    }
}
