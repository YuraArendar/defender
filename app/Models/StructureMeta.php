<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StructureMeta
 *
 * @property int $id
 * @property int $structure_id
 * @property int $index
 * @property int $noindex
 * @property int $follow
 * @property int $nofollow
 * @property-read \App\Models\Structure $structure
 * @property-read \App\Models\StructureMetaTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StructureMetaTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta whereFollow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta whereNofollow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta whereNoindex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMeta withTranslation()
 * @mixin \Eloquent
 */
class StructureMeta extends Model
{
    use Translatable;

    protected $table = 'structure_meta';
    public $timestamps = false;

    protected $fillable = ['structure_id', 'index', 'noindex', 'follow', 'nofollow'];
    public $translatedAttributes = ['title', 'description'];

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }
}
