<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class UserRole extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'user_id', 'role', 'status', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function countActiveUserRole()
    {
        $data = UserRole::where('status', 'active')->count();
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
