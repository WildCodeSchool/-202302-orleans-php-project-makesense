<?php

namespace App\DataFixtures;

use App\Entity\Decision;
use App\Entity\Status;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class StatusFixtures extends Fixture
{
    public const STATUS = [
        'Prise de décision commencée',
        'Première décision prise',
        'Conflit sur la décision',
        'Décision définitive',
        'Décision non aboutie',
        'Décision terminée'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::STATUS as $key => $statusName) {
            $status = new Status();
            $status->setName($statusName);
            $this->addReference('status_' . $key, $status);

            $manager->persist($status);
        }

        $manager->flush();
    }
}
