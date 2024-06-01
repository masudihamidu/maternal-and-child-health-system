<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\hasOne;



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

    public function diseases()
    {
        return $this->hasMany(Disease::class);
    }

    public function father()
    {
        return $this->hasOne(Father::class);
    }

    public function sibling()
    {
        return $this->hasMany(Sibling::class);
    }

    public function localChairman()
    {
        return $this->hasOne(LocalChairman::class);
    }

    public function healthProfessional()
    {
        return $this->hasMany(healthProfessional::class);
    }
}
