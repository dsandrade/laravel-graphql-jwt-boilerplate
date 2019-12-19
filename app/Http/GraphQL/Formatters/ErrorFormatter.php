<?php

namespace App\Http\GraphQL\Formatters;

use GraphQL\Error\Error;
use Rebing\GraphQL\Error\ValidationError;
use Rebing\GraphQL\Error\AuthorizationError;

class ErrorFormatter
{
    /**
     * @param Error $exception
     * @return array
     */
    public static function formatError(Error $exception): array
    {
        $statusCode = (new ErrorFormatter)->getExceptionStatusCode($exception);

        $error = [
            'message' => $exception->getMessage(),
            'code'    => $statusCode
        ];
        $locations = $exception->getLocations();

        if (!empty($locations)) {
            $error['locations'] = array_map(function ($location) {
                return $location->toArray();
            }, $locations);
        }

        $previous = $exception->getPrevious();
        if ($previous && $previous instanceof ValidationError) {
            $error['validation'] = $previous->getValidatorMessages();
        }

        return $error;
    }

    /**
     * @param Error $exception
     * @return int|mixed
     */
    private function getExceptionStatusCode(Error $exception)
    {
        $parsedException = $exception->getPrevious();

        if ($parsedException === null) {
            $parsedException = $exception;
        }

        if ($parsedException instanceof ValidationError) {
            return 500;
        }

        if ($parsedException instanceof AuthorizationError) {
            return 401;
        }

        return ($parsedException->getCode() !== 0 && $parsedException->getCode() !== '0')
            ? $parsedException->getCode()
            : 500;
    }
}
