<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\ApiController;
use App\Models\Patient;
use App\Transformers\PatientTransformer;
use Illuminate\Http\Request;
use App\Http\Requests;

class ClinicPatientController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $clinicId
     * @return \Illuminate\Http\Response
     */
    public function index($clinicId)
    {
        $this->authorize('view-patients');

        return $this->respondCollection(Patient::with(['rehabilitations', 'rehabilitations.professional'])
            ->where('clinic_id', $clinicId)
            ->paginate($this->resultsPerPage), new PatientTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $clinicId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $clinicId)
    {
        $this->authorize('create-professionals');

        $params = array_merge(
            $request->all(),
            [
                'clinic_id' => $clinicId
            ]
        );
        $validator = \Validator::make($params, (new Patient())->getRules());
        if ($validator->fails()) {
            return $this->setStatusCode(200)->respondWithError('Validation fails', [
                'error' => [
                    'fields' => $validator->errors()
                ]
            ]);
        }

        $patient = Patient::create($params);

        return $this->setStatusCode(201)->respondItem($patient, new PatientTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param int $clinicId
     * @param  int  $patientId
     * @return \Illuminate\Http\Response
     */
    public function show($clinicId, $patientId)
    {
        $this->authorize('view-patients');

        /**
         * @var $professional Patient
         */
        $patient = Patient::where('id', $patientId)->where('clinic_id', $clinicId)->first();
        if (!$patient) {
            return $this->respondNotFound('Patient does not exists');
        }

        return $this->respondItem($patient, new PatientTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $clinicId
     * @param int $patientId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clinicId, $patientId)
    {
        $this->authorize('edit-patients');

        /**
         * @var $patient Patient
         */
        $patient = Patient::where('id', $patientId)->where('clinic_id', $clinicId)->first();
        if (!$patient) {
            return $this->respondNotFound('Patient does not exists');
        }

        $patient->fill($request->except('clinic_id'));

        $validator = \Validator::make($patient->getAttributes(), $patient->getRules());
        if ($validator->fails()) {
            return $this->setStatusCode(200)->respondWithError('Validation fails', [
                'error' => [
                    'fields' => $validator->errors()
                ]
            ]);
        }

        $patient->save();
        return $this->respondItem($patient, new PatientTransformer());
    }

    /**
     * Update the patient status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $clinicId
     * @param int $patientId
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $clinicId, $patientId)
    {
        $this->authorize('deactivate-patients');

        /**
         * @var $patient Patient
         */
        $patient = Patient::where('id', $patientId)->where('clinic_id', $clinicId)->first();
        if (!$patient) {
            return $this->respondNotFound('Patient does not exists');
        }

        $validator = \Validator::make($request->all(), [
            'active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(200)->respondWithError('Validation fails', [
                'error' => [
                    'fields' => $validator->errors()
                ]
            ]);
        }

        $patient->activated = (boolean) $request->get('active');
        $patient->save();
        return $this->respondItem($patient, new PatientTransformer());
    }
}
