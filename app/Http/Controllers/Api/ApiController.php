<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Transformers\ClinicTransformer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers\Api\v1
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
abstract class ApiController extends Controller
{
    /**
     * @var \League\Fractal\Manager
     */
    protected $fractal;

    /**
     * @var int
     */
    protected $statusCode = 200;
    /**
     * @var int
     */
    protected $resultsPerPage = 20;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->fractal = new Manager();
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param mixed $data
     * @param callable|string $transformer
     * @param string $resourceKey
     * @return \League\Fractal\Resource\Item
     */
    protected function item($data = null, $transformer = null, $resourceKey = null)
    {
        return new Item($data, $transformer, $resourceKey);
    }

    /**
     * @param mixed $data
     * @param callable|string $transformer
     * @param string $resourceKey
     * @return \League\Fractal\Resource\Collection
     */
    protected function collection($data = null, $transformer = null, $resourceKey = null)
    {
        $paginator = null;
        if ($data instanceof LengthAwarePaginator) {
            $paginator = $data;
            $data = $paginator->getCollection();
        }

        $resource = new Collection($data, $transformer, $resourceKey);

        if ($paginator) {
            $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        }

        return $resource;
    }

    /**
     * @param $data
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respond($data, $headers = [])
    {
        return \Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithError($message, $data = [])
    {
        $data = array_merge_recursive([
            'error' => [
                'message' => $message,
                'code' => $this->getStatusCode()
            ]
        ], $data);
        return $this->respond($data);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param mixed $data
     * @param callable|string $transformer
     * @param string $resourceKey
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCollection($data = null, $transformer = null, $resourceKey = null)
    {
        return $this->respond($this->fractal->createData(
            $this->collection($data, $transformer, $resourceKey)
        )->toArray());
    }

    /**
     * @param mixed $data
     * @param callable|string $transformer
     * @param string $resourceKey
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondItem($data = null, $transformer = null, $resourceKey = null)
    {
        return $this->respond($this->fractal->createData(
            $this->item($data, $transformer, $resourceKey)
        )->toArray());
    }
}
