<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StructureMetaTranslation
 *
 * @property int $structure_meta_id
 * @property string $locale
 * @property string|null $title
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMetaTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMetaTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMetaTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMetaTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMetaTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMetaTranslation whereStructureMetaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMetaTranslation whereTitle($value)
 * @mixin \Eloquent
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureMetaTranslation whereId($value)
 */
class StructureMetaTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'structure_meta_translations';
    protected $fillable =  ['title', 'description', 'structure_meta_id'];
}
