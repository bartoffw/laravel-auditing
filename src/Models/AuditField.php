<?php

namespace OwenIt\Auditing\Models;

use Illuminate\Database\Eloquent\Model;

class AuditField extends Model
{
    /**
     * @var string
     */
    protected $table = 'tblAuditField';

    /**
     * @var string
     */
    protected $primaryKey = 'AuditFieldId';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * {@inheritdoc}
     */
    protected $dates = ['CreatedOn'];

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'AuditTransactionId',
        'AuditTableId',
        'Event',
        'PrimaryKey',
        'FieldName',
        'OldValue',
        'NewValue'
    ];
}
