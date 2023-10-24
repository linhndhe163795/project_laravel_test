<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Team extends Model
{
    use Sortable;
    use HasFactory;

    protected $table = 'm_teams';
    public $timestamps = false;
    protected $fillable = [
        'name','ins_id','upd_id','del_flag','ins_datetime','upd_datetime'
    ];
  
}
