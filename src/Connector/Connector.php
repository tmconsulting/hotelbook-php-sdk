<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 22.05.16
 * Project: provider_hotelbook
 */

declare(strict_types=1);

namespace App\Hotelbook\Connector;

use App\Hotelbook\Exception\ResponseException;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use SimpleXMLElement;

/**
 * Class Connector
 *
 * @package App\Hotelbook
 */
class Connector implements ConnectorInterface
{
    /**
     * What is the CACHE_FILENAME to save the file.
     */
    const CACHE_FILENAME = 'TMC_Provider_Hotelbook_cache_unixtime_diff.cache';

    /**
     * @var array
     */
    private $config;

    /**
     * @var Client
     */
    private $client;

    /**
     * Connector constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->setConfig($config);
    }

    /**
     * @return array
     */
    protected function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    protected function setConfig(array $config)
    {
        $this->config = $config;
    }


    /**
     * @return Client
     * @codeCoverageIgnore
     */
    protected function buildClient()
    {
        return new Client([
            'base_uri' => $this->getConfig()['url'],
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param $body
     * @param array $options
     * @return SimpleXMLElement
     * @throws \App\Hotelbook\Exception\ResponseException
     */
    public function request(string $method, string $uri = '', $body = null, array $options = [])
    {
        $this->client = $this->buildClient();

        $query = http_build_query(array_merge($options['query'] ?? [], $this->authentication()));

        $response = $this->client->{strtolower($method)}($uri, [
            'query' => $query,
            'headers' => [
                'Accept' => 'application/xml',
                'Accept-Encoding', 'gzip, deflate'
            ],
            'form_params' => [
                'request' => $body
            ],
            'timeout' => 300
        ]);

        $this->handleError($response);

        return new SimpleXMLElement((string)$response->getBody());
    }

    /**
     * @return array
     */
    private function authentication()
    {
        $diff = $this->remember();
        $time = $this->resolveCorrectTime($diff);
        $checksum = md5(md5($this->getConfig()['auth']['password']) . $time);

        return [
            'login' => $this->getConfig()['auth']['login'],
            'time' => $time,
            'checksum' => $checksum
        ];
    }

    /**
     * Remember the difference between Hotelbook time and hours
     * Usually 5 hours
     *
     * @param int $ttl
     * @return int
     */
    private function remember(int $ttl = 60 * 60 * 5)
    {
        $file = rtrim($this->getConfig()['differencePath'], '/') . '/' . self::CACHE_FILENAME;

        if ($this->isFileRelevant($file, $ttl)) {
            return $this->getDataFromCache($file);
        }

        $external = $this->getExternalTime();
        $data = $this->resolveDifference((int)$external);

        $this->writeCacheFile($file, $data);

        return $data;
    }

    /**
     * @param $file
     * @param $ttl
     * @return bool
     * @codeCoverageIgnore
     */
    protected function isFileRelevant($file, $ttl)
    {
        return file_exists($file) && (filemtime($file) > (time() - $ttl));
    }

    /**
     * @param $file
     * @return mixed
     * @codeCoverageIgnore
     */
    protected function getDataFromCache($file)
    {
        return unserialize(file_get_contents($file));
    }

    /**
     * @return bool|string
     */
    protected function getExternalTime()
    {
        return (string) $this->client->get('unix_time')->getBody();
    }

    /**
     * @param $file
     * @param $data
     * @codeCoverageIgnore
     */
    protected function writeCacheFile($file, $data)
    {
        file_put_contents($file, serialize($data), LOCK_EX);
    }


    /**
     * @param $external
     * @return int
     */
    private function resolveDifference(int $external)
    {
        $carbon = Carbon::now();
        $diff = $carbon->diffInSeconds(Carbon::createFromTimestamp($external));
        if ($external > $carbon->getTimestamp()) {
            return $diff;
        }

        return -$diff;
    }

    /**
     * @param int $difference
     * @return int
     */
    private function resolveCorrectTime(int $difference)
    {
        return Carbon::now()->getTimestamp() + $difference;
    }

    /**
     * @param Response $response
     * @throws ResponseException
     * @return void
     */
    protected function handleError($response)
    {
        $code = $response->getStatusCode();

        if ($code === 200 || $code === 201) {
            return;
        }

        throw new ResponseException($code, $response->getReasonPhrase());
    }
}
