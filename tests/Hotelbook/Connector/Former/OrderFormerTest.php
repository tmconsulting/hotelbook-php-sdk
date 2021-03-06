<?php

declare(strict_types=1);

namespace Neo\Hotelbook\Tests\Hotelbook\Connector;

use Hotelbook\Method\Former\Order;
use Neo\Hotelbook\Tests\TestCase;

class OrderFormerTest extends TestCase
{
    public function testHowFormerFormsResponse()
    {
        $methods = ['formOrderInfo', 'formOrderPaxes', 'formContactInfo', 'formHotelItems', 'getOrder'];
        $mock = $this->getMockBuilder(Order::class)
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
