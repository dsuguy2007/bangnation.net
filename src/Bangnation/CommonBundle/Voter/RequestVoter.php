<?php
namespace Bangnation\CommonBundle\Voter;

use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Voter\VoterInterface;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Voter based on the uri
 */
class RequestVoter implements VoterInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Checks whether an item is current.
     *
     * If the voter is not able to determine a result,
     * it should return null to let other voters do the job.
     *
     * @param ItemInterface $item
     * @return boolean|null
     */
    public function matchItem(ItemInterface $item)
    {
//        if ($item->getUri() === $this->container->get('request')->getRequestUri()) {
        $url = $this->container->get('request')->getBaseUrl() . $this->container->get('request')->getPathInfo();
        //$routeName = $request->get('_route');
        
        if ($item->getUri() === $url) {
            return true;
        }

        return null;
    }
}