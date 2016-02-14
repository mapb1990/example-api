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
 * @property-read \App\Models\Clinic $clinic
 */
	class Patient {}
}

namespace App\Models{
/**
 * Class Professional
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 * @property-read \App\Models\User $user
 */
	class Professional {}
}

namespace App\Models{
/**
 * App\Models\Rehabilitation
 *
 * @property-read \App\Models\Patient $patient
 */
	class Rehabilitation {}
}

namespace App\Models{
/**
 * Class Specialty
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
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
 * @property-write mixed $password
 * @property-read \App\Models\Professional $professional
 */
	class User {}
}

