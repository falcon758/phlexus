<?php
declare(strict_types=1);

namespace Phlexus\Providers;

use Phlexus\Modules\BaseUser\Models\User;
use Phlexus\Helpers;

class UserProvider extends AbstractProvider
{
    /**
     * Provider name
     *
     * @var string
     */
    protected $providerName = 'user';

    /**
     * Register application service.
     *
     * @param array $parameters Custom parameters for Service Provider
     * @return void
     */
    public function register(array $parameters = []): void
    {
        $info = User::getUser()->getUserInfo();

        $this->di->setShared($this->providerName, function () use ($info) {
            return (object) $info;
        });
    }
}