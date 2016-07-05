popularPages.combo.Period = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        store: new Ext.data.ArrayStore({
            id: 0
            ,fields: ['period','display']
            ,data: [
			['', _('popularpages_settings_combo_zero')]
			,['day', _('popularpages_settings_combo_day')]
			,['week', _('popularpages_settings_combo_week')]
			,['month', _('popularpages_settings_combo_month')]
			,['quarter', _('popularpages_settings_combo_quarter')]
			,['year', _('popularpages_settings_combo_year')]
		]
        })
        ,mode: 'local'
        ,displayField: 'display'
        ,valueField: 'period'
	,triggerAction: 'all'
        ,editable: false
        ,selectOnFocus: false
        ,preventRender: true
        ,forceSelection: true
        ,enableKeyEvents: true
    });
    
    popularPages.combo.Period.superclass.constructor.call(this,config);
};
Ext.extend(popularPages.combo.Period,MODx.combo.ComboBox);
Ext.reg('popularpages-combo-period',popularPages.combo.Period);


popularPages.combo.IsAuth = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		store: new Ext.data.ArrayStore({
			id: 0
			,fields: ['is_auth','display']
			,data: [
				[0, _('no')]
				,[1, _('yes')]
			]
		})
		,mode: 'local'
		,displayField: 'display'
		,valueField: 'is_auth'
		,triggerAction: 'all'
		,editable: false
		,selectOnFocus: false
		,preventRender: true
		,forceSelection: true
		,enableKeyEvents: true
	});
	popularPages.combo.IsAuth.superclass.constructor.call(this,config);
}
Ext.extend(popularPages.combo.IsAuth,MODx.combo.ComboBox);
Ext.reg('popularpages-combo-is_auth',popularPages.combo.IsAuth);