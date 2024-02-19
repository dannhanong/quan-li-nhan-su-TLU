<?php

// Trong file middleware LogoutMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class LogoutMiddleware
{
    public function handle($request, Closure $next)
    {
        // Thực hiện xử lý đăng xuất nếu cần

        // Thêm các header để ngăn chặn cache
        $response = $next($request);
        return $response->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT',
        ]);
    }
}
