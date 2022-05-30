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
    private $user_array;

    public function __construct()
    {
        parent::__construct();
        $this->dayPlanRepository = new DayPlanRepository();
        $this->userRepository = new UserRepository();
        $this->countryReposotory = new CountryRepository();
        $this->user_array = json_decode($_COOKIE['logUser'], true);
    }

    public function rankings()
    {
        if ($this->user_array['email'] == null) {
            return $this->render('login');
        }

        $country_id = $this->countryReposotory->getCountryId($this->user_array['country_name']);

        $top_plans_country =$this->dayPlanRepository->getTopCountry($country_id);



        $this->render('rankings', ['top_plans_country'=>$top_plans_country]);

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

}