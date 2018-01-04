<?php

declare(strict_types=1);

/*
 * This file is part of Mindy Framework.
 * (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Menu;

class MenuNode implements MenuNodeInterface
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var MenuNodeInterface[]
     */
    protected $children = [];

    /**
     * MenuNode constructor.
     *
     * @param array $properties
     */
    public function __construct(array $properties = [])
    {
        if (array_key_exists('name', $properties)) {
            $this->setName($properties['name']);
        }
        if (array_key_exists('url', $properties)) {
            $this->setUrl($properties['url']);
        }
        if (array_key_exists('children', $properties)) {
            $this->setChildren($properties['children']);
        }
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param MenuNodeInterface[] $nodes
     */
    public function setChildren(array $nodes)
    {
        foreach ($nodes as $node) {
            $this->children[] = is_array($node) ? $this->createMenuNode($node) : $node;
        }
    }

    /**
     * @param array $node
     *
     * @return MenuNode
     */
    public function createMenuNode(array $node)
    {
        return new self($node);
    }

    /**
     * @return MenuNodeInterface[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'url' => $this->getUrl(),
            'children' => array_map(function (MenuNodeInterface $node) {
                return $node->toArray();
            }, $this->children),
        ];
    }
}
