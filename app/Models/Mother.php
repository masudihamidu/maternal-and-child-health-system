<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;



class Mother extends Authenticatable
{
    use HasFactory;
    use HasRoles;

    protected $guard = 'mother';

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
        'region',
        'district',
        'ward',
        'street'
    ];

    public function immunities()
    {
        return $this->hasMany(Immunity::class);
    }

    public function diseases()
    {
        return $this->hasMany(Disease::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function father()
    {
        return $this->hasOne(Father::class);
    }

    public function siblings()
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

    public function pregnancySummary()
    {
        return $this->hasOne(PregnancySummary::class);
    }

    public function  motherBackground()
    {
        return $this->hasOne(MotherBackground::class);
    }

    public function ultrasoundImages()
    {
        return $this->hasMany(UltrasoundImage::class);
    }

}
