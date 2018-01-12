<?php
/**
 * Created by PhpStorm.
 * User: skipper
 * Date: 1/12/18
 * Time: 9:48 AM
 */

namespace App\Minesweeper\Decorator;


use App\Minesweeper\Cells\Cell;
use App\Minesweeper\Cells\NonLethalCell;
use App\Minesweeper\Field;

class JsonRenderer implements FieldRenderer
{
    public function render(Field $field)
    {
        $cells = $field->getCells();
        $result = [];
        foreach ($cells as $row => $columns) {
            /**@var Cell $cell */
            foreach ($columns as $column => $cell) {
                $result[$row][$columns] = [
                    'row' => $row,
                    'column' => $column,
                    'state' => $cell->getState(),
                ];
                if ($cell instanceof NonLethalCell && $cell->getState() === Cell::STATE_OPENED) {
                    $result[$row][$column]['mines'] = $cell->getMinesAround();
                }
            }
        }
        return json_encode($result);
    }
}