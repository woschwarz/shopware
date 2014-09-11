<?php
/**
 * Shopware 4
 * Copyright © shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

/**
 * Returns the current time measured in the number of seconds
 * since the Unix Epoch (January 1 1970 00:00:00 GMT).
 */
function smarty_function_themeTimestamp($params, $template)
{
    /**@var $pathResolver \Shopware\Components\Theme\PathResolver*/
    $pathResolver = Shopware()->Container()->get('theme_path_resolver');
    $context = Shopware()->Container()->get('context_service_core')->getShopContext();
    $shopId = $context->getShop()->getParentId();

    $file = $pathResolver->getCacheDirectory() . DIRECTORY_SEPARATOR . 'timestamp' . $shopId . '.txt';

    if (file_exists($file)) {
        $timestamp = file_get_contents($file);
    } else {
        $timestamp = time();
        file_put_contents($file, $timestamp);
    }

    return $timestamp;
}