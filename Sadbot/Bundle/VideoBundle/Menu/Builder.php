<?
namespace Sadbot\Bundle\VideoBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'collapse navbar-collapse');

            $menu->addChild('Home', array('route' => '_homepage'))
                ->setAttribute('icon', 'fa fa-home');
            $menu->addChild('Video', array('route' => '_video_homepage'))
                ->setAttribute('icon', 'fa fa-video-camera');
            $menu->addChild('Audio', array('route' => 'photo'))
                ->setAttribute('icon', 'fa fa-camera');
            $menu->addChild('Photo', array('route' => 'audio'))
                ->setAttribute('icon', 'fa fa-music');

        return $menu;
    }
}