<?php

namespace App\Transformers;

use App\Models\Rehabilitation;
use League\Fractal\TransformerAbstract;

/**
 * Class Rehabilitation
 * @package App\Transformers
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class RehabilitationTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Rehabilitation $rehabilitation
     * @return array
     */
    public function transform(Rehabilitation $rehabilitation)
    {
        return [
            'id' => (int) $rehabilitation->id,
            'name' => $rehabilitation->name,
            'professional' => [
                'id' => $rehabilitation->professional->id,
                'name' => $rehabilitation->professional->user->name
            ],
            'started_at' => $rehabilitation->started_at->toDateTimeString(),
            'ended_at' => $rehabilitation->ended_at->toDateTimeString(),
            'created_at' => $rehabilitation->created_at->toDateTimeString(),
            'updated_at' => $rehabilitation->updated_at->toDateTimeString(),
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => "rehabilitations/{$rehabilitation->id}"
                ],
                [
                    'rel' => 'patients',
                    'uri' => "clinics/{$rehabilitation->patient->clinic_id}/patients/{$rehabilitation->patient_id}"
                ],
                [
                    'rel' => 'professionals',
                    'uri' => "clinics/{$rehabilitation->patient->clinic_id}/professionals/{$rehabilitation->professional->id}"
                ]
            ]
        ];
    }
}
