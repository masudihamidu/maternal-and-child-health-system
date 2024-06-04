<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sibling extends Model
{
    use HasFactory;


     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sibling_firstname',
        'sibling_middlename',
        'sibling_surname',
        'sibling_phone_number',
        'mother_id'
    ];

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }
}
