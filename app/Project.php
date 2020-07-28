<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Project extends Model
{
    use Sortable;

    public $sortable = ['id', 'project_title', 'project_desc', 'client_name', 'head_id', 'project_start', 'project_deadline', 'status'];
    
    public function user()
    {
        return $this->belongsTo('App\User','head_id');
    }

    public function member()
    {
        return $this->belongsToMany('App\Member');
    }

    public function hasUser($member) {
        return $this->member->contains($member);
    }
}
