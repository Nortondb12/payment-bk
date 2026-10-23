<?php

declare(strict_types=1);

namespace Revoltify\SMSify;

use Illuminate\Support\Manager;
use Revoltify\SMSify\Drivers\AdnsmsDriver;
use Revoltify\SMSify\Drivers\AlphasmsDriver;
use Revoltify\SMSify\Drivers\BanglalinkDriver;
use Revoltify\SMSify\Drivers\BulksmsDriver;
use Revoltify\SMSify\Drivers\ElitbuzzDriver;
use Revoltify\SMSify\Drivers\EsmsDriver;
use Revoltify\SMSify\Drivers\GrameenphoneDriver;
use Revoltify\SMSify\Drivers\GreenwebDriver;
use Revoltify\SMSify\Drivers\InfobipDriver;
use Revoltify\SMSify\Drivers\LogDriver;
use Revoltify\SMSify\Drivers\MimsmsDriver;
use Revoltify\SMSify\Drivers\RobiDriver;
use Revoltify\SMSify\Drivers\SmsnocDriver;
use Revoltify\SMSify\Drivers\SmsqDriver;
use Revoltify\SMSify\Drivers\SslDriver;

class SMSifyManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return $this->config->get('smsify.default');
    }

    protected function createLogDriver(): LogDriver
    {
        return new LogDriver;
    }

    protected function createEsmsDriver(): EsmsDriver
    {
        return new EsmsDriver($this->config->get('smsify.drivers.esms'));
    }

    protected function createMimsmsDriver(): MimsmsDriver
    {
        return new MimsmsDriver($this->config->get('smsify.drivers.mimsms'));
    }

    protected function createSslDriver(): SslDriver
    {
        return new SslDriver($this->config->get('smsify.drivers.ssl'));
    }

    protected function createGrameenphoneDriver(): GrameenphoneDriver
    {
        return new GrameenphoneDriver($this->config->get('smsify.drivers.grameenphone'));
    }

    protected function createBanglalinkDriver(): BanglalinkDriver
    {
        return new BanglalinkDriver($this->config->get('smsify.drivers.banglalink'));
    }

    protected function createRobiDriver(): RobiDriver
    {
        return new RobiDriver($this->config->get('smsify.drivers.robi'));
    }

    protected function createInfobipDriver(): InfobipDriver
    {
        return new InfobipDriver($this->config->get('smsify.drivers.infobip'));
    }

    protected function createAdnsmsDriver(): AdnsmsDriver
    {
        return new AdnsmsDriver($this->config->get('smsify.drivers.adnsms'));
    }

    protected function createAlphasmsDriver(): AlphasmsDriver
    {
        return new AlphasmsDriver($this->config->get('smsify.drivers.alphasms'));
    }

    protected function createGreenwebDriver(): GreenwebDriver
    {
        return new GreenwebDriver($this->config->get('smsify.drivers.greenweb'));
    }

    protected function createBulksmsDriver(): BulksmsDriver
    {
        return new BulksmsDriver($this->config->get('smsify.drivers.bulksms'));
    }

    protected function createElitbuzzDriver(): ElitbuzzDriver
    {
        return new ElitbuzzDriver($this->config->get('smsify.drivers.elitbuzz'));
    }

    protected function createSmsnocDriver(): SmsnocDriver
    {
        return new SmsnocDriver($this->config->get('smsify.drivers.smsnoc'));
    }

    protected function createSmsqDriver(): SmsqDriver
    {
        return new SmsqDriver($this->config->get('smsify.drivers.smsq'));
    }
}
