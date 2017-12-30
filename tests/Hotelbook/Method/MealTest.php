<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use Hotelbook\Method\Meal as MealMethod;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class MealTest extends TestCase
{
    public function testHowMealMethodBuildsRequest()
    {
        $mock = new MealMethod(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($mock->build($params), $params);
    }

    public function testHowMealMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(MealMethod::class)
            ->setConstructorArgs([new ConnectorStub('meal')])
            ->setMethods(['getErrors'])
            ->getMock();

        $mock->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);

        $response = $mock->handle([]);

        $this->assertInstanceOf(ResultProceeder::class, $response);
        $this->assertNotEmpty($response->getItems());
    }
}
