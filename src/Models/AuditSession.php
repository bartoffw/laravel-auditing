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

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'SessionId',
        'UserId'
    ];


    public static function findOrCreate($sessionId, $userId)
    {
        $session = AuditSession::
            where('SessionId', $sessionId)
            ->where('UserId', $userId)
            ->first();
        if (!$session) {
            $session = AuditSession::create([
                'SessionId' => $sessionId,
                'UserId' => $userId
            ]);
        }
        return $session;
    }
}
