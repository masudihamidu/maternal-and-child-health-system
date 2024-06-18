<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HealthProfessional extends Model
{
    use HasFactory, Notifiable;


     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'professional_name',
        'rank',
        'mother_id'
    ];


    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }
}
