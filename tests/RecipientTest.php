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
        $this->seeJsonStructure([
                '*' => [
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ]
            ]
        );
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
        $this->seeInDatabase('recipient', [
            'name' => $parameters['name'],
            'email' => $parameters['email']
        ]);
    }

    /**
     * /api/recipients [POST]
     */
    public function testShouldUpdateRecipient()
    {

        $recipient = \App\Recipient::first();

        $parameters = [
            'name' => 'Hellin',
            'email' => 'hellison@alreadybuyingticketstoberlin.com',
        ];
        $this->put("/api/recipients/" . $recipient->id, $parameters, []);
        $this->seeStatusCode(200);

        $this->notSeeInDatabase('recipient', [
            'id' => $recipient->id,
            'name' => $recipient->name,
            'email' => $recipient->email,
        ]);

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
     * Should return a 404 for resource not found
     * /api/recipients [POST]
     */
    public function testShouldNotUpdateRecipient()
    {
        $parameters = [
            'name' => 'Hellin',
            'email' => 'hellison@alreadybuyingticketstoberlin.com',
        ];
        $this->put("/api/recipients/1598756661223", $parameters, []);
        $this->seeStatusCode(404);
        $this->seeJsonStructure(
            [
                'error'
            ]
        );
    }

    /**
     * Posting the same email before reset the database, should return a error.
     * 422 UNPROCESSABLE ENTITY(Laravel Validation)
     * /api/recipients [POST]
     */
    public function testShouldNotSaveDuplicatedEmail()
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

        $response = (array)json_decode($this->response->content());
        $this->assertArrayHasKey('email', $response);
        $this->seeJsonStructure([
            'email'
        ]);

    }

    /**
     * /recipients [DELETE]
     */
    public function testShouldDeleteRecipient()
    {
        $recipient = \App\Recipient::first();

        $this->delete("/api/recipients/" . $recipient->id, [], []);
        $this->seeStatusCode(200);
        $this->assertEquals('Deleted Successfully', $this->response->content());

    }
}
