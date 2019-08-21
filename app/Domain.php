<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Domain
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Topic[] $topics
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $domain
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Domain whereUpdatedAt($value)
 */
class Domain extends Model {

    public function topics() {
        return $this->hasMany(Topic::class);
    }
}