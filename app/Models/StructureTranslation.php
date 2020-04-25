<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StructureTranslation
 *
 * @property int $id
 * @property int $structure_id
 * @property string $language
 * @property string $name
 * @property string|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureTranslation whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureTranslation whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureTranslation whereStructureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StructureTranslation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class StructureTranslation extends Model
{
    public $timestamps = false;
}
