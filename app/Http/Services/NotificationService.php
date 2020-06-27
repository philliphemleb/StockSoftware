<?php
declare(strict_types=1);

namespace App\Http\Services;

/**
 * Class NotificationService
 * @package App\Http\Services
 */
class NotificationService
{
    /**
     * Contains all status messages
     *
     * @var array
     */
    private array $statusMessages = [];

    /**
     * Add´s a status message and returns the whole array.
     *
     * @param string $statusMessage
     * @param string $type
     * @return array
     */
    public function addStatusMessage(string $statusMessage, string $type = 'info'): array
    {
        $status = ['content' => $statusMessage, 'type' => $type];
        array_unshift($this->statusMessages, $status);

        $this->reflash();
        return $this->statusMessages;
    }


    private function reflash()
    {
        request()->session()->flash('status_messages', $this->statusMessages);
    }
}
