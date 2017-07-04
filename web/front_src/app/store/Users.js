Ext.define('front_src.store.Users', {
    extend: 'Ext.data.Store',
    model: 'front_src.model.User',

    proxy: {
        type: 'ajax',
        batchActions: false,
        api: {
            read: '/SToDoList/get_all_users',
            destroy: '/SToDoList/delete_user',
            create:  '/SToDoList/create_user',
            update: '/SToDoList/edit_user'
        },
        reader: {
            type: 'json',
            rootProperty: 'users'
        }
    },
    autoLoad: true
});
