<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrugPrescription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'medical_record_id',
        'drug_name',
        'dosage_instructions',
        'prescription_date',
        'status',
    ];

    protected $dates = ['prescription_date'];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public static function countActiveDrug()
    {
        $data = DrugPrescription::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
}
