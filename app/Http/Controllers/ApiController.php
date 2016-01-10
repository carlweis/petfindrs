<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as IlluminateResponse;

class ApiController extends Controller
{
    /**
     * HTTP status code
     *
     * @var int
     */
    protected $statusCode = IlluminateResponse::HTTP_OK;

    /**
     * Returns HTTP status code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets the HTTP status code
     *
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * Respond with error, resource not found.
     *
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)
                    ->respondWithError($message);
    }

    /**
     * Respond with internal server error.
     *
     * @param string $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Server Error')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)
                    ->respondWithError($message);
    }

    /**
     * Return response, resource created successfully.
     *
     * @param $message
     * @return mixed
     */
    public function respondCreated($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)
                    ->respond(['message' => $message]);
    }

    /**
     * Return response OK.
     *
     * @param $message
     * @return mixed
     */
    public function respondOk($message)
    {
        return $this->respond([
            'message' => $message
        ]);
    }

    /**
     * Return response with validation error.
     *
     * @param string $message
     * @return mixed
     */
    public function respondWithValidationError($message = 'Unprocessable Entity')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)
                    ->respondWithError(['message' => $message]);
    }

    /**
     * Return HTTP Response
     *
     * @param $data
     * @param array $headers
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }

    /**
     * Return response with error.
     *
     * @param $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * Return response with CORS headers.
     *
     * @param $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function respondWithCORS($data)
    {
        return $this->respond($data, $this->setCORSHeaders());
    }

    /**
     * Set CORS HTTP headers
     *
     * @return mixed
     */
    public function setCORSHeaders()
    {
        $header['Access-Control-Allow-Origin'] = '*';
        $header['Allow'] = 'GET, POST, OPTIONS';
        $header['Access-Control-Allow-Headers'] = 'Origin, Content-Type, Accept, Authorization, X-Request-With';
        $header['Access-Control-Allow-Credentials'] = 'true';

        return $header;
    }
}