<?php namespace Tests\Repositories;

use App\Models\Purchase_options;
use App\Repositories\Purchase_optionsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Purchase_optionsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Purchase_optionsRepository
     */
    protected $purchaseOptionsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->purchaseOptionsRepo = \App::make(Purchase_optionsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_purchase_options()
    {
        $purchaseOptions = factory(Purchase_options::class)->make()->toArray();

        $createdPurchase_options = $this->purchaseOptionsRepo->create($purchaseOptions);

        $createdPurchase_options = $createdPurchase_options->toArray();
        $this->assertArrayHasKey('id', $createdPurchase_options);
        $this->assertNotNull($createdPurchase_options['id'], 'Created Purchase_options must have id specified');
        $this->assertNotNull(Purchase_options::find($createdPurchase_options['id']), 'Purchase_options with given id must be in DB');
        $this->assertModelData($purchaseOptions, $createdPurchase_options);
    }

    /**
     * @test read
     */
    public function test_read_purchase_options()
    {
        $purchaseOptions = factory(Purchase_options::class)->create();

        $dbPurchase_options = $this->purchaseOptionsRepo->find($purchaseOptions->id);

        $dbPurchase_options = $dbPurchase_options->toArray();
        $this->assertModelData($purchaseOptions->toArray(), $dbPurchase_options);
    }

    /**
     * @test update
     */
    public function test_update_purchase_options()
    {
        $purchaseOptions = factory(Purchase_options::class)->create();
        $fakePurchase_options = factory(Purchase_options::class)->make()->toArray();

        $updatedPurchase_options = $this->purchaseOptionsRepo->update($fakePurchase_options, $purchaseOptions->id);

        $this->assertModelData($fakePurchase_options, $updatedPurchase_options->toArray());
        $dbPurchase_options = $this->purchaseOptionsRepo->find($purchaseOptions->id);
        $this->assertModelData($fakePurchase_options, $dbPurchase_options->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_purchase_options()
    {
        $purchaseOptions = factory(Purchase_options::class)->create();

        $resp = $this->purchaseOptionsRepo->delete($purchaseOptions->id);

        $this->assertTrue($resp);
        $this->assertNull(Purchase_options::find($purchaseOptions->id), 'Purchase_options should not exist in DB');
    }
}
