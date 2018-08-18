<?php


class RecipientTest extends TestCase
{
    use  \Illuminate\Database\Concerns\ManagesTransactions;

    /**
     * /api/recipients [GET]
     */
    public function testShouldReturnAllRecipients()
    {
        $this->get("/api/recipients", []);
        $this->seeStatusCode(200);
    }

    /**
     * /api/recipients [POST]
     */
    public function testShouldCreateRecipient()
    {
        $parameters = [
            'name' => 'Hellin',
            'email' => 'hellin@movingtoberlin.com',
        ];
        $this->post("/api/recipients", $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            [
                'name',
                'email',
                'created_at',
                'updated_at',
            ]
        );
    }

    /**
     * 422 UNPROCESSABLE ENTITY
     * /api/recipients [POST]
     */
    public function testWithDuplicatedEmail()
    {
        $parameters = [
            'name' => 'Hellison Oliveira',
            'email' => 'hellin@tottalymovingtoberlin.com',
        ];
        $this->post("/api/recipients", $parameters, []);
        $parameters = [
            'name' => 'Hellison Teodoro',
            'email' => 'hellin@tottalymovingtoberlin.com',
        ];
        $this->post("/api/recipients", $parameters, []);
        $this->seeStatusCode(422);

    }

    /**
     * /recipients [DELETE]
     */
    public function testShouldDeleteRecipient()
    {
        $recipient = \App\Recipient::first();

        $this->delete("/api/recipients/" . $recipient->id, [], []);
        $this->seeStatusCode(200);

    }
}
