<?php

namespace App\DataFixtures;

use App\Entity\Phones;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PhonesFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager parameter
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {

        $phones = [
            ['model' => 'Galaxy S23 Ultra 512Go | 12 Go', 'brand' => 'Samsung', 'color' => 'Vert', 'price' => '1339'],
            ['model' => 'iPhone 14 Pro Max 512Go | 8 Go', 'brand' => 'Apple', 'color' => 'Gris Sidéral', 'price' => '1499'],
            ['model' => 'OnePlus 10 Pro 256Go | 12 Go', 'brand' => 'OnePlus', 'color' => 'Bleu Nébuleuse', 'price' => '999'],
            ['model' => 'Xperia 2 256Go | 8 Go', 'brand' => 'Sony', 'color' => 'Noir', 'price' => '899'],
            ['model' => 'Pixel 7 XL 128Go | 8 Go', 'brand' => 'Google', 'color' => 'Blanc', 'price' => '849'],
            ['model' => 'Mate 50 Pro 256Go | 12 Go', 'brand' => 'Huawei', 'color' => 'Bleu Ciel', 'price' => '1099'],
            ['model' => 'Mi 12 256Go | 8 Go', 'brand' => 'Xiaomi', 'color' => 'Argent', 'price' => '999'],
            ['model' => 'Reno 8 Pro 128Go | 6 Go', 'brand' => 'Oppo', 'color' => 'Rose', 'price' => '799'],
            ['model' => 'Nord 3 128Go | 6 Go', 'brand' => 'OnePlus', 'color' => 'Bleu Glacier', 'price' => '699'],
            ['model' => 'Galaxy Z Fold 4 256Go | 16 Go', 'brand' => 'Samsung', 'color' => 'Noir Mystique', 'price' => '1899'],
            ['model' => 'Mi 12 Lite 128Go | 6 Go', 'brand' => 'Xiaomi', 'color' => 'Or Rose', 'price' => '499'],
            ['model' => 'Xperia 3 256Go | 8 Go', 'brand' => 'Sony', 'color' => 'Bleu Océan', 'price' => '949'],
            ['model' => 'Pixel 7 128Go | 6 Go', 'brand' => 'Google', 'color' => 'Rouge Flamme', 'price' => '749'],
            ['model' => 'iPhone 14 Mini 128Go | 6 Go', 'brand' => 'Apple', 'color' => 'Argent', 'price' => '799'],
            ['model' => 'Mate 50 128Go | 6 Go', 'brand' => 'Huawei', 'color' => 'Noir Carbone', 'price' => '699'],
            ['model' => 'Galaxy A53 128Go | 6 Go', 'brand' => 'Samsung', 'color' => 'Bleu Azur', 'price' => '399'],
            ['model' => 'Nord 3T 128Go | 6 Go', 'brand' => 'OnePlus', 'color' => 'Argent Lunaire', 'price' => '699'],
            ['model' => 'Mi Mix 5 256Go | 12 Go', 'brand' => 'Xiaomi', 'color' => 'Noir Ébène', 'price' => '1199'],
            ['model' => 'Reno 8 Lite 64Go | 4 Go', 'brand' => 'Oppo', 'color' => 'Blanc Perle', 'price' => '299'],
            ['model' => 'Pixel 7a 64Go | 4 Go', 'brand' => 'Google', 'color' => 'Bleu Ciel', 'price' => '349'],
            ['model' => 'iPhone 14 SE 64Go | 4 Go', 'brand' => 'Apple', 'color' => 'Rose Poudré', 'price' => '499'],
            ['model' => 'Galaxy A33 64Go | 4 Go', 'brand' => 'Samsung', 'color' => 'Vert Forêt', 'price' => '349'],
            ['model' => 'Mi Note 11 128Go | 6 Go', 'brand' => 'Xiaomi', 'color' => 'Or Champagne', 'price' => '499'],
            ['model' => 'Xperia Compact 256Go | 8 Go', 'brand' => 'Sony', 'color' => 'Bleu Nuit', 'price' => '799'],
            ['model' => 'Nord N200 64Go | 4 Go', 'brand' => 'OnePlus', 'color' => 'Gris Métal', 'price' => '249'],
            ['model' => 'Galaxy Z Flip 3 128Go | 8 Go', 'brand' => 'Samsung', 'color' => 'Violet Lavande', 'price' => '1199'],
            ['model' => 'Mi 12 Pro 512Go | 16 Go', 'brand' => 'Xiaomi', 'color' => 'Or Brillant', 'price' => '1499'],
            ['model' => 'Reno 8 256Go | 12 Go', 'brand' => 'Oppo', 'color' => 'Argent Galactique', 'price' => '999'],
            ['model' => 'Pixel 7 Pro 256Go | 8 Go', 'brand' => 'Google', 'color' => 'Bleu Électrique', 'price' => '1099'],
            ['model' => 'iPhone 14 256Go | 8 Go', 'brand' => 'Apple', 'color' => 'Or Rose', 'price' => '1299'],
            ['model' => 'Galaxy A73 128Go | 6 Go', 'brand' => 'Samsung', 'color' => 'Gris Titane', 'price' => '449'],
            ['model' => 'Mate 50 Lite 128Go | 6 Go', 'brand' => 'Huawei', 'color' => 'Rouge Cerise', 'price' => '399'],
            ['model' => 'Xperia 4 128Go | 6 Go', 'brand' => 'Sony', 'color' => 'Bleu Glacier', 'price' => '699'],
            ['model' => 'Mi 12 Lite Pro 128Go | 6 Go', 'brand' => 'Xiaomi', 'color' => 'Noir Onyx', 'price' => '499'],
            ['model' => 'Nord 3 Pro 256Go | 8 Go', 'brand' => 'OnePlus', 'color' => 'Bleu Céleste', 'price' => '999'],
            ['model' => 'Galaxy Z Fold Lite 256Go | 12 Go', 'brand' => 'Samsung', 'color' => 'Argent Lune', 'price' => '1299'],
            ['model' => 'Pixel 7 Lite 64Go | 4 Go', 'brand' => 'Google', 'color' => 'Blanc Alpin', 'price' => '349'],
            ['model' => 'Mate 50 Pro Lite 128Go | 6 Go', 'brand' => 'Huawei', 'color' => 'Rose Poudré', 'price' => '449'],
            ['model' => 'Mi 12 Note 256Go | 8 Go', 'brand' => 'Xiaomi', 'color' => 'Bleu Océan', 'price' => '899'],
            ['model' => 'Xperia 5a 128Go | 6 Go', 'brand' => 'Sony', 'color' => 'Noir Minuit', 'price' => '699'],
            ['model' => 'Reno 8 Lite Pro 128Go | 6 Go', 'brand' => 'Oppo', 'color' => 'Vert Olive', 'price' => '499'],
            ['model' => 'iPhone 14 Plus 256Go | 8 Go', 'brand' => 'Apple', 'color' => 'Bleu Nuit', 'price' => '1199'],
            ['model' => 'Galaxy A83 128Go | 6 Go', 'brand' => 'Samsung', 'color' => 'Or Champagne', 'price' => '499'],
            ['model' => 'Nord 3 Pro Max 256Go | 12 Go', 'brand' => 'OnePlus', 'color' => 'Noir Carbone', 'price' => '1299'],
        ];

        foreach ($phones as $phone) {
            $phoneEntity = new Phones();

            $phoneEntity->setModel($phone['model']);
            $phoneEntity->setBrand($phone['brand']);
            $phoneEntity->setColor($phone['color']);
            $phoneEntity->setPrice(floatval($phone['price']));

            $manager->persist($phoneEntity);
        }

        $manager->flush();
    }
}
