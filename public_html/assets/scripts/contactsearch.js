;(function ($) {

    $.contactsearch = function (element, options) {

        var $element = $(element);
        var defaults = {
            'elementClass' : 'contact-search',
            'tagTitle' : 'Search Tags',
            'criteriaTitle' : 'Search Contacts',
            'datepickerOptions' : {
                dateFormat : 'dd/mm/yy'
            },
            'textValueClass' : 'text-value',
            'dateValueClass' : 'date-value',
            'operations' : [],
            'tags' : [],
            'fields' : [],
            'searches' : []
        };
        var plugin = this;

        /*
         * Search tag container
         */
        plugin.tagContainer = null;
        /*
         * Search criteria container
         */
        plugin.criteriaContainer = null;
        /*
         * Hidden field for containing the ID of the search
         */
        plugin.idField = null;
        /*
         * Criteria table
         */
        plugin.criteriaTable = null;
        /*
         * ID of the current search
         */
        plugin.id = null;
        /*
         * Name of the current search
         */
        plugin.name = '';
        /*
         * List of search criteria
         */
        plugin.criteria = [];
        /*
         * Customisable settings
         */
        plugin.settings = {};

        /*
         * Plugin constructor
         */
        plugin.init = function () {

            plugin.settings = $.extend ({}, defaults, options);

        };

        /*
         * Sets the current search
         */
        plugin.setSearch = function (id, name) {

            plugin.id = id;
            plugin.name = name;

        };

        /*
         * Sets the current criteria
         */
        plugin.setCriteria = function (criteria) {

            plugin.criteria = criteria;

        };

        /*
         * Sets the tags to include
         */
        plugin.includeTags = function (tagIds) {

            plugin.includeTagIds = tagIds;

        };

        /*
         * Sets the tags to exclude
         */
        plugin.excludeTags = function (tagIds) {

            plugin.excludeTagIds = tagIds;

        };

        /*
         * Starts the plugin
         */
        plugin.start = function () {

            setupForm ();

        };

        /*
         * Requests search criteria from the server from an ID
         */
        plugin.get = function (id) {

        };

        /*
         * Creates the search form
         */
        var setupForm = function () {
            var fieldset;
            var table;
            var tr;
            var td;
            var select;

            $element.addClass (plugin.settings.elementClass);

            plugin.idField = $('<input/>').attr ('type', 'hidden').attr ('name', 'search-id').appendTo ($element);

            if (plugin.id) {
                plugin.idField.val (plugin.id);
            }

            $('<input/>').attr ('type', 'hidden').attr ('name', 'contact-search').val ('1').appendTo ($element);

            plugin.tagContainer = $('<fieldset/>').appendTo ($element);
            $('<legend/>').append (plugin.settings.tagTitle).appendTo (plugin.tagContainer);

            plugin.criteriaContainer = $('<fieldset/>').appendTo ($element);
            $('<legend/>').append (plugin.settings.criteriaTitle).appendTo (plugin.criteriaContainer);

            fieldset = $('<fieldset/>').appendTo ($element);
            $('<legend/>').append ('Search Details').appendTo (fieldset);

            table = $('<table/>').addClass ('auto').appendTo (fieldset);
            tr = $('<tr/>').appendTo (table);

            td = $('<td/>').appendTo (tr);
            $('<label/>').append ('Previous search: ').attr ('for', 'contact-search-previous').appendTo (td);

            td = $('<td/>').appendTo (tr);
            select = $('<select/>').attr ('name', 'contact-search-load-id').appendTo (td);

            $('<option/>').val ('0').append ('-').appendTo (select);

            $.each (plugin.settings.searches, function (i, search) {
                var option;

                option = $('<option/>').val (search.Id).append (search.name).appendTo (select);

                if (plugin.id === search.Id) {
                    option.prop ('selected', true);
                }

            });

            $('<button/>').attr ('type', 'submit').attr ('name', 'contact-search-load').val ('1').append ('Load Search').appendTo (td);

            tr = $('<tr/>').appendTo (table);

            td = $('<td/>').appendTo (tr);
            $('<label/>').append ('Name: ').attr ('for', 'contact-search-name').appendTo (td);

            td = $('<td/>').appendTo (tr);
            $('<input/>').attr ('type', 'text').attr ('name', 'search-name').attr ('id', 'contact-search-name').val (plugin.name).appendTo (td);

            $('<button/>').attr ('type', 'submit').attr ('name', 'contact-search-save-criteria').val ('1').append ('Save Criteria').appendTo (td).on ('click.contactsearch', function () {
                return saveCriteria ();
            });

            plugin.criteriaTable = $('<table/>').addClass ('auto').appendTo (plugin.criteriaContainer);

            $('<button/>').attr ('type', 'button').append ('Add new row').addClass ('right').insertAfter (plugin.criteriaTable).on ('click.contactsearch', function () {
                addCriteria ();
            });

            $('<button/>').attr ('type', 'submit').append ('Search').appendTo ($element).on ('click.contactsearch', function () {

            });

            setupTagTable ();
            setupCriteria ();

        };

        /*
         * Creates the tag table
         */
        var setupTagTable = function () {
            var table;
            var thead;
            var tbody;
            var tr;
            var cell;

            table = $('<table/>').addClass ('dataTable').appendTo (plugin.tagContainer);
            thead = $('<thead/>').appendTo (table);
            tr = $('<tr/>').appendTo (thead);
            $('<th/>').append ('Tag Name').appendTo (tr);
            $('<th/>').append ('Applied?').appendTo (tr);

            tbody = $('<tbody/>').appendTo (table);

            $.each (plugin.settings.tags, function (i, tag) {

                tr = $('<tr/>');
                $('<td/>').append (tag.Id + ' - ' + tag.GroupName).appendTo (tr);
                cell = $('<td/>').appendTo (tr);

                addTagFields (cell, tag);

                tr.appendTo (tbody);

            });

            table.dataTable ({
                'sPaginationType' : 'full_numbers',
                'bJQueryUI' : true,
                'iDisplayLength' : 10
            });

        };

        /*
         * Appends the form elements for the tag
         */
        var addTagFields = function (container, tag) {
            var applyTag = 'none';
            var input;

            if (jQuery.inArray (tag.Id, plugin.includeTagIds) !== -1) {
                applyTag = 'yes';
            } else if (jQuery.inArray (tag.Id, plugin.excludeTagIds) !== -1) {
                applyTag = 'no';
            }

            input = $('<input/>').attr ('type', 'radio').attr ('name', 'tag-' + tag.Id + '-apply').attr ('id', 'tag-' + tag.Id + '-apply-yes').val ('yes').appendTo (container);

            if (input.val () === applyTag) {
                input.prop ('checked', true);
            }

            $('<label/>').attr ('for', 'tag-' + tag.Id + '-apply-yes').append ('Yes').appendTo (container);

            input = $('<input/>').attr ('type', 'radio').attr ('name', 'tag-' + tag.Id + '-apply').attr ('id', 'tag-' + tag.Id + '-apply-no').val ('no').appendTo (container);

            if (input.val () === applyTag) {
                input.prop ('checked', true);
            }

            $('<label/>').attr ('for', 'tag-' + tag.Id + '-apply-no').append ('No').appendTo (container);

            input = $('<input/>').attr ('type', 'radio').attr ('name', 'tag-' + tag.Id + '-apply').attr ('id', 'tag-' + tag.Id + '-apply-none').val ('none').appendTo (container);

            if (input.val () === applyTag) {
                input.prop ('checked', true);
            }

            $('<label/>').attr ('for', 'tag-' + tag.Id + '-apply-none').append ("Don't care").appendTo (container);

        };

        /*
         * Creates the initial criteria fields and one blank row
         */
        var setupCriteria = function () {

            $.each (plugin.criteria, function (i, criteria) {
                setCriteria (addCriteria (), criteria);
            });

            addCriteria ();

        };

        /*
         * Adds new search criteria to the form. Returns the row.
         */
        var addCriteria = function (criteria) {
            var row;
            var cell;
            var select;

            row = $('<tr/>');

            /*
             * Add the field selector
             */

            cell = $('<td/>');
            select = $('<select/>').attr ('name', 'field[]').on ('change.contactsearch', function () {
                updateValueFields (this);
            });

            $('<option/>').val ('0').append ('Choose field to search on').appendTo (select);

            $.each (plugin.settings.fields, function (i, field) {
                $('<option/>').val (i).append (field.label).appendTo (select);
            });

            select.appendTo (cell);
            cell.appendTo (row);

            /*
             * Add the operation selector
             */

            cell = $('<td/>');
            select = $('<select/>').attr ('name', 'operation[]');
            $('<option/>').val ('0').append ('Choose operation').appendTo (select);

            $.each (plugin.settings.operations, function (i, operation) {
                $('<option/>').val (i).append (operation).appendTo (select);
            });

            select.appendTo (cell);
            cell.appendTo (row);

            /*
             * Add the value cell
             */

            cell = $('<td/>');

            $('<input/>').attr ('type', 'text').attr ('name', 'date-value[]').addClass (plugin.settings.dateValueClass).appendTo (cell).datepicker (plugin.settings.datepickerOptions).hide ();
            $('<input/>').attr ('type', 'text').attr ('name', 'text-value[]').addClass (plugin.settings.textValueClass).appendTo (cell).hide ();

            cell.appendTo (row);

            row.appendTo (plugin.criteriaTable);

            return row;

        };

        /*
         * Sets the criteria for a row
         *
         * @var element rowElement
         * @var object criteria
         */
        var setCriteria = function (rowElement, criteria) {
            var fieldSelector;

            fieldSelector = $('select[name="field[]"]', rowElement).val (criteria.field);
            $('select[name="operation[]"]', rowElement).val (criteria.operation);

            updateValueFields (fieldSelector, criteria.value);

        };

        /*
         * Updates which value input is visible for the selected field
         */
        var updateValueFields = function (selector, value) {
            var fieldName;
            var field;
            var row;
            var valueInput;

            fieldName = $(selector).val ();
            row = $(selector).parentsUntil ('tr').last ().parent ();

            $('input.' + plugin.settings.textValueClass, row).hide ();
            $('input.' + plugin.settings.dateValueClass, row).hide ();

            if (typeof plugin.settings.fields[fieldName] !== 'object') {
                return;
            }

            field = plugin.settings.fields[fieldName];

            if (field.type === 'date') {
                valueInput = $('input.' + plugin.settings.dateValueClass, row).show ();
            } else {
                valueInput = $('input.' + plugin.settings.textValueClass, row).show ();
            }

            if (typeof value !== 'undefined') {
                valueInput.val (value);
            }

        };

        /*
         * Saves the criteria
         */
        var saveCriteria = function () {
            var input;
            var label;

            input = $('#contact-search-name', $element);
            label = $('label[for="contact-search-name"]', $element);

            if (jQuery.trim (input.val ()) === '') {

                input.addClass ('error');
                label.addClass ('error');

                return false;

            } else {

                input.removeClass ('error');
                label.removeClass ('error');

                return true;

            }

        };

        plugin.init ();

    };

    $.fn.contactsearch = function (options) {

        return this.each (function () {

            if (undefined == $(this).data ('contactsearch')) {
                var plugin = new $.contactsearch (this, options);
                $(this).data ('contactsearch', plugin);
            }

        });

    };

})(jQuery);