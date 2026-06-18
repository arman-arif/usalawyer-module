<?php

namespace App\Modules\Lawyer\Models;

use App\Modules\Lawyer\Services\Config\Admin\CategoryConfig;
use App\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use QueryCacheable;

    protected $table = 'lawd_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function lawyers(): BelongsToMany
    {
        return $this->belongsToMany(Lawyer::class, 'lawd_lawyer_category')
            ->withTimestamps();
    }

    public function getConfigClass(): string
    {
        return CategoryConfig::class;
    }
}
