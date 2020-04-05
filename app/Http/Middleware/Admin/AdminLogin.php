<?php

namespace App\Http\Middleware\Admin;

use App\Admin\Auth\Authenticator;
use Closure;
use Illuminate\Http\Request;

class AdminLogin
{
    /**
     * @var Authenticator
     */
    private $authenticator;

    /**
     * AdminLogin constructor.
     * @param Authenticator $authenticator
     */
    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $client = $this->authenticator->getClient();

        $request->merge(['grant_type' => 'password']);

        if ($client !== null) {
            $request->merge([
                'client_id' => $client->id,
                'client_secret' => $client->secret
            ]);
        }

        return $next($request);
    }
}
