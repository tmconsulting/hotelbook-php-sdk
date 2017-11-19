<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/23/17
 */

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use App\Hotelbook\Method\Dynamic\Detail;
use App\Hotelbook\Object\Results\DetailResult;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class DetailTest extends TestCase
{
    public function testHowDetailMethodBuildTheRequest()
    {
        $detail = new Detail(new ConnectorStub);

        $detail->build([39858]);

        $this->assertEquals([39858], [39858]);
    }

    public function testsHowDetailMethodHandleTheRequest()
    {
        $detail  = new Detail(new ConnectorStub('detail'));
        $results = $detail->handle([39858, false]);

        $this->assertInstanceOf(DetailResult::class, $results);
    }
}
