<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    public static function recent(int $number=1){
        return self::whereNotNull('imagen')
                ->latest()
                ->limit($number)
                ->get();
    }

    use HasFactory;

    protected $fillable = ['marca', 'modelo', 'kms', 'precio', 'user_id', 
    
    'imagen', 'matriculada', 'matricula', 'color'];
}


