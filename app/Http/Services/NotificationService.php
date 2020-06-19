<?php
declare(strict_types=1);

namespace App\Http\Services;

use Illuminate\Http\Request;

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
     * @return array
     */
    public function addStatusMessage(string $statusMessage): array
    {
        array_unshift($this->statusMessages, $statusMessage);

        $this->refresh();

        return $this->statusMessages;
    }


    private function refresh()
    {
        request()->session()->flash('status_messages', $this->statusMessages);
    }
}
