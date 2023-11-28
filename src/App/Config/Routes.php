<?

/**
 * This class is for adding new routes to the framework
 */

declare(strict_types=1);

namespace App\Config;

use Framework\App;
//we need to import the controller so we can short cut the app->get call
use App\Controllers\{IndexController, AboutController};

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
        $app->get("/", [IndexController::class, "index"]);
        $app->get("/about", [AboutController::class, "index"]);
    }
}
