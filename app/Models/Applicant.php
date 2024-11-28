<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    /**
     * Table associated with the model.
     *
     * @var string
     */
    protected $table = 'applicants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'job_id',
        'name',
        'email',
        'company',
        'cv',
        'status',
    ];

    /**
     * Relasi ke tabel User.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(AdminJob::class, 'job_id');
    }

}
