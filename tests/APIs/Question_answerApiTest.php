<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Question_answer;

class Question_answerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_question_answer()
    {
        $questionAnswer = factory(Question_answer::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/question_answers', $questionAnswer
        );

        $this->assertApiResponse($questionAnswer);
    }

    /**
     * @test
     */
    public function test_read_question_answer()
    {
        $questionAnswer = factory(Question_answer::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/question_answers/'.$questionAnswer->id
        );

        $this->assertApiResponse($questionAnswer->toArray());
    }

    /**
     * @test
     */
    public function test_update_question_answer()
    {
        $questionAnswer = factory(Question_answer::class)->create();
        $editedQuestion_answer = factory(Question_answer::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/question_answers/'.$questionAnswer->id,
            $editedQuestion_answer
        );

        $this->assertApiResponse($editedQuestion_answer);
    }

    /**
     * @test
     */
    public function test_delete_question_answer()
    {
        $questionAnswer = factory(Question_answer::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/question_answers/'.$questionAnswer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/question_answers/'.$questionAnswer->id
        );

        $this->response->assertStatus(404);
    }
}
