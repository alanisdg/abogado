<?php

namespace App\Repository\Interfaces;

interface ISkillRepository
{
    public function getAllSkills();

    public function getSkillById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function deleteSkill($id);
}
