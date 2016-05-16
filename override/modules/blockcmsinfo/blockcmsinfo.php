<?php
/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

require_once _PS_MODULE_DIR_.'blockcmsinfo/classes/InfoBlock.php';

class BlockcmsinfoOverride extends Blockcmsinfo
{
	public $html = '';


	public function install()
	{
		return 	parent::install() &&
				$this->installDB() &&
				$this->registerHook('home') &&
				$this->registerHook('displayFooter') &&
				$this->installFixtures() &&
				$this->disableDevice(Context::DEVICE_TABLET | Context::DEVICE_MOBILE);
	}

	public function hookDisplayFooter($params)
	{
		
		$this->context->controller->addCSS($this->_path.'style.css', 'all');
		if (!$this->isCached('blockcmsinfo.tpl', $this->getCacheId()))
		{
			$infos = $this->getInfos($this->context->language->id, $this->context->shop->id);
			$this->context->smarty->assign(array('infos' => $infos, 'nbblocks' => count($infos)));
		}

		return $this->display(__FILE__, 'blockcmsinfo.tpl', $this->getCacheId());
	}

	
	public function installFixtures()
	{
		$return = true;
		$tab_texts = array(
			array(
				'text' => '<ul>
<li><em class="icon-shopping-cart" id="icon-shopping-cart"></em>
<div class="type-text">
<h3>¿Cómo comprar?</h3>
<p><a href="#">En sólo 4 simples pasos.</a></p>
</div>
</li>
<li><em class="icon-credit-card" id="icon-credit-card"></em>
<div class="type-text">
<h3>Opciones de pago</h3>
<p><a>En cuotas sin interés con tarjetas de crédito y con los medios de pago más </a><a>conocidos.</a></p>
</div>
</li>
<li><em class="icon-truck" id="icon-truck"></em>
<div class="type-text">
<h3>Envío a domicilio</h3>
<p>Contamos con servicio de envío a domicilio certificado.</p>
</div>
</li>
</ul>'
			),
			array(
				'text' => '<h3>¡Bienvenidos a Pili Deco!</h3>
<p>El lugar donde podés encontrar de todo para tu casa y más.</p>
<p>En <strong>Pili Deco</strong> priorizamos la estética y la practicidad.</p>
<p>Conocemos lo que necesitas y qué cosas te pueden resultar útiles. </p>
<p>Nos encanta acompañarte durante tu día a través de nuestros productos.</p>
<p>También podes encontrar nuestros productos a través de los <span style="text-decoration: underline; color: #2445a2;"><a href="http://pilideco.com.ar/shop/tiendas"><span style="color: #2445a2; text-decoration: underline;">Locales y Distribuidores Pili Deco. </span></a></span><span style="color: #000000;"></span></p>
<p><a href="http://pilideco.com.ar/shop/tiendas" class="btn btn-info">Buscá el más cercano.</a></p>'
			),
		);

		$shops_ids = Shop::getShops(true, null, true);
		$return = true;
		foreach ($tab_texts as $tab)
		{
			$info = new InfoBlock();
			foreach (Language::getLanguages(false) as $lang)
				$info->text[$lang['id_lang']] = $tab['text'];
			foreach ($shops_ids as $id_shop)
			{
				$info->id_shop = $id_shop;
				$return &= $info->add();
			}
		}

		return $return;
	}
}
