<?php

declare(strict_types=1);

namespace Neo\Hotelbook\Tests\Hotelbook\Connector;

use App\Hotelbook\Connector\Former\OrderFormer;
use Neo\Hotelbook\Tests\TestCase;

class OrderFormerTest extends TestCase
{
    public function testHowFormerFormsResponse()
    {
        $methods = ['formOrderInfo', 'formOrderPaxes', 'formContactInfo', 'formHotelItems', 'getOrder'];
        $mock = $this->getMockBuilder(OrderFormer::class)
            ->setMethods($methods)
            ->disableOriginalConstructor()
            ->getMock();

        foreach ($methods as $method) {
            $mock->expects($this->once())
                 ->method($method);
        }

        $this->assertNotEmpty($mock->form(null));
    }
}
