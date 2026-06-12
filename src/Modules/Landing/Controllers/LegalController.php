<?php
declare(strict_types=1);

namespace Phlexus\Modules\Landing\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Tag;

/**
 * Class Legal
 *
 * @package Phlexus\Modules\Landing\Controllers
 */
final class LegalController extends Controller
{
    /**
     * Terms and Conditions Action
     *
     * @return void
     */
    public function termsConditionsAction(): void
    {
        $title = $this->translation->setTypePage()->_('title-terms-and-conditions');

        Tag::setTitle($title);
    }

    /**
     * Disclaimer Action
     *
     * @return void
     */
    public function disclaimerAction(): void
    {
        $title = $this->translation->setTypePage()->_('title-disclaimer');

        Tag::setTitle($title);
    }

    /**
     * Privacy Policy Action
     *
     * @return void
     */
    public function privacyPolicyAction(): void
    {
        $title = $this->translation->setTypePage()->_('title-privacy-policy');

        Tag::setTitle($title);
    }

    /**
     * Use Policy Action
     *
     * @return void
     */
    public function usePolicyAction(): void
    {
        $title = $this->translation->setTypePage()->_('title-use-policy');

        Tag::setTitle($title);
    }

    /**
     * Cookie Policy Action
     *
     * @return void
     */
    public function cookiePolicyAction(): void
    {
        $title = $this->translation->setTypePage()->_('title-cookie-policy');

        Tag::setTitle($title);
    }

    /**
     * Return Policy Action
     *
     * @return void
     */
    public function returnPolicyAction(): void
    {
        $title = $this->translation->setTypePage()->_('title-return-policy');

        Tag::setTitle($title);
    }
}