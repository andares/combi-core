<?php

namespace Combi\Core\Interfaces;

use Combi\{
    Helper as helper,
    Abort as abort,
    Runtime as rt
};

/**
 *
 * @author andares
 */
interface LinkPackage {
    public function linkPackage(\Combi\Package $package);
}
