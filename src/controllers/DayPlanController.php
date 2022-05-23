<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/DayPlan.php';
require_once __DIR__ . '/../repository/DayPlanRepository.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class DayPlanController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

}