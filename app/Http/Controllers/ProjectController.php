<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\Projects\Services\ProjectService;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $projectService) {}

    public function index()
    {
        return response()->json($this->projectService->all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = $this->projectService->create($validated);

        return response()->json($project, 201);
    }
}
