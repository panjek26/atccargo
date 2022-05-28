var TableAjax = function () {

    var ListPriceAll = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#list_price"),
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
                    "url": "data/price_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
	var ListPriceActive = function () {

        var grid = new Datatable();
		//console.log('asdasdasjdlj');
        grid.init({
            src: $("#active_price"),
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
                    "url": "data/price_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
	var ListPriceBlock = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#block_price"),
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
                    "url": "data/price_ajax.php", // ajax source
                },
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
            }
        });


    }
	
	var ListPriceFilter = function () {
		var dataku = $('#form-price').serialize();
        var grid = new Datatable();

        grid.init({
            src: $("#price_filter"),
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
                    "url": "data/price_ajax.php", // ajax source
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

            ListPriceAll();
            ListPriceActive();
            ListPriceBlock();
			ListPriceFilter();
			
        }

    };

}();