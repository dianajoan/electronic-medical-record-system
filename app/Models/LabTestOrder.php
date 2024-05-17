<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class LabTestOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'medical_record_id',
        'lab_test_id',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function labTest()
    {
        return $this->belongsTo(LabTest::class);
    }

    public static function countActiveLabTestOrder()
    {
        $data = LabTestOrder::where('status', 'active')->count();
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
