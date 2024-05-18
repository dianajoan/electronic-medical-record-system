<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'user_id',
        'visit_date',
        'primary_diagnosis_id',
        'symptoms',
        'treatment_given',
        'outcome',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function primaryDiagnosis()
    {
        return $this->belongsTo(Diagnosis::class, 'primary_diagnosis_id');
    }

    public function secondaryDiagnoses()
    {
        return $this->belongsToMany(Diagnosis::class, 'medical_record_secondary_diagnoses', 'medical_record_id', 'diagnosis_id');
    }

    public static function countActiveMedical()
    {
        return self::where('status', 'active')->count();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::id();
                $model->save();
            }
        });
    }
}
