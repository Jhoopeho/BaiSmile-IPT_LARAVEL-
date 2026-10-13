<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['patient_number', 'full_name', 'date_of_birth', 'gender', 'contact_number', 'email', 'address', 'medical_history'];

    protected function casts(): array
    {
        return ['date_of_birth' => 'date'];
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
