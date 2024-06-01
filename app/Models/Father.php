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
        'firstname',
        'middlename',
        'surname',
        'phone_number',
        'education',
        'occupation',
        'mother_id'
    ];


    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }
}
