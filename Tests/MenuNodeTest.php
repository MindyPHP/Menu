<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Menu\Tests;

use Mindy\Menu\Generator;
use Mindy\Menu\MenuNode;
use PHPUnit\Framework\TestCase;

class MenuNodeTest extends TestCase
{
    public function testMenuNode()
    {
        $parent = new MenuNode();
        $parent->setName('parent');
        $this->assertSame('parent', $parent->getName());

        $node = new MenuNode();
        $node->setName('test');
        $this->assertSame('test', $node->getName());
        $node->setUrl('/foo/bar/');
        $this->assertSame('/foo/bar/', $node->getUrl());

        $parent->setChildren([
            $node
        ]);

        $this->assertSame([
            'name' => 'parent',
            'url' => null,
            'children' => [
                [
                    'name' => 'test',
                    'url' => '/foo/bar/',
                    'children' => []
                ]
            ]
        ], $parent->toArray());
    }

    public function testMenuNodeConstructor()
    {
        $parent = new MenuNode([
            'name' => 'parent',
            'children' => [
                [
                    'name' => 'test',
                    'url' => '/foo/bar/',
                ]
            ],
        ]);

        $this->assertSame([
            'name' => 'parent',
            'url' => null,
            'children' => [
                [
                    'name' => 'test',
                    'url' => '/foo/bar/',
                    'children' => []
                ]
            ]
        ], $parent->toArray());
    }

    public function testGenerator()
    {
        $source = [
            [
                'name' => 'parent 1',
                'url' => '/parent_1',
                'children' => [
                    [
                        'name' => 'about',
                        'url' => '/parent_1/about',
                        'children' => [
                            ['name' => 'foo'],
                            ['name' => 'bar']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'parent 2',
                'url' => '/parent_2',
                'children' => [
                    [
                        'name' => 'about',
                        'url' => '/parent_2/about',
                        'children' => [
                            ['name' => 'foo'],
                            ['name' => 'bar']
                        ]
                    ]
                ]
            ]
        ];

        $this->assertCount(2, Generator::fromArray($source));

        $generator = Generator::fromArray($source);
        $parent1 = $generator->current();
        $this->assertSame('parent 1', $parent1->getName());
        $generator->next();
        $parent2 = $generator->current();
        $this->assertSame('parent 2', $parent2->getName());
        $this->assertCount(1, $parent2->getChildren());
    }
}
