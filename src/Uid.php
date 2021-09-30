<?php

namespace AgenterLab\Uid;

use Illuminate\Contracts\Cache\Repository;

class Uid
{

    /**
     * @var int
     */
    private $instanceId;

    /**
     * @var \Illuminate\Contracts\Cache\Repository
     */
    private $cache;

    /**
     * Maximum value of increment
     * @var int
     */
    private $maxValue = 4095;

    /**
     * @param int $instanceId
     * @param \Illuminate\Contracts\Cache\Repository $cache
     */
    function __construct(int $instanceId, Repository $cache) {
        $this->instanceId = $instanceId;
        $this->cache = $cache;
    }


    /**
     * Create id
     * 
     * @return int
     */
    public function create(): int {

        $time = time();

        $increment = $this->cache->increment('auto_id_' . $this->instanceId);

        if ($increment == $this->maxValue) {
            $this->cache->forget('auto_id_' . $this->instanceId);
        }

        $result = ($this->instanceId << 52) | ($time << 12) | ($increment<<0);

        return $result;
    }

}