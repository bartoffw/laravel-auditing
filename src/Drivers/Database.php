<?php
/**
 * This file is part of the Laravel Auditing package.
 *
 * @author     Antério Vieira <anteriovieira@gmail.com>
 * @author     Quetzy Garcia  <quetzyg@altek.org>
 * @author     Raphael França <raphaelfrancabsb@gmail.com>
 * @copyright  2015-2017
 *
 * For the full copyright and license information,
 * please view the LICENSE.md file that was distributed
 * with this source code.
 */

namespace OwenIt\Auditing\Drivers;

use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Contracts\AuditDriver;
use OwenIt\Auditing\Models\AuditField;
use OwenIt\Auditing\Models\AuditSession;
use OwenIt\Auditing\Models\AuditTable;
use OwenIt\Auditing\Models\AuditTransaction;

class Database implements AuditDriver
{
    /**
     * {@inheritdoc}
     */
    public function audit(Auditable $model)
    {
        $toAudit = $model->toAudit();

        $table = AuditTable::findOrCreate($model->getTable());
        $session = AuditSession::findOrCreate(session()->getId(), $toAudit['user_id']);
        $transaction = AuditTransaction::create([
            'AuditSessionId' => $session->AuditSessionId,
            'Transaction' => date('YmdHis') . md5(uniqid(rand(), true))
        ]);

        foreach ($toAudit['new_values'] as $attribute => $newValue) {
            AuditField::create([
                'AuditTransactionId' => $transaction->AuditTransactionId,
                'AuditTableId' => $table->AuditTableId,
                'Event' => $toAudit['event'],
                'PrimaryKey' => $toAudit['auditable_id'],
                'FieldName' => $attribute,
                'OldValue' => $toAudit['old_values'][$attribute],
                'NewValue' => $toAudit['new_values'][$attribute]
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function prune(Auditable $model)
    {
        if (($threshold = $model->getAuditThreshold()) > 0) {
            $total = $model->audits()->count();

            $forRemoval = ($total - $threshold);

            if ($forRemoval > 0) {
                $model->audits()
                    ->orderBy('created_at', 'asc')
                    ->limit($forRemoval)
                    ->delete();

                return true;
            }
        }

        return false;
    }
}
