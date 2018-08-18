<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{

    protected $table = 'special_offer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'percentage_discount'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function voucher()
    {
        return $this->hasMany(VoucherPool::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($offer) {
            $offer->voucher()->delete();
        });
    }


}