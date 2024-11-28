<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperUser extends Model
{
    use HasFactory;

    // Jika nama tabel tidak sesuai dengan konvensi Laravel, Anda bisa mendefinisikannya
    protected $table = 'users';

    // Jika Anda ingin mengecualikan kolom tertentu dari mass assignment
    protected $guarded = []; // Atau Anda bisa menggunakan $fillable untuk mendefinisikan kolom yang bisa diisi
}
