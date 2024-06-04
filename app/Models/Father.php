<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'father_firstname',
        'father_middlename',
        'father_surname',
        'father_phone_number',
        'father_education',
        'father_occupation',
        'mother_id'
    ];


    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }
}
