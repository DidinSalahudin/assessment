<?php

namespace App\Http\Controllers\Master;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function index()
    {
        $data['title']     = 'Question';
        $data['questions'] = Question::all();
        return view('pages.master.question.index', $data);
    }
    
    public function create()
    {
        $data['title'] = 'Add Question';
        return view('pages.master.question.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => ['required'],
            'type'        => ['required'],
            'time'        => ['required', 'numeric'],
            'instruction' => ['required'],
        ]);

        $post = Question::create($request->all());
        if ($post) {
            return redirect()->route('question.edit', $post->id)->with('success', 'Question created successfully');
        } else {
            return redirect()->route('question.create')->with('error', 'Some problems occur, please try again');
        }
    }

    public function edit($id)
    {
        $data['title']            = 'Edit Question';
        $data['questions']        = Question::find($id);
        $data['question_details'] = QuestionDetail::where('question_id', $id)->get();
        // dd($data);
        return view('pages.master.question.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => ['required'],
            'type'        => ['required'],
            'time'        => ['required', 'numeric'],
            'instruction' => ['required'],
        ]);

        $update = Question::find($id)->update($request->all());

        if ($update) {
            return back()->with('success', 'Question updated successfully');
        } else {
            return back()->with('error', 'Some problems occur, please try again');
        }
    }

    public function destroy($id)
    {
        $destroy = Question::find($id)->delete();
        if ($destroy) {
            $destroyDetail = QuestionDetail::where('question_id', $id)->delete();
            if ($destroyDetail) {
                return response()->json(['success' => true, 'message' => 'Question deleted successfully'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Some problems occur, please try again'], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Some problems occur, please try again'], 200);
        }
    }

    public function update_detail(Request $request)
    {
        $input = $request->all();

        foreach ($input['questiondetail'] as $key => $value) {
            $data = [];
            if (isset($request->file('questiondetail')[$key]['question_image'])) {
                $question_image = $request->file('questiondetail')[$key]['question_image'];
                $filename       = 'question'.$key.time().".".$question_image->getClientOriginalExtension();

                $question_image->move(public_path().'/upload/master/question/', $filename);
                $data['question_image'] = $filename;
            }

            if (isset($request->file('questiondetail')[$key]['answer_image'])) {
                $answer_image = $request->file('questiondetail')[$key]['answer_image'];
                $filename     = 'answer'.$key.time().".".$answer_image->getClientOriginalExtension();

                $answer_image->move(public_path().'/upload/master/question/', $filename);
                $data['answer_image'] = $filename;
            }

            $data['question_id'] = $input['question_id'];
            $data['answer']      = $value['answer'];

            if ($value['id'] == '') {
                QuestionDetail::create($data);
            } else {
                QuestionDetail::find($value['id'])->update($data);
            }
        }
        return back()->with('success', 'Questio detail created successfully');       
    }

    public function update_detail_delete_question(Request $request)
    {
        $input = $request->all();
        
        $destroy = QuestionDetail::find($input['id'])->delete();
        if ($destroy) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 500);
        }
    }
}
