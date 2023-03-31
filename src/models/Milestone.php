<?php

class Milestone
{
    private $milestone_id;
    private $day_plan_id;
    private $milestone_type_id;
    private $location_name;
    private $street_name;
    private $street_number;
    private $milestone_start_time;
    private $milestone_end_time;
    private $milestone_description;
    private $coordinates;
    private $image;

    public function __construct($location_name)
    {
        $this->location_name = $location_name;
    }

    public function getMilestoneId()
    {
        return $this->milestone_id;
    }

    public function setMilestoneId($milestone_id): void
    {
        $this->milestone_id = $milestone_id;
    }

    public function getDayPlanId()
    {
        return $this->day_plan_id;
    }

    public function setDayPlanId($day_plan_id): void
    {
        $this->day_plan_id = $day_plan_id;
    }

    public function getMilestoneTypeId()
    {
        return $this->milestone_type_id;
    }

    public function setMilestoneTypeId($milestone_type_id): void
    {
        $this->milestone_type_id = $milestone_type_id;
    }

    public function getLocationName()
    {
        return $this->location_name;
    }

    public function setLocationName($location_name): void
    {
        $this->location_name = $location_name;
    }

    public function getStreetName()
    {
        return $this->street_name;
    }

    public function setStreetName($street_name): void
    {
        $this->street_name = $street_name;
    }

    public function getStreetNumber()
    {
        return $this->street_number;
    }

    public function setStreetNumber($street_number): void
    {
        $this->street_number = $street_number;
    }

    public function getMilestoneStartTime()
    {
        return $this->milestone_start_time;
    }

    public function setMilestoneStartTime($milestone_start_time): void
    {
        $this->milestone_start_time = $milestone_start_time;
    }

    public function getMilestoneEndTime()
    {
        return $this->milestone_end_time;
    }

    public function setMilestoneEndTime($milestone_end_time): void
    {
        $this->milestone_end_time = $milestone_end_time;
    }

    public function getMilestoneDescription()
    {
        return $this->milestone_description;
    }

    public function setMilestoneDescription($milestone_description): void
    {
        $this->milestone_description = $milestone_description;
    }

    public function getCoordinates()
    {
        return $this->coordinates;
    }

    public function setCoordinates($coordinates): void
    {
        $this->coordinates = $coordinates;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }


}