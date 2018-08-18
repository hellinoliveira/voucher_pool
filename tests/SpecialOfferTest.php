<?php


class SpecialOfferTest extends TestCase
{

    use  \Illuminate\Database\Concerns\ManagesTransactions;

    /**
     * /api/offers [GET]
     */
    public function testShouldReturnAllOffers()
    {
        $this->get("/api/offers", []);
        $this->seeStatusCode(200);
    }

    /**
     * /api/offers [POST]
     */
    public function testShouldCreateOffer()
    {
        $parameters = [
            'name' => 'Discount',
            'percentage_discount' => '90',
        ];
        $this->post("/api/offers", $parameters, []);
        $this->seeStatusCode(201);
        $response = (array)json_decode($this->response->content());


        $this->assertArrayHasKey('name', $response);
        $this->assertArrayHasKey('percentage_discount', $response);
        $this->assertArrayHasKey('id', $response);

        $this->seeJsonStructure(
            [
                'name',
                'percentage_discount',
                'created_at',
                'updated_at',
            ]
        );
    }
}