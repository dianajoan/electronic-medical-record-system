<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class LabResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'lab_test_order_id',
        'authenticated_by',
        'result_details',
        'result_date',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = ['result_date', 'deleted_at'];

    public function labTestOrder()
    {
        return $this->belongsTo(LabTestOrder::class);
    }

    public function authenticatedBy()
    {
        return $this->belongsTo(User::class, 'authenticated_by');
    }

    public static function countActiveLab()
    {
        return LabResult::where('status', 'active')->count() ?? 0;
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
