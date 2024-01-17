<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $results = Project::with('type', 'technologies')->get();

        return response()->json([
            'projects' => $results,
            'success' => true
        ]);
    }


    public function show(Project $project)
    {
        // Aggiungere qua type.projects, serve per recuperare anche tutti i progetti che hanno quel type
        $project->load('type', 'technologies', 'type.projects', 'type.projects.technologies');

        return response()->json([
            'project' => $project,
            'success' => true
        ]);
    }
}
