<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ContentMeta
 *
 * @property int $id
 * @property int $content_id
 * @property int $index
 * @property int $noindex
 * @property int $follow
 * @property int $nofollow
 * @property-read \App\Models\Content $content
 * @property-read \App\Models\ContentMetaTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContentMetaTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta whereFollow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta whereNofollow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta whereNoindex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ContentMeta withTranslation()
 * @mixin \Eloquent
 */
class ContentMeta extends Model
{
    use Translatable;

    protected $table = 'content_meta';
    public $timestamps = false;

    protected $fillable = ['content_id', 'index', 'noindex', 'follow', 'nofollow'];
    public $translatedAttributes = ['title', 'description'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
