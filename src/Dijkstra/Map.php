<?php

namespace App\Dijkstra;

class Map
{
    /** @var array $map */
    protected $map = [];

    /**
     * @param $a
     * @param $b
     * @param $weight
     */
    public function addRoute($a, $b, $weight)
    {
        $this->map[(string)$a][(string)$b] = (float)abs($weight);
    }

    /**
     * @return string
     */
    public function printMap()
    {
        return json_encode($this->map);
    }

    /**
     * @return array
     */
    public function getMap()
    {
        return $this->map;
    }
}