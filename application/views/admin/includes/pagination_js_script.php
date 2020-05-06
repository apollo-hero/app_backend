<link href="<?php echo base_url();?>assets/jquery-ui-1.8.4.custom.css" type="text/css"  rel="stylesheet" />

<script type="text/javascript">
    $(document).ready(function(){
        // check all
        $('.chkall').click(function () {
            if ($(this).is(':checked')) {
                $('.chkids').prop('checked', true);
            }
            else {
                $('.chkids').prop('checked', false);
            }
        });
        
        $('.custom-pagination a').click(function () {
            var page = $(this).data('id');
            $('#search_form #page').val(page);
            $('#search_form').submit();
            return false;
        });      
        
      
        
        $('.sort-fields1, .sort-fields3').change(function () {
            $('#search_form').submit();
            return false;
        });
        
        $('.radio-search,.sort-fields2').click(function () {
            $('#search_form').submit();
            return false;
        });   
        
        $('.sorting_desc, .sorting_asc').click(function(){
            $sortOrder = $(this).data('order');
            $sortColumn = $(this).data('column');
            $('#sort_order').val($sortOrder);
            $('#sort_by').val($sortColumn);
            $('#search_form').submit();
        })        
        
        $("#start_date").datepicker({	
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            yearRange: '1900:' + '2050',
            showButtonPanel: false,
            onClose: function( selectedDate ) {
                   $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
            }    
        });
        $("#end_date").datepicker({	
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            changeMonth: true,
            yearRange: '1900:' +'2050',
            showButtonPanel: false,
            onClose: function( selectedDate ) {
                              $("#start_date" ).datepicker( "option", "maxDate", selectedDate );
                           }    
        });        
        
    });
</script>    
