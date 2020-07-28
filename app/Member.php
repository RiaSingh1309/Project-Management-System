<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Member extends Model
{
    use Sortable;

    public $sortable = ['id', 'name', 'email', 'doj'];

    public function project()
    {
        return $this->belongsToMany('App\Project');
    }
}
