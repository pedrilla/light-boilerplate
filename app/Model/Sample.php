<?php

declare(strict_types = 1);

namespace App\Model;

use Light\Model;

/**
 * @collection Sample
 *
 * @property string $id
 *
 * @method static Sample[]    fetchAll($cond = null, $sort = null, int $count = null, int $offset = null)
 * @method static Sample|null fetchOne($cond = null, $sort = null)
 * @method static Sample      fetchObject($cond = null, $sort = null)
 */
class Sample extends Model
{

}