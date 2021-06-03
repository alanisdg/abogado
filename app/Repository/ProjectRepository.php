<?php

namespace App\Repository;

use App\Models\Project;
use App\Repository\Interfaces\IProjectRepository;
use File;

class ProjectRepository implements IProjectRepository
{
    protected $project = null;

    public function getAllProjects()
    {
        return Project::all();
    }

    public function getProjectById($id)
    {
        return Project::find($id);
    }

    public function createOrUpdate($id = null, $collection = [])
    {
        if (is_null($id)) {
            $project = new Project;
            $project->title = $collection['title'];
            $project->description = $collection['description'];
            $project->client = $collection['client'];
            $project->industry = $collection['industry'];
            $project->file_name = $collection['file_name'];
            $project->save();

            // Register skills
                $project->skills()->attach($collection['skills']);

            return $project;
        }

        $project = Project::find($id);
        $project->title = $collection['title'];
        $project->description = $collection['description'];
        $project->client = $collection['client'];
        $project->industry = $collection['industry'];
        $project->file_name = $collection['file_name'];
        return $project->save();
    }

    public function deleteProject($id)
    {
        $directory = '/backend/images/uploads/skills/';
        $project = Project::find($id);

        // Delete image
            $currentImage = public_path($directory.$project->file_name);
            File::delete($currentImage);

        // Delete skills
            $project->skills()->detach();

        return $project->delete();
    }
}
