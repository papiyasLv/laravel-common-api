<?php


namespace Papiyas\Api\Response;

use App\Enums\ApiCodeEnum;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;

class Api
{
    protected $statusKey;
    protected $messageKey;
    protected $dataResultKey;
    protected $messageAlwaysReturn;

    public function __construct(array $config)
    {
        $this->statusKey = $config['status_key'];
        $this->messageKey = $config['message_key'];
        $this->dataResultKey = $config['data_result_key'];
        $this->messageAlwaysReturn = $config['message_always_return'];
    }

    /**
     * @param  int  $apiCodeEnum
     * @param  null  $data
     * @param  string  $forceMessage
     * @return array
     * @throws InvalidEnumMemberException
     */
    protected function codeReturn(
        int $apiCodeEnum,
        $data = null,
        string $forceMessage = ''
    ): array {
        list($status, $message) = (new ApiCodeEnum($apiCodeEnum))->toArray();
        $message = $forceMessage ?: $message;

        // 必会返回状态码字段
        $json = [
            $this->statusKey => $status,
        ];

        // 当$data为null时，返回格式中不会包含数据结果字段
        if (is_null($data)) {
            $json[$this->messageKey] = $message;
        } else {
            // 如果开启了始终返回提示信息开关，则无论成功与否都会返回提示信息字段
            if ($this->messageAlwaysReturn) {
                $json[$this->messageKey] = $message;
            }

            // 只有在成功时，即$data字段不为null时返回数据结果字段
            $json[$this->dataResultKey] = $data;
        }

        return $json;
    }

    /**
     * 数据处理成功时返回的通用API数据格式
     * @param  array  $data  要返回给前端的数据
     * @return array
     * @throws InvalidEnumMemberException
     */
    public function success(
        array $data = []
    ): array {
        return $this->codeReturn(ApiCodeEnum::success, $data);
    }

    /**
     * 数据处理失败或错误时返回的通用API数据格式
     * @param  int  $apiCode  错误码枚举值
     * @param  string  $forceMessage  如果要相同的错误码显示不同的信息，可以使用改参数覆盖原错误信息
     * @return array
     * @throws InvalidEnumMemberException
     */
    public function failure(
        int $apiCode = ApiCodeEnum::failure,
        string $forceMessage = ''
    ): array {
        return $this->codeReturn($apiCode, null, $forceMessage);
    }
}
