<?

declare(strict_types=1);

namespace Framework;

class App {

    private Router $router;

    public function __construct()
    {
        #create route object to be used for routing
        $this->router = new Router();
    }

    public function run()
    {
        // gets the URL path to be routed too
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method);
    }

    /**
     * Adds a path to the routes object
     * 
     * @param string $path: Path to be added to the router
     * @param array $controller: controller to  be added to the router
     */
    public function get(string $path, array $controller)
    {
        $this->router->add("GET", $path, $controller);
    }
}