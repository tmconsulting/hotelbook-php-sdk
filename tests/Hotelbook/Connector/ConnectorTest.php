<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Connector;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Hotelbook\Connector\Connector;
use Hotelbook\Exception\ResponseException;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class ConnectorTest extends TestCase
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

    protected function buildSimpleResponse()
    {
        return new Response(200, [], file_get_contents(__DIR__ . "/../../protocol/response/book.xml"));
    }

    protected function buildErrorResponse()
    {
        return new Response(301);
    }

    protected function buildTimeResponse($timestamp)
    {
        return new Response(200, ['Content-type' => 'text/plain'], $timestamp);
    }

    protected function buildHandler($responses)
    {
        return new MockHandler($responses);
    }

    protected function buildClient($responses)
    {
        return new Client(['handler' => $this->buildHandler($responses)]);
    }

    public function testHowRequestMethodHandlesOKResponseWithAlreadyRememberedDifference()
    {
        $mock = $this->getMockBuilder(Connector::class)
            ->setConstructorArgs([$this->configFixture])
            ->setMethods(['buildClient', 'resolveCorrectTime', 'isFileRelevant', 'getDataFromCache'])
            ->getMock();

        $mock->expects($this->atLeast(1))
            ->method('buildClient')
            ->willReturn($this->buildClient([$this->buildSimpleResponse()]));

        $mock->expects($this->once())
            ->method('isFileRelevant')
            ->willReturn(true);

        $mock->expects($this->once())
            ->method('getDataFromCache')
            ->willReturn(0);

        $this->assertInstanceOf(SimpleXMLElement::class, $mock->request('GET', '/'));
    }

    public function testHowRequestMethodHandlesOKResponseWithNotRememeberedDifference()
    {
        $mock = $this->getMockBuilder(Connector::class)
            ->setConstructorArgs([$this->configFixture])
            ->setMethods([
                'buildClient',
                'resolveCorrectTime',
                'isFileRelevant',
                'writeCacheFile'
            ])
            ->getMock();

        $responses = [$this->buildTimeResponse(Carbon::now()->addHour()->timestamp), $this->buildSimpleResponse()];

        $mock->expects($this->atLeast(1))
            ->method('buildClient')
            ->willReturn($this->buildClient($responses));

        $mock->expects($this->once())
            ->method('isFileRelevant')
            ->willReturn(false);

        $mock->expects($this->once())
            ->method('writeCacheFile');

        $this->assertInstanceOf(SimpleXMLElement::class, $mock->request('GET', '/'));
    }


    public function testHowRequestMethodHandlesErrorResponseWithNotRememeberedDifference()
    {
        $mock = $this->getMockBuilder(Connector::class)
            ->setConstructorArgs([$this->configFixture])
            ->setMethods([
                'buildClient',
                'resolveCorrectTime',
                'isFileRelevant',
                'writeCacheFile'
            ])
            ->getMock();

        $responses = [$this->buildTimeResponse(Carbon::now()->subDay()->timestamp), $this->buildErrorResponse()];

        $mock->expects($this->atLeast(1))
            ->method('buildClient')
            ->willReturn($this->buildClient($responses));

        $mock->expects($this->once())
            ->method('isFileRelevant')
            ->willReturn(false);

        $mock->expects($this->once())
            ->method('writeCacheFile');

        $this->expectException(ResponseException::class);
        $this->assertNull($mock->request('GET', '/'));
    }
}
