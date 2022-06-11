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

    public function addMilestone(Milestone $mil)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.milestone (day_plan_id, milestone_type_id, location_name, street_name, street_number, milestone_start_time,milestone_end_time, milestone_description, image)
            VALUES (?, 0, ?, ?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $mil->getDayPlanId(),
            $mil->getLocationName(),
            $mil->getStreetName(),
            $mil->getStreetNumber(),
            $mil->getMilestoneStartTime(),
            $mil->getMilestoneEndTime(),
            $mil->getMilestoneDescription(),
            $mil->getImage()
        ]);
    }
}
