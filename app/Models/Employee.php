<?php

namespace App\Models;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Employee extends Authenticatable 
{
    use HasFactory;
    use Sortable;
    protected $table = 'm_employees';

    protected $fillable = [
        'team_id', 'email', 'first_name', 'last_name', 'password',
        'gender', 'birthday', 'address', 'salary', 'position', 'avatar',
        'status', 'type_of_work', 'ins_id', 'upd_id', 'ins_datetime', 'upd_datetime', 'del_flag'
    ];

    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the value of id
     */
    
}