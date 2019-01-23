<?php

namespace App\DataFixtures;

use App\Entity\Markdown;
use Doctrine\Common\Persistence\ObjectManager;

class MarkdownFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $markdown = new Markdown();
        $markdown
            ->setName('about_encounter')
            ->setMarkdown('##HOLY Markdown!

This is some *really* **awesome** ~~markdown~~! [Check Out Anchors!][Check out Anchors!]
[Check out Anchors!]: http://localhost:8000 "Check it out"

> This is a block quote! "Woooh"- Brice Thrower

- unordered list
- - unordered list
- - unordered list
- unordered list

1. Ordered List
1. 2. Ordered List
2. 3. Ordered List
4. Ordered List');
         $manager->persist($markdown);

        $manager->flush();
    }
}
