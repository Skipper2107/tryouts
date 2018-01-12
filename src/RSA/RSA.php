<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 3/2/17
 * Time: 10:57 AM
 */

namespace App\RSA;


use App\Evklid\Evklid;

class RSA
{
    private $p1 = 53;
    private $p2 = 59;
    private $complexity = 2;

    /**
     * @param int $p1
     * @return $this
     */
    public function setControl1($p1)
    {
        $this->p1 = (int)$p1;
        return $this;
    }

    /**
     * @param int $p2
     * @return $this
     */
    public function setControl2($p2)
    {
        $this->p2 = (int)$p2;
        return $this;
    }

    /**
     * @param $data
     * @return array
     * @throws \Exception
     */
    public function encrypt($data)
    {
        $n = $this->generateN();
        $fi = $this->generateFi();
        $e = $this->generateOpenKey($fi);
        $data = $this->textToInteger($data);
        return [
            'data' => ($data ** $e) % $n,
            'openKey' => $e,
            'control' => $n,
        ];
    }

    private function generateN()
    {
        return $this->p1 * $this->p2;
    }

    /**
     * @return float|int
     * @throws \Exception
     */
    private function generateFi()
    {
        if (Evklid::gcd($this->p1, $this->p2) != 1) {
            throw new \Exception('Numbers are not simple');
        }
        return ($this->p1 - 1) * ($this->p2 - 1);
    }

    private function generateOpenKey($fi)
    {
        do {
            $e = rand(3, 11);
            if ($e % 2 == 0 || Evklid::gcd($e, $fi) != 1) {
                $e = null;
            }
        } while (is_null($e));
        return $e;
    }

    private function textToInteger($text)
    {
        return $text;
    }

    /**
     * @param $data
     * @param $openKey
     * @param $control
     * @return mixed
     * @throws \Exception
     */
    public function decrypt($data, $openKey, $control)
    {
        $fi = $this->generateFi();
        $d = $this->generateClosedKey($fi, $openKey);
        $data = ($data ** $d) % $control;
        return $this->integerToText($data);
    }

    private function generateClosedKey($fi, $openKey)
    {
        return ($this->complexity * $fi + 1) / $openKey;
    }

    private function integerToText($integer)
    {
        return $integer;
    }
}