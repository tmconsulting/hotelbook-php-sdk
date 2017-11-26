<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method\StaticData;

use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;
use App\Hotelbook\Method\StaticData\Meal as MealMethod;
use App\Hotelbook\Object\Results\StaticData\MealResponse;
use App\Hotelbook\Object\Hotel\Meal as MealObject;

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

        $this->assertInstanceOf(MealResponse::class, $response);
        $this->assertInstanceOf(MealObject::class, current($response->getItems()));
    }
}
