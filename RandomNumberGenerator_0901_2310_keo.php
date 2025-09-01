<?php
// 代码生成时间: 2025-09-01 23:10:51
 * It includes error handling and is designed to be easy to understand and maintain.
 */

namespace Application\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RandomNumberGenerator implements ServiceLocatorAwareInterface
{
    /**
     * The service locator
     *
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * The minimum number in the range
     *
     * @var int
     */
    protected $min;

    /**
     * The maximum number in the range
     *
     * @var int
     */
    protected $max;

    /**
     * Constructor
     *
     * @param int $min The minimum number in the range
     * @param int $max The maximum number in the range
     */
    public function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Set the service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return void
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get the service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Generate a random number within the specified range
     *
     * @return int The generated random number
     * @throws \InvalidArgumentException If the range is invalid
     */
    public function generate()
    {
        if ($this->min > $this->max) {
            throw new \InvalidArgumentException('The minimum value cannot be greater than the maximum value');
        }

        return rand($this->min, $this->max);
    }
}
