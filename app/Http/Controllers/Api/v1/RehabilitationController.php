<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiController;
use App\Models\Patient;
use App\Models\Rehabilitation;
use App\Transformers\PatientTransformer;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Class RehabilitationController
 *
 * @package App\Http\Controllers\Api\v1
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class RehabilitationController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $clinicId
     * @param int $patientId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $clinicId, $patientId)
    {
        $this->authorize('define-rehabilitations');

        /**
         * @var $patient Patient
         */
        $patient = Patient::where('id', $patientId)->where('clinic_id', $clinicId)->first();
        if (!$patient) {
            return $this->respondNotFound('Patient does not exists');
        }

        $params = array_merge(
            $request->all(),
            [
                'professional_id' => $request->user()->professional->id
            ]
        );
        $validator = \Validator::make($params, (new Rehabilitation())->getRules());
        if ($validator->fails()) {
            return $this->setStatusCode(200)->respondWithError('Validation fails', [
                'error' => [
                    'fields' => $validator->errors()
                ]
            ]);
        }

        $patient->rehabilitations()->create($params);

        return $this->setStatusCode(201)->respondItem($patient, new PatientTransformer());
    }
}
