<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JabatanMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        $user = session('user');

        // If user is not logged in
        if (!$user) {
            $html = <<<HTML
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Tidak Boleh Masuk</title>
                    <meta http-equiv="refresh" content="2;url=/login">
                    <style>
                        body {
                            font-family: sans-serif;
                            background-color: #f8d7da;
                            color: #721c24;
                            padding: 40px;
                            text-align: center;
                        }
                        .alert {
                            background-color: #f5c6cb;
                            padding: 20px;
                            border-radius: 8px;
                            display: inline-block;
                            margin-top: 50px;
                        }
                    </style>
                </head>
                <body>
                    <div class="alert">
                        <h2>Tidak Boleh Masuk</h2>
                        <p>Anda Belum Login.</p>
                        <p>Mengalihkan ke Login dalam 2 detik...</p>
                    </div>

                    <script>
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 2000);
                    </script>
                </body>
                </html>
            HTML;

            return new Response($html, 403);
        }

        // Check if user's role is allowed
        $allowedRoles = array_map('strtolower', explode(',', $roles));
        $userRole = strtolower($user['jabatan'] ?? '');

        if (!in_array($userRole, $allowedRoles)) {
            $referer = $request->headers->get('referer') ?? '/';
            $html = <<<HTML
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Tidak Diizinkan</title>
                    <meta http-equiv="refresh" content="2;url={$referer}">
                    <style>
                        body {
                            font-family: sans-serif;
                            background-color: #f8d7da;
                            color: #721c24;
                            padding: 40px;
                            text-align: center;
                        }
                        .alert {
                            background-color: #f5c6cb;
                            padding: 20px;
                            border-radius: 8px;
                            display: inline-block;
                            margin-top: 50px;
                        }
                    </style>
                </head>
                <body>
                    <div class="alert">
                        <h2>Tidak Diizinkan</h2>
                        <p>Anda tidak memiliki akses ke halaman ini.</p>
                        <p>Mengalihkan kembali dalam 2 detik...</p>
                    </div>

                    <script>
                        setTimeout(() => {
                            window.history.back();
                        }, 2000);
                    </script>
                </body>
                </html>
            HTML;

            return new Response($html, 403);
        }

        return $next($request);
    }
}
