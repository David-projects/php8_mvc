<?

declare(strict_types=1);

namespace Framework;

class Container
{
    private array $difinition = [];

    public function addDefinition(array $newDefitition)
    {
        //Merges two arrays but this was is faster then the array_merge function
        $this->difinition = [...$this->difinition, ...$newDefitition];
        dd($newDefitition);
    }
}
