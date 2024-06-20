<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = auth()->user();
        // $questions = Question::where('user_id', $user->id)->orderByDesc('created_at')->get();

        $title = 'My Questions';
        $module_id = null;
        $pending = false;

        return view(
            'questions.index',
            compact('pending', 'title', 'module_id')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($module_id)
    {
        $title = 'New Question';
        $module = Module::findOrFail($module_id);
        return view('questions.create', compact('title', 'module'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'module_id' => 'required|exists:modules,id',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'photo' => 'nullable|mimes:jpg,bmp,png',
            ]);

            $user_id = auth()->user()->id;
            $validatedData['user_id'] = $user_id;

            if ($request->has('photo')) {
                $extension = $request->photo->extension();
                $path = $request->photo->storeAs('img', substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(10))), 0, 10) . '.' . $extension, 'public');
                $validatedData['photo'] = $path;
            }
            Question::create($validatedData);

            return redirect()->route('questions.index');
        } catch (ValidationException $e) {
            return $e->errors();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $questions = Question::where('module_id', $id)->orderByDesc('created_at')->get();
        $title = ucfirst(Module::find($id)->name);
        $module_id = $id;

        return view(
            'questions.index',
            compact('questions', 'title', 'module_id')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $title = 'Edit question';
        $module = Module::findOrFail($question->module->id);
        return view('questions.create', compact('title', 'module', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $question_id)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'photo' => 'nullable|mimes:jpg,bmp,png',
            ]);

            // tener en cuenta la foto

            $question = Question::find($question_id);

            $question->update($validatedData);
            return redirect()->route('questions.module', ['module_id' => $question->module->id]);
        } catch (ValidationException $e) {
            dd($e->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return back();
    }

    public function pendingWithPriority($module_id)
    {
        $title = ucfirst(Module::find($module_id)->name);

        $questions = Question::where('module_id', $module_id)
            ->whereDoesntHave('answer')
            ->orderByDesc('created_at')
            ->get();

        $pending = true;

        return view('questions.index', compact('pending', 'module_id', 'title'));
    }

    public function allByModule($module_id)
    {
        // $questions = Question::where('module_id', $module_id)->orderByDesc('created_at')->get();
        $title = ucfirst(Module::find($module_id)->name);
        $pending = false;

        return view(
            'questions.index',
            compact('pending', 'title', 'module_id')
        );
    }
}
