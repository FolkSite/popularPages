popularPages.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		border: false
		,baseCls: 'modx-formpanel'
		,cls: 'container'
		,items: [{
			html: '<h2>' + _('popularpages') + '</h2>'
			,border: false
			,cls: 'modx-page-header'
			,style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: { border: false, autoHeight: true },
			border: true,
			items: [{
				title: _('popularpages_settings')
				,defaults: { autoHeight: true }
				,items: [{
					html: '<p>'+_('popularpages_intro_msg')+'</p>'
					,border: false
					,cls: 'panel-desc'
				}, {
					xtype: 'popularpages-grid-settings'
					,cls: 'main-wrapper'
					,preventRender: true
				}]
			}]
		}]
	});
	popularPages.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(popularPages.panel.Home, MODx.Panel);
Ext.reg('popularpages-panel-home', popularPages.panel.Home);
