<?php


namespace Papiyas\Api;


class Setting
{
    public string $statusKey;
    public string $messageKey;
    public string $dataResultKey;
    public string $messageAlwaysReturn;
    public \Closure $extra;


    public function __construct(array $settings, $callback = null)
    {
        $this->statusKey = $settings['status_key'];
        $this->messageKey = $settings['message_key'];
        $this->dataResultKey = $settings['data_result_key'];
        $this->messageAlwaysReturn = $settings['message_always_return'];

        if ($callback && $callback instanceof \Closure) {
            $this->extra = $callback;
        }
    }
}
