<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Helpers;
use PHPMailer\PHPMailer\PHPMailer;

class SMSProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'sms';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $communications = Helpers::phlexusConfig('communications')->toArray();

        if (!isset($communications[$this->providerName])) {
            return;
        }

        $configs = $communications[$this->providerName];

        $this->di->setShared($this->providerName, function () use ($configs) {
            $options = $configs['options'];

            $sid = $options['sid'];
            $token = $options['token'];

            $client = new Twilio\Rest\Client($sid, $token);

            return $client;
        });
    }
}
