<?php

namespace App\Http\Controllers;

use App\DataTables\QuestionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Repositories\QuestionRepository;
use App\Imports\QuestionImport;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Models\QuestionDetails;
use DB;
class QuestionController extends AppBaseController
{
    /** @var  QuestionRepository */
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepository = $questionRepo;

        $this->middleware('permission:questions-index|questions-create|questions-edit|questions-delete', ['only' => ['index','store']]);
        $this->middleware('permission:questions-create', ['only' => ['create','store']]);
        $this->middleware('permission:questions-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:questions-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Question.
     *
     * @param QuestionDataTable $questionDataTable
     * @return Response
     */
    public function index(QuestionDataTable $questionDataTable)
    {

        
        $data = \App\Models\Question::leftjoin('users','question.user_id','users.id')
                ->select('question.*','users.name as userName')
                ->get();

        
        
        //return $questionDataTable->render('questions.index');
        //$data = \App\Models\Question::orderBy('id','DESC')->get();



        /*$data = DB::table("question")
        ->leftjoin("users",DB::raw("FIND_IN_SET(users.id,question.user_id)"),">",DB::raw("'0'"))
        ->select("question.*",DB::raw("GROUP_CONCAT(users.name) as userName"))
        ->whereNull('question.deleted_at')
        ->groupBy("question.id")
        ->get();*/
        return view('questions.index',compact('data'));
    }

    /**
     * Show the form for creating a new Question.
     *
     * @return Response
     */
    public function create()
    {
        $users = User::where('role_id','4')->pluck('name','id');
        return view('questions.create',compact('users'));
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param CreateQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionRequest $request)
    {

        $input = $request->all();

        /*$count = $input['user_id'];
        */

        
        $result = Excel::toArray(new QuestionImport, $request->file('question_data'));
        $finalArray = array_filter($result[0], 'array_filter');
        $count = count($finalArray[0]);
        $countData = count($finalArray);
        $error_array = [];
        $count_user = count($input['user_id']);

        
        for ($u=0; $u < $count_user; $u++) { 
            //echo $input['user_id'][$u];

            $data['user_id'] = $input['user_id'][$u];
            $data['title'] = $request['title'];
            $data['notes'] = $request['notes'];
            $data['code'] = $request['code'];
            $data['q_date'] = $request['q_date'];
            $data['msg_eng'] = $request['msg_eng'];
            $data['msg_italian'] = $request['msg_italian'];
            $data['msg_greek'] = $request['msg_greek'];
            $data['msg_albanian'] = $request['msg_albanian'];

            $question = \App\Models\Question::create($data);
            
            for ($j = 1; $j < $countData; $j++) {
                for ($i = 0; $i < $count; $i++) {
                    //echo $result[0][0][$i];
                    if ($finalArray[0][$i] != '') {
                        //echo $finalArray[$j][$i]."<br>";
                        
                        $array[$finalArray[0][$i]] = 'public/media/Tmpfile.pdf';
                        $array[$finalArray[0][$i]] = $finalArray[$j][$i];
                        $array['user_id'] = $input['user_id'][$u];
                        $array['question_id'] = $question->id;
                        $array['status'] = '1';
                    } 
                }
                $question_details = QuestionDetails::create($array);
            }
        }
      
        


        $firebaseToken = \App\User::whereIn('id',$request->user_id)->where('users.role_id',4)->whereNotNull('device_token')->pluck('device_token')->all();
        $SERVER_API_KEY = 'AAAAYgl_AaM:APA91bGeiY3Tcw2vQMjSycjurTP5ME3h7SkCw6MTLX-SKrYDnvJRdatkUUmvHKx_e-uErk5ymEtzOnVBI2GQ9BFcLknm6c5oR7dSFGIjK8a7PWHxsgIWPyPLyazrgFdswa97ZwJTzZV7'; 

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => "New Question Added",
                "body" =>  $request['title'],
                //"body" => "Rating",

            ],
             "data" => [
                "type" => "Question",
                // "title" => $request['title'],
                "code" => $request['code'],
            ]                     

        ];
      
        $dataString = json_encode($data);  

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',

        ];
        $ch = curl_init();    

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);
        $data = json_decode($response);
            



        Flash::success('Question saved successfully.');

        return redirect(route('questionAnswers.index'));
    }

    /**
     * Display the specified Question.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

        return view('questions.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified Question.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

        return view('questions.edit')->with('question', $question);
    }

    /**
     * Update the specified Question in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionRequest $request)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

        $question = $this->questionRepository->update($request->all(), $id);

        Flash::success('Question updated successfully.');

        return redirect(route('questions.index'));
    }

    /**
     * Remove the specified Question from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $question = $this->questionRepository->find($id);

        /*echo "<pre>";
        print_r($question);
        exit;*/

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }

        $this->questionRepository->delete($id);

        //\App\Models\QuestionDetails::update($question->user_id);
        $data = Date('Y-m-d : h:s:i');
        
        
        //$question_details = \App\Models\QuestionDetails::update($data, $question->user_id);

        $question_details = \App\Models\QuestionDetails::where('user_id', $question->user_id)->update(['deleted_at' => $data]);

        Flash::success('Question deleted successfully.');

        return redirect(route('questions.index'));
    }
    public function question_status($id, $status)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Question not found');

            return redirect(route('questions.index'));
        }
        if ($status == 1) {
            $data['status'] = 0;
        } else {
            $data['status'] = 1;
        }
        $question = $this->questionRepository->update($data, $id);

        Flash::success('Question status updated successfully.');

        return redirect(route('questions.index'));
    }
    public function remove_empty( $array )
    {
        
        return array_filter($array, '_remove_empty');
    }

}
