<?php

class DiscordService
{
    private $webhook;

    public function __construct($webhook)
    {
        $this->webhook = $webhook;
    }

    public function send($message)
    {
        $data = [
            "content" => $message
        ];

        $ch = curl_init($this->webhook);

        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_exec($ch);
        curl_close($ch);
    }
}
