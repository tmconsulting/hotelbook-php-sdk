<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use App\Hotelbook\Method\AnnulOrder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;
use App\Hotelbook\ResultProceeder;

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
            ->setMethods(['getErrors'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $result = $mock->handle([1, 2]);

        $this->assertInstanceOf(ResultProceeder::class, $result);
        $this->assertNotEmpty($result);
    }
}
