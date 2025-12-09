<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelter extends Model{
    
    
    public function dogs()
        {
            return $this->hasMany(Doge::class);
        }
}
