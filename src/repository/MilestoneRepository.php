<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Milestone.php';

class MilestoneRepository extends Repository
{
    public function getMilestones($id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.milestone WHERE day_plan_id = :planid ORDER BY milestone_start_time;
        ');

        $stmt->bindParam(':planid', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}