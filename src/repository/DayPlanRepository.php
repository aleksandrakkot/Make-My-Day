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
}