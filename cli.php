<?

include __DIR__ . "/src/Framework/database.php";

use Framework\Database;

$db = new Database("mysql", [
    "host"  => "localhost",
    "port" => 3306,
    "dbname" => "php8-learning",
], "", "");

$connection = $db->getConnection();

try {
    //SQL Injection fix
    #$search = "Hats' OR 1=1 -- ";

    #$query = "SELECT * FROM products";

    $db->query("INSERT INTO products VALUES(null,'Glovers')");

    $query = "SELECT * FROM products WHERE name=:name";

    $result = $db->select($query, ['name' => 'Glovers']);

    print_r($result);
} catch (Exception $e) {
    if ($connection->inTransaction()) {
        $connection->rollBack();
    }
    echo "transaction failed";
    echo $e->getMessage();
}

$search = 'Hats';
