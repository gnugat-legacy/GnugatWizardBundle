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
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Makes sure the given string is a valid bundle namespace.
 * Inspired from Sensio\Bundle\GeneratorBundle\Command\Validators::validateBundleNamespace.
 *
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class HasNamespaceWordValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^(?:[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\\\?)+$/', $value)) {
            $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    }
}
