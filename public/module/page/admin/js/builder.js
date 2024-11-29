const editor = grapesjs.init({
    container: '#gjs',
    fromElement: true,
    height: '100%',
    width: 'auto',
    clearOnRender: true,
    plugins: ['gjs-preset-newsletter'],
    storageManager: {
        autosave: false,
        setStepsBeforeSave: 1,
        type: 'remote',
        urlStore: 'http://cimailer.dev/lets_dragdrop',
        urlLoad: 'http://cimailer.dev/lets_dragdrop',
        contentTypeJson: true,
    },
});

editor.Panels.addButton
('options',
    [{
        id: 'save-db',
        className: 'fa fa-floppy-o',
        command: 'save-db',
        attributes: {title: 'Save DB'}
    }]
);

// Add the command
editor.Commands.add
('save-db',
    {
        run: function(editor, sender)
        {
            sender && sender.set('active', 0); // turn off the button
            editor.store();
            var htmldata = editor.getHtml();
            var cssdata = editor.getCss();
            $.post("http://cimailer.dev/lets_dragdrop",
                {
                    "html": htmldata,
                    "css": cssdata
                });
        }
    });
