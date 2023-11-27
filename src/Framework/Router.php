<?

declare(strict_types=1);

namespace Framework;

class Router
{
    private array $routes = [];

    /**
     * adds a route to the router
     * 
     * @param string $method: Method to be added GET, POST, PUT, DELETE
     * @param string $path: Path to be added to the router
     * @param array $controller: controller to  be added to the router
     */
    public function add(string $method, string $path, array $controller)
    {
        $this->routes[] = [
            "path" => $this->normalizePath($path),
            "method" => strtoupper($method),
            "controller" => $controller
        ];
    }

    /**
     * normalize the path for the route removes the forward slashes to ensure there is only one at the start and end
     * @param string $path: Path to be normalized
     * 
     * @return string : returns a normalized path as a string
     */
    private function normalizePath(string $path): string
    {
        $regex = "#[/]{2,}#";
        $path = trim($path, "/");
        $path = "/{$path}/";
        return preg_replace($regex, "/", $path);
    }

    /**
     * dispatches the pages to be displayed
     * 
     * @param string $path: Path to route too
     * @param string $method: Method to be added GET, POST, PUT, DELETE
     */
    public function dispatch(string $path, string $method)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        /**
         * Looping thought all the routes to find the right one
         * 
         */
        //TODO Add support for 404 page not found
        foreach ($this->routes as $route) {
            if (
                !preg_match("#^{$route['path']}$#", $path) ||
                $route['method'] !== $method
            ) {
                continue;
            }

            /**
             * Gets the class and function call in the request.
             * Then loads the controller and calls the function.
             */
            [$class, $function] = $route['controller'];

            $controllerInstance = new $class;
            $controllerInstance->{$function}();
        }
    }
}