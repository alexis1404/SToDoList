/*
 * This file is generated and updated by Sencha Cmd. You can edit this file as
 * needed for your application, but these edits will have to be merged by
 * Sencha Cmd when upgrading.
 */
Ext.application({
    name: 'front_src',

    extend: 'front_src.Application',

    requires: [
        'front_src.view.main.Main',
        'front_src.view.main_panel.MainPanel',
        'front_src.view.Users.UsersGrid',
        'front_src.view.Tasks.TasksGrid'
    ],

    // The name of the initial view to create. With the classic toolkit this class
    // will gain a "viewport" plugin if it does not extend Ext.Viewport. With the
    // modern toolkit, the main view will be added to the Viewport.
    //
    mainView: 'front_src.view.main_panel.MainPanel'
	
    //-------------------------------------------------------------------------
    // Most customizations should be made to front_src.Application. If you need to
    // customize this file, doing so below this section reduces the likelihood
    // of merge conflicts when upgrading to new versions of Sencha Cmd.
    //-------------------------------------------------------------------------
});
