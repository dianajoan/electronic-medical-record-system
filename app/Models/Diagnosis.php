<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Diagnosis extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'icd_code',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'primary_diagnosis_id');
    }

    public function medicalRecordsSecondary()
    {
        return $this->belongsToMany(MedicalRecord::class, 'medical_record_secondary_diagnoses');
    }

    public static function countActiveDiagnosis()
    {
        $data = Diagnosis::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
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
