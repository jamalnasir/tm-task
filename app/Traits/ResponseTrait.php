<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;

trait ResponseTrait
{

    /**
     * success response method.
     *
     * @param null $data
     * @param null $message
     * @return JsonResponse
     */
    public function successResponse($message = null, $data = null) : JsonResponse
    {
        $response = ['success' => true];

        if ($message !== null) {
            $response['message'] = $message;
        }

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response);
    }


    /**
     * return error response.
     *
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse(string $error, array $errorMessages = [], int $code = 404) : JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (! empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

}
