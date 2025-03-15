<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $categories = ['Chronique', 'Interview', 'Playlist', 'Actu'];
        $genres = ['Rap', 'Pop', 'Rock', 'Jazz', 'Electro'];
        $artists = ['Drake', 'Beyoncé', 'Travis Scott', 'Adele', 'Daft Punk'];
        $covers = [
            'drake_album.jpg',
            'beyonce_album.jpg',
            'travis_album.jpg',
            'adele_album.jpg',
            'daftpunk_album.jpg'
        ];

        for ($i = 0; $i < 5; $i++) {
            $article = new Article();

            $article->setTitle('Chronique de l\'album ' . $artists[$i]);
            $article->setContent('Découvrez notre avis sur le dernier projet de ' . $artists[$i]);
            $article->setCreatedAt(new \DateTimeImmutable());
            $article->setCategory($categories[array_rand($categories)]);
            $article->setGenre($genres[$i]);
            $article->setArtist($artists[$i]);
            $article->setCoverImage($covers[$i]);

            $author = $i % 2 === 0
                ? $this->getReference('jeremyy_prt', \App\Entity\User::class)
                : $this->getReference('melvinn_prt', \App\Entity\User::class);

            $article->setAuthor($author);

            $manager->persist($article);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}