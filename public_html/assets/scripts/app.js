$(function() {
    

    // Autocomplete
    var sectorList =['Accountant', 'Agricultural', 'Architect', 'Motor Vehicles', 'Business Advisors', 'Car sales', 'Catering/Hospitality/Travel', 'Charity', 'Chartered Building Surveyers', 'Child care / Nursery', 'Childcare', 'Cleaning company', 'Debt Management', 'Dental', 'Designers', 'Distributor', 'Education', 'Energy', 'Engineers', 'Engineers/Heating & plumbing', 'Finance / Investment', 'Financial Advisor', 'Financial Planning', 'Health & beauty', 'Health & wellbeing', 'Health Care', 'IT', 'Maintenance', 'Manufacturing', 'Marketing', 'Medical', 'Medical (wholesale)', 'Mortgages', 'Nuclear', 'Office Space', 'Pharmaceutical / Chemical', 'Printers', 'Promotion', 'Property Company', 'Recruitment', 'Retail', 'Service Plan Provider', 'Solicitor', 'Sport', 'Surveyors', 'Training', 'Vets', ];
    
    var countryList_uk = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burma", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo, Democratic Republic", "Congo, Republic of the", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Mongolia", "Morocco", "Monaco", "Mozambique", "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Norway", "Oman", "Pakistan", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Samoa", "San Marino", " Sao Tome", "Saudi Arabia", "Senegal", "Serbia and Montenegro", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"];
    $("#countries_uk").autocomplete({
        source: countryList_uk
    });
    
    $("#sectors").autocomplete({
        source: sectorList
    });

    // Accordion
    $(".accordion").accordion({ header: "h3" });

    // Uploadify
    $('#file_upload').uploadify({
            'uploader'  : 'assets/scripts/uploadify/uploadify.swf',
            'script'    : 'assets/scripts/uploadify/uploadify.php',
            'cancelImg' : 'assets/scripts/uploadify/cancel.png',
            'folder'    : '/uploads',
            'multi'     : true,
            'auto'      : true
          });

    // Tabs
    $('.tabs').tabs({
        create : function (event, ui) {
            $(this).data ('lastPanelSelector', ui.panel.selector);
        },
        activate : function (event, ui) {
            $(this).data ('lastPanelSelector', ui.oldPanel.selector);
        }
    });
   
    
    // toggling of divd
    $("#option1_toggle").click(function(){
          $("#option1").toggle("slow","swing");
    });
    $("#option2_toggle").click(function(){
          $("#option2").toggle("slow","swing");
    });
    $("#option3_toggle").click(function(){
          $("#option3").toggle("slow","swing");
    });
    $("#option4_toggle").click(function(){
          $("#option4").toggle("slow","swing");
    });
    $("#option5_toggle").click(function(){
          $("#option5").toggle("slow","swing");
    });
    $("#option6_toggle").click(function(){
          $("#option6").toggle("slow","swing");
    });
    
    //changes the url parameter for the quick action button based on drop dwn selection
    /*$("#quick_action").change(function () {
        var str = "";
        $("select option:selected").each(function () {
                  str = $(this).text();
        });
        $("#quick_action_button").value(str);
    })
    .change();*/
    $("#quick_action").change(function () {
        //var selected_item = $("#quick_action_button").attr("href") + $(this).val()
        var selected_item = $("#quick_action_url").attr("value") + $(this).val();
        
        $("#quick_action_button").attr("href", selected_item);
    });
    

    

    // Dialog			
    $('#dialog').dialog({
        autoOpen: false,
        width: 600,
        buttons: {
            "Ok": function() {
                $(this).dialog("close");
            },
            "Cancel": function() {
                $(this).dialog("close");
            }
        },
        modal: true
    });

    // Dialog Link
    $('#dialog_link').button().click(function() {
        $('#dialog').dialog('open');
        return false;
    });

    // Datepicker
    $('.datepicker').datepicker({
      changeMonth: true,
      changeYear: true,
      defaultDate: '01/01/70',
      dateFormat: 'dd/mm/yy'
    }).children().show();
    
    // Datepicker
    $('.datepicker_dob').datepicker({
      changeMonth: true,
      changeYear: true,
      defaultDate: '01/01/70',
      dateFormat: 'dd/mm/yy'
    });
    
    //Inputmask mask - a much more powerful mask: https://github.com/RobinHerbots/jquery.inputmask
    $(":input").inputmask();
    $(".input_mask_date").inputmask("d/m/y");  //direct mask
    $(".input_mask_phone").inputmask("mask", {"mask": "(999) 999-9999"}); //specifying fn & options
    $("#tin").inputmask({"mask": "99-9999999"}); //specifying options only
    //$(".username").inputmask({"mask": "******?*******", "placeholder": " ", "validator": "[0-9\(\)\.\+/ ]",}); //specifying options only
    $(".input_mask_price").inputmask('£99999.99', { numericInput: true, rightAlignNumerics: false, "placeholder": " " }); //For prices
    
    //This is under PCSS3 - not as powerful a mask
    $(".mask_date").mask('99/99/9999', {placeholder:'-'});
    $(".mask_phone").mask('(0999) 999 9999', {placeholder:'_'});
    $(".mask_phone_work").mask('(0999) 999 9999  ?xxxx', {placeholder:'_'});
    $(".mask_phone_overseas").mask('(+99) (999) 999 9999 ?999999', {placeholder:'_'});
    $(".mask_mobile").mask('07999999999', {placeholder:'_'});
    $(".mask_card").mask('9999-9999-9999-9999', {placeholder:'x'});
    $(".serial").mask('***-***-***-***-***-***', {placeholder:'x'});
    $(".mask_tax").mask('99-9999999', {placeholder:'x'}); 
    $(".mask_price").mask('£?99999', {placeholder:'_'}); 
    $(".mask_username").mask('******?******', {placeholder:'_'}); 
    
   $('<i class="icon-ok"></i><i class="icon-remove"></i>').appendTo($('.form section'));					
    $(".form_val").validate(
    {
            // Rules for form validation
            rules:
            {
                    name:
                    {
                            required: true
                    },
                    Email:
                    {
                            required: true,
                            email: true
                    },
                    EmailAddress2:
                    {
                            required: false,
                            email: true
                    },
                    message:
                    {							
                            required: true,
                            minlength: 10
                    }
            },

            // Messages for form validation
            messages:
            {
                    name:
                    {
                            required: 'Please enter your name'
                    },
                    Email:
                    {
                            required: "<br/> Please enter an email address",
                            email: "<br/> Please enter a VALID email address"
                    },
                    EmailAddress2:
                    {
                            email: "<br/> Please enter a VALID email address"
                    },
                    message:
                    {
                            required: 'Please enter your message'
                    }
            },					

            // Do not change code below
            errorPlacement: function(error, element)
            {
                    error.appendTo(element.parent());
            }
    }); 
    
    //Date & time picker (from http://trentrichardson.com/examples/timepicker/)
    $('.datetimepicker').datetimepicker({
	timeFormat: "hh:mm:ss",
        dateFormat: 'yy-mm-dd',
        stepHour: 1,
	stepMinute: 10
        });
    

    // Horizontal Slider
    $('#horizSlider').slider({
        range: true,
        values: [17, 67]
    });

    // Vertical Slider				
    $("#eq > span").each(function() {
        var value = parseInt($(this).text(), 10);
        $(this).empty().slider({
            value: value,
            range: "min",
            animate: true,
            orientation: "vertical"
        });
    });

    //hover states on the static widgets
    $('#dialog_link, ul#icons li').hover(
        function() {
            $(this).addClass('ui-state-hover');
        },
        function() {
            $(this).removeClass('ui-state-hover');
        }
    );

    // Button
    $("#divButton, #linkButton, #submitButton, #inputButton").button();

    // Icon Buttons
    $("#leftIconButton").button({
        icons: {
            primary: 'ui-icon-wrench'
        }
    });

    $("#bothIconButton").button({
        icons: {
            primary: 'ui-icon-wrench',
            secondary: 'ui-icon-triangle-1-s'
        }
    });

    // Button Set
    //$("#radio1").buttonset();


    // Progressbar
    /*
    $("#progressbar").progressbar({
        value: 37
    }).width(500);
    $("#animateProgress").click(function(event) {
        var randNum = Math.random() * 90;
        $("#progressbar div").animate({ width: randNum + "%" });
        event.preventDefault();
    });
    */


    //Datatable
    //$('.dataTable').dataTable({
      //  "sPaginationType": "full_numbers",
      //  "bJQueryUI": true
    //});

    // Adds an overlay to the container which prevents the contents from being
    // interacted with.
    var disableTable = function (container) {
        $('<div/>').addClass ('datatable-updating').css ('width', container.css ('width')).css ('height', container.css ('height')).css ('line-height', container.css ('height')).append ('Updating...').prependTo (container);
    };

    // Called when the user closes the dialog. Refreshes the datatable
    // associated with the link that opened it.
    var onOverlayClosedCallback = function () {
        var tableId = $(this).data ('table-id');

        if (typeof tableId === 'undefined') {
            return;
        }

        var dataTableContainer = $('#' + tableId + ' .dataTable-container');

        if (dataTableContainer.length !== 1) {
            return;
        }

        reloadDatatable (dataTableContainer);
    };

    // Reloads the datatable in the container
    var reloadDatatable = function (container) {

        if (typeof container.data ('table-source') === 'undefined') {
            return;
        }

        var table = $('.dataTable', container);

        if (table.length !== 1) {
            return;
        }

        disableTable (container);

        $.get (container.data ('table-source'), function (response) {
            var settings;
            var customOptions;

            settings = table.dataTable ().fnSettings ();
            customOptions = dataTableOptions;
            customOptions.aaSorting = settings.aaSorting;
            customOptions.iDisplayStart = settings._iDisplayStart;

            table.dataTable ().fnDestroy ();
            container.html (response);

            table = $('.dataTable', container);
            table.dataTable (customOptions);

        }, 'json');

    };

    var dataTableOptions = {
        "sPaginationType": "full_numbers",
        "bJQueryUI": true,
        "iDisplayLength": 5,
         "aaSorting": [],   //disables sorting when page loads, but users can still sort manually
        //AE 21-06-12	Next line added apply modalbox to whole table no matter how you 'redraw' it (redraw=re-sort) 
        "fnDrawCallback": function(  ) {
            $(".iframe").colorbox({iframe:true, width:"80%", height:"90%", escKey: false, overlayClose: false, fixed:true, onClosed: onOverlayClosedCallback });
        }
    };

    // Adds an alert to an element
    //
    // @param string type alert type (success, error)
    // @param string content content to display
    // @param element element to add the alert to
    var addAlert = function (type, content, element) {
        $('<span/>').addClass ('notification').addClass (type).append (content).prependTo (element).delay (200).fadeOut (300, function () {
            $(this).remove ();
        });
    };

    // Adds a success alert to an element
    //
    // @param string content content to display
    // @param element element to add the alert to
    var addDoneAlert = function (content, element) {
      addAlert ('done', content, element);
    };

    // Adds a error alert to an element
    //
    // @param string content content to display
    // @param element element to add the alert to
    var addErrorAlert = function (content, element) {
      addAlert ('error', content, element);
    };

    // Reloads the datatables in each of the tabs when they are clicked for a
    // second time after being focused.
    $('.tabs').each (function () {
        var tabContainer = $(this);

        $('a', tabContainer).on ('click.loaddatatables', function () {
            var href = $(this).attr ('href');

            if (href.substring (0, 1) !== '#') {
                return;
            }

            if (href === tabContainer.data ('lastPanelSelector')) {
                var container = $(href + ' .dataTable-container');
                if (container.length === 1) {
                    reloadDatatable (container);
                }
            }

            tabContainer.data ('lastPanelSelector', href);
        });
    });

    //Datatable
    $('.dataTable').dataTable(dataTableOptions);

    //Unselects all checkboxes if they have been checked
    /*$(".dataTable tbody tr").click(function(e) {
            $(".dataTable tbody tr").removeClass("selected");
            var $checkbox = $(this).find(':checkbox');
            $(".dataTable :checkbox").not($checkbox).removeAttr("checked");
            if (e.target.type == "checkbox") {
                    // stop the bubbling to prevent firing the row's click event
                    e.stopPropagation();
            } else {        
                    $checkbox.attr('checked', !$checkbox.attr('checked'));
                    $(this).filter(':has(:checkbox)').toggleClass('selected');
            }
    });*/

    //Submits forms via AJAX
    var ajaxSubmitForm = function (form, input) {
        var $form = $(form);
        var submit;

        if (typeof input !== 'undefined') {
            $(input).data ('value', $(input).val ()).val ('Saving...').prop ('disabled', true);
        }

        $.post (form.attr ('action'), form.serializeArray (), function (response) {
            var alertContainer = form;

            if (typeof input !== 'undefined') {
                $(input).val ($(input).data ('value')).prop ('disabled', false);
                alertContainer = $(input).parent ();
            }

            if (typeof response !== 'object' || typeof response.success !== 'boolean' || response.success !== true) {
                addErrorAlert ('There was an error submitting the form', form);
                return;
            }

            addDoneAlert ('Record saved!', alertContainer);

            if (typeof response.redirect === 'string') {
                window.location.href = response.redirect;
                return;
            }

            if (typeof response.data === 'object') {
              $.each (response.data, function (name, value) {
                  var input = $('[name="' + name + '"]', form);

                  if (input.length !== 1) {
                    return;
                  }

                  input = input.first ();
                  input.val (value);

                  if (input.is ('textarea')) {
                    input.scrollTop (input[0].scrollHeight - input.height());
                  }

                });
            }

            if (typeof response.updateCalendar === 'boolean' && response.updateCalendar === true) {
                $('#calendar').fullCalendar ('refetchEvents');
            }

            if (typeof response.updateDatatable === 'string') {
                var dataTableContainer = $('div.' + response.updateDatatable);

                if (dataTableContainer.length === 1) {
                    reloadDatatable (dataTableContainer);
                }
            }

        }, 'json');

        return false;

    };

    // Ajax forms
    $('form.ajax').each (function (i, form) {
        var $form = $(form);

        $('input[type="submit"]', form).on ('click.ajaxform', function () {
            ajaxSubmitForm ($form, this);
            return false;
        });

        $form.on ('submit.ajaxform', ajaxSubmitForm);

    });

    //Tooltips
    $("[rel=tooltips]").twipsy({
        "placement": "right",
        "offset": 5
    });

    //WYSIWYG Editor
   /* $(".cleditor").cleditor({
         controls:     
           // controls to add to the toolbar. 
           //see http://premiumsoftware.net/cleditor/docs/GettingStarted.html#optionalParameters for options
            "bold italic underline strikethrough | font size " +
            "| color highlight | bullets numbering | " +
            "| alignleft center alignright justify | " +
            "rule image link unlink "
    });*/
    $(".cleditor").cleditor({
         width:        600, // width not including margins, borders or padding
        height:       250, // height not including margins, borders or padding
        controls:     // controls to add to the toolbar
          "bold italic underline strikethrough subscript superscript | font size " +
          "style | color highlight removeformat | bullets numbering | outdent " +
          "indent | alignleft center alignright justify | undo redo | " +
          "rule image link unlink | cut copy paste pastetext | print source",
        colors:       // colors in the color popup
          "FFF FCC FC9 FF9 FFC 9F9 9FF CFF CCF FCF " +
          "CCC F66 F96 FF6 FF3 6F9 3FF 6FF 99F F9F " +
          "BBB F00 F90 FC6 FF0 3F3 6CC 3CF 66C C6C " +
          "999 C00 F60 FC3 FC0 3C0 0CC 36F 63F C3C " +
          "666 900 C60 C93 990 090 399 33F 60C 939 " +
          "333 600 930 963 660 060 366 009 339 636 " +
          "000 300 630 633 330 030 033 006 309 303",
        fonts:        // font names in the font popup
          "Arial,Arial Black,Comic Sans MS,Courier New,Narrow,Garamond," +
          "Georgia,Impact,Sans Serif,Serif,Tahoma,Trebuchet MS,Verdana",
        sizes:        // sizes in the font size popup
          "1,2,3,4,5,6,7",
        styles:       // styles in the style popup
          [["Paragraph", "<p>"], ["Header 1", "<h1>"], ["Header 2", "<h2>"],
            ["Header 3", "<h3>"],  ["Header 4","<h4>"],  ["Header 5","<h5>"],
            ["Header 6","<h6>"]],
        useCSS:       false, // use CSS to style HTML when possible (not supported in ie)
        docType:      // Document type contained within the editor
          '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">',
        docCSSFile:   // CSS file used to style the document contained within the editor
          "",
        bodyStyle:    // style to assign to document body contained within the editor
          "<p>"
      });
    //
    

    //HTML5 Placeholder for lesser browsers. Uses jquery.placeholder.1.2.min.shrink.js
    $.Placeholder.init();


    //Uses formvalidator
    //$("#form0, #form1, #form2").validationEngine();

   
   //Calendar
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    //var pathname = window.location.pathname+"/get_booking_array";
    var pathname = window.location.pathname;
    var arr = pathname.split('booking');    
    var eventsarray = arr[0]+"booking/get_booking_array";
    var eventurl = arr[0]+"booking/";

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        theme: true,
        defaultView: 'agendaWeek',
        disableDragging: true,
        disableResizing: true,
		
        events: eventsarray,  
        
        eventClick: function (calEvent, jsEvent, view) {

            /*if ($.colorbox) {
                $.colorbox({href:calEvent.url, iframe:true, width:'80%', height:'80%'});
            } else {
                window.open(calEvent.url, '_blank');
            }*/
            window.location(eventurl+calEvent.url);
            

            return false;

        },
        eventRender: function(event, element, view) {

            if (typeof event.htmlTitle === 'string') {
                element.find('.fc-event-title').html (event.htmlTitle);
            }

            if (typeof event.description === 'string') {
                element.find('.fc-event-title').append ('<br/>' + event.description);
            }

        },
        viewDisplay: function (element) {

        }

    });


    $('#gcalendar').fullCalendar({
        // US Holidays
        events: 'http://www.google.com/calendar/feeds/usa__en%40holiday.calendar.google.com/public/basic',
        theme: true,

        eventClick: function(event) {
            // opens events in a popup window
            window.open(event.url, 'gcalevent', 'width=700,height=600');
            return false;
        },

        loading: function(bool) {
            if (bool) {
                $('#loading').show();
            } else {
                $('#loading').hide();
            }
        }
    });
    
    //$("#cboxClose").click();
    
    

});

//Set up Nickname to cha ge when first name is changed.
$(function() {
    $('#FirstName').change(function() {
       $('#NickName').val(this.value);
    });
});

//Delete Confirmation
function deletechecked()
{
    var answer = confirm("Really delete this record? (There is no undo!)")
    if (answer){
        document.messages.submit();
    }
    
    return false;  
}

















/* hopefully we can delete all of this below



// Customize


$(function() {
    
    // Sliding Panel
    $(".trigger").click(function() {
        $(".panel").toggle("slow");
        $(this).toggleClass("active");
        return false;
    });

    // Color Picker for Demo

    $('#in-header').ColorPicker({
        color: '3d0707',
        onShow: function (colpkr) {
            
            $(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            $('header').css('backgroundColor', '#' + hex);
            $('#in-header').css('backgroundColor', '#' + hex);
            $('#faux_header').css('backgroundColor', '#' + hex);
            createCookie('headerCss', hex);
        }
    });

    // Cookies for Demo

    $('#in-nav').ColorPicker({
        color: '222936',
        onShow: function (colpkr) {
            $(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            $('nav, nav li, .sf-menu li li, .sf-menu li li li, #sidebar').css('backgroundColor', '#' + hex);
            $('#in-nav').css('backgroundColor', '#' + hex);
            createCookie('navCss', hex);
        }
    });

    $('#in-title').ColorPicker({
        color: '222936',
        onShow: function (colpkr) {
            $(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            $('#titlediv').css('backgroundColor', '#' + hex);
            $('#in-title').css('backgroundColor', '#' + hex);
            createCookie('titleCss', hex);
        }
    });

    var headerCss = readCookie('headerCss')
    var navCss = readCookie('navCss')
    var titleCss = readCookie('titleCss')
    var titleBG = readCookie('titleBG')
    var bodyBG = readCookie('bodyBG')

    if (headerCss != null) {
        $('header').css('backgroundColor', '#' + headerCss);
        $('#in-header').css('backgroundColor', '#' + headerCss);
        $('#faux_header').css('backgroundColor', '#' + headerCss);
    }

    if (navCss != null) {
        $('nav').css('backgroundColor', '#' + navCss);
        $('nav li').css('backgroundColor', '#' + navCss);
        $('.sf-menu li li').css('backgroundColor', '#' + navCss);
        $('.sf-menu li li li').css('backgroundColor', '#' + navCss);
        $('#in-nav').css('backgroundColor', '#' + navCss);
        $('#sidebar').css('backgroundColor', '#' + navCss);
    }

    if (titleCss != null) {
        $('#titlediv').css('backgroundColor', '#' + titleCss);
        $('#in-title').css('backgroundColor', '#' + titleCss);
    }

    if (titleBG != null) {
        $("#pattern").css("backgroundImage", "url(assets/images/background/" + titleBG + ")");
    }

    if (bodyBG != null) {
        $("body").css("backgroundImage", "url(assets/images/background/" + bodyBG + ")");
    }


    $('#colorChanger').change(function() {
        var str = $(this).val();
        var colors = str.split(',');

        $('header').css('backgroundColor', '#' + colors[0]);
        $('#faux_header').css('backgroundColor', '#' + colors[0]);
        $('nav, nav li, .sf-menu li li, .sf-menu li li li, #sidebar').css('backgroundColor', '#' + colors[1]);
        $('.pagetitle').css('backgroundColor', '#' + colors[2]);
        $('#in-header').css('backgroundColor', '#' + colors[0]);
        $('#in-nav').css('backgroundColor', '#' + colors[1]);
        $('#sidebar').css('backgroundColor', '#' + colors[1]);
        $('#in-title').css('backgroundColor', '#' + colors[2]);

        //update cookies
        createCookie('headerCss', colors[0]);
        createCookie('navCss', colors[1]);
        createCookie('titleCss', colors[2]);
    });

});

function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function eraseCookie(name) {
    createCookie(name, "", -1);
}
// /cookie functions
function changeTitlePattern() {
    var imgfile = $("#titlepattern").val();
    //alert("url(assets/images/background/"+imgfile+")");
    $("#pattern").css("backgroundImage", "url(assets/images/background/" + imgfile + ")");
    createCookie('titleBG', imgfile);
}

function changeBGPattern() {
    var imgfile = $("#backgroundpattern").val();
    //alert("url(assets/images/background/"+imgfile+")");
    $("body").css("backgroundImage", "url(assets/images/background/" + imgfile + ")");
    createCookie('bodyBG', imgfile);
}

function changePreset(){
    var preset = $("#preset").val();
    var presets = preset.split(",");
    $('header').css('backgroundColor', presets[0]);
    $('#in-header').css('backgroundColor', presets[0]);
    $('#faux_header').css('backgroundColor', presets[0]);
    $('#in-header').ColorPickerSetColor( presets[0]);
    
    $('nav').css('backgroundColor', presets[1]);
    $('nav li').css('backgroundColor', presets[1]);
    $('#in-nav').css('backgroundColor', presets[1]);
    $('#sidebar').css('backgroundColor', presets[1]);
    $('#in-nav').ColorPickerSetColor( presets[1]);
    
    $('#titlediv').css('backgroundColor',  presets[2]);
    $('#in-title').css('backgroundColor',  presets[2]);
    $('#in-title').ColorPickerSetColor( presets[2]);
    
    createCookie('headerCss', presets[0].replace("#",""));
    createCookie('navCss', presets[1].replace("#",""));
    createCookie('titleCss', presets[2].replace("#",""));
    $("#pattern").css("backgroundImage", "url(assets/images/background/" + presets[3] + ")");
    createCookie('titleBG', presets[3] );
    $("body").css("backgroundImage", "url(assets/images/background/" + presets[4] + ")");
    createCookie('bodyBG', presets[4]);
}

*/
