<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 2/17/17
 * Time: 4:34 PM
 */

namespace App\NeuralNetwork;


class Input
{
    /** @var string $criteria */
    protected $criteria = 'default';
    /** @var int $value */
    protected $value = 0;
    /** @var int $weight */
    protected $weight = 0;

    /**
     * @param string $criteria
     * @param int $input
     * @param int $weight
     * @return $this
     */
    public function setInput(string $criteria, int $input, int $weight): Input
    {
        $this->criteria = $criteria;
        $this->value = $input;
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return string
     */
    public function getCriteria(): string
    {
        return $this->criteria;
    }

    /**
     * @param $criteria string
     * @return $this
     */
    public function setCriteria(string $criteria): Input
    {
        $this->criteria = $criteria;
        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setValue(int $value): Input
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }


    /**
     * @param int $weight
     * @return $this
     */
    public function setWeight(int $weight): Input
    {
        $this->weight = $weight;
        return $this;
    }

}