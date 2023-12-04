<?

declare(strict_types=1);

namespace Framework;

class App
{

    private Router $router;
    private Container $container;

    public function __construct(string $containDefinitionPath = null)
    {
        //create route object to be used for routing
        $this->router = new Router();
        //Create container to create containers with dependencies injection
        $this->container = new Container();

        if ($containDefinitionPath) {
            $containDefinitions = include $containDefinitionPath;
            $this->container->addDefinition($containDefinitions);
        }
    }

    public function run()
    {
        // gets the URL path to be routed too
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        $this->router->dispatch($path, $method, $this->container);
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

    public function addMiddleware(string $middleware)
    {
        $this->router->addMiddleware($middleware);
    }
}