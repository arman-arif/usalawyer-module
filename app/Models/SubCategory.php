<?php

namespace App\Modules\Lawyer\Models;

use App\Modules\Lawyer\Services\Config\Admin\SubCategoryConfig;
use App\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubCategory extends Model
{
    use QueryCacheable;

    protected $table = 'lawd_sub_categories';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function lawyers(): BelongsToMany
    {
        return $this->belongsToMany(Lawyer::class, 'lawd_lawyer_sub_category')
            ->withTimestamps();
    }

    public function getConfigClass(): string
    {
        return SubCategoryConfig::class;
    }
}
