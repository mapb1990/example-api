<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\ProfessionalCreated;
use App\Http\Controllers\Api\ApiController;
use App\Models\Professional;
use App\Models\User;
use App\Transformers\ProfessionalTransformer;
use Illuminate\Http\Request;
use App\Http\Requests;

class ClinicProfessionalController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $clinicId
     * @return \Illuminate\Http\Response
     */
    public function index($clinicId)
    {
        $this->authorize('view-professionals');

        return $this->respondCollection(Professional::with(['specialty', 'user'])
            ->where('clinic_id', $clinicId)
            ->paginate($this->resultsPerPage), new ProfessionalTransformer());
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

        $rules = array_merge(
            (new Professional())->getRules(),
            (new User())->getRules()
        );

        $params = array_merge(
            $request->all(),
            [
                'clinic_id' => $clinicId,
                'role' => User::PROFESSIONAL_ROLE
            ]
        );
        $validator = \Validator::make($params, $rules);
        if ($validator->fails()) {
            return $this->setStatusCode(200)->respondWithError('Validation fails', [
                'error' => [
                    'fields' => $validator->errors()
                ]
            ]);
        }

        $user = User::create($params);
        $professional = $user->professional()->create($params);

        \Event::fire(new ProfessionalCreated($professional));

        return $this->setStatusCode(201)->respondItem($professional, new ProfessionalTransformer());
    }

    /**
     * Display the specified resource.
     *
     * @param int $clinicId
     * @param int $professionalId
     * @return \Illuminate\Http\Response
     */
    public function show($clinicId, $professionalId)
    {
        $this->authorize('view-professionals');

        /**
         * @var $professional Professional
         */
        $professional = Professional::where('id', $professionalId)->where('clinic_id', $clinicId)->first();
        if (!$professional) {
            return $this->respondNotFound('Professional does not exists');
        }

        return $this->respondItem($professional, new ProfessionalTransformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $clinicId
     * @param int $professionalId
     * @return \Illuminate\Http\Response
     */
    public function destroy($clinicId, $professionalId)
    {
        $this->authorize('delete-professionals');

        /**
         * @var $professional Professional
         */
        $professional = Professional::where('id', $professionalId)->where('clinic_id', $clinicId)->first();
        if (!$professional) {
            return $this->respondNotFound('Professional does not exists');
        }

        $professional->delete();
        return $this->respond(['data' => ['message' => 'Professional deleted successfully']]);
    }
}
