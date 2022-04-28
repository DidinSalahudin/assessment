<?php

namespace App\Http\Controllers\Form;

use App\Models\Question;
use App\Models\Assessment;
use Illuminate\Http\Request;
use App\Models\QuestionDetail;
use App\Models\AssessmentResult;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function index()
    {
        $data['title']            = 'Assessment';
        $data['question_details'] = DB::table('assessments')
                                        ->join('questions', 'assessments.question_id', '=', 'questions.id')
                                        ->where('assessments.user_id', '=', Auth::user()->id)
                                        ->whereIn('status', ['registration', 'inprogress'])
                                        ->select('assessments.*', 'questions.title', 'questions.type', 'questions.time', 'questions.instruction')
                                        ->get();
        // dd($data);
        return view('pages.form.assessment.index', $data);
    }

    public function store(Request $request)
    {
        // dd($request);
        $question = Question::all();
        foreach ($question as $key => $value) {
            $assessment = Assessment::create([
                'user_id'     => $request->id,
                'question_id' => $value->id,
                'status'      => 'registration'
            ]);

            $questionDetail = QuestionDetail::where('question_id', $value->id)->get();
            foreach ($questionDetail as $keyDetail => $valueDetail) {
                AssessmentResult::create([
                    'assessment_id'      => $assessment->id,
                    'question_detail_id' => $valueDetail->id,
                ]);
            }
        }
        return response()->json(['success' => true], 200);
    }

    public function assessment_exam($id)
    {
        // dd($assessment);
        $assessment = Assessment::find($id);
        if ($assessment) {
            if ($assessment->status == 'inprogress' || $assessment->status == 'registration') {
                Assessment::find($id)->update(['status' => 'inprogress']);
            
                $data['assessment_id'] = $assessment->id;
                $data['time_start']    = $assessment->time_start;

                $question = Question::find($assessment->question_id);
                if ($question) {

                    $data['title'] = $question->title;
                    $data['type']  = $question->type;
                    $data['time']  = $question->time;

                    // $questionDetail = QuestionDetail::where('question_id', $assessment->question_id)->get();
                    $questionDetail = DB::table('question_details')
                                            ->join('assessment_results', 'question_details.id', '=', 'assessment_results.question_detail_id')
                                            ->where('assessment_results.assessment_id', '=', $assessment->id)
                                            ->select('assessment_results.id', 'assessment_results.answer', 'question_details.question_image', 'question_details.answer_image')
                                            ->get();
                    if ($questionDetail) {
                        foreach ($questionDetail as $key => $value) {
                            $data['detail'][] = [
                                'id'             => $value->id,
                                'question_image' => $value->question_image,
                                'answer_image'   => $value->answer_image,
                                'answer'         => $value->answer,
                            ];
                        }
                        // dd($data);
                        return view('pages.form.assessment.assessment_exam', $data);
                    } else {
                        return back()->with('error', 'Some problems occur, please try again');
                    }
                } else {
                    return back()->with('error', 'Some problems occur, please try again');
                }
            } else {
                return back()->with('error', 'your exam is over');
            }
        } else {
            return back()->with('error', 'Some problems occur, please try again');
        }
    }

    public function update_start_time(Request $request)
    {
        $dateNow = date('Y-m-d H:i:s');
        $update = Assessment::find($request->id)->update(['time_start' => $dateNow]);

        if ($update) {
            return response()->json([
                'success' => true,
                'data'    => $dateNow
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data'    => ''
            ], 500);
        }
    }

    public function autosave(Request $request)
    {
        $input = $request->all();
        if (isset($input['answer_result'])) {
            foreach ($input['answer_result'] as $key => $value) {  
                $index = explode("]", explode("[", $value['name'])[1])[0] - 1;                
                AssessmentResult::find($input['answer_result_id'][$index]['value'])->update([
                    'answer' => $value['value'],
                ]);
            }
        }
        if ($input['flag'] == 'autosave') {            
        } else {
            $assessmentResults = AssessmentResult::where('assessment_id', $input['assessment_id'])->get();
            $count = 0;
            foreach ($assessmentResults as $key => $value) {
                $questionDetail = DB::table('question_details')
                                        ->where('id', '=', $value->question_detail_id)
                                        ->where('answer', '=', $value->answer)
                                        ->count();
                if ($questionDetail > 0) {
                    $count++;
                }
            }
            Assessment::find($input['assessment_id'])->update([
                'status'         => $input['flag'],
                'time_end'       => date('Y-m-d H:i:s'),
                'correct_answer' => $count
            ]);
        }
        return response()->json(['success' => true], 200);
    }

    public function history(Type $var = null)
    {
        $data['title']     = 'History Assessment';
        // $data['assessment'] = Assessment::all();
        if (Auth::user()->level == 'admin') {
            $data['assessments'] = DB::table('assessments')
                                            ->join('questions', 'assessments.question_id', '=', 'questions.id')
                                            ->join('users', 'users.id', '=', 'assessments.user_id')
                                            ->select('assessments.*', 'users.fullname', 'questions.title', 'questions.type')
                                            ->get();
        } else {
            $data['assessments'] = DB::table('assessments')
                                            ->join('questions', 'assessments.question_id', '=', 'questions.id')
                                            ->join('users', 'users.id', '=', 'assessments.user_id')
                                            ->where('assessments.user_id', '=', Auth::user()->id)
                                            ->select('assessments.*', 'users.fullname', 'questions.title', 'questions.type')
                                            ->get();
        }
        // dd($data);
        return view('pages.form.assessment.history', $data);
    }
}
