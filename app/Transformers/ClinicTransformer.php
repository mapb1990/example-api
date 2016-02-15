<?php

namespace App\Transformers;

use App\Models\Clinic;
use League\Fractal\TransformerAbstract;

/**
 * Class Clinic
 * @package App\Transformers
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class ClinicTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Clinic $clinic
     * @return array
     */
    public function transform(Clinic $clinic)
    {
        return [
            'id' => (int) $clinic->id,
            'name' => $clinic->name,
            'created_at' => $clinic->created_at->toDateTimeString(),
            'updated_at' => $clinic->updated_at->toDateTimeString(),
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => "clinics/{$clinic->id}"
                ],
                [
                    'rel' => 'professionals',
                    'uri' => "clinics/{$clinic->id}/professionals/"
                ],
                [
                    'rel' => 'patients',
                    'uri' => "clinics/{$clinic->id}/patients/"
                ],
            ]
        ];
    }
}
