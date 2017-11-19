<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use App\Hotelbook\Method\AnnulOrder;

use App\Hotelbook\Method\Dynamic\CancelOrder;
use App\Hotelbook\Object\Results\AnnulOrderResult;
use App\Hotelbook\Object\Results\CancelOrderResult;
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
            ->setMethods(['getErrors', 'form'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $mock->expects($this->once())
            ->method('form')
            ->willReturn([]);

        $this->assertInstanceOf(CancelOrderResult::class, $mock->handle([1, 2]));
    }
}
