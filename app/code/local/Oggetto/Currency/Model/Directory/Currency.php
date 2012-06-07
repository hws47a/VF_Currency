<?php
/**
 * Oggetto extension for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the Oggetto Currency module to newer versions in the future.
 * If you wish to customize the Oggetto Currency module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Oggetto
 * @package    Oggetto_Currency
 * @copyright  Copyright (C) 2012 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Currency Model
 *
 * @category   Oggetto
 * @package    Oggetto_Currency
 * @subpackage Model
 * @author     Vladimir Fishchenko <fishchenko@oggettoweb.com>
 */
class Oggetto_Currency_Model_Directory_Currency extends Mage_Directory_Model_Currency
{
    const PRECISION = 2;
    const SEPARATE = false;
    const SHOW_SEPARATOR = true;
    const CUSTOM_SEPARATOR = null;

    /**
     * Format price to currency format
     *
     * @param   double $price
     * @param   array $options
     * @param   bool $includeContainer
     * @param   bool $addBrackets
     * @return  string
     */
    public function format($price, $options = array(), $includeContainer = true, $addBrackets = false)
    {
        $separator = '.';
        if (self::SEPARATE && self::PRECISION) {
            $options['format'] = '<span class="currency">¤</span>#,##0.00';
            $format = $this->formatPrecision($price, self::PRECISION, $options, $includeContainer, $addBrackets);
            $options['format'] = '#,##0.00';
            $formatBase = $this->formatPrecision($price, self::PRECISION, $options, false, $addBrackets);
            $priceFormatted = explode($separator, $formatBase);
            $priceFormatted[0] = '<span class="int">' . $priceFormatted[0] . '</span>';
            $priceFormatted[1] = '<span class="cent">' . $priceFormatted[1] . '</span>';
            if (self::SHOW_SEPARATOR) {
                if (self::CUSTOM_SEPARATOR) {
                    $separator = self::CUSTOM_SEPARATOR;
                }
                $separator = '<span class="separator">' . $separator . '</span>';
            } else {
                $separator = '';
            }
            $priceFormatted = implode($separator, $priceFormatted);
            $format = str_replace($formatBase, $priceFormatted, $format);
            return $format;
        } else {
            $options['format'] = '<span class="currency">¤</span><span class="value">#,##0.00</span>';
            $format = $this->formatPrecision($price, self::PRECISION, $options, $includeContainer, $addBrackets);
            if (self::CUSTOM_SEPARATOR) {
                $format = str_replace($separator, self::CUSTOM_SEPARATOR, $format);
            }
            return $format;
        }
    }
}
