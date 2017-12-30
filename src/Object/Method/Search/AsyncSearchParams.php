<?php

declare(strict_types=1);

namespace Hotelbook\Object\Method\Search;

class AsyncSearchParams
{
    protected $searchId;
    protected $timeout;
    protected $pause;
    protected $limit;
    protected $offset;

    public function __construct(
        int $timeout = 10,
        int $pause = 1,
        int $limit = 100,
        int $offset = 0
    )
    {
        $this->setTimeout($timeout);
        $this->setPause($pause);
        $this->setLimit($timeout);
        $this->setOffset($timeout);
    }

    /**
     * SearchId Getter
     * @return int
     */
    public function getSearchId()
    {
        return $this->searchId;
    }

    /**
     * SearchId Setter
     * @param int $searchId
     * @return void
     */
    public function setSearchId(int $searchId)
    {
        $this->searchId = $searchId;
    }

    /**
     * Timeout Getter
     * @return mixed
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Timeout Setter
     * @param int $timeout
     * @return void
     */
    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * SearchId Getter
     * @return int
     */
    public function getPause()
    {
        return $this->pause;
    }

    /**
     * SearchId Setter
     * @param int $pause
     * @return void
     */
    public function setPause(int $pause)
    {
        $this->pause = $pause;
    }

    /**
     * Timeout Getter
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Limit Setter
     * @param int $limit
     * @return void
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * Offset Getter
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Offset Stter
     * @param int $offset
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }
}
