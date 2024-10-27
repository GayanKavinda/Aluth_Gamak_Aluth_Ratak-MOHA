<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

//Developed by G.R Gayan Kavinda Gamlath 
//gayankavinda98v.lk@gmail.com
//2024 SLIIT Internship 
//Ministry of Home Affairs (MOHA)

class ProcessAgreement extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'process_agreements';

    protected $fillable = [
        'field',
        'task',
        'performance_indicator',
        'contracted_target',
        'first_quarter',
        'second_quarter',
        'third_quarter',
        'fourth_quarter',
        'total',
        'percentage',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['field', 'task', 'performance_indicator', 'contracted_target', 'first_quarter', 'second_quarter', 'third_quarter', 'fourth_quarter', 'total', 'percentage'])
            ->useLogName('process_agreement')
            ->logOnlyDirty();
    }

    // Add any relationships or additional methods here
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
