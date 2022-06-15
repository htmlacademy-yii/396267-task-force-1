<?php

require_once 'vendor/autoload.php';

$strategy = new force\logic\AvailableActions('cancel', 2);
var_dump($strategy->getNextStatus('act_cancel'));

// assert($strategy->getNextStatus('act_cancel') == AvailableActions::STATUS_CANCEL, 'cancel');
