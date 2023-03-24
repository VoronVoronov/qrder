<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Logs;
use Illuminate\Http\Request;

class Loggers
{
    private $startTime;    //Сохраним в дальнейшем в этой переменной время начала запроса, для просчета общей длительности запроса
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed  //Функция в которую приходи наш запрос
    {
        $this->startTime = microtime(true);
        return $next($request);
    }

    public function terminate($request): void
    {
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
        if($request->fullUrl() != $protocol.$_SERVER['HTTP_HOST'] . '/api/v1/users/profile') {
            $endTime = microtime(true);
            $log = new Logs();
            $log->time = gmdate('Y-m-d H:i:s');
            $log->duration = number_format($endTime - LARAVEL_START, 3);
            $log->ip = $request->ip();
            $log->url = $request->fullUrl();
            $log->headers = json_encode($request->headers->all());
            $log->method = $request->method();
            $log->input = json_encode($request->all());
            $log->response = json_encode($request->response()->getData());
            $log->save();
        }
    }
}
