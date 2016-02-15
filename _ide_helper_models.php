<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Clinic
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Professional[] $professionals
 */
	class Clinic {}
}

namespace App\Models{
/**
 * Class Patient
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $birthday
 * @property string $email
 * @property integer $clinic_id
 * @property boolean $activated
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Clinic $clinic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Rehabilitation[] $rehabilitations
 */
	class Patient {}
}

namespace App\Models{
/**
 * Class Professional
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 * @property integer $id
 * @property integer $user_id
 * @property integer $clinic_id
 * @property integer $specialty_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Specialty $specialty
 */
	class Professional {}
}

namespace App\Models{
/**
 * App\Models\Rehabilitation
 *
 * @property integer $id
 * @property string $name
 * @property integer $patient_id
 * @property integer $professional_id
 * @property \Carbon\Carbon $started_at
 * @property \Carbon\Carbon $ended_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Professional $professional
 */
	class Rehabilitation {}
}

namespace App\Models{
/**
 * Class Specialty
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Professional[] $professionals
 */
	class Specialty {}
}

namespace App\Models{
/**
 * Class User
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Professional $professional
 */
	class User {}
}

