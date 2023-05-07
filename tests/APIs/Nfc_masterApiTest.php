<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Nfc_master;

class Nfc_masterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_nfc_master()
    {
        $nfcMaster = factory(Nfc_master::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/nfc_masters', $nfcMaster
        );

        $this->assertApiResponse($nfcMaster);
    }

    /**
     * @test
     */
    public function test_read_nfc_master()
    {
        $nfcMaster = factory(Nfc_master::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/nfc_masters/'.$nfcMaster->id
        );

        $this->assertApiResponse($nfcMaster->toArray());
    }

    /**
     * @test
     */
    public function test_update_nfc_master()
    {
        $nfcMaster = factory(Nfc_master::class)->create();
        $editedNfc_master = factory(Nfc_master::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/nfc_masters/'.$nfcMaster->id,
            $editedNfc_master
        );

        $this->assertApiResponse($editedNfc_master);
    }

    /**
     * @test
     */
    public function test_delete_nfc_master()
    {
        $nfcMaster = factory(Nfc_master::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/nfc_masters/'.$nfcMaster->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/nfc_masters/'.$nfcMaster->id
        );

        $this->response->assertStatus(404);
    }
}
