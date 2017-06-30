Ext.define('front_src.store.Tasks', {
    extend: 'Ext.data.Store',
    model: 'front_src.model.Task',

    proxy: {
        type: 'ajax',
        batchActions: false,
        api: {
            read: 'http://localhost/SToDoList/web/app_dev.php/get_all_tasks'
        },
        reader: {
            type: 'json',
            rootProperty: 'tasks'
        }
    },
    autoLoad: true
});
