Ext.define('front_src.view.main_panel.MainPanelController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.ctrlpanel',
    models: ['User'],
    stores: ['Users'],

    del_user: function(grid, rowIndex, colIndex) {
        var store = grid.getStore();
        var selectionModel = grid.getSelectionModel(), record;
        selectionModel.select(rowIndex);
        record = selectionModel.getSelection()[0];
        Ext.MessageBox.confirm('Delete', 'Are you sure?', function(btn) {
            if(btn === 'yes') {
                store.remove(record);
                store.sync();
            }else {
                console.log('Delete reject')
            }
        });
    },

    createExecutorAkaUser: function(button) {
        var grid = button.up('#UsersGrid');
        var store = grid.getStore();
        var r = Ext.create('User', {
            user_name: 'NEW EXECUTOR'
        });
        store.insert(0, r);
        store.sync();
        store.load();

    },

    saveAllChangesInUserGrid: function(button) {
        var grid = button.up('#UsersGrid');
        var store = grid.getStore();
        store.sync();
        store.load();
    }
});