<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 2/17/17
 * Time: 4:26 PM
 */

namespace App\NeuralNetwork;


class NeuralNetwork
{
    /** @var array $inputs */
    protected $inputs = [];
    /** @var Output $output */
    protected $output;
    /** @var array $neurons */
    protected $neurons = [];

    /** @var $question string */
    protected $question;

    public function __construct(string $question)
    {
        $this->question = $question;
        $this->output = new Output();
    }

    /**
     * @param Input $inputs
     * @return NeuralNetwork
     */
    public function addInput(Input $inputs): NeuralNetwork
    {
        $this->inputs[] = $inputs;
        return $this;
    }

    /**
     * @param int $count
     * @return NeuralNetwork
     */
    public function createNeurons(int $count): NeuralNetwork
    {
        for ($i = 0; $i < $count; $i++) {
            $this->neurons[] = new Neuron();
        }
        return $this;
    }

    /**
     * @return NeuralNetwork
     */
    public function work(): NeuralNetwork
    {
        foreach ($this->inputs as $input) {
            $this->bind($input);
        }
        foreach ($this->neurons as $neuron) {
            /**@var $neuron Neuron */
            $this->output->addResult($neuron->perform());
        }
        return $this;
    }

    /**
     * @param Input $input
     * @return NeuralNetwork
     */
    protected function bind(Input $input): NeuralNetwork
    {
        foreach ($this->neurons as $neuron) {
            /**@var $neuron Neuron */
            $neuron->throwInput($input->getValue(), $input->getWeight());
        }
        return $this;
    }

    /**
     * @return Output
     */
    public function getOutput(): Output
    {
        return $this->output->summarize();
    }
}