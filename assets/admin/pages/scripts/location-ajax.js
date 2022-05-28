var TableAjax = function () {

    var ListLocationAll = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#all_loc"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
				
            },
            loadingMessage: 'Please Wait...',
            dataTable: { 
                
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
					"type": "POST",
					"data": {"type":"1"},
                    "url": "data/location_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
	var ListLocationActive = function () {

        var grid = new Datatable();
		//console.log('asdasdasjdlj');
        grid.init({
            src: $("#active_loc"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
				
            },
            loadingMessage: 'Please Wait...',
            dataTable: { 
                
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
					"type": "POST",
					"data": {"type":"2"},
                    "url": "data/location_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
	var ListLocationBlock = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#block_loc"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
				
            },
            loadingMessage: 'Please Wait...',
            dataTable: { 
                
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
					"type": "POST",
					"data": {"type":"3"},
                    "url": "data/location_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
	var ListLocationFilter = function () {
		var dataku = $('#form-location').serialize();
        var grid = new Datatable();

        grid.init({
            src: $("#location_filter"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
				
            },
            loadingMessage: 'Please Wait...',
            dataTable: { 
                
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
					"type": "POST",
					"data": {dataku},
                    "url": "data/location_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
    return {

        //main function to initiate the module
        init: function () {

            ListLocationAll();
            ListLocationActive();
            ListLocationBlock();
			ListLocationFilter();
			
        }

    };

}();