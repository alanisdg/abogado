<?php

namespace App\Repository;

use App\Models\Skill;
use App\Repository\Interfaces\ISkillRepository;

class SkillRepository implements ISkillRepository
{
    protected $skill = null;

    public function getAllSkills()
    {
        return Skill::all();
    }

    public function getSkillById($id)
    {
        return Skill::find($id);
    }

    public function createOrUpdate($id = null, $collection = [])
    {
        if (is_null($id)) {
            $skill = new Skill;
            $skill->name = $collection['name'];
            $skill->file_name = $collection['file_name'];
            return $skill->save();
        }

        $skill = Skill::find($id);
        $skill->name = $collection['name'];
        $skill->file_name = $collection['file_name'];
        return $skill->save();
    }

    public function deleteSkill($id)
    {
        return Skill::find($id)->delete();
    }
}
