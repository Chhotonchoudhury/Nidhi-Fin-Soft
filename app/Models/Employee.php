<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';

    protected $fillable = [
        'employee_code',
        'name',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'aadhaar_number',
        'pan_number',
        'photo',
        'signature',
        'bank_name',
        'account_number',
        'ifsc_code',
        'branch_name',
        'address',
        'city',
        'state',
        'pincode',
        'branch_id',
        'joining_date',
        'salary',
        'commission_rate',
        'is_active',
        'documents',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate a unique employee code when a new employee is created
        static::creating(function ($employee) {
            // $employee->employee_code = 'EM' . str_pad(static::max('id') + 1, 5, '0', STR_PAD_LEFT);
            $employee->employee_code = 'EM' . str_pad(static::max('id') + 1);
           
        });
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
