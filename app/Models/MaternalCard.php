<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Contracts\Auth\Authenticatable;


class MaternalCard extends AuthenticatableUser implements Authenticatable

{
    use HasFactory;

    protected $fillable = [
        'maternalCard',
        'mother_id',
    ];

    // Override method to return maternalCard as the password
    public function getAuthPassword()
    {
        return $this->maternalCard;
    }

    // Optional: Override method if needed for custom logic
    public function getAuthIdentifierName()
    {
        return 'maternalCard';
    }

    public function getAuthIdentifier()
    {
        return $this->attributes['maternalCard'];
    }

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }
}
