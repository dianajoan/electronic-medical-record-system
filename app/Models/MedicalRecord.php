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
        'visit_date',
        'chief_complaint',
        'medical_history',
        'primary_diagnosis',
        'secondary_diagnosis',
        'treatment',
        'status',
    ];

    protected $dates = ['visit_date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public static function countActiveMedical()
    {
        $data = MedicalRecord::where('status', 'active')->count();
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
