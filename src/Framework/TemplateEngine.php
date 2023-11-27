<?

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    public function __construct(private string $basePath)
    {
    }


    /**
     * render the template and send to broswer
     * 
     * @param string $template: Template to be rendered
     * @param array $data: data to be put into the template
     * 
     * @return string: Template that has been rendered with data
     */
    public function render(string $template, array $data = [])
    {
        /**
         * extracts all data from the array and puts it into they own params.
         * The is an associative array
         * data['title' => 'Hello world', 'content' => 'bye world'] be comes
         * 
         * $title
         * $content
         * 
         * in the view
         */
        extract($data, EXTR_SKIP);

        //start output buffering so the page to build and then sent
        ob_start();
        include $this->resolve($template);

        $output = ob_get_clean(); //get output buffer contents
        ob_end_clean(); //clean and end output buffering

        return $output;
    }

    /**
     * Builds path to the needed files to be rendered
     * 
     * @param string $path: Path to be rendered
     * 
     * @return string: full path
     */
    public function resolve(string $path)
    {
        return "{$this->basePath}/{$path}";
    }
}