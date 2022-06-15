<?php

namespace force\logic;

class AvailableActions
{
    public const STATUS_NEW = 'new';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_CANCEL = 'cancel';
    public const STATUS_COMPLETE = 'complete';
    public const STATUS_EXPIRED = 'expired';

    public const ACTION_RESPONCE = 'act_response';
    public const ACTION_CANCEL = 'act_cancel';
    public const ACTION_DENY = 'act_deny';
    public const ACTION_COMPLETE = 'act_complete';

    public const ROLE_PERFORMER = 'performer';
    public const ROLE_CLIENT = 'customer';

    private $performerId;
    private $clientId;

    private $status;

    /**
     * AvailableActionsStrategy constructor
     * @param string $status
     * @param int|null $performerId
     * @param int $clientId
     */

    public function __construct(string $status, int $clientId, ?int $performerId = null)
    {
        $this->setStatus($status);

        $this->performerId = $performerId;
        $this->clientId = $clientId;
    }

    /**
     * @return string[]
     */
    public function getStatusesMap(): array
    {
        return [
             self::STATUS_NEW => 'Новое',
             self::STATUS_CANCEL => 'Отменено',
             self::STATUS_IN_PROGRESS => 'В работе',
             self::STATUS_COMPLETE => 'Выполнено',
             self::STATUS_EXPIRED => 'Провалено'
         ];
    }

    /**
     * получение следующего статуса по действию
     * @param string $action
     * @return string|null
     */
    public function getNextStatus(string $action): ?string
    {
        $map = [
              self::ACTION_COMPLETE => self::STATUS_COMPLETE,
              self::ACTION_CANCEL => self::STATUS_CANCEL,
              self::ACTION_DENY => self::STATUS_CANCEL,
          ];

        return $map[$action] ?? null;
    }

    /**
     * установка статуса
     * @param string $status
     * @return void
     */
    private function setStatus(string $status): void
    {
        $availableStatuses = [
              self::STATUS_NEW,
              self::STATUS_IN_PROGRESS,
              self::STATUS_CANCEL,
              self::STATUS_COMPLETE,
              self::STATUS_EXPIRED
            ];

        if (in_array($status, $availableStatuses)) {
            $this -> status = $status;
        }
    }

    /**
      * @return string[]
      */
    private function getActionMap(): array
    {
        return [
              self::ACTION_CANCEL => 'Отменить',
              self::ACTION_RESPONCE => 'Отклилкуться',
              self::ACTION_COMPLETE => 'Выполнено',
              self::ACTION_DENY => 'Отказаться',
          ];
    }

    /**
     * Возвращает действия, доступные для указанного статуса
     * @param string $status
     * @return array
     */
    private function statusAllowedActions(string $status): array
    {
        $map = [
              self::STATUS_IN_PROGRESS => [self::ACTION_DENY, self::ACTION_COMPLETE],
              self::STATUS_NEW => [self::ACTION_CANCEL, self::ACTION_RESPONCE],
          ];

        return $map[$status] ?? [];
    }
}
