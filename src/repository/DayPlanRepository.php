<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/DayPlan.php';

class DayPlanRepository extends Repository
{
    public function getTopCountry(int $country_id){
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

    public function getTopWorld(){
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

    public function getTop($stmt){
        $stmt->execute();

        $plans = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        $i = 0;

        foreach ($plans as $plan){
            $result[$i] = new DayPlan($plan['city_name']);
            $result[$i]->setDayPlanId($plan['day_plan_id']);
            $result[$i]->setCountry($plan['country_name']);
            $result[$i]->setDayPlanName($plan['day_plan_name']);
            $result[$i]->setLikes($plan['likes']);
            $result[$i]->setCreatedBy($plan['nick']);
            $result[$i]->setImage($plan['image']);
            $i += 1;
        }

        return $result;
}


    public function getPlansByCity($search)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.day_plan d
                left join public.user u on u.user_id = d.created_by
                left join public.city c on c.city_id = d.city_id
            where c.city_name like :search
        ');
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPlanById($id){
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
        
        return $day_plan_obj;
    }

    public function getUserPlans(int $userid): array
    {
        $result = [];
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

        $i = 0;
        foreach ($plans as $plan) {
            $result[$i] = new DayPlan($plan['city_name']);
            $result[$i]->setDayPlanId($plan['day_plan_id']);
            $result[$i]->setCountry($plan['country_name']);
            $result[$i]->setDayPlanName($plan['day_plan_name']);
            $result[$i]->setLikes($plan['likes']);
            $result[$i]->setCreatedBy($plan['nick']);
            $result[$i]->setImage($plan['image']);
            $i += 1;
        }
        return $result;
    }

    public function getPublicPrivateUserPlans(int $userid, int $flag): array
    {
        $result = [];
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

        $i = 0;
        foreach ($plans as $plan) {
            $result[$i] = new DayPlan($plan['city_name']);
            $result[$i]->setDayPlanId($plan['day_plan_id']);
            $result[$i]->setCountry($plan['country_name']);
            $result[$i]->setDayPlanName($plan['day_plan_name']);
            $result[$i]->setLikes($plan['likes']);
            $result[$i]->setCreatedBy($plan['nick']);
            $result[$i]->setImage($plan['image']);
            $i += 1;
        }
        return $result;
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


}