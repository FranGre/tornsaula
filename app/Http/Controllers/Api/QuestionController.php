<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 * path="/api/questions",
 * summary="Create question",
 * description="Create a question",
 * security={ {"apiAuth": {} }},
 * operationId="questionStore",
 * tags={"questions"},
 * @OA\RequestBody(
 *    required=true,
 *    description="question store",
 *    @OA\JsonContent(ref="#/components/schemas/Question"),
 * ),
 * @OA\Response(
 *    response=401,
 *    description="Error: Unauthorized",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Unauthenticated")
 *        )
 *     ),
 * @OA\Response(
 *    response=200,
 *    description="Succesfully login",
 *    @OA\JsonContent(
 *       @OA\Property(property="token", type="string", example="khk3474")
 *        )
 *     )
 * )
 * 
 * @OA\Delete(
 *      path="/api/questions",
 *      summary="Delete Question",
 *      description="Delete a question",
 *      security={{"apiAuth": {}}},
 *      operationId="questionDestroy",
 *      tags={"questions"},
 *      @OA\Response(
 *      
 *      ),
 *      @OA\Response(
 *      )
 * )
 */
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new QuestionCollection(Question::paginate(3));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'module_id' => 'required|integer|exists:modules,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // 'photo' => 'nullable|mimes:jpg,bmp,png',
        ]);

        $question = Question::create($validatedData);

        return new QuestionResource($question);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        if ($request->method() === 'PUT') {
            $validations = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'module_id' => 'required|integer|exists:modules,id',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'photo' => 'nullable|mimes:jpg,bmp,png',
            ]);

            $question->update($validations);
            return new QuestionResource($question);
        }

        $validations = [];

        if ($request->has('user_id')) {
            $validations['user_id'] = 'required|integer|exists:users,id';
        }

        if ($request->has('module_id')) {
            $validations['module_id'] = 'required|integer|exists:modules,id';
        }

        if ($request->has('title')) {
            $validations['title'] = 'required|string|max:255';
        }

        if ($request->has('description')) {
            $validations['description'] = 'required|string';
        }

        if ($request->has('photo')) {
            $validations['photo'] = 'nullable|mimes:jpg,bmp,png';
        }

        $validatedData = $request->validate($validations);

        $question->update($validatedData);
        return new QuestionResource($question);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(null, 204);
    }
}
