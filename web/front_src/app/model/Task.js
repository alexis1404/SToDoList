Ext.define('front_src.model.Task', {
    extend: 'Ext.data.Model',
    alias: 'Task',
    fields: [
        {
            name: 'id'

        },
        {
            name: 'name'
        },
        {
            name: 'acceptionDate'
        },
        {
            name: 'executionDate'
        },
        {
            name: 'status'
        },
        {
            name: 'executor'
        }
    ]
});