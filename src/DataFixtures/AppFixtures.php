<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Collections;
use App\Entity\Cars;

class AppFixtures extends Fixture
{
	/**
	     * Generates initialization data for cars : [modèle, marque,type]
	     * @return \\Generator
	     */
	    private static function carsDataGenerator()
	    {   		
	        yield ["Porsche 911 GT3", "Porsche","Sport"];
	        yield ["1967 Mustang", "Ford ","Vintage"];
	        yield ["Model X ", "Tesla","Electric"];
	        yield ["Mercedes-Benz S-Class", "Mercedes-Benz","Luxury"];
	    }
	    
	    /**
	     * Generates initialization data for film recommendations:
	     *  [film_title, film_year, recommendation]
	     * @return \\Generator
	     */
	    private static function collectionsGenerator()
	    {
	        yield ["Luxury","This collection contains luxury cars"];
	        yield ["Sport","Sport car fans we got you!"];
	        yield ["Vintage","Old is gold"];
	        yield ["Electric", "Not everyone hate Tesla"];
			
	    }
	    
	    public function load(ObjectManager $manager)
	    {
	        $collectionsRepo = $manager->getRepository(Collections::class);
	        
	        foreach (self::collectionsGenerator() as [$title, $description] ) {
	            $collection = new Collections();
	            $collection->setTitle($title);
	            $collection->setDescription($description);
	            $manager->persist($collection);
	        }
	        $manager->flush();
	        
	        foreach (self::carsDataGenerator() as [$modèle, $marque,$type])
	        {
	            $collection = $collectionsRepo->findOneBy(['title' => $type]);
				$car = new Cars();
			 	$car->setModèle($modèle);
	            $car->setMarque($marque);
	            $car->setType($type);
	            $collection->addCar($car);
	            // there's a cascade persist on fim-recommendations which avoids persisting down the relation
	            $manager->persist($collection);
	        }
	        $manager->flush();
	    }
}
