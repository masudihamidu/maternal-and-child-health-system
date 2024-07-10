<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class MaternalCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'maternalCard',
        'mother_id',
    ];

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function getAuthPassword()
    {
        return $this->maternalCard;
    }
}
