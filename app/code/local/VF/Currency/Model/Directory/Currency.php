<?php
/**
 * VF extension for Magento
 *
 * @category   VF
 * @package    VF_Currency
 * @copyright  Copyright (C) 2011-2018 Vladimir Fishchenko (https://fishchenko.com/)
 * @license    MIT
 */

/**
 * Currency Model
 *
 * @category   VF
 * @package    VF_Currency
 * @subpackage Model
 * @author     Vladimir Fishchenko <vladimir@fishchenko.com>
 */
class VF_Currency_Model_Directory_Currency extends Mage_Directory_Model_Currency
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
