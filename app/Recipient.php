<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{

    protected $table = 'recipient';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email'];

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
}
