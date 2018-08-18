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
     * /vouchers [DELETE]
     */
    public function testShouldDeleteVoucher()
    {

        $voucher = \App\VoucherPool::first();

        $this->delete("/api/vouchers/" . $voucher->id, [], []);
        $this->seeStatusCode(200);

    }
}
