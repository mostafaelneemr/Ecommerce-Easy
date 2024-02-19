<?php


function pda($ob)
{
    print_r($ob->toArray());
    die;
}

function pd($ob)
{
    print_r($ob);
    die;
}

function whereBetween(&$eloquent, $columnName, $form, $to)
{
    if (!empty($form) && empty($to)) {
        $eloquent->whereRaw("$columnName >= ?", [$form]);
    } elseif (empty($form) && !empty($to)) {
        $eloquent->whereRaw("$columnName <= ?", [$to]);
    } elseif (!empty($form) && !empty($to)) {
        $eloquent->where(function ($query) use ($columnName, $form, $to) {
            $query->whereRaw("$columnName BETWEEN ? AND ?", [$form, $to]);
        });
    }
}
