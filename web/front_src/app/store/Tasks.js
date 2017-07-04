Ext.define('front_src.store.Tasks', {
    extend: 'Ext.data.Store',
    model: 'front_src.model.Task',

    proxy: {
        type: 'ajax',
        batchActions: false,
        api: {
            read: '/SToDoList/get_all_tasks',
            destroy: '/SToDoList/delete_task',
            update: '/SToDoList/edit_task'
        },
        reader: {
            type: 'json',
            rootProperty: 'tasks'
        }
    },
    autoLoad: true
});
