<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Helpers;
use PHPMailer\PHPMailer\PHPMailer;
use ReCaptcha\ReCaptcha;

class EmailProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'captcha';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $application = Helpers::phlexusConfig('application')->toArray();
        $configs = Helpers::phlexusConfig('captcha')->toArray();
        $this->di->setShared($this->providerName, function () use ($application, $configs) {
            $recaptcha = new ReCaptcha($configs['captcha']['secret']);
            return $recaptcha->setExpectedHostname($application->base_uri);
        });
    }
}
