<?php

namespace Neo\Hotelbook\Tests\Hotelbook\Method;

use App\Hotelbook\Method\Dynamic\Book;
use App\Hotelbook\Object\Contact;
use App\Hotelbook\Object\Hotel\BookItem;
use App\Hotelbook\Object\Hotel\BookPassenger;
use App\Hotelbook\Object\Hotel\Tag;
use App\Hotelbook\Object\Results\Method\BookResult;
use Neo\Hotelbook\Tests\Hotelbook\Connector\ConnectorStub;
use Neo\Hotelbook\Tests\TestCase;

class BookTest extends TestCase
{
    public function testHowBookMethodBuildRequest()
    {
        $bookMock = new Book(new ConnectorStub());

        $contact = new Contact(
            'John Smith',
            'john.smith@example.com',
            '+1111111111'
        );

        $bookItem = new BookItem(1, 1);
        $bookPessanger = new BookPassenger('Mr', 'John', 'Smith');
        $bookItem->addRoom([$bookPessanger]);

        //Tag
        $tag = new Tag(1);

        $xml = $this->formatXml($bookMock->build([
            $contact, [$bookItem], $tag, null
        ]));

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
