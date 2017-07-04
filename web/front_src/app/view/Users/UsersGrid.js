Ext.define('front_src.view.Users.UsersGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'usersGrid',
    itemId: 'UsersGrid',
    id: 'uGrid',
    store: 'Users',
    controller: 'ctrlpanel',
    margin: 10,
    selType: 'rowmodel',
    plugins:[{
        ptype:'rowediting',
        clicksToEdit: 2,
        pluginId: 'roweditingId',
        saveBtnText : "Save",
        listeners: {
            edit: function(editor, context, eOpts){
                var grid = Ext.ComponentQuery.query('#UsersGrid')[0];
                var store = grid.getStore();
                var txtColIdx = 1;
                var textfieldRef = context.grid.columns[txtColIdx].getEditor(context.record);
                var tetxfieldValue = textfieldRef.getValue();
                var coisa = context.record.set('name', tetxfieldValue);
            }
        }
    }],

    tbar: [
        {
            xtype: 'button',
            text: 'Add new executor',
            name: 'addExecButton',
            handler: 'createExecutorAkaUser'
        },
        {
            xtype: 'button',
            text: 'Save all changes',
            name: 'saveChangesButton',
            handler: 'saveAllChangesInUserGrid'
        },
        {
            xtype: 'button',
            text: 'Load all tasks',
            name: 'loadAllTasksButton',
            handler: 'loadAllTasks'
        }
    ],

    columns: [{
        header: 'Name',
        dataIndex: 'user_name',
        flex:1,
        editor: {
            allowBlank: false,
            xtype: 'textfield'
        }
    },
        {
            xtype: 'actioncolumn',
            flex: 1,
            header: 'DEL',
            items: [{
                icon: 'images/delete.png',
                handler: 'del_user'
            }]
        },
        {
            xtype: 'actioncolumn',
            flex: 1,
            header: 'User`s tasks',
            items: [{
                icon: 'images/notepad.png',
                handler: 'all_tasks_user'
            }]
        }
    ]
});