<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use App\Hotelbook\Method\Dynamic\ConfirmOrder;
use App\Hotelbook\Object\Results\CancelOrderResult;
use App\Hotelbook\Object\Results\ConfirmOrderResult;
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
            ->setMethods(['getErrors', 'form'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $mock->expects($this->once())
            ->method('form')
            ->willReturn([]);

        $this->assertInstanceOf(ConfirmOrderResult::class, $mock->handle([1, 2, 3, 'USD']));
    }
}
