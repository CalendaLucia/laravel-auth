<?php

namespace App\Http\Controllers\Admin;

use App\Mail\NewProjectCreated;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;



class MailController extends Controller
{
public function sendNewProjectCreated(Project $project)
{
    $user = $project->user;

    if ($user) {
        $sent = Mail::to($user)->send(new NewProjectCreated($project, $user));

        if ($sent) {
            return redirect()->route('projects.show', $project->id)->with('success', 'Email inviata con successo');
        } else {
            return redirect()->route('projects.show', $project->id)->with('error', 'Si è verificato un errore durante l\'invio della email');
        }
    }

    return redirect()->route('projects.show', $project->id);
}


}
