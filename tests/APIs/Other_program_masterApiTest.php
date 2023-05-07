<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Other_program_master;

class Other_program_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_other_program_master()
    {
        $otherProgramMaster = factory(Other_program_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/other_program_masters', $otherProgramMaster
        );

        $this->assertApiResponse($otherProgramMaster);
    }

    /**
     * @test
     */
    public function test_read_other_program_master()
    {
        $otherProgramMaster = factory(Other_program_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/other_program_masters/'.$otherProgramMaster->id
        );

        $this->assertApiResponse($otherProgramMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_other_program_master()
    {
        $otherProgramMaster = factory(Other_program_master::class)->create();
        $editedOther_program_master = factory(Other_program_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/other_program_masters/'.$otherProgramMaster->id,
            $editedOther_program_master
        );

        $this->assertApiResponse($editedOther_program_master);
    }

    /**
     * @test
     */
    public function test_delete_other_program_master()
    {
        $otherProgramMaster = factory(Other_program_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/other_program_masters/'.$otherProgramMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/other_program_masters/'.$otherProgramMaster->id
        );

        $this->response->assertStatus(404);
    }
}
