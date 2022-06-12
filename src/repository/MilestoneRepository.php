<?php

require_once 'Repository.php';
require_once 'config.php';
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

    public function addMilestone(Milestone $mil, $city_name)
    {

        $coordinates = $this->getCooridinates($mil->getStreetName(), $mil->getStreetNumber(), $city_name);
        $map = false;
        if($coordinates['lat']) {
            $map = true;
            $coordinates = "[".$coordinates['lng'].",".$coordinates['lat']."]";
        } else{
            $coordinates = null;
        }
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.milestone (day_plan_id, milestone_type_id, location_name, street_name, street_number, milestone_start_time,milestone_end_time, milestone_description, image, coordinates)
            VALUES (?, 0, ?, ?, ?, ?, ?, ?, ?,?)
        ');

        $stmt->execute([
            $mil->getDayPlanId(),
            $mil->getLocationName(),
            $mil->getStreetName(),
            $mil->getStreetNumber(),
            $mil->getMilestoneStartTime(),
            $mil->getMilestoneEndTime(),
            $mil->getMilestoneDescription(),
            $mil->getImage(),
            $coordinates
        ]);

        return $map;
    }
    
    private function getCooridinates($street,  $num, $city){

        $street_tmp = iconv('utf-8', 'ISO-8859-1//TRANSLIT//IGNORE', $street);

        if($street_tmp != false) $street = $street_tmp;

        $url = "https://api.opencagedata.com/geocode/v1/json?q=".$street."%20".$num."%2C%20".$city."&key=".MAP_API."&language=en&pretty=1&no_annotations=1";

        $geocode = file_get_contents($url);

        $json = json_decode($geocode);

        if(!$json->results[0]->components->road) return false;

        $data['lat'] = $json->results[0]->geometry->lat;
        $data['lng'] = $json->results[0]->geometry->lng;
        return $data;
}

    public function getPlacesByPlanId($planid)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.milestone
            WHERE plan_id = :planid
        ');
        $stmt->bindParam(':planid', $planid, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
