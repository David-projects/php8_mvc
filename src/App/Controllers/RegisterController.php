<?

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\ValidatorService;

class RegisterController
{

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService
    ) {
    }

    public function index()
    {
        echo $this->view->render("/register.php");
    }

    public function register()
    {
        $this->validatorService->validateRegister($_POST);
    }
}