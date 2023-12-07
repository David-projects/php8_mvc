<?

declare(strict_types=1);

namespace Framework;

use PDO, PDOException, Exception;

class Database
{
    private $connection;
    public function __construct(string $driver, array $config, string $username, string $password)
    {
        $config = http_build_query(data: $config, arg_separator: ';');

        $dns = "{$driver}:{$config}";

        try {
            $this->connection = new PDO($dns, $username, $password);
        } catch (PDOException $e) {
            die("Unable to connect to the DB");
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function query(string $query)
    {
        $this->connection->query($query);
    }

    public function select(string $query, array $data = [])
    {
        try {
            $this->connection->beginTransaction();
            $stmt = $this->connection->prepare($query);

            foreach ($data as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            $stmt->execute();

            $this->connection->commit();

            return  $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            if ($this->connection->inTransaction()) {
                $this->connection->rollBack();
            }
            echo "transaction failed";
            print($e->getMessage());
        }

        return [];
    }
}
