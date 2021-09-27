<?php

declare(strict_types = 1);

namespace ModuleMerchant\Requests;

use Hyperf\Validation\Rule;

class MerchantRequest extends AbstractRequest
{
    protected function _addRule()
    {
        return [
            'name' => ['bail', 'required'],
            'code' => ['bail', 'required', 'unique:merchant,code'],
            'status' => $this->_getKeyValues('status'),
        ];
    }

    protected function _updateRule()
    {
        return [
            'code' => ['bail', 'required', 'unique:merchant,code'],
            //'id' => ['bail', 'required', 'exists'],
        ];
    }

    public function attributes(): array
    {
        return [
            'username' => '用户名',
            'password' => '密码'
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => '请填写用户名',
            'password.required' => '请填写密码',
        ];
    }
}
