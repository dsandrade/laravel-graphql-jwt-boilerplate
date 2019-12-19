<?php

namespace App\Http\GraphQL\Traits;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Exceptions\AuthExpiredException;
use GraphQL\Type\Definition\ResolveInfo;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

trait AuthorizationTrait
{
    /**
     * @var bool|null
     */
    protected $auth;

    /**
     * @param mixed $root
     * @param array $args
     * @param mixed $ctx
     * @param ResolveInfo|null $resolveInfo
     * @param Closure|null $getSelectFields
     * @return bool
     * @throws AuthExpiredException
     */
    public function authorize(
        $root,
        array $args,
        $ctx,
        ResolveInfo $resolveInfo = null,
        Closure $getSelectFields = null
    ): bool {
        try {
            $this->auth = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $exception) {
            throw new AuthExpiredException($exception->getMessage());
        } catch (Exception $exception) {
            $this->auth = null;
        }

        return (boolean) $this->auth;
    }
}
