<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{

    public function index() {
        $questions = Question::with('user')->paginate(15);
        return response()->json($questions, 200);
    }

    public function store(Request $request) {
        $question = Question::create($request->all());
        return response()->json(['message' => 'Question created successfully.', 'question' => $question], 201);
    }

    public function update(Request $request, $id) {
        $question = Question::findOrFail($id);
        $question->update($request->all());
        return response()->json(['message' => 'Question updated successfully.', 'question' => $question], 200);
    }

    public function destroy($id) {
        $question = Question::findOrFail($id);
        $question->delete();
        return response()->json(['message' => 'Question deleted successfully.'], 200);
    }

    public function show($id) {
        $question = Question::findOrFail($id);
        return response()->json($question, 200);
    }

    public function answer(Request $request, $id) {
        $question = Question::findOrFail($id);
        if ($question->answer == $request->answer) {
            return response()->json(['message' => 'Correct answer.'], 200);
        } else {
            return response()->json(['message' => 'Incorrect answer.'], 200);
        }
    }
}
