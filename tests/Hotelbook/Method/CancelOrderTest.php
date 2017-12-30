<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use Hotelbook\Method\CancelOrder;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class CancelOrderTest extends TestCase
{
    public function testHowCancelOrderMethodBuildTheRequest()
    {
        $cancelOrder = new CancelOrder(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($params, $cancelOrder->build($params));
    }

    public function testHowCancelOrderMethodHandleRequest()
    {
        $mock = $this->getMockBuilder(CancelOrder::class)
            ->setConstructorArgs([new ConnectorStub('cancel-order')])
            ->setMethods(['getErrors'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $result = $mock->handle([1, 2]);

        $this->assertInstanceOf(ResultProceeder::class, $result);
        $this->assertNotEmpty($result->getItems());
    }
}
