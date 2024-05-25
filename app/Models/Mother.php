<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mother extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mother_firstname',
        'mother_secondname',
        'mother_lastname',
        'mother_dob',
        'mother_phone_number',
        'marital_status',
        'occupation',
        'education',
    ];

    public function immunities()
    {
        return $this->hasMany(Immunity::class);
    }
}
