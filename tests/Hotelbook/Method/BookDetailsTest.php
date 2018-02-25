<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;
use Hotelbook\Method\BookDetails;

class BookDetailsTest extends TestCase
{
    public function testBookDetailsMethodBuildTheSimpleRequest()
    {
        $bookDetails = new BookDetails(new ConnectorStub);
        $params = [123, 123];
        $this->assertEquals($bookDetails->build($params), $params);
    }

    public function testsBookDetailsMethodMethodHandleTheRequest()
    {
        $mock = $this->getMockBuilder(BookDetails::class)
            ->setConstructorArgs([new ConnectorStub('book-details')])
            ->setMethods(['getErrors'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $response = $mock->handle([1]);

        $this->assertInstanceOf(ResultProceeder::class, $response);
        $this->assertNotEmpty($response->getItems());
    }
}
