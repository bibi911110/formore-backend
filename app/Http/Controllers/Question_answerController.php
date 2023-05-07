<?php

namespace App\Http\Controllers;

use App\DataTables\Question_answerDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuestion_answerRequest;
use App\Http\Requests\UpdateQuestion_answerRequest;
use App\Repositories\Question_answerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\User;
use Illuminate\Http\Request;
use App\Exports\QuestionExport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;


class Question_answerController extends AppBaseController
{
    /** @var  Question_answerRepository */
    private $questionAnswerRepository;

    public function __construct(Question_answerRepository $questionAnswerRepo)
    {
        $this->questionAnswerRepository = $questionAnswerRepo;

        $this->middleware('permission:question_answers-index|question_answers-create|question_answers-edit|question_answers-delete', ['only' => ['index','store']]);
        $this->middleware('permission:question_answers-create', ['only' => ['create','store']]);
        $this->middleware('permission:question_answers-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:question_answers-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Question_answer.
     *
     * @param Question_answerDataTable $questionAnswerDataTable
     * @return Response
     */
    public function index(Question_answerDataTable $questionAnswerDataTable)
    {
        $title = \App\Models\Question::pluck('title','id');
        $code = \App\Models\Question::pluck('code','code');
        $users = User::where('role_id','4')->pluck('name','id');
        return view('question_answers.index',compact('users','title','code'));
        //return $questionAnswerDataTable->render('question_answers.index',cpm);
    }

    /**
     * Show the form for creating a new Question_answer.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_answers.create');
    }

    /**
     * Store a newly created Question_answer in storage.
     *
     * @param CreateQuestion_answerRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestion_answerRequest $request)
    {
        $input = $request->all();

        $questionAnswer = $this->questionAnswerRepository->create($input);

        Flash::success('Question Answer saved successfully.');

        return redirect(route('questionAnswers.index'));
    }

    /**
     * Display the specified Question_answer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionAnswer = $this->questionAnswerRepository->find($id);

        if (empty($questionAnswer)) {
            Flash::error('Question Answer not found');

            return redirect(route('questionAnswers.index'));
        }

        return view('question_answers.show')->with('questionAnswer', $questionAnswer);
    }

    /**
     * Show the form for editing the specified Question_answer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionAnswer = $this->questionAnswerRepository->find($id);

        if (empty($questionAnswer)) {
            Flash::error('Question Answer not found');

            return redirect(route('questionAnswers.index'));
        }

        return view('question_answers.edit')->with('questionAnswer', $questionAnswer);
    }

    /**
     * Update the specified Question_answer in storage.
     *
     * @param  int              $id
     * @param UpdateQuestion_answerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestion_answerRequest $request)
    {
        $questionAnswer = $this->questionAnswerRepository->find($id);

        if (empty($questionAnswer)) {
            Flash::error('Question Answer not found');

            return redirect(route('questionAnswers.index'));
        }

        $questionAnswer = $this->questionAnswerRepository->update($request->all(), $id);

        Flash::success('Question Answer updated successfully.');

        return redirect(route('questionAnswers.index'));
    }

    /**
     * Remove the specified Question_answer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionAnswer = $this->questionAnswerRepository->find($id);

        if (empty($questionAnswer)) {
            Flash::error('Question Answer not found');

            return redirect(route('questionAnswers.index'));
        }

        $this->questionAnswerRepository->delete($id);

        Flash::success('Question Answer deleted successfully.');

        return redirect(route('questionAnswers.index'));
    }
    public function exporQuestion(Request $request)
    {

        $title = \App\Models\Question::pluck('title','id');
        $code = \App\Models\Question::pluck('code','code');
        $users = User::where('role_id','4')->pluck('name','id');

     /*   if ($request['user_id'] != null) {
            $questionsAns = \App\Models\Question_answer::leftjoin('question_details','question_answer.question_id','question_details.id')
                                ->leftjoin('question','question_details.question_id','question.id')
                                ->where('question_answer.user_id',$request->user_id)
                                ->select('question_answer.*','question_details.name as que','question.code','question.title','question.q_date','question.notes','question.id as que_id')
                                ->get();
        }

        if ($request['title_id'] != null && $request['user_id'] != null) {
            $questionsAns = \App\Models\Question_answer::leftjoin('question_details','question_answer.question_id','question_details.id')
                                ->leftjoin('question','question_details.question_id','question.id')
                                ->where('question.id',$request->id)
                                ->where('question_answer.user_id',$request->user_id)
                                ->select('question_answer.*','question_details.name as que','question.code','question.title','question.q_date','question.notes','question.id as que_id')
                                ->get();
        }
        if ($request['code_id'] != null && $request['user_id'] != null) {
            $questionsAns = \App\Models\Question_answer::leftjoin('question_details','question_answer.question_id','question_details.id')
                                ->leftjoin('question','question_details.question_id','question.id')
                                ->where('question.id',$request->id)
                                ->where('question_answer.user_id',$request->user_id)
                                ->select('question_answer.*','question_details.name as que','question.code','question.title','question.q_date','question.notes','question.id as que_id')
                                ->get();
        }
        if ($request['start_date'] != null && $request['user_id'] != null) {
            $questionsAns = \App\Models\Question_answer::leftjoin('question_details','question_answer.question_id','question_details.id')
                                ->leftjoin('question','question_details.question_id','question.id')
                                ->where('question.q_date',$request->start_date)
                                ->where('question_answer.user_id',$request->user_id)
                                ->select('question_answer.*','question_details.name as que','question.code','question.title','question.q_date','question.notes','question.id as que_id')
                                ->get();
        }*/
        /*if ($request['start_date'] != null && $request['code_id'] != null && $request['user_id'] != null) {
            $questionsAns = \App\Models\Question_answer::leftjoin('question_details','question_answer.question_id','question_details.id')
                                ->leftjoin('question','question_details.question_id','question.id')
                                ->where('question.q_date',$request->start_date)
                                ->where('question_answer.user_id',$request->user_id)
                                ->where('question.code',$request->code_id)
                                ->select('question_answer.*','question_details.name as que','question.code','question.title','question.q_date','question.notes','question.id as que_id')
                                ->get();
        }*/
         if ($request['title_id'] != null && $request['code_id'] != null && $request['user_id'] != null && $request['start_date'] == null) {
                        $code = \App\Models\Question::where('id',$request->code_id)->select('code')->first();
           // echo $request['code_id']; exit;
            $questionsAns = \App\Models\Question_answer::leftjoin('question_details','question_answer.question_id','question_details.id')
                                ->leftjoin('question','question_details.question_id','question.id')
                                //->where('question.q_date',$request->start_date)
                                ->where('question_answer.user_id',$request->user_id)
                                ->where('question.code',$request->code_id)
                               // ->where('question.title',$request->title_id)
                               // ->groupBy('question_answer.question_id')
                                ->select('question_answer.*','question_details.name as que','question.code','question.title','question.q_date','question.notes','question.id as que_id')
                                ->get();
           /* echo "<pre>";
            print_r($questionsAns); exit;*/
        }
        if ($request['title_id'] != null && $request['start_date'] != null && $request['code_id'] != null && $request['user_id'] != null) {
       

            $questionsAns = \App\Models\Question_answer::leftjoin('question_details','question_answer.question_id','question_details.id')
                                ->leftjoin('question','question_details.question_id','question.id')
                                ->where('question.q_date',$request->start_date)
                                ->where('question_answer.user_id',$request->user_id)
                                ->where('question.code',$request->code_id)
                               // ->where('question.title',$request->title_id)
                                ->select('question_answer.*','question_details.name as que','question.code','question.title','question.q_date','question.notes','question.id as que_id')
                                ->get();
        }
        if(!empty($questionsAns))
        {
        $questions = [];
        foreach ($questionsAns as $value) {
            $code_name = $value['code'];
            $question_id =$value['que_id'];

        }
        if(isset($question_id))
        {
            $questions = \App\Models\Question::where('id',$question_id)->get();
        }else{
             $questions = [];
        }
       /* echo "<pre>";
        print_r($question_id); exit;*/
            
            if(!isset($code_name))
            {

             $uniqid = uniqid();
            }else
            {
            $uniqid = $code_name;

            }
           /* echo "<pre>";
            print_r($questionsAns); exit;*/
            Excel::store(new QuestionExport($questionsAns),  $uniqid.'.xlsx','excel');
            $file_path_full =base_path().'/public/excel/'.$uniqid.'.xlsx';
            $file_path =pathinfo(base_path().'public/excel/'.$uniqid.'.xlsx');
            $basename = $uniqid.'.xlsx';
            $path = $uniqid.'.xlsx';
            ob_end_clean(); // this
            ob_start(); // and this
            $exce_download_url = url('/').'/public/excel/'.$uniqid.'.xlsx';
        }

        //return redirect(route('questionAnswers.index',compact('basename','questionsAns')));
         return view('question_answers.index',compact('basename','questionsAns','title','code','exce_download_url','questions'));
        //return response()->download($file_path_full, $basename, ['Content-Type' => 'application/force-download']);

    }
}
