<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuestionAPIRequest;
use App\Http\Requests\API\UpdateQuestionAPIRequest;
use App\Models\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\QuestionResource;
use Response;
use DB;
/**
 * Class QuestionController
 * @package App\Http\Controllers\API
 */

class QuestionAPIController extends AppBaseController
{
    /** @var  QuestionRepository */
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepository = $questionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/questions",
     *      summary="Get a listing of the Questions.",
     *      tags={"Question"},
     *      description="Get all Questions",
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
     *                  @SWG\Items(ref="#/definitions/Question")
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
        $questions = $this->questionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(QuestionResource::collection($questions), 'Questions retrieved successfully');
    }


    public function questions_get(Request $request)
    {

        $question = \App\Models\QuestionDetails::where('question_details.user_id',$request->user_id)
                            ->where('question.code',$request->code)
                            ->leftjoin('question','question_details.question_id','question.id')
                            //->groupBy('question.id')
                            ->whereNull('question_details.deleted_at')
                            ->select('question_details.*','question.code','question.msg_eng','question.msg_italian','question.msg_greek','question.msg_albanian')
                            ->get();

        /*$question =  Question::whereIn('user_id',$request->user_id)->get();
        echo "<pre>";
        print_r($question);
        exit;*/
        /*$question = DB::table("question")
        ->leftjoin("users",DB::raw("FIND_IN_SET(users.id,question.user_id)"),">",DB::raw("'0'"))
        ->select("question.*",DB::raw("GROUP_CONCAT(users.name) as userName"))
        //->whereRaw('FIND_IN_SET('.$request->user_id.',user_id)')
        ->whereRaw('FIND_IN_SET("'.$request->user_id.'",user_id)')
        ->whereNull('question.deleted_at')
        ->groupBy("question.id")
        ->get();*/
        /*echo "<pre>";
        print_r($question);
        exit;*/
        /*$$question = DB::table('question')
         ->whereRaw('FIND_IN_SET(css,Tags)')
         ->get();*/


        if($question != ''){
            return response(['status'=>'200','Message'=>'questions retrieved successfully.','question' => $question]);
        }else{
            return response(['status'=>'401','Message'=>"questions Not Found"]);
        }

    }

    /**
     * @param CreateQuestionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/questions",
     *      summary="Store a newly created Question in storage",
     *      tags={"Question"},
     *      description="Store Question",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Question that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Question")
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
     *                  ref="#/definitions/Question"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateQuestionAPIRequest $request)
    {
        $input = $request->all();

        $question = $this->questionRepository->create($input);

        return $this->sendResponse(new QuestionResource($question), 'Question saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/questions/{id}",
     *      summary="Display the specified Question",
     *      tags={"Question"},
     *      description="Get Question",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Question",
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
     *                  ref="#/definitions/Question"
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
        /** @var Question $question */
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            return $this->sendError('Question not found');
        }

        return $this->sendResponse(new QuestionResource($question), 'Question retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateQuestionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/questions/{id}",
     *      summary="Update the specified Question in storage",
     *      tags={"Question"},
     *      description="Update Question",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Question",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Question that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Question")
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
     *                  ref="#/definitions/Question"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateQuestionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Question $question */
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            return $this->sendError('Question not found');
        }

        $question = $this->questionRepository->update($input, $id);

        return $this->sendResponse(new QuestionResource($question), 'Question updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/questions/{id}",
     *      summary="Remove the specified Question from storage",
     *      tags={"Question"},
     *      description="Delete Question",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Question",
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
        /** @var Question $question */
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            return $this->sendError('Question not found');
        }

        $question->delete();

        return $this->sendSuccess('Question deleted successfully');
    }
}
