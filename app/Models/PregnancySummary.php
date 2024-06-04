<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PregnancySummary extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lnmp',
        'edd',
        'menstrual_cycle',
        'normal_cycle',
        'mother_id'
    ];


    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

}
