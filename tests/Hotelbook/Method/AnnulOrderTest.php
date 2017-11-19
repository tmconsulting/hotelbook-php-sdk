<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use App\Hotelbook\Method\Dynamic\AnnulOrder;

use App\Hotelbook\Object\Results\AnnulOrderResult;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class AnnulOrderTest extends TestCase
{
    public function testHowAnnulOrderMethodBuildTheRequest()
    {
        $cancelOrder = new AnnulOrder(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($params, $cancelOrder->build($params));
    }

    public function testHowAnnulOrderMethodHandleRequest()
    {
        $mock = $this->getMockBuilder(AnnulOrder::class)
            ->setConstructorArgs([new ConnectorStub('annul-order')])
            ->setMethods(['getErrors', 'form'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $mock->expects($this->once())
            ->method('form')
            ->willReturn([]);

        $this->assertInstanceOf(AnnulOrderResult::class, $mock->handle([1, 2]));
    }
}
