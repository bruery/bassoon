<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\Bundle\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Category fixtures loader.
 *
 * @author Sylvain Deloux <sylvain.deloux@ekino.com>
 */
class LoadCollectionData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Returns the Sonata MediaManager.
     *
     * @return \Sonata\CoreBundle\Model\ManagerInterface
     */
    public function getCollectionManager()
    {
        return $this->container->get('sonata.classification.manager.collection');
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //GALLERY
        $context = $this->getReference('context-gallery');

        $collection = $this->getCollectionManager()->create();
        $collection->setName('Featured Gallery');
        $collection->setDescription('Featured Gallery');
        $collection->setSlug('featured-gallery');
        $collection->setEnabled(true);
        $collection->setContext($context);

        $this->setReference('collection-featured-gallery', $collection);
        $this->getCollectionManager()->save($collection);


        //USER DEMOGRAPHICS
        $context = $this->getReference('context-user-age-demographics');

        $collection = $this->getCollectionManager()->create();
        $collection->setName('12-17 years old');
        $collection->setDescription('12-17 years old');
        $collection->setSlug('12-17-years-old');
        $collection->setEnabled(true);
        $collection->setContext($context);

        $this->setReference('collection-12-17-years-old', $collection);
        $this->getCollectionManager()->save($collection);

        $collection = $this->getCollectionManager()->create();
        $collection->setName('18-24 years old');
        $collection->setDescription('18-24 years old');
        $collection->setSlug('18-24-years-old');
        $collection->setEnabled(true);
        $collection->setContext($context);

        $this->setReference('collection-18-24-years-old', $collection);
        $this->getCollectionManager()->save($collection);

        $collection = $this->getCollectionManager()->create();
        $collection->setName('25-34 years old');
        $collection->setDescription('25-34 years old');
        $collection->setSlug('25-34-years-old');
        $collection->setEnabled(true);
        $collection->setContext($context);

        $this->setReference('collection-25-34-years-old', $collection);
        $this->getCollectionManager()->save($collection);

        $collection = $this->getCollectionManager()->create();
        $collection->setName('35-44 years old');
        $collection->setDescription('35-44 years old');
        $collection->setSlug('35-44-years-old');
        $collection->setEnabled(true);
        $collection->setContext($context);

        $this->setReference('collection-35-44-years-old', $collection);
        $this->getCollectionManager()->save($collection);

        $collection = $this->getCollectionManager()->create();
        $collection->setName('45-54 years old');
        $collection->setDescription('45-54 years old');
        $collection->setSlug('45-54-years-old');
        $collection->setEnabled(true);
        $collection->setContext($context);

        $this->setReference('collection-45-54-years-old', $collection);
        $this->getCollectionManager()->save($collection);

        $collection = $this->getCollectionManager()->create();
        $collection->setName('55-64 years old');
        $collection->setDescription('55-64 years old');
        $collection->setSlug('55-64-years-old');
        $collection->setEnabled(true);
        $collection->setContext($context);

        $this->setReference('collection-55-64-years-old', $collection);
        $this->getCollectionManager()->save($collection);

        $collection = $this->getCollectionManager()->create();
        $collection->setName('65-74 years old');
        $collection->setDescription('65-74 years old');
        $collection->setSlug('65-74-years-old');
        $collection->setEnabled(true);
        $collection->setContext($context);

        $this->setReference('collection-65-74-years-old', $collection);
        $this->getCollectionManager()->save($collection);

        $collection = $this->getCollectionManager()->create();
        $collection->setName('Under 12 years old');
        $collection->setDescription('Under 12 years old');
        $collection->setSlug('under-12-years-old');
        $collection->setEnabled(true);
        $collection->setContext($context);

        $this->setReference('collection-under-12-years-old', $collection);
        $this->getCollectionManager()->save($collection);

        $collection = $this->getCollectionManager()->create();
        $collection->setName('75 years or older');
        $collection->setDescription('75 years or older');
        $collection->setSlug('75-years-or-older');
        $collection->setEnabled(true);
        $collection->setContext($context);

        $this->setReference('collection-75-years-or-older', $collection);
        $this->getCollectionManager()->save($collection);

        $manager->flush();
    }
}
