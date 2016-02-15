<?php

namespace App\Transformers;

use App\Models\Professional;
use League\Fractal\TransformerAbstract;

/**
 * Class Professional
 * @package App\Transformers
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class ProfessionalTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\Professional $professional
     * @return array
     */
    public function transform(Professional $professional)
    {
        return [
            'id' => (int) $professional->id,
            'name' => $professional->user->name,
            'email' => $professional->user->email,
            'specialty' => [
                'id' => $professional->specialty->id,
                'name' => $professional->specialty->name
            ],
            'created_at' => $professional->created_at->toDateTimeString(),
            'updated_at' => $professional->updated_at->toDateTimeString(),
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => "clinics/{$professional->clinic_id}/professionals/{$professional->id}"
                ],
                [
                    'rel' => 'clinics',
                    'uri' => "clinics/{$professional->clinic_id}"
                ],
                [
                    'rel' => 'specialty',
                    'uri' => "specialties/{$professional->specialty->id}"
                ],
                [
                    'rel' => 'user',
                    'uri' => "users/{$professional->user->id}"
                ],
            ]
        ];
    }
}
