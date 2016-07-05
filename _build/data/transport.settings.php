<?php

$settings = array();

$tmp = array(
	'ignore_group' => array(
		'xtype' => 'textfield',
		'value' => '1',
		'area' => 'popularpages_main',
	),
	'bots_list' => array(
		'xtype' => 'textarea',
		'value' => 'rambler,googlebot,aport,yahoo,msnbot,turtle,mail.ru,omsktele,yetibot,picsearch,sape.bot,sape_context,gigabot,snapbot,alexa.com,megadownload.net,askpeter.info,igde.ru,ask.com,qwartabot,yanga.co.uk,scoutjet,similarpages,oozbot,shrinktheweb.com,aboutusbot,followsite.com,dataparksearch,google-sitemaps,appEngine-google,feedfetcher-google,liveinternet.ru,xml-sitemaps.com,agama,metadatalabs.com,h1.hrn.ru,googlealert.com,seo-rus.com,yaDirectBot,yandeG,yandex,yandexSomething,Copyscape.com,AdsBot-Google,domaintools.com,Nigma.ru,bing.com,dotnetdotcom',
		'area' => 'popularpages_main',
	),
);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => 'popularpages_' . $k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
