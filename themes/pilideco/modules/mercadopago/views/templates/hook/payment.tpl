{**
 * Mercadopago Payments Module for Prestashop
 *
 * Based on the Prestashop 1.5.6.0 form.tpl
 *
 * @author    Rinku Kazeno <development@kazeno.co>
 *
 * @copyright Copyright (c) 2012-2015, Rinku Kazeno
 * @license   This module is licensed to the user, upon purchase
 *  from either Prestashop Addons or directly from the author,
 *  for use on a single commercial Prestashop install, plus an
 *  optional separate non-commercial install (for development/testing
 *  purposes only). This license is non-assignable and non-transferable.
 *  To use in additional Prestashop installations an additional
 *  license of the module must be purchased for each one.
 *
 *  The user may modify the source of this module to suit their
 *  own business needs, as long as no distribution of either the
 *  original module or the user-modified version is made.
 *
 * @file-version 1.8
 *}
<div class="col-xs-12 col-md-6">
<p class="payment_module">
    <a href="{$paymentPath|escape:'html':'UTF-8'}" title="{$buttonText|escape:'html':'UTF-8'}">
        <img src="{$imagePath|escape:'html':'UTF-8'}{$imageName|escape:'html':'UTF-8'}" alt="{$buttonText|escape:'html':'UTF-8'}" style="max-height: 46px;" />
        {$buttonText|escape:'html':'UTF-8'}
        {if $buttonText2}<br/><span><i>{$buttonText2|escape:'html':'UTF-8'}</i></span><br/>{/if}
        {if $mpFee}<br/><strong>{$mpFee|escape:'html':'UTF-8'}</strong>{/if}
        {if $sandboxMode}<br/><br/><span class="warning alert alert-warning">{$sandboxMode|escape:'html':'UTF-8'}</span>{/if}
    </a>
</p>
</div>
<script>//<!--      loader image preloading to cache
    $('<img src="{$imagePath|escape:'html':'UTF-8'}loading.gif" />');
//--></script>