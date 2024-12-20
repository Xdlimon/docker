<?php
namespace App\Controllers;

use App\Models\SessionModel;
require_once __DIR__ . '/../Models/SessionModel.php';

class SessionController
{
    private $sessionModel;

    public function __construct($config)
    {
        $this->sessionModel = new SessionModel($config);
    }

    public function saveSettings()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $this->sessionModel->set('user_settings', $data);

        echo json_encode(['message' => 'Settings saved in session!']);
    }

    public function displaySettings()
    {
        $settings = $this->sessionModel->get('user_settings') ?? [
            'login' => 'Guest',
            'theme' => 'light',
            'language' => 'en',
        ];

        include __DIR__ . '/../views/session_view.php';
    }
}
