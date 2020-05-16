<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContentTranslation
 *
 * @property int $id
 * @property int $content_id
 * @property string $locale
 * @property string $name
 * @property string|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentTranslation whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentTranslation whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentTranslation whereName($value)
 * @mixin \Eloquent
 * @property string|null $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentTranslation whereImage($value)
 */
class ContentTranslation extends Model
{
    public $timestamps = false;

    protected $fillable =  ['name', 'content', 'image'];
}
