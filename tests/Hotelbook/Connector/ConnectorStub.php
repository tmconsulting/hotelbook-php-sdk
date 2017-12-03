<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/23/17
 */

namespace Neo\Hotelbook\Tests\Hotelbook\Connector;

use App\Hotelbook\Connector\ConnectorInterface;
use SimpleXMLElement;

class ConnectorStub implements ConnectorInterface
{
    /**
     * @var
     */
    private $responseName;

    /**
     * ConnectorStub constructor.
     *
     * @param $responseName
     */
    public function __construct($responseName = '')
    {
        $this->responseName = $responseName;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param $body
     * @param array $options
     * @return SimpleXMLElement
     */
    public function request(string $method, string $uri = '', $body = null, array $options = [])
    {
        if (empty($this->responseName)) {
            throw new \LogicException('You should be pass responseName parameter for testing request output.');
        }

        $content = file_get_contents(__DIR__ . "/../../protocol/response/{$this->responseName}.xml");

        return new SimpleXMLElement($content);
    }
}
