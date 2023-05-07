<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Flag_selection;

class Flag_selectionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_flag_selection()
    {
        $flagSelection = factory(Flag_selection::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/flag_selections', $flagSelection
        );

        $this->assertApiResponse($flagSelection);
    }

    /**
     * @test
     */
    public function test_read_flag_selection()
    {
        $flagSelection = factory(Flag_selection::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/flag_selections/'.$flagSelection->id
        );

        $this->assertApiResponse($flagSelection->toArray());
    }

    /**
     * @test
     */
    public function test_update_flag_selection()
    {
        $flagSelection = factory(Flag_selection::class)->create();
        $editedFlag_selection = factory(Flag_selection::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/flag_selections/'.$flagSelection->id,
            $editedFlag_selection
        );

        $this->assertApiResponse($editedFlag_selection);
    }

    /**
     * @test
     */
    public function test_delete_flag_selection()
    {
        $flagSelection = factory(Flag_selection::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/flag_selections/'.$flagSelection->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/flag_selections/'.$flagSelection->id
        );

        $this->response->assertStatus(404);
    }
}
