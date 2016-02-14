<?php

namespace App\Models;

/**
 * Class Professional
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class Professional extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professionals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'clinic_id', 'specialty_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * @var array
     */
    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'clinic_id' => 'required|exists:clinics,id',
        'specialty_id' => 'required|exists:specialties,id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
