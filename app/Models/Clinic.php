<?php

namespace App\Models;

/**
 * Class Clinic
 *
 * @package App\Models
 * @author Miguel Borges <miguelborges@miguelborges.com>
 */
class Clinic extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clinics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

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
        'name' => 'required|min:5|max:50',
    ];

    /**
     * @var array
     */
    protected $uniques = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function professionals()
    {
        return $this->hasMany(Professional::class);
    }
}
