<?php $num_pages = $number_of_pages;?>
<?php if ($num_pages > 1): ?>
    <div class="clearfix">&nbsp;</div>    
    <div  class="dataTables_paginate paging_simple_numbers custom-pagination">

            <ul class="pagination">
                
                    <li class="paginate_button">
                        <a href="javascript:void(0);"  data-id="1" title="First">
                            <<
                        </a>
                    </li>
                    
                    <?php
                    $previous = $page - 1;
                    $start = $page - 2;
                    if ($start <= 0)
                        $start = 1;

                    $end = $page + 2;

                    if ($end > $num_pages)
                        $end = $num_pages;
                    ?>
                    <?php if ($page > 1): ?>
                        <li class="paginate_button previous">
                            <a href="javascript:void(0);"  data-id="<?php echo $previous; ?>" title="Prev"><i class="fa fa-angle-left"></i></a>
                        </li>                                                            
                    <?php else:?>
                    <?php endif; ?>
                        
                <?php
                for ($i = $start; $i <= $end; $i++) {
                    ?>
                    <?php if ($i == $page): ?>
                        <li class="paginate_button active">
                            <a href="javascript:void(0);" data-id="<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>                        
                    <?php else: ?>
                        <li class="paginate_button">
                            <a href="javascript:void(0);" data-id="<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>                                                
                    <?php endif; ?>
                    <?php
                }
                ?>
                        
            <?php if ($page < $num_pages): ?>
                <li class="paginate_button next">        
                    <a href="javascript:void(0);" data-id="<?php echo $page + 1; ?>" title="Next">
                    <i class="fa fa-angle-right"></i>
                </a>
                </li>    
            <?php else:?>            
            <?php endif; ?>

            <?php if ($num_pages > 0): ?>    
                <li class="paginate_button">
                    <a href="javascript:void(0);" data-id="<?php echo $num_pages; ?>" title="Last">>></a>
                </li>
            <?php endif; ?>    
                        
                        
                    

            </ul>
            
        
    </div>                             
    <div class="clearfix">&nbsp;</div>
<?php endif; ?>                                																		
