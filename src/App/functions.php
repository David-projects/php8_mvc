<?

function dd($value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    die();
}


function e(mixed $value): string
{
    return htmlspecialchars((string) $value);
}
