<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Price
 *
 * @property-read Product $product
 * @method static Builder|Price newModelQuery()
 * @method static Builder|Price newQuery()
 * @method static Builder|Price query()
 * @mixin Eloquent
 * @property string $id
 * @property string $currency
 * @property mixed $value
 * @property string $product_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Price whereCreatedAt($value)
 * @method static Builder|Price whereCurrency($value)
 * @method static Builder|Price whereId($value)
 * @method static Builder|Price whereProductId($value)
 * @method static Builder|Price whereUpdatedAt($value)
 * @method static Builder|Price whereValue($value)
 */
class Price extends Model
{
    use UsesUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['currency', 'value'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['value' => 'float'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
