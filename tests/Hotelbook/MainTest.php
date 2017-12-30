<?php

namespace Neo\Hotelbook\Tests\Hotelbook;

use Carbon\Carbon;
use Hotelbook\Main;
use Hotelbook\Object\Hotel\SearchParameter;
use Hotelbook\Object\Hotel\SearchPassenger;
use Hotelbook\Object\Method\Search\AsyncSearch;
use Hotelbook\Object\Method\Search\AsyncSearchParams;
use Hotelbook\ResultProceeder;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;

class MainTest extends TestCase
{
    protected $configFixture;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->configFixture = [
            'url' => 'http://hotelbook.local',
            'differencePath' => sys_get_temp_dir(),
            'login' => 'LOGIN',
            'password' => 'PASSWORD'
        ];
    }

    public function testHowMainClassBuild()
    {
        $mock = $this->getMockBuilder(Main::class)
            ->disableOriginalConstructor()
            ->setMethods(['createConnector'])
            ->getMock();

        $mock->expects($this->once())
            ->method('createConnector')
            ->willReturn(new ConnectorStub());

        $mock->__construct($this->configFixture);
    }

    public function testHowMainClassBuildWithException()
    {
        $mock = $this->getMockBuilder(Main::class)
            ->disableOriginalConstructor()
            ->setMethods(['createConnector'])
            ->getMock();

        $mock->expects($this->never())
             ->method('createConnector')
             ->willReturn(new ConnectorStub());

        $this->expectException(InvalidOptionsException::class);
        $mock->__construct(['url' => 1]);
    }

    protected function getMockForMethodTest($responseName)
    {
        $mock = $this->getMockBuilder(Main::class)
            ->disableOriginalConstructor()
            ->setMethods(['createConnector'])
            ->getMock();

        $mock->expects($this->once())
            ->method('createConnector')
            ->willReturn(new ConnectorStub($responseName));

        $mock->__construct($this->configFixture);
        return $mock;
    }

    public function testSearchMethod()
    {
        $mock = $this->getMockForMethodTest('search');

        $from = Carbon::parse('19-01-2018');
        $till = Carbon::parse('20-01-2018');

        $result = $mock->search(
            1,
            $from,
            $till,
            [new SearchPassenger(1)],
            new SearchParameter()
        );

        $this->assertInstanceOf(ResultProceeder::class, $result);
    }

    public function testSearchMethodWithError()
    {
        $mock = $this->getMockForMethodTest('search-with-error');

        $from = Carbon::parse('19-01-2018');
        $till = Carbon::parse('20-01-2018');

        $result = $mock->search(
            1,
            $from,
            $till,
            [new SearchPassenger(1)],
            new SearchParameter()
        );

        $this->assertInstanceOf(ResultProceeder::class, $result);
    }

    public function testAsyncSearchMethod()
    {
        $mock = $this->getMockForMethodTest('async-search-initialize');

        $from = Carbon::parse('19-01-2018');
        $till = Carbon::parse('20-01-2018');

        $result = $mock->asyncSearch(
            1,
            $from,
            $till,
            [new SearchPassenger(1)],
            new SearchParameter(),
            new AsyncSearchParams()
        );

        $this->assertInstanceOf(AsyncSearch::class, $result);
    }

    public function testAsyncSearchMethodWithErrors()
    {
        $mock = $this->getMockForMethodTest('async-search-initialize-with-errors');

        $from = Carbon::parse('19-01-2018');
        $till = Carbon::parse('20-01-2018');

        $result = $mock->asyncSearch(
            1,
            $from,
            $till,
            [new SearchPassenger(1)],
             new SearchParameter(),
             new AsyncSearchParams()
        );

        $this->assertNull($result);
    }
}
