<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Content
 *
 * @property int $id
 * @property int $structure_id
 * @property string $alias
 * @property int $active
 * @property int $position
 * @property string $template
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $publish_at
 * @property-read \App\Models\Structure $structure
 * @property-read \App\Models\ContentTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ContentTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content wherePublishAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Content withTranslation()
 * @mixin \Eloquent
 */
class Content extends Model
{
    use Translatable;

    protected $fillable = ['alias', 'template', 'active', 'structure_id', 'publish_at', 'position'];
    public $translatedAttributes = ['name', 'content', 'image'];

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    /**
     * @param string $date
     * @return string
     */
    public function getCreatedAtAttribute(string $date): string
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }

    /**
     * @param string $date
     * @return string
     */
    public function getUpdatedAtAttribute(string $date): string
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }

    /**
     * @param string $date
     * @return string
     */
    public function getPublishAtAttribute(?string $date): ?string
    {
        if ($date === null) {
            return null;
        }

        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
}
