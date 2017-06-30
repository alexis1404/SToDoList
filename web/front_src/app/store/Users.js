Ext.define('front_src.store.Users', {
    extend: 'Ext.data.Store',
    model: 'front_src.model.User',

    proxy: {
        type: 'ajax',
        batchActions: false,
        api: {
            read: 'http://localhost/SToDoList/web/app_dev.php/get_all_users',
            destroy: 'http://localhost/SToDoList/web/app_dev.php/delete_user',
            create:  'http://localhost/SToDoList/web/app_dev.php/create_user',
            update: 'http://localhost/SToDoList/web/app_dev.php/edit_user'
        },
        reader: {
            type: 'json',
            rootProperty: 'users'
        }
    },
    autoLoad: true
});
