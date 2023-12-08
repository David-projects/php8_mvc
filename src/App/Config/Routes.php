<?

/**
 * This class is for adding new routes to the framework
 */

declare(strict_types=1);

namespace App\Config;

use Framework\App;
//we need to import the controller so we can short cut the app->get call
use App\Controllers\{
    IndexController,
    AboutController,
    RegisterController,
    LoginController
};

use App\Middleware\{
    AuthRequiredMiddleware,
    GuestOnlyMiddleware
};

class Routes
{
    /**
     * Setup routes for the framework 
     * To app a new route you add it here
     * 
     * @param App $app: App class to load routes
     */
    //TODO try to make this auto load via some kind of config.
    static function registerRouters(App $app)
    {
        //These are so we can use {Controller}::class and we to not make misstakes when calling $app->get
        $app->get("/", [IndexController::class, "index"])->add(AuthRequiredMiddleware::class);
        $app->get("/about", [AboutController::class, "index"]);
        $app->get("/register", [RegisterController::class, "index"])->add(GuestOnlyMiddleware::class);
        $app->post("/register", [RegisterController::class, "register"])->add(GuestOnlyMiddleware::class);
        $app->get("/login", [LoginController::class, "index"])->add(GuestOnlyMiddleware::class);
        $app->post("/auth", [LoginController::class, "auth"])->add(GuestOnlyMiddleware::class);
        $app->get("/logout", [LoginController::class, "logout"])->add(AuthRequiredMiddleware::class);
    }
}
