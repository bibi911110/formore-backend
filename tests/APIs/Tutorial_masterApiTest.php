<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Tutorial_master;

class Tutorial_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tutorial_master()
    {
        $tutorialMaster = factory(Tutorial_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tutorial_masters', $tutorialMaster
        );

        $this->assertApiResponse($tutorialMaster);
    }

    /**
     * @test
     */
    public function test_read_tutorial_master()
    {
        $tutorialMaster = factory(Tutorial_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/tutorial_masters/'.$tutorialMaster->id
        );

        $this->assertApiResponse($tutorialMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_tutorial_master()
    {
        $tutorialMaster = factory(Tutorial_master::class)->create();
        $editedTutorial_master = factory(Tutorial_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tutorial_masters/'.$tutorialMaster->id,
            $editedTutorial_master
        );

        $this->assertApiResponse($editedTutorial_master);
    }

    /**
     * @test
     */
    public function test_delete_tutorial_master()
    {
        $tutorialMaster = factory(Tutorial_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tutorial_masters/'.$tutorialMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tutorial_masters/'.$tutorialMaster->id
        );

        $this->response->assertStatus(404);
    }
}
