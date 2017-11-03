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

use App\Hotelbook\Exception\RequestException;
use Carbon\Carbon;
use SimpleXMLElement;

/**
 * Class Connector
 *
 * @package App\Hotelbook
 */
class Connector implements ConnectorInterface
{
    const CACHE_FILENAME = 'TMC_Provider_Hotelbook_cache_unixtime_diff.cache';

    /**
     * @var array
     */
    private $config;

    /**
     * Connector constructor.
     *
     */
    public function __construct($config)
    {
        $this->config = $config;
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
        $query = http_build_query(array_merge($options['query'] ?? [], $this->authentication()));
        $curl = curl_init();

        if ($method === 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, 'request=' . $body);
        }

        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 300);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_URL, $this->config['url'] . $uri . '?' . $query);
        curl_setopt($curl, CURLOPT_PORT, 80);
        curl_setopt($curl, CURLOPT_USERAGENT, 'tmc crazy connector');
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Accept: application/xml',
            'Accept-Encoding: gzip, deflate'
        ]);

        $response = curl_exec($curl);
        $this->handleError($curl);

        curl_close($curl);

        return new SimpleXMLElement($response);
    }

    /**
     * @return array
     */
    private function authentication()
    {
        $diff = $this->remember();
        $time = $this->resolveCorrectTime($diff);
        $checksum = md5(md5($this->config['auth']['password']) . $time);

        return [
            'login' => $this->config['auth']['login'],
            'time' => $time,
            'checksum' => $checksum
        ];
    }

    /**
     * Запоминаем (на 5 часов) разницу
     * во времени между сервером хотелбука и нашим.
     *
     * @param int $ttl
     * @return int
     */
    private function remember(int $ttl = 60 * 60 * 5)
    {
        $file = sys_get_temp_dir() . self::CACHE_FILENAME;
        if (file_exists($file) && (filemtime($file) > (time() - $ttl))) {
            return unserialize(file_get_contents($file));
        }

        $context = stream_context_create(['http' => ['timeout' => 10]]);
        $external = file_get_contents($this->config['url'] . 'unix_time', false, $context);

        $data = $this->resolveDifference(intval($external));
        file_put_contents($file, serialize($data), LOCK_EX);

        return $data;
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
     * @param $curl
     * @throws RequestException
     *
     * @return void
     */
    protected function handleError($curl)
    {
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_errno($curl) === 0 && ($code === 200 || $code === 201)) {
            return;
        }

        $msg = curl_error($curl);
        $num = curl_errno($curl);
        // $this->logger->warning('Ошибка обработки данных', compact('msg', 'num', 'provider'));
        throw new RequestException($msg, $num);
    }
}
