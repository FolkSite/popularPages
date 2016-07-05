var popularPages = function (config) {
	config = config || {};
	popularPages.superclass.constructor.call(this, config);
};
Ext.extend(popularPages, Ext.Component, {
	page: {}, grid: {}, panel: {}, config: {}, view: {}, utils: {}, combo:{}
});
Ext.reg('popularpages', popularPages);

popularPages = new popularPages();
