<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/DayPlan.php';
require_once __DIR__ . '/../repository/DayPlanRepository.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/CountryRepository.php';

class DayPlanController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private DayPlanRepository $dayPlanRepository;
    private UserRepository $userRepository;
    private CountryRepository $countryRepository;
    private MilestoneRepository $milestoneRepository;
    private $user_array;


    public function __construct()
    {
        parent::__construct();
        $this->dayPlanRepository = new DayPlanRepository();
        $this->userRepository = new UserRepository();
        $this->countryRepository = new CountryRepository();
        $this->milestoneRepository = new MilestoneRepository();
        $this->user_array = json_decode($_COOKIE['logUser'], true);
    }

    public function rankings()
    {

        session_start();

        if (!isset($_SESSION['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        }

        $country_id = $this->countryRepository->getCountryId($this->user_array['country_name']);

        $top_plans_country =$this->dayPlanRepository->getTopCountry($country_id);

        $top_plans_world = $this->dayPlanRepository->getTopWorld();



        $this->render('rankings', ['top_plans_country'=>$top_plans_country, 'top_plans_world'=>$top_plans_world]);

    }

    public function searchPlans()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->dayPlanRepository->getPlansByCity($decoded['search']));
        }
    }

    public function dayplan($id){

        session_start();

        if(!isset($_SESSION['user'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        }
        $userid = $this->userRepository->getUserId($_SESSION['user']);
        $plan = $this->dayPlanRepository->getPlanById($id);
        
        //$isFav = $this->dayPlanRepository->isFavourite($id, $userid);

        switch ($plan->getStateFlag()){
            case 0:
                if($userid == $plan->getCreatedById()) {
                    $this->render('dayplan', ['plan' => $plan]);
                }
                break;
            case 1:
                $this->render('dayplan', ['plan' => $plan]);
                break;
            case 2:
                if($this->userRepository->isAdmin($userid) || $userid == $plan->getCreatedById()){
                    $this->render('dayplan', ['plan' => $plan]);
                }
                break;
            default :
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/rankings");
        }
    }

    public function yourplans()
    {
        $user_id = $this->userRepository->getUserId($this->user_array['email']);
        $all_plans = $this->dayPlanRepository->getUserPlans($user_id);
        $private_plans = $this->dayPlanRepository->getPublicPrivateUserPlans($user_id,0);
        $public_plans = $this->dayPlanRepository->getPublicPrivateUserPlans($user_id, 1);

        $this->render('yourplans', ['all_plans'=>$all_plans, 'private_plans'=>$private_plans, 'public_plans'=>$public_plans]);
    }

    public function createplan(){
        $countries= $this->countryRepository->getCountries();
        $cities= $this->countryRepository->getCities();

        $this->render('createplan', ['countries' => $countries, 'cities' => $cities]);
    }

    public function addplan($steps) {
        if ($this->isPost()) {
            $files_array = [];
                if (isset($_FILES['file'])) {
                    $file_name = $_FILES['file']['name'];
                    array_push($files_array, $file_name);
                    $file_tmp =$_FILES['file']['tmp_name'];
                    move_uploaded_file( $file_tmp,  dirname(__DIR__).self::UPLOAD_DIRECTORY.$file_name);
                }

            $post_city = $_POST['city'];
            $post_country = $_POST['country'];

            $post_image = $files_array[0];
            $post_day_plan_name = $_POST['day_plan_name'];
            $post_day_plan_description = $_POST['description'];

            $user_id = $this->userRepository->getUserId($this->user_array['email']);

            $day_plan = new DayPlan($post_city);
            $day_plan->setImage($post_image);
            $day_plan->setCreatedBy($user_id);
            $day_plan->setCountry($post_country);
            $day_plan->setDayPlanName($post_day_plan_name);
            $day_plan->setDescription($post_day_plan_description);

            $post_milestone_location_name[0] = $_POST['milestone_location_name'];
            //$post_milestone_image[0] = $files_array[1];
            $post_milestone_street_name[0] = $_POST['milestone_street_name'];
            $post_milestone_street_number[0] = $_POST['milestone_street_number'];
            $post_milestone_description[0] = $_POST['milestone_description'];
            $post_milestone_start_time[0] = $_POST['milestone_start_time'];
            $post_milestone_end_time[0] = $_POST['milestone_end_time'];

            $plan_id = $this->dayPlanRepository->addNewPlan($day_plan);

            $mil1 = new Milestone($post_milestone_location_name[0]);
            $mil1->setStreetName($post_milestone_street_name[0]);
            //$mil1->setImage($post_milestone_image[0]);
            $mil1->setStreetNumber($post_milestone_street_number[0]);
            $mil1->setMilestoneDescription($post_milestone_description[0]);
            $mil1->setMilestoneStartTime($post_milestone_start_time[0]);
            $mil1->setMilestoneEndTime($post_milestone_end_time[0]);
            $mil1->setDayPlanId($plan_id);

            $map = false;

            $city_name_mil = $this->countryRepository->getCityName($post_city);

            $map = $this->milestoneRepository->addMilestone($mil1, $city_name_mil);

            if($map == true) $this->dayPlanRepository->setMap($plan_id);

            if ($steps > 1) {
                for ($i = 1; $i < $steps; $i++) {
                    $wart = $i + 1;
                    $post_milestone_location_name[$i] = $_POST['milestone_location_name'];
                    //$post_milestone_image[$i] = $files_array[$wart];
                    $post_milestone_street_name[$i] = $_POST['milestone_street_name'.$wart];
                    $post_milestone_street_number[$i] = $_POST['milestone_street_number'.$wart];
                    $post_milestone_description[$i] = $_POST['milestone_description'.$wart];
                    $post_milestone_start_time[$i] = $_POST['milestone_start_time'.$wart];
                    $post_milestone_end_time[$i] = $_POST['milestone_end_time'.$wart];

                    $mil = new Milestone($post_milestone_location_name[$i]);
                    $mil->setStreetName($post_milestone_street_name[$i]);
                    //$mil->setImage($post_milestone_image[$i]);
                    $mil->setStreetNumber($post_milestone_street_number[$i]);
                    $mil->setMilestoneDescription($post_milestone_description[$i]);
                    $mil->setMilestoneStartTime($post_milestone_start_time[$i]);
                    $mil->setMilestoneEndTime($post_milestone_end_time[$i]);
                    $mil->setDayPlanId($plan_id);

                    $this->milestoneRepository->addMilestone($mil, $city_name_mil);
                    if($map == true) $this->dayPlanRepository->setMap($plan_id);
                }
            }
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/createplan");
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/yourplans");
    }

    public function places()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->milestoneRepository->getMilestones($decoded['id']));
        }
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is too large';
            return false;
        }
        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported';
            return false;
        }
        return true;
    }

    private function getPlansId(array $plans): array
    {
        $result = [];
        $i = 0;
        foreach ($plans as $p) {
            $id = $p->getId();
            $result[$i] = [$id, $this->milestoneRepository->countMilestones($id)];
        }
        return $result;
    }



}