<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Team
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $team_id
 * @property string $team_name
 * @property int $domain_id
 * @property int|null $topic_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereDomainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTeamName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereUpdatedAt($value)
 * @property-read \App\Domain $domain
 * @property-read \App\Topic|null $topic
 * @property string $scrolls_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereScrollsId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 */
class Team extends Model {

    public function domain(){
        return $this->belongsTo(Domain::class);
    }

    public function topic(){
        return $this->belongsTo(Topic::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

}
