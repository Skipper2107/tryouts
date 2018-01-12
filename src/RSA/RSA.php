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
    /** @var int $p1*/
    private $p1 = 53;
    /** @var int $p2 */
    private $p2 = 59;
    /** @var int $complexity */
    private $complexity = 2;

    /**
     * @param int $p1
     * @return $this
     */
    public function setControl1(int $p1): RSA
    {
        $this->p1 = $p1;
        return $this;
    }

    /**
     * @param int $p2
     * @return $this
     */
    public function setControl2(int $p2): RSA
    {
        $this->p2 = $p2;
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
     * @return int
     * @throws \Exception
     */
    private function generateFi(): int
    {
        if (Evklid::gcd($this->p1, $this->p2) != 1) {
            throw new \Exception('Numbers are not simple');
        }
        return ($this->p1 - 1) * ($this->p2 - 1);
    }

    private function generateOpenKey(int $fi): int
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
    public function decrypt($data, int $openKey, int $control)
    {
        $fi = $this->generateFi();
        $d = $this->generateClosedKey($fi, $openKey);
        $data = ($data ** $d) % $control;
        return $this->integerToText($data);
    }

    private function generateClosedKey(int $fi, int $openKey)
    {
        return ($this->complexity * $fi + 1) / $openKey;
    }

    private function integerToText($integer)
    {
        return $integer;
    }
}