<?php

namespace OwenIt\Auditing\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTable extends Model
{
    /**
     * @var string
     */
    protected $table = 'tblAuditTable';

    /**
     * @var string
     */
    protected $primaryKey = 'AuditTableId';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * {@inheritdoc}
     */
    protected $dates = ['CreatedOn'];
}
