<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleCollection;
use App\Http\Resources\ModuleResource;
use App\Models\Module;
use Deployer\Component\PharUpdate\Update;
use Illuminate\Http\Request;

/**
 * @OA\Post(
 *     path="/api/modules",
 *     summary="Create Module",
 *     description="Create a module",
 *     security={{"apiAuth": {}}},
 *     operationId="moduleStore",
 *     tags={"modules"},
 *     @OA\RequestBody(
 *         required=true,
 *         description="Module store",
 *         @OA\JsonContent(ref="#/components/schemas/Module")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Error: Unauthorized",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Unauthenticated")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Module created successfully!"
 *     )
 * )
 * 
 * @OA\Put(
 *      path="/api/modules",
 *      summary="Edit Module",
 *      description="Edit a module",
 *      security={{"apiAuth": {}}},
 *      operationId="moduleUpdate",
 *      tags={"modules"},
 *      @OA\RequestBody(
 *         required=true,
 *         description="Module update",
 *         @OA\JsonContent(ref="#/components/schemas/Module")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Module edited successfully!"
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Error: Unauthorized",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Unathentucated")
 *          )
 *      )
 * )
 * 
 * @OA\Delete(
 *     path="/api/modules",
 *     summary="Delete Module",
 *     description="Delete a module",
 *     security={{"apiAuth": {}}},
 *     operationId="moduleDestroy",
 *     tags={"modules"},
 *     @OA\Response(
 *          response=401,
 *          description="Error: Unauthorized",
 *          @OA\JsonContent(
 *          @OA\Property(property="message", type="string", example="Unauthenticated")
 *              )
 *     ),
 *     @OA\Response(
 *         response=202,
 *         description="Module removed successfully!"
 *     )
 * )
 */

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ModuleCollection(Module::paginate(3));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255'
        ]);

        $module = Module::create($validatedData);

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        if ($request->method() === 'PUT') {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255'
            ]);

            $moduleUpdated = $module->update($validatedData);

            return new ModuleResource($moduleUpdated);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        //
    }
}
