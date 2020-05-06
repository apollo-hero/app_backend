<div class="row">        
    <form method="post" id="search_form">
        <input type="hidden" name="page" id="page" value="1"/>    
        <input type="hidden" name="sort_order" id="sort_order" value="<?php echo $this->input->get_post('sort_order') ?>"    />                                                
        <input type="hidden" name="sort_by" id="sort_by" value="<?php echo $this->input->get_post('sort_by') ?>"    />                                                
        <div class="col-md-12">                                            
            <div class="clearfix">&nbsp;</div>
            <div class="portlet box green ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-search"></i> Search Form
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body" style="padding: 8px;">
                        <?php if (isset($search_with_date) && $search_with_date == 1): ?>
                            <div class="row">
                                <div class="col-md-4">        
                                    <div class="form-group">
                                        <label>Search Column</label>
                                        <select class="form-control" name="search_column">
                                            <option value="">select column</option>
                                            <?php foreach($search_columns as $value => $label):?>
                                                <option <?php echo $this->input->get_post('search_column') == $value ? 'selected' : ''; ?> value="<?php echo $value;?>"><?php echo $label;?></option>
                                            <?php endforeach;?>                                            
                                        </select>
                                    </div>                                                                                                                
                                </div>                                                            
                                <div class="col-md-4">        
                                    <div class="form-group">
                                        <label>Search Text</label>
                                        <input type="text" placeholder="Search Text" class="form-control" name="search_text" value="<?php echo $this->input->get_post('search_text'); ?>">
                                    </div>                                                                                                                
                                </div>                                        
                            </div>
                            <div class="row">
                                <div class="col-md-4">        
                                    <div class="form-group">
                                        <label class="">From</label>

                                        <input type="text" name="from_date" class="form-control" id="start_date" value="<?php echo $this->input->get_post('from_date'); ?>"/>

                                    </div>                                                                                                                
                                </div>    
                                <div class="col-md-4">        
                                    <div class="form-group">
                                        <label class="">To</label>

                                        <input type="text" name="to_date" class="form-control" id="end_date" value="<?php echo $this->input->get_post('to_date'); ?>"/>

                                    </div>                                                                                                                
                                </div>    
                                <div class="col-md-3">        
                                    <div class="form-group" style="margin-top: 23px;">

                                        <input type="submit" class="btn green" value="Search" />
                                        &nbsp;&nbsp;
                                        <a class="btn btn-danger" href="<?php echo $list_url; ?>">Reset</a>
                                    </div>                                                                                                                
                                </div>    
                            </div>                                
                        <?php else: ?>
                            <div class="row">
                                <div class="col-md-4">        
                                    <div class="form-group">
                                        <label>Search Column</label>
                                        <select class="form-control" name="search_column">
                                            <option value="">select column</option>
                                            <?php foreach($search_columns as $value => $label):?>
                                                <option <?php echo $this->input->get_post('search_column') == $value ? 'selected' : ''; ?> value="<?php echo $value;?>"><?php echo $label;?></option>
                                            <?php endforeach;?>                                                                                        
                                        </select>
                                    </div>                                                                                                                
                                </div>                                                            
                                <div class="col-md-4">        
                                    <div class="form-group">
                                        <label>Search Text</label>
                                        <input type="text" placeholder="Search Text" class="form-control" name="search_text" value="<?php echo $this->input->get_post('search_text'); ?>">
                                    </div>                                                                                                                
                                </div>                                        
                                <div class="col-md-3">        
                                    <div class="form-group" style="margin-top: 23px;">

                                        <input type="submit" class="btn green" value="Search" />
                                        &nbsp;&nbsp;
                                        <a class="btn btn-danger" href="<?php echo $list_url; ?>">Reset</a>
                                    </div>                                                                                                                
                                </div>                                    
                            </div>                        
                        <?php endif; ?>                            
                    </div>

                </div>

            </div>
            <div class="row">                            
                <div class="col-md-6">
                    <?php
                    if ($total_records == 1) {
                        ?>
                        <h4><?php echo $total_records; ?> Record Found</h4>    
                        <?php
                    } else {
                        ?>
                        <h4><?php echo $total_records; ?> Records Found</h4>    
                        <?php
                    }
                    ?>            
                </div>
            </div>

        </div>           
    </form>        
</div>