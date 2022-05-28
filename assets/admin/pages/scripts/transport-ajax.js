var TableAjax = function () {

    var ListTransportAll = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#list_transport"),
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
                    "url": "data/transport_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });
	
    }
	
	var ListTransportActive = function () {

        var grid = new Datatable();
		//console.log('asdasdasjdlj');
        grid.init({
            src: $("#transport_active"),
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
                    "url": "data/transport_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
	var ListTransportBlock = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#transport_block"),
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
                    "url": "data/transport_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });

    }
	
	var ListTransportFilter = function () {
		var dataku = $('#form-transport').serialize();
        var grid = new Datatable();
		console.log(dataku);

        grid.init({
            src: $("#transport_filter"),
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
                    "url": "data/transport_ajax.php", // ajax source
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

            ListTransportAll();
            ListTransportActive();
            ListTransportBlock();
			ListTransportFilter();
      
        }

    };

}();