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
 * Currency test case
 *
 * @category   VF
 * @package    VF_Currency
 * @subpackage Test
 * @author     Vladimir Fishchenko <vladimir@fishchenko.com>
 */
class VF_Currency_Test_Model_Currency extends EcomDev_PHPUnit_Test_Case
{
    /**
     * Test price value decoration
     * 
     * @test
     */
    public function testPriceDecoration()
    {
        $currency = Mage::getModel('directory/currency');

        $this->assertEquals(
            '$123,123',
            $currency->format(123123, array(), false)
        );

        $this->assertEquals(
            '<span class="price"><span class="currency">$</span><span class="value">123,123</span></span>',
            $currency->format(123123, array(), true)
        );
    }
}
