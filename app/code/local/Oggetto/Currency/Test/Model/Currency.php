<?php 
/**
 * Oggetto currency extension for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php * 
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade
 * the Oggetto Address module to newer versions in the future.
 * If you wish to customize the Oggetto Address module for your needs
 * please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Oggetto
 * @package    Oggetto_Top
 * @copyright  Copyright (C) 2012 Oggetto Web ltd (http://oggettoweb.com/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Currency test case
 *
 * @category   Oggetto
 * @package    Oggetto_Currency
 * @subpackage Test
 * @author     Vladimir Fishchenko <fishchenko@oggettoweb.com>
 */
class Oggetto_Currency_Test_Model_Currency extends EcomDev_PHPUnit_Test_Case
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
