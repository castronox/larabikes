<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bike extends Model
{
    use HasFactory, SoftDeletes;

    public static function recent(int $number=1){
        return self::whereNotNull('imagen')
                ->latest()
                ->limit($number)
                ->get();
    }

    protected $fillable = ['marca', 'modelo', 'kms', 'precio', 'user_id', 
    
    'imagen', 'matriculada', 'matricula', 'color'];

    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
}


