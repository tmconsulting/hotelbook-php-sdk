<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\Dictionary;

use App\Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;
use App\Hotelbook\Method\MealBreakfast;

class MealBreakfastTest extends TestCase
{
    public function testHowMealBreakfastMethodBuildsRequest()
    {
        $mock = new MealBreakfast(new ConnectorStub());
        $params = [123, 123];
        $this->assertEquals($mock->build($params), $params);
    }

    public function testHowMealbreakFastMethodHandlesRequest()
    {
        $mock = $this->getMockBuilder(MealBreakfast::class)
            ->setConstructorArgs([new ConnectorStub('meal-breakfast')])
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
