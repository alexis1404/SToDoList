Ext.define('front_src.view.main_panel.MainPanel', {
    extend: 'Ext.tab.Panel',
    requires: [
        'Ext.layout.container.Card',
        'front_src.view.main_panel.MainPanelController'
    ],
    xtype: 'layout-mainpanel',
    controller: 'ctrlpanel',

    defaults: {
        bodyPadding: 15
    },

    items:[
        {
            title: 'Tab 1',
            items: [
                {
                    xtype: 'usersGrid',
                    style: 'border: 1px double #1E90FF',
                    width: 300,
                    height: 300
                },
                {
                    xtype: 'tasksGrid',
                    style: 'border: 1px double #1E90FF',
                    width: 1000,
                    height: 300
                }
            ]
        },
        {
            title: 'Tab 2',
            html: 'This is tab 2 content.'
        }
    ]
});