<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Package;
use App\Entity\ShippingInfo;
use App\Entity\ShippingPrice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Uid\Uuid;

class Basic extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $spMug = new ShippingPrice(200, 500, 100, 250, 10);
        $spTs = new ShippingPrice(100, 300, 50, 150, 10);
        
        $mug = new Item(Uuid::v4()->toRfc4122(), 0, 'muggy', $spMug);
        $ts = new Item(Uuid::v4()->toRfc4122(), 0, 't-short', $spTs);

        $p1 = new Package(3, $mug);
        $p2 = new Package(1, $ts);

        $c = new Customer();
        $si = new ShippingInfo(
            'US',
            '',
            '???',
            '123',
            'me',
            null,
            'XX',
            null
        );
// TODO: calc price
        $o = new Order(500, $si, new ArrayCollection([$p1, $p2]), $c);

        $manager->persist($o);
        $manager->flush();
    }
}
