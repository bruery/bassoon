<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function __construct($environment, $debug)
    {
        // Please read http://symfony.com/doc/2.0/book/installation.html#configuration-and-setup
        bcscale(3);

        parent::__construct($environment, $debug);
    }

    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = array(
            // SYMFONY STANDARD EDITION
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),

            // Disable this if you don't want the audit on entities
            // should be decalred before doctrine bundle to allow overriding of default connection
            new SimpleThings\EntityAudit\SimpleThingsEntityAuditBundle(),
            new Bruery\EntityAuditBundle\BrueryEntityAuditBundle(),

            // DOCTRINE
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),

            // KNP HELPER BUNDLES
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),

            // SONATA FEATURE
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new Sonata\PageBundle\SonataPageBundle(),
            new Sonata\NewsBundle\SonataNewsBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),

            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),

            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),

            // API
            new FOS\RestBundle\FOSRestBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),

            // SONATA BUNDLES
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new FOS\CommentBundle\FOSCommentBundle(),
            new Sonata\CommentBundle\SonataCommentBundle(),

            // SONATA FOUNDATION
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),
            new Sonata\FormatterBundle\SonataFormatterBundle(),
            new Sonata\CacheBundle\SonataCacheBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\SeoBundle\SonataSeoBundle(),
            new Sonata\ClassificationBundle\SonataClassificationBundle(),
            new Sonata\NotificationBundle\SonataNotificationBundle(),
            new Sonata\DatagridBundle\SonataDatagridBundle(),

            // CMF Integration
            new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),

            new Mopa\Bundle\BootstrapBundle\MopaBootstrapBundle(),
            new Bruery\AdminBundle\BrueryAdminBundle(),
            new Bruery\CoreBundle\BrueryCoreBundle(),
            new Bruery\UserBundle\BrueryUserBundle(),
            new Bruery\DoctrineORMAdminBundle\BrueryDoctrineORMAdminBundle(),
            #new Bruery\DemoBundle\BrueryDemoBundle(),
            new Bruery\ClassificationBundle\BrueryClassificationBundle(),
            new Bruery\NewsBundle\BrueryNewsBundle(),
            new Bruery\MediaBundle\BrueryMediaBundle(),
            new Bruery\CommentBundle\BrueryCommentBundle(),
            new Bruery\PageBundle\BrueryPageBundle(),
            new Bruery\SeoBundle\BruerySeoBundle(),
            new Bruery\BlockBundle\BrueryBlockBundle(),
            new Bruery\RedirectBundle\BrueryRedirectBundle(),
            new Bruery\FormatterBundle\BrueryFormatterBundle(),
            new Bruery\CategoryPageBundle\BrueryCategoryPageBundle(),
            new Bruery\NewsPageBundle\BrueryNewsPageBundle(),
            new Bruery\AdvancePageBundle\BrueryAdvancePageBundle(),
            new Bruery\GoogleAPIClientBundle\BrueryGoogleAPIClientBundle(),
            new Bruery\SearchBundle\BruerySearchBundle(),
            new Bruery\UserSecurityBundle\BrueryUserSecurityBundle(),

            // Disable this if you don't want the timeline in the admin
            new Spy\TimelineBundle\SpyTimelineBundle(),
            new Sonata\TimelineBundle\SonataTimelineBundle(),
            new Bruery\TimelineBundle\BrueryTimelineBundle(),

            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            //new PHPMentors\WorkflowerBundle\PHPMentorsWorkflowerBundle(),

            //SSO Server for API
            //new Mosaic\SsoBundle\MosaicSsoBundle(),
            new FOS\OAuthServerBundle\FOSOAuthServerBundle(),
            new Bruery\OAuthServerBundle\BrueryOAuthServerBundle(),

            new AppBundle\AppBundle(),
            new App\TimelineBundle\AppTimelineBundle(),
            new Bruery\CoreBundle\BrueryCoreBundle(),
            new Bruery\DoctrineORMAdminBundle\BrueryDoctrineORMAdminBundle(),
            new Bruery\AdminBundle\BrueryAdminBundle(),
            new Bruery\BlockBundle\BrueryBlockBundle(),
            new Bruery\ClassificationBundle\BrueryClassificationBundle(),
            new Bruery\MediaBundle\BrueryMediaBundle(),
            new Bruery\FormatterBundle\BrueryFormatterBundle(),
            new Bruery\EntityAuditBundle\BrueryEntityAuditBundle(),
            new Bruery\TimelineBundle\BrueryTimelineBundle(),
            new Bruery\UserBundle\BrueryUserBundle(),
            new Bruery\UserSecurityBundle\BrueryUserSecurityBundle(),

        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Bazinga\Bundle\FakerBundle\BazingaFakerBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
