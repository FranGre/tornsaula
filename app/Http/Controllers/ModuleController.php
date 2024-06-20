<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::all();
        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string|max:255",
        ]);

        Module::create($validatedData);

        return redirect()->route('modules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return view('modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        return view('modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $rules = [];

        if ($request->has('name')) {
            $rules['name'] = 'required|string|max:255';
        }

        if ($request->has('description')) {
            $rules['description'] = 'required|string|max:255';
        }

        $validatedData = $request->validate($rules);

        $module->update($validatedData);
        return redirect()->route('modules.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('modules.index');
    }

    public function usersWithModule($module_id)
    {
        $module = Module::find($module_id);
        $users = $module->users()->get();
        $moduleName = $module->name;
        return view('modules.users', compact('users', 'moduleName'));
    }
}
