<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\TelegramService;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {

         $exceptions->renderable(function (Throwable  $e,  $request) {
            // Ignore 404 errors
            if ($e instanceof NotFoundHttpException) {
                return;
            }

            $message = "🚨 *Error in TamDan* 🚨\n\n" .

                    "🧾 Message: " . $e->getMessage() . "\n" .
                    "📍 File: " . $e->getFile() . " (Line " . $e->getLine() . ")\n\n" .

                    "🌐 URL: " . $request->fullUrl() . "\n" .
                    "📌 Method: " . $request->method() . "\n" .
                    "🌍 IP: " . $request->ip() . "\n" .
                    "🖥️ User Agent: " . $request->userAgent() . "\n\n" .

                    "👤 User ID: " . optional($request->user())->name . "\n\n" .

                    "⚙️ Environment: " . app()->environment() . "\n" .
                    "⏰ Time: " . now()->format('Y-m-d H:i:s') . "\n\n" .

                    "📦 Exception: " . get_class($e);

            $telegramChatId = config('services.telegram.chat_id');
            TelegramService::sendMessage($message, $telegramChatId);
           
        });
    })->create();
