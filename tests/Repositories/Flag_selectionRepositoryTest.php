<?php namespace Tests\Repositories;

use App\Models\Flag_selection;
use App\Repositories\Flag_selectionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Flag_selectionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Flag_selectionRepository
     */
    protected $flagSelectionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->flagSelectionRepo = \App::make(Flag_selectionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_flag_selection()
    {
        $flagSelection = factory(Flag_selection::class)->make()->toArray();

        $createdFlag_selection = $this->flagSelectionRepo->create($flagSelection);

        $createdFlag_selection = $createdFlag_selection->toArray();
        $this->assertArrayHasKey('id', $createdFlag_selection);
        $this->assertNotNull($createdFlag_selection['id'], 'Created Flag_selection must have id specified');
        $this->assertNotNull(Flag_selection::find($createdFlag_selection['id']), 'Flag_selection with given id must be in DB');
        $this->assertModelData($flagSelection, $createdFlag_selection);
    }

    /**
     * @test read
     */
    public function test_read_flag_selection()
    {
        $flagSelection = factory(Flag_selection::class)->create();

        $dbFlag_selection = $this->flagSelectionRepo->find($flagSelection->id);

        $dbFlag_selection = $dbFlag_selection->toArray();
        $this->assertModelData($flagSelection->toArray(), $dbFlag_selection);
    }

    /**
     * @test update
     */
    public function test_update_flag_selection()
    {
        $flagSelection = factory(Flag_selection::class)->create();
        $fakeFlag_selection = factory(Flag_selection::class)->make()->toArray();

        $updatedFlag_selection = $this->flagSelectionRepo->update($fakeFlag_selection, $flagSelection->id);

        $this->assertModelData($fakeFlag_selection, $updatedFlag_selection->toArray());
        $dbFlag_selection = $this->flagSelectionRepo->find($flagSelection->id);
        $this->assertModelData($fakeFlag_selection, $dbFlag_selection->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_flag_selection()
    {
        $flagSelection = factory(Flag_selection::class)->create();

        $resp = $this->flagSelectionRepo->delete($flagSelection->id);

        $this->assertTrue($resp);
        $this->assertNull(Flag_selection::find($flagSelection->id), 'Flag_selection should not exist in DB');
    }
}
