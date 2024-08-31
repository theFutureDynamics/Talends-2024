<?php

namespace Tangibledesign\Framework\Models\User\Helpers;

use Tangibledesign\Framework\Models\Helpers\HasMeta;

trait HasAccountType
{
    use HasMeta;

    /**
     * @return string
     */
    public function getAccountType(): string
    {
        $type = $this->getMeta(UserSettingKey::ACCOUNT_TYPE);
        if (empty($type)) {
            return UserSettingKey::ACCOUNT_TYPE_PRIVATE;
        }

        return $type;
    }

    /**
     * @return string
     */
    public function getDisplayAccountType(): string
    {
        if ($this->isBusinessAccount()) {
            return tdf_string('business');
        }

        return tdf_string('private_account_type');
    }

    /**
     * @param string $type
     * @return void
     * @noinspection PhpMissingParamTypeInspection
     */
    public function setAccountType($type): void
    {
        if ($type !== UserSettingKey::ACCOUNT_TYPE_BUSINESS && $type !== UserSettingKey::ACCOUNT_TYPE_PRIVATE) {
            $type = UserSettingKey::ACCOUNT_TYPE_PRIVATE;
        }

        $this->setMeta(UserSettingKey::ACCOUNT_TYPE, $type);
    }

    /**
     * @return bool
     */
    public function isBusinessAccount(): bool
    {
        return $this->getAccountType() === UserSettingKey::ACCOUNT_TYPE_BUSINESS;
    }

    /**
     * @return bool
     */
    public function isPrivateAccount(): bool
    {
        return $this->getAccountType() === UserSettingKey::ACCOUNT_TYPE_PRIVATE;
    }

}