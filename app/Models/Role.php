<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;
    
    public $table = 'roles';

    protected $fillable = [
    	'name',
        'status',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
