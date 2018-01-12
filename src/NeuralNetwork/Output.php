<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 2/17/17
 * Time: 4:27 PM
 */

namespace App\NeuralNetwork;


class Output
{
    /** @var array $results */
    protected $results = [];

    /**
     * @param Neuron $neuron
     * @return Output
     */
    public function addResult( Neuron $neuron ): Output
    {
        $this->results[] = $neuron->getOutput();
        return $this;
    }

    /**
     * @return Output
     */
    public function summarize(): Output
    {
        $res = array_sum( $this->results ) / count($this->results);
        $response = $res > 0.5 ? 'Yes!' : 'No! God, no! Please, no! God...';
        ddd( $response );
        return $this;
    }

}