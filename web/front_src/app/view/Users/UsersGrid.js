Ext.define('front_src.view.Users.UsersGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'usersGrid',
    itemId: 'UsersGrid',
    store: 'Users',
    controller: 'ctrlpanel',
    margin: 10,
    plugins:[{
        ptype:'rowediting',
        clicksToEdit: 2
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
        }
    ],

    columns: [{
        header: 'Name',
        dataIndex: 'user_name',
        width: '80%',
        editor: {
            allowBlank: false
        }
    },
        {
            xtype: 'actioncolumn',
            width: '19%',
            id: 'delete',
            header: 'DEL',
            items: [{
                icon: 'images/delete.png',
                handler: 'del_user'
            }]
        }
    ]
});