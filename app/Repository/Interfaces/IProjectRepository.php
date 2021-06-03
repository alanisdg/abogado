<?php

namespace App\Repository\Interfaces;

interface IProjectRepository
{
    public function getAllProjects();

    public function getProjectById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteProject($id);
}
