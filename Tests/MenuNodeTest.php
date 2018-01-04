<?php

/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Menu\Tests;

use Mindy\Menu\MenuNode;
use Mindy\Menu\MenuNodeInterface;
use PHPUnit\Framework\TestCase;

class MenuNodeTest extends TestCase
{
    public function testMenuNode()
    {
        $parent = new MenuNode();
        $parent->setName('parent');

        $node = new MenuNode();

        $node->setName('test');
        $this->assertSame('test', $node->getName());

        $node->setUrl('/foo/bar/');
        $this->assertSame('/foo/bar/', $node->getUrl());

        $node->setParent($parent);

        $this->assertInstanceOf(MenuNodeInterface::class, $node->getParent());
        $this->assertSame('parent', $node->getParent()->getName());

        $this->assertSame([
            'name' => 'test',
            'url' => '/foo/bar/',
            'parent' => [
                'name' => 'parent',
                'url' => null,
                'parent' => null,
            ]
        ], $node->toArray());
    }
}
