<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use App\Hotelbook\Method\Book;
use App\Hotelbook\Object\Contact;
use App\Hotelbook\Object\Hotel\BookItem;
use App\Hotelbook\Object\Hotel\BookPassenger;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;
use App\Hotelbook\Object\Results\BookResult;

class BookTest extends TestCase
{
    public function testHowBookMethodBuildRequest()
    {
        $bookMock = $this->getMockBuilder(Book::class)
            ->setConstructorArgs([new ConnectorStub()])
            ->setMethods(['getRandomTag'])
            ->getMock();

        $bookMock->expects($this->once())
            ->method('getRandomTag')
            ->willReturn('1');

        $contact = new Contact(
            'John Smith',
            'john.smith@example.com',
            '+1111111111'
        );

        $bookItem = new BookItem(1, 1);
        $bookPessanger = new BookPassenger('Mr', 'John', 'Smith');
        $bookItem->addRoom([$bookPessanger]);

        $xml = $bookMock->build([
            $contact, [$bookItem]
        ]);

        $this->assertEquals($this->getRequestProtocol('book-simple'), $xml);
    }

    public function testsHowSearchMethodHandleTheRequest()
    {
        //Declare methods to stub
        $methods = ['getErrors', 'form'];

        //Get mock
        $bookMock = $this->getMockBuilder(Book::class)
            ->setConstructorArgs([new ConnectorStub('book')])
            ->setMethods($methods)
            ->getMock();

        //Assert stub
        foreach ($methods as $method) {
            $bookMock->expects($this->once())
                ->method($method)
                ->willReturn([]);
        }

        $results = $bookMock->handle($this->getRequestProtocol('book-simple'));

        $this->assertInstanceOf(BookResult::class, $results);
    }
}
