<?php

class DayPlan
{
    private $day_plan_id;
    private $city_id;
    private $day_plan_name;
    private $likes;
    private $image;
    private $map;
    private $description;
    private $created_by;
    private $state_flag;

    public function __construct($city_id, $likes = 0, $day_plan_id = null)
    {
        $this->city_id = $city_id;
        $this->likes = $likes;
        $this->day_plan_id = $day_plan_id;
    }

    public function getDayPlanId()
    {
        return $this->day_plan_id;
    }

    public function setDayPlanId($day_plan_id): void
    {
        $this->day_plan_id = $day_plan_id;
    }

    public function getCityId()
    {
        return $this->city_id;
    }

    public function setCityId($city_id): void
    {
        $this->city_id = $city_id;
    }

    public function getDayPlanName()
    {
        return $this->day_plan_name;
    }

    public function setDayPlanName( $day_plan_name): void
    {
        $this->day_plan_name = $day_plan_name;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getMap()
    {
        return $this->map;
    }

    public function setMap($map): void
    {
        $this->map = $map;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getCreatedBy()
    {
        return $this->created_by;
    }

    public function setCreatedBy($created_by): void
    {
        $this->created_by = $created_by;
    }

    public function getStateFlag()
    {
        return $this->state_flag;
    }

    public function setStateFlag($state_flag): void
    {
        $this->state_flag = $state_flag;
    }



}