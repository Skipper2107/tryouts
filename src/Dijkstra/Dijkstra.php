<?php

namespace App\Dijkstra;

class Dijkstra
{
    protected $visited = [];
    protected $weight = [];
    protected $route = [];

    /** @var array $map */
    protected $map;

    public function __construct(Map $map)
    {
        $this->map = $map->getMap();
    }

    /**
     * @return array
     */
    public function getWeights()
    {
        return $this->weight;
    }

    /**
     * @param $start
     */
    public function mapWay($start)
    {
        if (in_array($start, $this->visited) || !key_exists($start, $this->map)) {
            return;
        }
        $start = (string)$start;
        if (!isset($this->weight[$start])) {
            $this->weight[$start] = 0;
        }
        $current = key_exists($start, $this->map) ? $this->map[$start] : [];
        $this->visited[] = $start;
        foreach ($current as $destination => $weight) {
            $destinationWeight = isset($this->weight[$destination]) ? $this->weight[$destination] : -1;
            $currentWeight = $this->weight[$start] + $weight;
            if ($currentWeight < $destinationWeight || $destinationWeight == -1) {
                $this->weight[$destination] = $currentWeight;
                $this->route[$destination] = $start;
                $this->refreshWeight($destination);
            }
            $this->mapWay($destination);
        }
        return;
    }

    /**
     * @param $destination
     */
    private function refreshWeight($destination)
    {
        if (!in_array($destination, $this->route) || !key_exists($destination, $this->weight)) {
            return;
        }
        $weight = $this->weight[$destination];
        $heads = array_keys($this->route, $destination);
        foreach ($heads as $head) {
            $oldWeight = key_exists($head, $this->weight) ? $this->weight[$head] : -1;
            if ($oldWeight === -1) {
                continue;
            }
            $this->weight[$head] = $this->map[$destination][$head] + $weight;
            $this->refreshWeight($head);
        }
    }

    /**
     * @param $end
     * @return array
     */
    public function getRouteTo($end)
    {
        $originalEnd = $end;
        $route = [$end];
        while (key_exists($end, $this->route)) {
            $route[] = $this->route[$end];
            $end = $this->route[$end];
        }
        return [
            'route' => $route,
            'weight' => $this->getWeight($originalEnd)
        ];
    }

    /**
     * @param $end
     * @return mixed
     */
    public function getWeight($end)
    {
        return $this->weight[(string)$end] ?? null;
    }
}