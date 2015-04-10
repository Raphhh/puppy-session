<?php
namespace Puppy\Session;

/**
 * Class SessionTest
 * @package Puppy\Service
 * @author Raphaël Lefebvre <raphael@raphaellefebvre.be>
 */
class SessionServiceTest extends \PHPUnit_Framework_TestCase
{

    public function test__invokeWithoutConfig()
    {
        $template = new SessionService();
        $this->setExpectedException(
            'InvalidArgumentException',
            'Service "config" not found'
        );
        $template(new \ArrayObject());
    }


    public function test__invoke()
    {
        $services = new \ArrayObject();
        $services['config'] = new \ArrayObject([
            'session.sessionStorageClass' => 'Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage'
        ]);

        $session = new SessionService();
        $result = $session($services);
        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Session\Session', $result);

        /**
         * @var \Symfony\Component\HttpFoundation\Session\Session $result
         */
        $this->assertTrue($result->isStarted());

    }
}
 