<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
	protected $fillable = [
		'user_id',
		'name',
		'description',
		'start_time',
		'end_time',
		'location',
	];

	protected $casts = [
		'start_time' => 'datetime',
		'end_time' => 'datetime',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
	public function attendees(): HasMany
	{
		return $this->hasMany(Attendee::class);
	}
}
