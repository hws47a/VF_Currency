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
class VF_Currency_Model_Core_Locale extends Mage_Core_Model_Locale
{
    /**
     * Functions returns array with price formating info for js function
     * formatCurrency in js/varien/js.js
     *
     * @return array
     */
    public function getJsPriceFormat()
    {
        $format = Zend_Locale_Data::getContent($this->getLocaleCode(), 'currencynumber');
        $symbols = Zend_Locale_Data::getList($this->getLocaleCode(), 'symbols');

        $pos = strpos($format, ';');
        if ($pos !== false) {
            $format = substr($format, 0, $pos);
        }
        $format = preg_replace("/[^0\#\.,]/", "", $format);
        $totalPrecision = 0;
        $decimalPoint = strpos($format, '.');
        if ($decimalPoint !== false) {
            $totalPrecision = (strlen($format) - (strrpos($format, '.')+1));
        } else {
            $decimalPoint = strlen($format);
        }
        
        //hook for changing precision
        $totalPrecision = VF_Currency_Model_Directory_Currency::PRECISION;

        $requiredPrecision = $totalPrecision;
        $temp = substr($format, $decimalPoint);
        $pos = strpos($temp, '#');
        if ($pos !== false) {
            $requiredPrecision = strlen($temp) - $pos - $totalPrecision;
        }
        $group = 0;
        if (strrpos($format, ',') !== false) {
            $group = ($decimalPoint - strrpos($format, ',') - 1);
        } else {
            $group = strrpos($format, '.');
        }
        $integerRequired = (strpos($format, '.') - strpos($format, '0'));

        $result = array(
            'pattern' => Mage::app()->getStore()->getCurrentCurrency()->getOutputFormat(),
            'precision' => $totalPrecision,
            'requiredPrecision' => $requiredPrecision,
            'decimalSymbol' => $symbols['decimal'],
            'groupSymbol' => $symbols['group'],
            'groupLength' => $group,
            'integerRequired' => $integerRequired
        );

        return $result;
    }
}
