<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * Kompaniyaning xodimlarini olish.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Kompaniyaning mijozlarini olish.
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
