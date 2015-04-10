<?php
namespace Puppy\Session;

use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBagInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

/**
 * Class Session
 * @package Puppy\Service
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class SessionService
{
    /**
     * @param \ArrayAccess $services
     * @throws \InvalidArgumentException
     * @return SymfonySession
     */
    public function __invoke(\ArrayAccess $services)
    {
        if (empty($services['config'])) {
            throw new \InvalidArgumentException('Service "config" not found');
        }

        $session = new SymfonySession(
            $this->getSessionStorage($services['config']),
            $this->getAttributeBag($services['config']),
            $this->getFlashBag($services['config'])
        );
        $session->start();
        return $session;
    }

    /**
     * @param \ArrayAccess $config
     * @return SessionStorageInterface|null
     */
    private function getSessionStorage(\ArrayAccess $config)
    {
        return isset($config['session.sessionStorageClass']) ? new $config['session.sessionStorageClass'] : null;
    }

    /**
     * @param \ArrayAccess $config
     * @return AttributeBagInterface|null
     */
    private function getAttributeBag(\ArrayAccess $config)
    {
        return isset($config['session.attributeBagClass']) ? new $config['session.attributeBagClass'] : null;
    }

    /**
     * @param \ArrayAccess $config
     * @return FlashBagInterface|null
     */
    private function getFlashBag(\ArrayAccess $config)
    {
        return isset($config['session.flashBagClass']) ? new $config['session.flashBagClass'] : null;
    }
}
