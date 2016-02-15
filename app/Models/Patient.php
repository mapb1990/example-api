<?php

namespace App\Models;

use Delatbabel\Elocrypt\Elocrypt;

/**
 * Class Patient
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class Patient extends BaseModel
{
    use Elocrypt;

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
        'name', 'birthday', 'email', 'clinic_id'
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
     * The attributes that should be encrypted on save.
     *
     * @var array
     */
    protected $encrypts = [
        'name', 'birthday', 'email'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rehabilitations()
    {
        return $this->hasMany(Rehabilitation::class);
    }
}
