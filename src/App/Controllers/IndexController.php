<?

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class IndexController
{
    private TemplateEngine $view;

    public function __construct()
    {
        $this->view = new TemplateEngine(Paths::VIEW);
    }

    public function index()
    {
        echo $this->view->render("/index.php", [
            "title" => "Hello data again"
        ]);
    }
}