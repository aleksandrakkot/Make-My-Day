<?php

class DayPlan
{
    private $day_plan_id;
    private $city;
    private $country;
    private $day_plan_name;
    private $likes;
    private $image;
    private $map;
    private $description;
    private $created_by;
    private $created_by_id;
    private $state_flag;
    private $start_time;
    private $is_fav;

    public function getStartTime()
    {
        return $this->start_time;
    }

    public function setStartTime($start_time): void
    {
        $this->start_time = $start_time;
    }

    public function getEndTime()
    {
        return $this->end_time;
    }

    public function setEndTime($end_time): void
    {
        $this->end_time = $end_time;
    }
    private $end_time;

    public function __construct($city, $likes = 0, $day_plan_id = null)
    {
        $this->city = $city;
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

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city): void
    {
        $this->city = $city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country): void
    {
        $this->country = $country;
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

    public function getCreatedById()
    {
        return $this->created_by_id;
    }

    public function setCreatedById($created_by_id): void
    {
        $this->created_by_id = $created_by_id;
    }

    public function setIsFav($bool): void
    {
        $this->is_fav = $bool;
    }

    public function getIsFav()
    {
        return $this->is_fav;
    }

}