Ext.define('front_src.view.Tasks.TasksGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'tasksGrid',
    itemId: 'TasksGrid',
    id: 'tasks',
    store: 'Tasks',
    controller: 'ctrlpanel',
    margin: 10,
    plugins:[{
        ptype:'cellediting',
        clicksToEdit: 1

    }],

    tbar: [

    ],

    columns: [{
        xtype:'rownumberer'
    },{
        header: 'Task name',
        dataIndex: 'name',
        width: '25%',
        editor: {
            allowBlank: false
        }
    },
        {
            header: 'Accept date',
            dataIndex: 'acceptionDate',
            xtype:'datecolumn',
            format: 'd/m/Y',
            width: '25%',
            editor: {
                xtype: 'datefield',
                allowBlank: false
            }
        },
        {
            header: 'Exec Date',
            dataIndex: 'executionDate',
            xtype:'datecolumn',
            format: 'd/m/Y',
            width: '25%',
            editor: {
                xtype: 'datefield'
            }
        },
        {
            header: 'Task status',
            dataIndex: 'status',
            xtype:'booleancolumn',
            trueText:'COMPLETE',
            falseText:'NOT COMPLETE',
            flex:1,
            width: '25%',
            editor: {
                xtype: 'checkbox',
                checked: false
            }
        }
    ]
});