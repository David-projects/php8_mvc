<?

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;


class FlashMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $view)
    {
    }
    public function process(callable $next)
    {
        //adding data for the templates to display the from feilds and errors
        $this->view->addGlobal('errors', $this->view->escape($_SESSION['errors'] ?? []));
        $this->view->addGlobal('oldFormData', $this->view->escape($_SESSION['oldFormData'] ?? []));

        unset($_SESSION['errors']);
        unset($_SESSION['oldFormData']);
        $next();
    }
}