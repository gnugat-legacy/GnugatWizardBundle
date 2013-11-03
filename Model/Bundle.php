<?php

/*
 * This file is part of the GnugatWizardBundle project.
 *
 * (c) Loïc Chardonnet <loic.chardonnet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gnugat\Bundle\WizardBundle\Model;

/**
 * @author Loïc Chardonnet <loic.chardonnet@gmail.com>
 */
class Bundle
{
    /**
     * @var string
     */
    public $fullyQualifiedClassname;

    /**
     * @param string $fullyQualifiedClassname
     */
    public function __construct($fullyQualifiedClassname)
    {
        $this->fullyQualifiedClassname = $fullyQualifiedClassname;
    }
}
