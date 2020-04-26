<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\Structure
 *
 * @property int $id
 * @property string $alias
 * @property string $template
 * @property string $controller
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Structure[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Structure|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\Structure newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\Structure newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|\App\Models\Structure query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereController($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\StructureTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StructureTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure listsTranslations($translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure orWhereTranslation($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure orWhereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure orderByTranslation($translationField, $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure translated()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure translatedIn($locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereTranslation($translationField, $value, $locale = null, $method = 'whereHas', $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure whereTranslationLike($translationField, $value, $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Structure withTranslation()
 */
class Structure extends Model
{
    use NodeTrait, Translatable;

    protected $fillable = ['alias', 'template', 'controller', 'parent_id'];
    public $translatedAttributes = ['name', 'content'];
}
