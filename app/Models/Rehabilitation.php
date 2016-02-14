<?php

namespace App\Models;

class Rehabilitation extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rehabilitations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'patient_id', 'started_at', 'ended_at'
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
    protected $dates = ['started_at', 'ended_at'];

    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required|min:5|max:50',
        'patient_id' => 'required|exists:patients,id',
        'started_at' => 'required|date|before:ended_at',
        'ended_at' => 'required|date|after:started_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
