<?php namespace Tests\Repositories;

use App\Models\Question_answer;
use App\Repositories\Question_answerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Question_answerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Question_answerRepository
     */
    protected $questionAnswerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->questionAnswerRepo = \App::make(Question_answerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_question_answer()
    {
        $questionAnswer = factory(Question_answer::class)->make()->toArray();

        $createdQuestion_answer = $this->questionAnswerRepo->create($questionAnswer);

        $createdQuestion_answer = $createdQuestion_answer->toArray();
        $this->assertArrayHasKey('id', $createdQuestion_answer);
        $this->assertNotNull($createdQuestion_answer['id'], 'Created Question_answer must have id specified');
        $this->assertNotNull(Question_answer::find($createdQuestion_answer['id']), 'Question_answer with given id must be in DB');
        $this->assertModelData($questionAnswer, $createdQuestion_answer);
    }

    /**
     * @test read
     */
    public function test_read_question_answer()
    {
        $questionAnswer = factory(Question_answer::class)->create();

        $dbQuestion_answer = $this->questionAnswerRepo->find($questionAnswer->id);

        $dbQuestion_answer = $dbQuestion_answer->toArray();
        $this->assertModelData($questionAnswer->toArray(), $dbQuestion_answer);
    }

    /**
     * @test update
     */
    public function test_update_question_answer()
    {
        $questionAnswer = factory(Question_answer::class)->create();
        $fakeQuestion_answer = factory(Question_answer::class)->make()->toArray();

        $updatedQuestion_answer = $this->questionAnswerRepo->update($fakeQuestion_answer, $questionAnswer->id);

        $this->assertModelData($fakeQuestion_answer, $updatedQuestion_answer->toArray());
        $dbQuestion_answer = $this->questionAnswerRepo->find($questionAnswer->id);
        $this->assertModelData($fakeQuestion_answer, $dbQuestion_answer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_question_answer()
    {
        $questionAnswer = factory(Question_answer::class)->create();

        $resp = $this->questionAnswerRepo->delete($questionAnswer->id);

        $this->assertTrue($resp);
        $this->assertNull(Question_answer::find($questionAnswer->id), 'Question_answer should not exist in DB');
    }
}
