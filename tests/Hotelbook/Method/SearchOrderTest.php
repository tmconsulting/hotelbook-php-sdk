<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use Hotelbook\Method\SearchOrder;
use Hotelbook\Object\Method\SearchOrder\SearchOrderParams;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;


/**
 * Class SearchOrderTest
 * @package Neo\Hotelbook\Tests\Hotelbook\Method
 */
class SearchOrderTest extends TestCase
{
    public function testHowSearchOrderMethodBuildRequest()
    {
        $mock = new SearchOrder(new ConnectorStub());

        $xml = $this->formatXml($mock->build([
            new SearchOrderParams('2018-01-01', '2018-01-03', '2018-02-01', '2018-02-01')
        ]));

        $this->assertEquals($this->getRequestProtocol('search-order'), $xml);
    }

    public function testsHowSearchMethodHandleTheRequest()
    {
        $mock = $this->getMockBuilder(SearchOrder::class)
            ->setConstructorArgs([new ConnectorStub('search-order')])
            ->setMethods(['getErrors'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $result = $mock->handle($this->getRequestProtocol('search-order'));

        $this->assertInstanceOf(ResultProceeder::class, $result);
        $this->assertNotEmpty($result->getItems());
    }
}
