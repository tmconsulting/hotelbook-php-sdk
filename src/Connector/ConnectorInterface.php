<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/17/17
 */

namespace Hotelbook\Connector;

use SimpleXMLElement;

/**
 * Interface ConnectorInterface
 *
 * @package App\Hotelbook
 */
interface ConnectorInterface
{
    /**
     * @param string $method
     * @param string $uri
     * @param $body
     * @param array $options
     * @return SimpleXMLElement
     */
    public function request(string $method, string $uri = '', $body = null, array $options = []);
}
