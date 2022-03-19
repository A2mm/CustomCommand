<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory, SoftDeletes;
    
    public $table = 'schools';

    protected $fillable = [
    	'name',
        'status',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
