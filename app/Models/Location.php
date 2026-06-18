<?php

namespace App\Modules\Lawyer\Models;

use App\Modules\Lawyer\Models\Lawyer;
use App\Modules\Lawyer\Services\Config\Admin\LocationConfig;
use App\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function lawyers(): HasMany
    {
        return $this->hasMany(Lawyer::class, 'location');
    }

    public function getConfigClass(): string
    {
        return LocationConfig::class;
    }
}
