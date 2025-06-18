<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class CompanyScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        // Agar foydalanuvchi tizimga kirgan bo'lsa va u xodim bo'lsa (web guard)
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            // Agar xodimning kompaniyasi mavjud bo'lsa,
            // barcha so'rovlarga avtomatik ravishda shu shartni qo'sh
            if ($user->company_id) {
                // Agar modelda 'company_id' ustuni bo'lsa, u bo'yicha filtrla
                if (in_array('company_id', $model->getFillable()) || $model->getConnection()->getSchemaBuilder()->hasColumn($model->getTable(), 'company_id')) {
                    $builder->where($model->getTable() . '.company_id', $user->company_id);
                }

                // Agar modelda 'managed_by_company_id' ustuni bo'lsa, u bo'yicha filtrla
                if (in_array('managed_by_company_id', $model->getFillable()) || $model->getConnection()->getSchemaBuilder()->hasColumn($model->getTable(), 'managed_by_company_id')) {
                    $builder->where($model->getTable() . '.managed_by_company_id', $user->company_id);
                }
            }
        }
    }
}
