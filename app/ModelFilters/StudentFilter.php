<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class StudentFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function registerDate($created_date)
    {
        return $this->where('created_at', 'LIKE', "%$created_date%");
    }

    public function studyYear($year)
    {
        return $this->where('study_year', 'LIKE', "$year")->select('id', 'roll_no');
    }
}
