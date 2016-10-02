<?php
/**
 * This file is part of the UrlShortener package.
 *
 * (c) Nikolay Baev aka Monster3D <gametester3d@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monster3D\Shortener\Interfaces;

/**
 * @package         DriverInterface
 * @author          Nikolay Baev <gametester3d@gmail.com>
 * @copyright       Nikolay Baev <gametester3d@gmail.com>
 * @license         http://opensource.org/licenses/mit-license.php  The MIT License (MIT)
 * @link            https://github.com/Monster3D/php-url-shortenert
 */

 interface DriverInterface 
 {
     /**
     * Initialization request driver
     *
     */

     function init($setting);
     /**
     * Get current inited driver
     *
     */
     function getDriver();
 }