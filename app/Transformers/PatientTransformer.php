<?php

namespace App\Transformers;

use App\Models\Patient;
use League\Fractal\Manager;
use League\Fractal\TransformerAbstract;

/**
 * Class Patient
 * @package App\Transformers
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class PatientTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Patient $patient
     * @return array
     */
    public function transform(Patient $patient)
    {
        $activated = (boolean) $patient->activated;
        $rehabilitations = [];
        if ($activated) {
            $rehabilitations = [
                'rehabilitations' => (new Manager())->createData($this->includeRehabilitations($patient))->toArray()
            ];
        }

        return array_merge(
            [
                'id' => (int) $patient->id,
                'name' => $patient->name,
                'birthday' => $patient->birthday->toDateString(),
                'email' => $patient->email,
                'clinic_id' => (int) $patient->clinic_id,
                'activated' => $activated,
                'created_at' => $patient->created_at->toDateTimeString(),
                'updated_at' => $patient->updated_at->toDateTimeString()
            ],
            $rehabilitations,
            [
                'links' => [
                    [
                        'rel' => 'self',
                        'uri' => "clinics/{$patient->clinic_id}/patients/{$patient->id}/"
                    ],
                    [
                        'rel' => 'clinics',
                        'uri' => "clinics/{$patient->clinic_id}/"
                    ],
                ]
            ]
        );
    }

    /**
     * Include Rehabilitations
     *
     * @param \App\Models\Patient $patient
     * @return \League\Fractal\Resource\Collection
     */
    public function includeRehabilitations(Patient $patient)
    {
        return $this->collection($patient->rehabilitations, new RehabilitationTransformer());
    }
}
