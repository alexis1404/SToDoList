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
        var rowediting = grid.getPlugin('roweditingId');
        rowediting.cancelEdit();
        var r = Ext.create('User', {
        });
        store.insert(0, r);
        rowediting.startEdit(0, 0);
    },

    saveAllChangesInUserGrid: function(button) {
        var grid = button.up('#UsersGrid');
        var store = grid.getStore();
        store.sync();
        store.load();
    },

    del_task: function(grid, rowIndex, colIndex) {
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

    saveAllChangesInTasksGrid: function(button) {
        var grid = button.up('#TasksGrid');
        var store = grid.getStore();
        store.sync();
        store.load();
        //location.reload();
    },

    all_tasks_user: function(grid, rowIndex, colIndex) {
        var bagPanel = Ext.get('tasks');
        bagPanel.slideIn('t', {
            easing: 'easeIn',
            duration: 300
        });
        var buttonLoadAllTask = Ext.get('addNewTaskButton');
        buttonLoadAllTask.show();
        var store = grid.getStore();
        var selectionModel = grid.getSelectionModel(), record;
        selectionModel.select(rowIndex);
        record = selectionModel.getSelection()[0];

        var store_tasks = Ext.getStore('Tasks');
        store_tasks.getProxy().getApi().read = '/SToDoList/get_user_tasks/' + record.get('id');
        store_tasks.getProxy().getApi().create = '/SToDoList/create_task/' + record.get('id');
        store_tasks.load();

    },

    loadAllTasks: function(button) {
        var buttonLoadAllTask = Ext.get('addNewTaskButton');
        buttonLoadAllTask.hide();
        var store = Ext.getStore('Tasks');
        store.getProxy().getApi().read = '/SToDoList/get_all_tasks';
        store.load()
    },

    addNewTaskAction: function(button) {
        var grid = button.up('#TasksGrid');
        var store = grid.getStore();
        var r = Ext.create('Task', {
            name: 'NEW TASK'
        });
        store.insert(0, r);
        store.sync();
        store.load();
    }
});