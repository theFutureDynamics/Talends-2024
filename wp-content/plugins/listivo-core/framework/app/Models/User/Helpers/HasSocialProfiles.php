<?php

namespace Tangibledesign\Framework\Models\User\Helpers;

use Tangibledesign\Framework\Models\Helpers\HasMeta;

trait HasSocialProfiles
{
    use HasMeta;

    /**
     * @return bool
     */
    public function hasSocialProfiles(): bool
    {
        return !empty($this->getYouTubeProfile())
            || !empty($this->getFacebookProfile())
            || !empty($this->getLinkedInProfile())
            || !empty($this->getInstagramProfile())
            || !empty($this->getTwitterProfile())
            || !empty($this->getTiktokProfile())
            || !empty($this->getTelegramProfile());
    }

    public function setYouTubeProfile($url): void
    {
        $this->setMeta(UserSettingKey::YOU_TUBE_PROFILE, (string)$url);
    }

    public function getYouTubeProfile(): string
    {
        return (string)$this->getMeta(UserSettingKey::YOU_TUBE_PROFILE);
    }

    public function setFacebookProfile($url): void
    {
        $this->setMeta(UserSettingKey::FACEBOOK_PROFILE, (string)$url);
    }

    public function getFacebookProfile(): string
    {
        return (string)$this->getMeta(UserSettingKey::FACEBOOK_PROFILE);
    }

    public function setLinkedInProfile($url): void
    {
        $this->setMeta(UserSettingKey::LINKED_IN_PROFILE, (string)$url);
    }

    public function getLinkedInProfile(): string
    {
        return (string)$this->getMeta(UserSettingKey::LINKED_IN_PROFILE);
    }

    public function setTwitterProfile($url): void
    {
        $this->setMeta(UserSettingKey::TWITTER_PROFILE, (string)$url);
    }

    public function getTwitterProfile(): string
    {
        return (string)$this->getMeta(UserSettingKey::TWITTER_PROFILE);
    }

    public function setInstagramProfile($url): void
    {
        $this->setMeta(UserSettingKey::INSTAGRAM_PROFILE, (string)$url);
    }

    public function getInstagramProfile(): string
    {
        return (string)$this->getMeta(UserSettingKey::INSTAGRAM_PROFILE);
    }

    public function setTiktokProfile($url): void
    {
        $this->setMeta(UserSettingKey::TIKTOK_PROFILE, (string)$url);
    }

    public function getTiktokProfile(): string
    {
        return (string)$this->getMeta(UserSettingKey::TIKTOK_PROFILE);
    }

    public function setTelegramProfile($url): void
    {
        $this->setMeta(UserSettingKey::TELEGRAM_PROFILE, (string)$url);
    }

    public function getTelegramProfile(): string
    {
        return (string)$this->getMeta(UserSettingKey::TELEGRAM_PROFILE);
    }

    protected function getSocialProfilesSettingKeys(): array
    {
        return [
            UserSettingKey::FACEBOOK_PROFILE,
            UserSettingKey::YOU_TUBE_PROFILE,
            UserSettingKey::LINKED_IN_PROFILE,
            UserSettingKey::TWITTER_PROFILE,
            UserSettingKey::INSTAGRAM_PROFILE,
            UserSettingKey::TIKTOK_PROFILE,
            UserSettingKey::TELEGRAM_PROFILE,
        ];
    }

}