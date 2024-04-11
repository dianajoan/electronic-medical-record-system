<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'visit_date',
        'chief_complaint',
        'medical_history',
        'diagnosis',
        'treatment',
        'status',
    ];

    protected $dates = ['visit_date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function labResults()
    {
        return $this->hasMany(LabResult::class);
    }

    public function drugPrescriptions()
    {
        return $this->hasMany(DrugPrescription::class);
    }

    public static function countActiveMedical()
    {
        $data = MedicalRecord::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
}
