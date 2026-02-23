<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = ['patient_id', 'user_id', 'complaint', 'diagnosis', 'action'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
