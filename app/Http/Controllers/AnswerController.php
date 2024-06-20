<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Question $question)
    {
        $answer = Answer::where('question_id', $question->id)->first();

        if (!$answer) {
            return view('answer.create', compact('question'));
        }

        return view('answer.create', compact('question', 'answer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'question_id' => 'required|exists:questions,id',
                'content' => 'required|string|max:65535'
            ]);

            $validatedData['user_id'] = Auth::user()->id;

            Answer::create($validatedData);

            return redirect('dashboard');
        } catch (ValidationException $e) {
            return $e->errors();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $answer_id)
    {

        try {
            $validatedData = $request->validate([
                'question_id' => 'required|exists:questions,id',
                'content' => 'required|string|max:65535'
            ]);

            $answer = Answer::findOrFail($answer_id);
            $answer->update($validatedData);

            return redirect()->route('dashboard');
        } catch (ValidationException $e) {
            return $e->errors();
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
