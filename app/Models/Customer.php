<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Scopes\CompanyScope;

class Customer extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'company_id',
        'full_name',
        'passport_number',
        'phone_number',
        'email',
        'password',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // Har bir so'rovga CompanyScope "filtr"ini avtomatik qo'shish
        static::addGlobalScope(new CompanyScope());
    }

    /**
     * Mijoz ro'yxatdan o'tgan kompaniyani olish.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Mijozning qurilmalarini olish.
     */
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
