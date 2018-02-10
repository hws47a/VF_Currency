# VF_Currency

Module for Magento 1.*

It rounds all prices on frontend to integer value or to another precision.
For example, you have the price $304,53. After module installation, you will see on frontend $305.

You can change rounding precision in one constant: `VF_Currency_Model_Directory_Currency::PRECISION`
Default is `2`

Format also will been changed.
Instead of `$19.99` now u will see 
```
<span class="currency">$</span>
<span class="value">19.99</span>
```

## Install 
using either of these ways
* copy files to magento root
* using modman
* using composer:  
`composer config repositories.firegento composer https://packages.firegento.com`  
`composer require hws47a/currency`

To separate integer and fractional value set VF_Currency_Model_Directory_Currency::SEPARATE = true
u will see
```
<span class="currency">$</span>
<span class="int">19</span>
<span class="separator">.</span>
<span class="cent">99</span>
```
To do not show separator set `VF_Currency_Model_Directory_Currency::SHOW_SEPARATOR = false`

To set custom separator set `VF_Currency_Model_Directory_Currency::CUSTOM_SEPARTOR`