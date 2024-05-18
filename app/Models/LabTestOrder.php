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
        'medical_record_id',
        'ordered_by',
        'general_test_id',
        'test_name',
        'status',
    ];

    protected $casts = [
        'status' => 'string', // Ensure status is cast as string
    ];

    public static function countActiveLabTestOrder()
    {
        $data = LabTestOrder::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ordered_by', 'id');
    }

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id', 'id');
    }

    public function genTest()
    {
        return $this->belongsTo(LabTest::class, 'general_test_id', 'id');
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

    // Get the user who ordered the lab test order
    public function orderedByUser()
    {
        return $this->belongsTo(User::class, 'ordered_by', 'id');
    }
}
