<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 2/17/17
 * Time: 4:28 PM
 */

namespace App\NeuralNetwork;


class Neuron
{
    const CURVE_ARG = 1;

    /** @var array $inputs */
    protected $inputs = [];
    /** @var null $output */
    protected $output = null;

    /**
     * @param $input
     * @param int $weight
     * @return Neuron
     */
    public function throwInput($input, int $weight): Neuron
    {
        $additions = 0;
        if (key_exists((string)$input, $this->inputs)) {
            $additions = $this->inputs[(string)$input];
        }
        $this->inputs[(string)$input] = $weight + $additions;
        return $this;
    }

    /**
     * @return Neuron
     */
    public function perform(): Neuron
    {
        $this->output = $this->fs($this->sum());
        return $this;
    }

    /**
     * @param int $sum
     * @return float
     */
    protected function fs(int $sum): float
    {
        $y = 1 / (1 + exp(-1 * self::CURVE_ARG * $sum));
        return $y;
    }

    /**
     * @return int
     */
    protected function sum(): int
    {
        $out = 0;
        foreach ($this->inputs as $input => $weight) {
            $out += $input * $weight;
        }
        return $out;
    }

    /**
     * @return double
     */
    public function getOutput(): float
    {
        return $this->output;
    }

}