<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

class VoucherPool extends Model
{

    protected $table = 'voucher';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['expires_at', 'used_at', 'used'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function recipients()
    {
        return $this->belongsTo(Recipient::class, 'recipient_id');
    }

    public function specialOffer()
    {
        return $this->belongsTo(SpecialOffer::class, 'special_offer_id');
    }

    public function __construct(array $attributes = [])
    {
        $this->code = $this->randomCode(8);
        parent::__construct($attributes);
    }

    function randomCode(int $length)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }


}