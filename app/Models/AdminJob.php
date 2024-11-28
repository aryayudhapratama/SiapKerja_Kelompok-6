<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminJob extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'user_id',
        'company_name',
        'description',
        'address',
        'category',
        'picture',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class, 'job_id');
    }
}
