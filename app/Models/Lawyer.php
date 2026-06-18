<?php

namespace App\Modules\Lawyer\Models;

use App\Modules\Lawyer\Services\Config\Admin\LawyerConfig;
use App\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lawyer extends Model
{
    use QueryCacheable;

    protected $table = 'lawd_lawyers';

    protected $fillable = [
        'name',
        'photo',
        'practice_areas',
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

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class, 'lawd_lawyer_location')
            ->withTimestamps();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'lawd_lawyer_category')
            ->withTimestamps();
    }

    public function subCategories(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'lawd_lawyer_sub_category')
            ->withTimestamps();
    }

    public function getConfigClass(): string
    {
        return LawyerConfig::class;
    }
}
