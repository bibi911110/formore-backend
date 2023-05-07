<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestion_answerAPIRequest;
use App\Http\Requests\API\UpdateQuestion_answerAPIRequest;
use App\Models\Question_answer;
use App\Repositories\Question_answerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\Question_answerResource;
use Response;

/**
 * Class Question_answerController
 * @package App\Http\Controllers\API
 */

class Question_answerAPIController extends AppBaseController
{
    /** @var  Question_answerRepository */
    private $questionAnswerRepository;

    public function __construct(Question_answerRepository $questionAnswerRepo)
    {
        $this->questionAnswerRepository = $questionAnswerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/questionAnswers",
     *      summary="Get a listing of the Question_answers.",
     *      tags={"Question_answer"},
     *      description="Get all Question_answers",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Question_answer")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $questionAnswers = $this->questionAnswerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(Question_answerResource::collection($questionAnswers), 'Question Answers retrieved successfully');
    }

    /**
     * @param CreateQuestion_answerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/questionAnswers",
     *      summary="Store a newly created Question_answer in storage",
     *      tags={"Question_answer"},
     *      description="Store Question_answer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Question_answer that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Question_answer")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Question_answer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $questionAnswer = $this->questionAnswerRepository->create($input);

        return $this->sendResponse(new Question_answerResource($questionAnswer), 'Question Answer saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/questionAnswers/{id}",
     *      summary="Display the specified Question_answer",
     *      tags={"Question_answer"},
     *      description="Get Question_answer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Question_answer",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Question_answer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Question_answer $questionAnswer */
        $questionAnswer = $this->questionAnswerRepository->find($id);

        if (empty($questionAnswer)) {
            return $this->sendError('Question Answer not found');
        }

        return $this->sendResponse(new Question_answerResource($questionAnswer), 'Question Answer retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateQuestion_answerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/questionAnswers/{id}",
     *      summary="Update the specified Question_answer in storage",
     *      tags={"Question_answer"},
     *      description="Update Question_answer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Question_answer",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Question_answer that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Question_answer")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Question_answer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateQuestion_answerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Question_answer $questionAnswer */
        $questionAnswer = $this->questionAnswerRepository->find($id);

        if (empty($questionAnswer)) {
            return $this->sendError('Question Answer not found');
        }

        $questionAnswer = $this->questionAnswerRepository->update($input, $id);

        return $this->sendResponse(new Question_answerResource($questionAnswer), 'Question_answer updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/questionAnswers/{id}",
     *      summary="Remove the specified Question_answer from storage",
     *      tags={"Question_answer"},
     *      description="Delete Question_answer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Question_answer",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Question_answer $questionAnswer */
        $questionAnswer = $this->questionAnswerRepository->find($id);

        if (empty($questionAnswer)) {
            return $this->sendError('Question Answer not found');
        }

        $questionAnswer->delete();

        return $this->sendSuccess('Question Answer deleted successfully');
    }
}
