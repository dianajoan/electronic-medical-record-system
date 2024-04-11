<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'file_number',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone_number',
        'next_of_kin_relationship',
        'status',
    ];

    protected $dates = ['date_of_birth'];

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public static function countActivePatient()
    {
        $data = Patient::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
}
