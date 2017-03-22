<?php

namespace OwenIt\Auditing\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTransaction extends Model
{
    /**
     * @var string
     */
    protected $table = 'tblAuditTransaction';

    /**
     * @var string
     */
    protected $primaryKey = 'AuditTransactionId';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * {@inheritdoc}
     */
    protected $dates = ['CreatedOn'];
}
