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
        {
            xtype: 'button',
            text: 'Save all changes',
            name: 'saveChangesButton_1',
            handler: 'saveAllChangesInTasksGrid'
        },
        {
            xtype: 'button',
            text: 'Add new task',
            name: 'addNewTask',
            handler: 'addNewTaskAction',
            id: 'addNewTaskButton'
        }
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
            width: '15%',
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
            width: '15%',
            editor: {
                xtype: 'datefield'
            }
        },
        {
            header: 'Executor',
            dataIndex: 'executor',
            flex: 1
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
        },
        {
            xtype: 'actioncolumn',
            flex: 1,
            header: 'DEL',
            items: [{
                icon: 'images/delete.png',
                handler: 'del_task'
            }]
        }
    ]
});