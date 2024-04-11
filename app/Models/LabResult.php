<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'medical_record_id',
        'test_name',
        'result_details',
        'result_date',
        'status',
    ];

    protected $dates = ['result_date'];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public static function countActiveLab()
    {
        $data = LabResult::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
}
