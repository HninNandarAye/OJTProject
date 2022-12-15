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

    public function registerDate($created_date){
        return $this->where('created_at','LIKE',"%$created_date%");
    }

    public function rollNo($roll_no){
        return $this->where('roll_no','LIKE',"$roll_no");
    }
}
