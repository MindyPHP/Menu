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
     * @var MenuNodeInterface
     */
    protected $parent;

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
     * @param MenuNodeInterface $menuNode
     */
    public function setParent(MenuNodeInterface $menuNode)
    {
        $this->parent = $menuNode;
    }

    /**
     * @return MenuNodeInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'parent' => $this->parent ? $this->parent->toArray() : null
        ];
    }
}
