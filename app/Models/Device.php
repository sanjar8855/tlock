<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\CompanyScope;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'managed_by_company_id',
        'imei',
        'model_name',
        'status',
        'lock_reason',
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
     * Qurilma egasini (mijozni) olish.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Qurilmani boshqarayotgan kompaniyani olish.
     */
    public function managingCompany()
    {
        return $this->belongsTo(Company::class, 'managed_by_company_id');
    }

    public function locations()
    {
        return $this->hasMany(DeviceLocation::class)->orderBy('created_at', 'desc');
    }
}
