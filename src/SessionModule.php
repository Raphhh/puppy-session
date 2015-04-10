<?php
namespace Puppy\Session;

use Puppy\Application;
use Puppy\Module\IModule;

/**
 * Class SessionModule
 * @package Puppy\Session
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class SessionModule implements IModule
{
    /**
     * init the module.
     *
     * @param Application $application
     */
    public function init(Application $application)
    {
        $application->addService('session', new SessionService());
    }
}
