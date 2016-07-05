popularPages.grid.Settings = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		id: 'popularpages-grid-settings'
		,url: popularPages.config.connector_url
		,fields: ['id', 'period', 'createdon', 'deletedon', 'active', 'is_auth', 'actions']
		,baseParams: { action: 'mgr/settings/getlist' }
		,save_action: 'mgr/settings/updatefromgrid'
		,autosave: true
		,preventSaveRefresh: false
		,anchor: '97%'
		,sm: new Ext.grid.CheckboxSelectionModel()
		,baseParams: { action: 'mgr/settings/getlist' }
		,viewConfig: {
			forceFit: true
			,getRowClass: function (rec) {
				return !rec.data.active
					? 'popularpages-grid-row-disabled'
					: '';
			}
		}
		,columns: [{
			header: _('id')
			,dataIndex: 'id'
			,sortable: false
			,width: 60
		},{
			header: _('popularpages_settings_period')
			,dataIndex: 'period'
			,sortable: false
			,width: 150
			,editor: { xtype: 'popularpages-combo-period',renderer: true }
		},{
			header: _('popularpages_settings_createdon')
			,dataIndex: 'createdon'
			,sortable: false
			,width: 200
		},{
			header: _('popularpages_settings_deletedon')
			,dataIndex: 'deletedon'
			,sortable: false
			,width: 200
		},{
			header: _('popularpages_settings_is_auth')
			,dataIndex: 'is_auth'
			,sortable: false
			,width: 150
			,editor: { xtype: 'popularpages-combo-is_auth',renderer: true }
		},{
			header: _('popularpages_settings_active')
			,dataIndex: 'active'
			,renderer: popularPages.utils.renderBoolean
			,sortable: false
			,width: 100
		},{
			header: _('popularpages_grid_actions')
			,dataIndex: 'actions'
			,renderer: popularPages.utils.renderActions
			,sortable: false
			,width: 100
			,id: 'actions'
		}]
	
	});
	
	popularPages.grid.Settings.superclass.constructor.call(this, config);
	
	this.store.on('load', function () {
		if (this._getSelectedIds().length) {
			this.getSelectionModel().clearSelections();
		}
	}, this);
}
Ext.extend(popularPages.grid.Settings, MODx.grid.Grid, {
	getMenu: function (grid, rowIndex) {
		var ids = this._getSelectedIds();

		var row = grid.getStore().getAt(rowIndex);
		var menu = popularPages.utils.getMenu(row.data['actions'], this, ids);
		
		this.addContextMenuItem(menu);
	}
	,enableSettings: function (act, btn, e) {
		var ids = this._getSelectedIds();
		if (!ids.length) {
			return false;
		}
		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/settings/enable',
				ids: Ext.util.JSON.encode(ids),
			},
			listeners: {
				success: {
					fn: function () {
						this.refresh();
					}, scope: this
				}
			}
		})
	}
	,disableSettings: function () {
		var ids = this._getSelectedIds();
		if (!ids.length) {
			return false;
		}
		MODx.Ajax.request({
			url: this.config.url,
			params: {
				action: 'mgr/settings/disable',
				ids: Ext.util.JSON.encode(ids),
			},
			listeners: {
				success: {
					fn: function () {
						this.refresh();
					}, scope: this
				}
			}
		})
	}
	
	,onClick: function (e) {
		var elem = e.getTarget();
		if (elem.nodeName == 'BUTTON') {
			var row = this.getSelectionModel().getSelected();
			if (typeof(row) != 'undefined') {
				var action = elem.getAttribute('action');
				if (action == 'showMenu') {
					var ri = this.getStore().find('id', row.id);
					return this._showMenu(this, ri, e);
				}
				else if (typeof this[action] === 'function') {
					this.menu.record = row.data;
					return this[action](this, e);
				}
			}
		}
		return this.processEvent('click', e);
	}
	
	,_getSelectedIds: function () {
		var ids = [];
		var selected = this.getSelectionModel().getSelections();

		for (var i in selected) {
			if (!selected.hasOwnProperty(i)) {
				continue;
			}
			ids.push(selected[i]['id']);
		}

		return ids;
	}
});

Ext.reg('popularpages-grid-settings', popularPages.grid.Settings);
