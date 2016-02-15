<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

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
        'name', 'started_at', 'ended_at', 'professional_id'
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
        'patient_id' => 'exists:patients,id',
        'professional_id' => 'exists:professionals,id',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    /**
     * Scope a query to only include rehabilitations that ended in next days.
     *
     * @param Builder $query
     * @param int $days
     * @return Builder
     */
    public function scopeEndedInNextDays(Builder $query, $days = 15)
    {
        return $query->where('ended_at', '<=', Carbon::now()->addDays($days));
    }
}
