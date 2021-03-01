<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

class ApiCodeEnum extends Enum
{
    const success = 0;
    const failure = -1;


    public function toArray(): array
    {
        return [
            $this->value,
            // 本地化
            __('api.' . $this->key),
            // 非本地化则需要通过一个额外的信息类来处理
            // for example
            // Message::trans($this->key),
        ];
    }
}
