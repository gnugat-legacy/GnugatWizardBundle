<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Bundle\WizardBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Makes sure the given string is a valid bundle namespace.
 * Inspired from Sensio\Bundle\GeneratorBundle\Command\Validators::validateBundleNamespace.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class IsNamespaceWithVendor extends Constraint
{
    /**
     * @var string
     */
    public $message;

    public function __construct()
    {
        $this->message = 'The namespace must contain a vendor namespace (e.g. "VendorName\%string%" instead of simply "%string%").';
        $this->message .= "\n\n";
        $this->message .= 'If you\'ve provided one, make sure to surround the argument with quotes to prevent the backslashes from being trimmed.';
    }
}
