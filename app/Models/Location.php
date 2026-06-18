<?php

namespace App\Modules\Lawyer\Models;

use App\Modules\Lawyer\Services\Config\Admin\LocationConfig;
use App\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Location extends Model
{
    use QueryCacheable;

    protected $table = 'lawd_locations';

    protected $fillable = [
        'name',
        'short_code',
        'slug',
        'description',
    ];

    public function lawyers(): BelongsToMany
    {
        return $this->belongsToMany(Lawyer::class, 'lawd_lawyer_location')
            ->withTimestamps();
    }

    public function getConfigClass(): string
    {
        return LocationConfig::class;
    }
}
