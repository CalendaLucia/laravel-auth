<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;

use App\Mail\NewProjectCreated;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
{
    $projects = Project::all();
    return view('admin.projects.index', compact('projects'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'image' => 'required|image|max:2048'
    ]);

    // Salva l'immagine nella cartella "public/images" e ottiene il path
    $path = $validated['image']->store('public/images');

    // Crea il nuovo progetto
    $project = Project::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'image' => $path // Salva il path dell'immagine nel database
    ]);

    // Invia la mail di notifica
    app(MailController::class)->sendNewProjectCreated($project);
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|max:2048'
        ]);

        $project = Project::findOrFail($id);

        if (isset($validated['image'])) {
            Storage::delete($project->image);
            $image = $validated['image']->store('public/images');
        } else {
            $image = $project->image;
        }

        $project->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $image
        ]);

        return redirect()->route('projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
{
    $project->delete();

    return redirect()->route('projects.index')
        ->with('success', 'Project deleted successfully.');
}
}
