<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Milestone.php';
require_once __DIR__ . '/../repository/MilestoneRepository.php';

class MilestoneController extends AppController
{

    private $milestoneRepository;

    public function __construct()
    {
        parent::__construct();
        $this->milestoneRepository = new MilestoneRepository();
    }
    
    public function milestone(){
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);
            echo json_encode($this->milestoneRepository->getMilestones($decoded['id']));
        }
    }
}