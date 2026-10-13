<?php

namespace App\Models;

use Database\Factories\DentistFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dentist extends Model
{
    /** @use HasFactory<DentistFactory> */
    use HasFactory;

    protected $fillable = ['name', 'specialization', 'email', 'phone'];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
