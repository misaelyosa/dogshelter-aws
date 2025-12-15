<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doge extends Model
{
    use HasFactory;

    protected $table = 'doge';

    protected $fillable = ['nama', 'dob', 'trait', 'jenis_kelamin', 'keterangan', 'vaccin_status', 'pesan_adopsi'];

    public function adopter(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // alias for convenience
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shelter()
    {
        return $this->belongsTo(Shelter::class);
    }

}
