var TableAjax = function () {

    var ListCostAll = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#all_cost"),
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
                    "url": "data/cost_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
	var ListCostActive = function () {

        var grid = new Datatable();
		//console.log('asdasdasjdlj');
        grid.init({
            src: $("#cost_active"),
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
                    "url": "data/cost_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
	var ListCostBlock = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#cost_block"),
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
                    "url": "data/cost_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
	var ListCostFilter = function () {
		var dataku = $('#form-cost').serialize();
        var grid = new Datatable();

        grid.init({
            src: $("#cost_filter"),
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
                    "url": "data/cost_ajax.php", // ajax source
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

            ListCostAll();
            ListCostActive();
            ListCostBlock();
			ListCostFilter();
			
        }

    };

}();