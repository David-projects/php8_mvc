<?

/**
 * load and configurer  the files needed to run the application
 */

declare(strict_types=1);

/**
 * Autoloader setup, update this file up updating composer.json
 * then run composer dump-autoload. this will create a new 
 * vendor/composer/autoload_psr4.php file
 * 
 * PSR are the standards used by this project please read for the standards
 * https://www.php-fig.org/
 * 
 */
require __DIR__ . "/../../vendor/autoload.php";

//These are so we can use {Controller}::class and we to not make misstakes when calling $app->get
use Framework\App;
use App\Controllers\IndexController;
use App\Controllers\AboutController;

$app = new App();

$app->get("/", [IndexController::class, "index"]);
$app->get("/about", [AboutController::class, "index"]);

return $app;