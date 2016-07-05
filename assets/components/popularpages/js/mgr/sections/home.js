Ext.onReady(function() {
	MODx.load({ xtype: 'popularpages-panel-home'});
});
popularPages.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'popularpages-panel-home'
			,renderTo: 'popularpages-panel-home-div'
		}]
	});
	popularPages.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(popularPages.page.Home, MODx.Component);
Ext.reg('popularpages-page-home', popularPages.page.Home);
