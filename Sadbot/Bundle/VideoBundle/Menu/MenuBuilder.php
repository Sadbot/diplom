<?
namespace Sadbot\Bundle\VideoBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;


class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', array('route' => '_homepage'));

        $menu->addChild('Фото', array('route' => '_photo'));
        $menu->addChild('Видео', array('route' => '_video'));
        $menu->addChild('Аудио', array('route' => '_audio'));

        return $menu;
    }
}