<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Synopsis
 *
 * @property int $id
 * @property int $team_id
 * @property string $scrolls_id
 * @property string $namespace
 * @property string|null $pre_signed_url
 * @property int $is_completed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis whereIsCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis whereNamespace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis wherePreSignedUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis whereScrollsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Synopsis whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Synopsis extends Model
{
    //
}
