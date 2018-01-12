<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 1/12/18
 * Time: 9:48 AM
 */

namespace App\Minesweeper\Decorator;


use App\Minesweeper\Field;

interface FieldRenderer
{
    public function render(Field $field);
}