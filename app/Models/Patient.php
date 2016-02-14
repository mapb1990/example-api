<?php

namespace App\Models;

/**
 * Class Patient
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class Patient extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'birthday', 'email', 'clinic_id', 'activated'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['birthday'];

    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required|min:5|max:50',
        'birthday' => 'required|date',
        'email' => 'required|email',
        'clinic_id' => 'required|exists:clinics,id',
        'activated' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
