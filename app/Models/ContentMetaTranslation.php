<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContentMetaTranslation
 *
 * @property int $id
 * @property int $content_meta_id
 * @property string $locale
 * @property string|null $title
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMetaTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMetaTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMetaTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMetaTranslation whereContentMetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMetaTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMetaTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMetaTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMetaTranslation whereTitle($value)
 * @mixin \Eloquent
 */
class ContentMetaTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'content_meta_translations';
    protected $fillable =  ['title', 'description', 'content_meta_id'];
}
