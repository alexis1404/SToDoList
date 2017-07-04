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
            title: 'TASK LIST',
            items: [
                {
                    xtype: 'usersGrid',
                    style: 'border: 1px double #1E90FF',
                    width: 500,
                    height: 300
                },
                {
                    xtype: 'tasksGrid',
                    style: 'border: 1px double #1E90FF',
                    width: 1300,
                    height: 300
                }
            ]
        },
        {
            title: 'DISCKLAIMER',
            html: '<h1 style="font-size: 17px">Этот фронт ни в коем случае не является демонстрацией труЪ-кода на Extjs, а лишь ' +
            'выполняет функцию базового view для серверного кода на Symfony.</h1>'
        }
    ]
});