<?php

class RpnEncoder
{
    /**
     * @var array
     */
    private $stack;
 
    public function encode(string $expression)
    {
        $result = '';
        $parts = str_split($expression);
        $this->stack = [];
 
        foreach ($parts as $part) {
            if ($part == '^') {
                foreach ($this->stack as $key => $item) {
                    if(in_array($item, ['+', '-', '*', '/'])){
                        $result .= $item;
                        unset($this->stack[$key]);
                    } else {
                        break;
                    }
                }
                array_unshift($this->stack, $part);
                continue;
            }
 
            if (in_array($part, ['*', '/'])) {
                foreach ($this->stack as $key => $item) {
                    if(in_array($item, ['+', '-'])){
                        $result .= $item;
                        unset($this->stack[$key]);
                    } else {
                        break;
                    }
                }
                array_unshift($this->stack, $part);
                continue;
            }
 
            if (in_array($part, ['+', '-'])) {
                array_unshift($this->stack, $part);
                continue;
            }
 
            if ($part == '(') {
                array_unshift($this->stack, $part);
                continue;
            }
 
            if ($part == ')') {
                foreach ($this->stack as $key => $item) {
                    if ($item != '(') {
                        $result .= $item;
                        unset($this->stack[$key]);
                    } else {
                        unset($this->stack[$key]);
                        break;
                    }
                }
                if (in_array(reset($this->stack), [])) {
                    $result .= array_shift($this->stack);
                }
                continue;
            }
 
            $result .= $part;
        }
 
        foreach ($this->stack as $item) {
            $result .= $item;
        }
 
        return $result;
    }
}
