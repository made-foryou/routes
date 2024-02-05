<?php

namespace MadeForYou\Routes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use MadeForYou\Routes\Contracts\HasRoute;

/**
 * ## Route model
 * ___
 *
 * @property-read int $id
 * @property-read string routed_type
 * @property-read int routed_id
 * @property string $url
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read HasRoute $routed
 */
class Route extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'made_routes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'routed_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The object which this route is connected to.
     */
    public function routed(): MorphTo
    {
        return $this->morphTo();
    }
}
