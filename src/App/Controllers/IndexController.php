<?

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;
use App\Services\TransactionService;

class IndexController
{

    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService
    ) {
    }

    public function index()
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 3;
        $offset = ($page - 1) * $length;
        $searchTerm = $_GET['s'] ?? NULL;

        [$transactions, $count] = $this->transactionService->getuserTransactions(
            $length,
            $offset
        );

        $lastPage = ceil($count / $length);

        $pages = $lastPage ? range(1, $lastPage) : [];
        $pagelinks = array_map(fn ($pageNum) => http_build_query([
            'p' => $pageNum,
            's' => $searchTerm
        ]), $pages);

        echo $this->view->render("/index.php", [
            'transactions' => $transactions,
            'currentPage' => $page,
            'lastPage' => $lastPage,
            'pagelinks' => $pagelinks,
            'searchTerm' => $searchTerm,
            'previouPageQuery' => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm
            ]),
            'nextPageQuery' => http_build_query([
                'p' => $page + 1,
                's' => $searchTerm
            ])
        ]);
    }
}