<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $results = Project::with('type', 'technologies', 'type.projects')->get();

        return response()->json([
            'projects' => $results,
            'success' => true
        ]);
    }


    public function show(Project $project)
    {
        $project->load('type', 'technologies');

        return response()->json([
            'project' => $project,
            'success' => true
        ]);
    }
}
