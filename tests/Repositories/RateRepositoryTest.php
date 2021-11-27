<?php namespace Tests\Repositories;

use App\Models\Rate;
use App\Repositories\RateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RateRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RateRepository
     */
    protected $rateRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rateRepo = \App::make(RateRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rate()
    {
        $rate = Rate::factory()->make()->toArray();

        $createdRate = $this->rateRepo->create($rate);

        $createdRate = $createdRate->toArray();
        $this->assertArrayHasKey('id', $createdRate);
        $this->assertNotNull($createdRate['id'], 'Created Rate must have id specified');
        $this->assertNotNull(Rate::find($createdRate['id']), 'Rate with given id must be in DB');
        $this->assertModelData($rate, $createdRate);
    }

    /**
     * @test read
     */
    public function test_read_rate()
    {
        $rate = Rate::factory()->create();

        $dbRate = $this->rateRepo->find($rate->id);

        $dbRate = $dbRate->toArray();
        $this->assertModelData($rate->toArray(), $dbRate);
    }

    /**
     * @test update
     */
    public function test_update_rate()
    {
        $rate = Rate::factory()->create();
        $fakeRate = Rate::factory()->make()->toArray();

        $updatedRate = $this->rateRepo->update($fakeRate, $rate->id);

        $this->assertModelData($fakeRate, $updatedRate->toArray());
        $dbRate = $this->rateRepo->find($rate->id);
        $this->assertModelData($fakeRate, $dbRate->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rate()
    {
        $rate = Rate::factory()->create();

        $resp = $this->rateRepo->delete($rate->id);

        $this->assertTrue($resp);
        $this->assertNull(Rate::find($rate->id), 'Rate should not exist in DB');
    }
}
