<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotherBackground extends Model
{
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'allergy',
        'gravidity',
        'parity',
        'childrens_born_niti',
        'miscarriages',
        'out_of_pocket',
        'died_child',
        'living_children',
        'mother_id'
    ];


    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }
}
