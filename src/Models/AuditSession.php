<?php

namespace OwenIt\Auditing\Models;

use Illuminate\Database\Eloquent\Model;

class AuditSession extends Model
{
    /**
     * @var string
     */
    protected $table = 'tblAuditSession';

    /**
     * @var string
     */
    protected $primaryKey = 'AuditSessionId';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * {@inheritdoc}
     */
    protected $dates = ['CreatedOn'];
}
