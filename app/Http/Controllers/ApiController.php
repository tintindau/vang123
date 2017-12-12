<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function response($result = [], $statusCode = 200, $message = 'OK', $headers = [])
    {
        $responseBody = array (
            'code'    => $statusCode,
            'message' => $message,
            'result'  => $result
        );

        return response()->json($responseBody, $statusCode, $headers);
    }

    public function responseWithPageCount($result, $statusCode = 200, $message = 'OK', $headers = [], $pageCount = 0)
    {
        $responseBody = array (
            'code'    => $statusCode,
            'message' => $message,
            'result'  => $result,
            'page_count' => $pageCount,
        );

        return response()->json($responseBody, $statusCode, $headers);
    }

    public function responseWithError($message, $statusCode, $headers = [])
    {
        return self::response([], $statusCode, $message, $headers);
    }

    public function responseWithErrorWithDetail($detail, $message, $statusCode, $headers = [])
    {
        $isDebug = env('API_DEBUG', false);
        if($isDebug){
            return self::response($detail, $statusCode, $message, $headers);
        }
        else{
            return self::response([], $statusCode, $message, $headers);
        }
    }

    public function responseDeleteFailed($message, $statusCode = 404, $headers = [])
    {
        return self::response([], $statusCode, $message, $headers);
    }

    public function responseInactiveUser($headers = [])
    {
        $message = __('login.inactive');
        return self::response([], 401, $message, $headers);
    }

    public function responseNotFound($message = 'Resource is not found', $headers = [])
    {
        return self::response([], 404, $message, $headers);
    }

    public function responseInvalidCredentials($headers = [])
    {
        $message = __('login.invalid-email-or-password');
        return self::response([], 401, $message, $headers);
    }

    public function responseCouldNotCreateToken($message = 'Could not create token.', $headers = [])
    {
        return self::response([], 500, $message, $headers);
    }

    public function responseTokenBlacklist($message = 'Token has been blacklisted.', $headers = [])
    {
        return self::response([], 429, $message, $headers);
    }

    public function responseForbidden($message = 'Forbidden.', $headers = [])
    {
        return self::response([], 403, $message, $headers);
    }

    public function responseUnauthorized($message = 'Unauthorized.', $headers = [])
    {
        return self::response([], 401, $message, $headers);
    }

    public function responseTokenExpired($message = 'Token is expired.', $headers = [])
    {
        return self::response([], 419, $message, $headers);
    }

    public function responseTokenInvalid($message = 'Invalid bearer token.', $headers = [])
    {
        return self::response([], 401, $message, $headers);
    }

    public function responseOauthTokenInvalid($message = 'Invalid oauth token.', $headers = [])
    {
        return self::response([], 401, $message, $headers);
    }

    public function responseTokenAbsent($message = 'Token is absent.', $headers = [])
    {
        return self::response([], 401, $message, $headers);
    }

    public function responseEmailNotFound($message = 'Email not found.', $headers = [])
    {
        return self::response([], 401, $message, $headers);
    }

    public function responseProviderInvalid($message = 'Provider is invalid.', $headers = [])
    {
        return self::response([], 401, $message, $headers);
    }

    public function responseTokenIsMissing($message = 'Token is missing.', $headers = [])
    {
        return self::response([], 428, $message, $headers);
    }

    public function responseValidateFailed($message = 'Validate failed.', $data = [], $headers = [])
    {
        return self::response($data, 422, $message, $headers);
    }

    public function responseNotBelongTo($message = 'Resource is not belongs to user', $data = [], $headers = [])
    {
        return self::response($data, 403, $message, $headers);
    }

    public function responseMissingParameter($message = 'Missing parameter', $data = [], $headers = [])
    {
        return self::response($data, 429, $message, $headers);
    }

    public function responseEmptyParameter($message = 'Empty parameter', $data = [], $headers = [])
    {
        return self::response($data, 429, $message, $headers);
    }

    public function responseInvalidUser($message = 'Invalid user.', $data = [], $headers = [])
    {
        return self::response($data, 423, $message, $headers);
    }

    public function responseResetPasswordFails($message = 'Reset password failed.', $data = [], $headers = [])
    {
        return self::response([], 424, $message, $headers);
    }

    public function responseFileTypeNotAllowed($message = 'File type is not allowed.', $data = [], $headers = [])
    {
        return self::response($data, 426, $message, $headers);
    }

    public function responseNotSupportedType($message = 'This type is not supported.', $data = [], $headers = [])
    {
        return self::response($data, 427, $message, $headers);
    }

    public function responseFileNotFound($message = 'File not found.', $data = [], $headers = [])
    {
        return self::response($data, 430, $message, $headers);
    }
}
