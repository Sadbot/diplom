<?
namespace Sadbot\Bundle\VideoBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder
{
    /** @var ContainerInterface */
    private $container;


    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function createAdminMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        // dashboard
        $menu->addChild('Dashboard', array(
            'route' => 'backend_home'
        ))
        ;
        // quick links
        $menu->addChild('Quick links', array())->setAttribute('dropdown', true)
            ->addChild('New post', array(
                'route' => 'backend_post_new'
            ))->getParent()
            ->addChild('New category', array(
                'route' => 'backend_category_new'
            ))->getParent()
            ->addChild('New user', array(
                'route' => 'backend_user_new'
            ))->getParent()
            ->addChild('New link', array(
                'route' => 'backend_link_new'
            ))->getParent()
            ->addChild('New developer', array(
                'route' => 'backend_developer_new'
            ))->getParent()
            ->addChild('New project', array(
                'route' => 'backend_project_new'
            ))->getParent()
            ->addChild('New testimonial', array(
                'route' => 'backend_testimonial_new'
            ))->getParent()
            ->addChild('New skill', array(
                'route' => 'backend_skill_new'
            ))->getParent()
        ;


        // blog
        $menu->addChild('Blog', array())->setAttribute('dropdown', true)
            ->addChild('Posts', array(
                'route' => 'backend_post'
            ))->getParent()
            ->addChild('Categories', array(
                'route' => 'backend_category'
            ))->getParent()
        ;
        $menu->addChild('Misc', array())->setAttribute('dropdown', true)
            ->addChild('Links', array('route' => 'backend_link'))->getParent()
            ->addChild('Developers', array('route' => 'backend_developer'))->getParent()
            ->addChild('Skills', array('route' => 'backend_skill'))->getParent()
            ->addChild('Project', array('route' => 'backend_project'))->getParent()
            ->addChild('Testimonials', array('route' => 'backend_testimonial'))->getParent()
            ->addChild('Users', array('route' => 'backend_user'))->getParent();


        if ($this->container->get('session')->has('real_user_id')) {
            $menu->addChild('Deimpersonate', array('route' => 'backend_user_deimpersonate'));
        }
        $menu->addChild('Log out', array('route' => 'fos_user_security_logout'))->getParent();


        return $menu;
    }
}