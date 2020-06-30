<?php

namespace App\Models\Hiworks;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $connection = 'hiworks_master';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'basic_info';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'no';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
