<?php
/**
 * Created by PhpStorm.
 * User: hellison
 * Date: 8/14/18
 * Time: 3:26 PM
 */

class VoucherPoolTest extends TestCase
{

    /**
     * /voucher/validate [PUT]
     */
    public function testNotFindVoucher()
    {
        $parameters = [
            'code' => '123456789',
            'email' => 'hellison.oliveira@gmai.com',
        ];
        $this->put("api/vouchers/validate", $parameters, []);
        $this->seeStatusCode(400);
    }

    /**
     * /voucher/validate [PUT]
     */
    public function testFindVoucher()
    {
        $parameters = [
            'code' => '123456789',
            'email' => 'reichel.kay@pacocha.com',
        ];
        $this->put("api/vouchers/validate", $parameters, []);
        $this->seeStatusCode(200);
//        $this->seeJsonStructure(
//            ['data' =>
//                [
//                    'error'
//                ]
//            ]
//        );


    }
}
