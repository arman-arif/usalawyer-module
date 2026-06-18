<?php

namespace App\Modules\Lawyer\Models;

use App\Modules\Lawyer\Services\Config\Admin\LawyerConfig;
use App\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lawyer extends Model
{
    use QueryCacheable;

    protected $table = 'lawd_lawyers';

    protected $fillable = [
        'name',
        'photo',
        'practice_areas',
        'location',
        'address',
        'about_overview',
        'contact_number',
        'email',
        'is_paid',
        'website_url',
        'featured_date_setup',
    ];

    protected $casts = [
        'practice_areas' => 'array',
        'is_paid' => 'boolean',
        'featured_date_setup' => 'date',
    ];

    public function locationRel(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location');
    }

    public function getConfigClass(): string
    {
        return LawyerConfig::class;
    }
}
