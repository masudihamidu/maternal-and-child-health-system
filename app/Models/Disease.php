<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disease extends Model
{
    use HasFactory;

          /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'disease_name',
        'description',
        'mother_id',
        'week12',
        'week20',
        'week26',
        'week30',
        'week36',
        'week38',
        'week40'
    ];

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }


}
