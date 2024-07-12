<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UltrasoundImage extends Model
{
    use HasFactory;


      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image_path',
        'disease_id',
        'mother_id'
    ];

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }
}
