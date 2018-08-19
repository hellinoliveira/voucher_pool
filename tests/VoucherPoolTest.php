<?php


class VoucherPoolTest extends TestCase
{

    use  \Illuminate\Database\Concerns\ManagesTransactions;

    /**
     * /vouchers/validate [PUT]
     */
    public function testNotFindVoucher()
    {
        $parameters = [
            'code' => '123456789',
            'email' => 'hellison.oliveira@movingtoberlin.com',
        ];
        $this->put("/api/vouchers/validate", $parameters, []);
        $this->seeStatusCode(400);
    }

    /**
     * /vouchers/validate [PUT]
     */
    public function testUseVoucher()
    {
        $voucher = \App\VoucherPool::first();
        $recipient = \App\Recipient::find($voucher->recipient_id);

        $parameters = [
            'code' => $voucher->code,
            'email' => $recipient->email,
        ];

        $this->put("/api/vouchers/validate", $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(['percentage_discount']);
        $this->seeInDatabase('voucher', [
            'id' => $voucher->id,
            'used' => true,
            'code' => $voucher->code,
            'special_offer_id' => $voucher->special_offer_id,
            'used_at' => new \Carbon\Carbon()
        ]);
    }


    /**
     * /vouchers [DELETE]
     */
    public function testShouldDeleteVoucher()
    {

        $voucher = \App\VoucherPool::first();

        $this->delete("/api/vouchers/" . $voucher->id, [], []);
        $this->seeStatusCode(200);

    }
}
