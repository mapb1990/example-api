<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiController;
use App\Models\Clinic;
use App\Transformers\ClinicTransformer;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Class ClinicController
 *
 * @package App\Http\Controllers\Api\v1
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class ClinicController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-clinics');

        return $this->respondCollection(Clinic::paginate($this->resultsPerPage), new ClinicTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create-clinics');

        $validator = \Validator::make($request->all(), (new Clinic())->getRules());
        if ($validator->fails()) {
            return $this->setStatusCode(200)->respondWithError('Validation fails', [
                'error' => [
                    'fields' => $validator->errors()
                ]
            ]);
        }

        $clinic = Clinic::create($request->all());
        return $this->setStatusCode(201)->respondItem($clinic, new ClinicTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view-clinics');

        $clinic = Clinic::find($id);
        if (!$clinic) {
            return $this->respondNotFound('Clinic does not exists');
        }

        return $this->respondItem($clinic, new ClinicTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('edit-clinics');

        /**
         * @var $clinic Clinic
         */
        $clinic = Clinic::find($id);
        if (!$clinic) {
            return $this->respondNotFound('Clinic does not exists');
        }

        $validator = \Validator::make($request->all(), $clinic->getRules());
        if ($validator->fails()) {
            return $this->setStatusCode(200)->respondWithError('Validation fails', [
                'error' => [
                    'fields' => $validator->errors()
                ]
            ]);
        }

        $clinic->fill($request->all());
        $clinic->save();
        return $this->respondItem($clinic, new ClinicTransformer());
    }
}
