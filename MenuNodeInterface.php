<?php
/*
 * This file is part of Mindy Framework.
 * (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Menu;

interface MenuNodeInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string|null
     */
    public function getUrl();

    /**
     * @return MenuNodeInterface[]
     */
    public function getChildren(): array;

    /**
     * @return array
     */
    public function toArray(): array;
}
