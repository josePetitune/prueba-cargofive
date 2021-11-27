<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Rate;

class RateApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rate()
    {
        $rate = Rate::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rates', $rate
        );

        $this->assertApiResponse($rate);
    }

    /**
     * @test
     */
    public function test_read_rate()
    {
        $rate = Rate::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/rates/'.$rate->id
        );

        $this->assertApiResponse($rate->toArray());
    }

    /**
     * @test
     */
    public function test_update_rate()
    {
        $rate = Rate::factory()->create();
        $editedRate = Rate::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rates/'.$rate->id,
            $editedRate
        );

        $this->assertApiResponse($editedRate);
    }

    /**
     * @test
     */
    public function test_delete_rate()
    {
        $rate = Rate::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rates/'.$rate->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rates/'.$rate->id
        );

        $this->response->assertStatus(404);
    }
}
