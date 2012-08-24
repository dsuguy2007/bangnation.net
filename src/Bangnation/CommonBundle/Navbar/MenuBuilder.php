<?php
namespace Bangnation\CommonBundle\Navbar;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

/**
 * An example howto inject a default KnpMenu to the Navbar
 * see also Resources/config/example_menu.yml
 * and example_navbar.yml
 * @author phiamo
 *
 */
class MenuBuilder extends AbstractNavbarMenuBuilder
{
    protected $securityContext;
    protected $isLoggedIn;
    
    public function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext)
    {
        parent::__construct($factory);

        $this->securityContext = $securityContext;
        //$this->isLoggedIn = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');
        $this->isLoggedIn = $this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED');
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');

        if ($this->isLoggedIn) {
            $menu->addChild('Home', array('route' => 'welcome'));
        }

        return $menu;
    }
    
    public function createRightSideDropdownMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        if ($this->isLoggedIn) {
            $user = $this->securityContext->getToken()->getUser();

            if ($this->securityContext->isGranted('ROLE_PREVIOUS_ADMIN')) {
                $dropdown = $this->createDropdownMenuItem($menu, 'IMPERSONATING '.$user->getUsername(), false, array('icon' => 'caret'));
            } else {
                $dropdown = $this->createDropdownMenuItem($menu, 'Welcome '.$user->getUsername(), false, array('icon' => 'caret'));
            }
            $dropdown->addChild('Edit Profile', array('route' => 'fos_user_profile_edit'));
            $dropdown->addChild('Change Password', array('route' => 'fos_user_change_password'));
            $this->addDivider($dropdown);
            if ($this->securityContext->isGranted('ROLE_PREVIOUS_ADMIN')) {
                $dropdown->addChild('Stop Impersonating', array(
                    'route'=>'welcome',
                    'routeParameters' => array('_switch_user' => '_exit')
                ));
            } else {
                $dropdown->addChild('Logout', array('route' => 'fos_user_security_logout'));
            }

            if ($user->hasRole('ROLE_SUPER_ADMIN')) {
                $dropdown2 = $this->createDropdownMenuItem($menu, "Super Admin", false, array('icon' => 'caret'));
            } elseif ($user->hasRole('ROLE_ADMIN')) {
                $dropdown3 = $this->createDropdownMenuItem($menu, "Admin", false, array('icon' => 'caret'));
            }
        }
        
        return $menu;
    }
}
