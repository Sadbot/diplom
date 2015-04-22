<?
namespace Sadbot\Bundle\VideoBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'homepage'));

        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        $photo = $em->getRepository('SadbotVideoBundle:Photo')->findAll();

        $menu->addChild('Latest photo post', array(
            'route' => '_photo_show',
            'routeParameters' => array('id' => $photo->getId())
        ));

        // create another menu item
        $menu->addChild('About Me', array('route' => 'about'));
        // you can also add sub level's to your menu's as follows
        $menu['About Me']->addChild('Edit profile', array('route' => 'fos_user_profile_edit'));

        // ... add more children

        return $menu;
    }
}