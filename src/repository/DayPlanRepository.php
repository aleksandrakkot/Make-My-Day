<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/DayPlan.php';

class DayPlanRepository extends Repository
{
    public function getTopCountry(int $country_id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.day_plan dp
            JOIN public.city c on dp.city_id = c.city_id
            JOIN public.country co on c.country_id = co.country_id
            JOIN public.user u on u.user_id = dp.created_by
            WHERE c.country_id = :countryid
            AND dp.state_flag = 1
            ORDER BY dp.likes desc limit 10;
        ');

        $stmt->bindParam(':countryid', $country_id, PDO::PARAM_INT);

        return $this->getTop($stmt);
    }

    public function getTopWorld()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.day_plan dp
            JOIN public.city c on dp.city_id = c.city_id
            JOIN public.country co on c.country_id = co.country_id
            JOIN public.user u on u.user_id = dp.created_by
            WHERE dp.state_flag = 1
            ORDER BY dp.likes desc limit 10;
        ');

        return $this->getTop($stmt);
    }

    public function getTop($stmt)
    {
        $stmt->execute();

        $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->createPlanModel($plans);
    }


    public function getPlansByCity($search)
    {

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.day_plan d
                left join public.user u on u.user_id = d.created_by
                left join public.city c on c.city_id = d.city_id
            where c.city_name like :search and d.state_flag = 1
        ');
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->execute();

        $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->createPlanModel($plans);
    }

    public function getPlanById($id)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.day_plan dp
            JOIN public.city c on dp.city_id = c.city_id
            JOIN public.country co on c.country_id = co.country_id
            JOIN public.user u on u.user_id = dp.created_by
            WHERE dp.day_plan_id = :planid;
        ');

        $stmt->bindParam(':planid', $id, PDO::PARAM_INT);
        $stmt->execute();

        $plan = $stmt->fetch(PDO::FETCH_ASSOC);

        $day_plan_obj = new DayPlan($plan['city_name']);
        $day_plan_obj->setCountry($plan['country_name']);
        $day_plan_obj->setDayPlanName($plan['day_plan_name']);
        $day_plan_obj->setLikes($plan['likes']);
        $day_plan_obj->setCreatedBy($plan['nick']);
        $day_plan_obj->setImage($plan['image']);
        $day_plan_obj->setStateFlag($plan['state_flag']);
        $day_plan_obj->setMap($plan['map']);
        $day_plan_obj->setCreatedById($plan['created_by']);
        $day_plan_obj->setDescription($plan['description']);

        $time = $this->getStartEndTime($id);
        $day_plan_obj->setStartTime($time['start']);
        $day_plan_obj->setEndTime($time['fin']);

        return $day_plan_obj;
    }

    public function getUserPlans(int $userid): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.day_plan dp
                JOIN public.city c on dp.city_id = c.city_id
                JOIN public.country co on c.country_id = co.country_id
                JOIN public.user u on u.user_id = dp.created_by
            where dp.created_by = :userid order by dp.likes desc
        ');
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();
        $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->createPlanModel($plans);
    }

    public function getPublicPrivateUserPlans(int $userid, int $flag): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.day_plan dp
                JOIN public.city c on dp.city_id = c.city_id
                JOIN public.country co on c.country_id = co.country_id
                JOIN public.user u on u.user_id = dp.created_by
            where dp.created_by = :userid and dp.state_flag = :flag order by dp.likes desc
        ');
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindParam(':flag', $flag, PDO::PARAM_INT);
        $stmt->execute();
        $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->createPlanModel($plans);
    }

    public function addNewPlan(DayPlan $day_plan)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.day_plan (city_id, day_plan_name, image, description, created_by, state_flag)
            VALUES (?, ?, ?, ?, ?, 0) returning day_plan_id
        ');

        $stmt->execute([
            $day_plan->getCity(),
            $day_plan->getDayPlanName(),
            $day_plan->getImage(),
            $day_plan->getDescription(),
            $day_plan->getCreatedBy()
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC)['day_plan_id'];
    }

    public function setMap($id)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE public.day_plan SET map = true WHERE day_plan_id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function getFavouritePlans(int $userid): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.day_plan dp
                JOIN public.city c on dp.city_id = c.city_id
                JOIN public.country co on c.country_id = co.country_id
                JOIN public.user u on u.user_id = dp.created_by
                JOIN public.user_day_plan_favourites dpf on dpf.day_plan_id = dp.day_plan_id
            where dpf.user_id = :userid order by dp.likes desc
        ');
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->execute();
        $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->createPlanModel($plans);
    }

    public function getPlanToCommit()
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.day_plan dp
            JOIN public.city c on dp.city_id = c.city_id
            JOIN public.country co on c.country_id = co.country_id
            JOIN public.user u on u.user_id = dp.created_by
            WHERE dp.state_flag = 2;
        ');

        $stmt->execute();
        $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->createPlanModel($plans);
    }

    public function handleDayPlan($id, $state_flag)
    {
        $stmt=0;
        if ($state_flag == -1) {
            $stmt = $this->database->connect()->prepare('
                    DELETE FROM public.day_plan 
                    WHERE day_plan_id = :id
                ');
        } else {
            $stmt = $this->database->connect()->prepare('
                    UPDATE public.day_plan SET state_flag = :state_flag WHERE day_plan_id = :id
                ');
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':state_flag', $state_flag, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function createPlanModel($plans){
        $result = [];
        $i = 0;

        foreach ($plans as $plan) {
            $result[$i] = new DayPlan($plan['city_name']);
            $result[$i]->setDayPlanId($plan['day_plan_id']);
            $result[$i]->setCountry($plan['country_name']);
            $result[$i]->setDayPlanName($plan['day_plan_name']);
            $result[$i]->setLikes($plan['likes']);
            $result[$i]->setCreatedBy($plan['nick']);
            $result[$i]->setImage($plan['image']);
            $time = $this->getStartEndTime($plan['day_plan_id']);
            $result[$i]->setStartTime($time['start']);
            $result[$i]->setEndTime($time['fin']);
            $i += 1;
        }

        return $result;
    }

    private function getStartEndTime($plan_id){
        $stmt = $this->database->connect()->prepare('
            SELECT min(milestone_start_time) start, max(milestone_end_time) fin FROM public.milestone
            WHERE day_plan_id = :planid
        ');

        $stmt->bindParam(':planid', $plan_id, PDO::PARAM_INT);
        $stmt->execute();


        $time = $stmt->fetch(PDO::FETCH_ASSOC);

        return $time;
    }
}