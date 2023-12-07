<?

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use App\Exception\SessionException;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException("Session already active.");
        }

        /**
         * $filename and line will get automatic created due to the heasders send global function.
         */
        if (headers_sent($filename, $line)) {
            throw new SessionException("Headers already sent. Consider enbling output buffering. Data outputted from {$filename} - Line {$line}.");
        }

        session_start();
        $next();

        session_write_close();
    }
}