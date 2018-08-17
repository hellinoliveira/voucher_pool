<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VoucherPool
 * @package App
 */
class VoucherPool extends Model
{

    protected $table = 'voucher';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code','recipient_id', 'expires_at', 'used_at', 'used'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Many to One declaration (Many Voucher One Recipient)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipients()
    {
        return $this->belongsTo(Recipient::class, 'recipient_id');
    }

    /**
     * Many to One declaration (Many Voucher One Offer)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specialOffer()
    {
        return $this->belongsTo(SpecialOffer::class, 'special_offer_id');
    }

    /**
     * VoucherPool constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->code = $this->randomCode(8);
        parent::__construct($attributes);
    }

    /**
     * @param int $length
     * @return bool|string
     */
    private function randomCode(int $length)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }
}
