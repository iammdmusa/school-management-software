<style>
    .imageupload_area{width:100%;float:left;}
    .imageupload_area_L{width:30%;float:left;}
    .imageupload_area_R{width:70%;float:left;}
    .smallImgArea{width:40px;height:40px;float:left;margin-right:5px;margin-bottom:5px;}
    .feature_LR{width:50%;float:left;}
    .airport_stopage{float: left;clear: both;}
    .airport_list_div{display: none;}
    .content_area{overflow-x: auto;}
    /*#result_details_container {width:700px; overflow: auto;}*/
</style>

<fieldset>
    <div class="widget">
        <div class="title"><h6>Result</h6></div>
        <div class="formRow">
            <div class="divBox">
                <div class="levelttlBOX">Class</div>
                <div class="selectionBox">
                    <select id="class_name_id" name="class_name_id" required> 
                        <option value="" >Select One</option>
                        <?php if($class): ?>
                             <?php foreach($class as $cls): ?>
                                <option value="<?php echo $cls['class_name_id'];?>" ><?php echo $cls['classname'];?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>                            
                </div>
                <div class="levelttlBOX">
                    Section
                </div>
                <div class="selectionBox">
                    <select id="section_name_id" name="section_name_id" required> 
                        <option value="">Select One</option>
                    </select>                            
                </div>
                
                <div class="levelttlBOX">
                    Exam
                </div>
                <div class="selectionBox">
                    <select id="exam_name_id" name="exam_name_id" required> 
                        <option value="">Select One</option>
                    </select>                            
                </div>
                <div class="levelttlBOX">
                    <input type="button" id="showBtn" name="showBtn" value="Show" onclick="get_result_sheet_SMS_v2_1(); return false;">
                </div>
            </div>
            <div class="clear"></div>      
        </div>
        <div class="clear"></div>
        <div class="formRow" id="result_details_container"></div>
    </div> 
</fieldset>
<script type="text/javascript">
    $(document).ready(function() {
        $("#class_name_id").change(function() {
            var content = {
                class_name_id: $(this).val(),
                ajax: true
            }
            $.ajax({
                url: "<?php echo site_url('tabulation_sheet/getSection')?>",
                type: 'POST',
                data: content,
                success: function(data) {
                    $('#section_name_id').html(data);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#section_name_id").change(function() {
            var class_name_id = $("#class_name_id").val();
            var section_name_id = $("#section_name_id").val();
            var content = {
                class_name_id: class_name_id,
                section_name_id: section_name_id,
                ajax: true
            }
            $.ajax({
                url: "<?php echo site_url('tabulation_sheet/getClassExam')?>",
                type: 'POST',
                data: content,
                success: function(data) { 
                    console.log(data);
                    $('#exam_name_id').html(data);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#showBtn").click(function() {
            var class_name_id = $("#class_name_id").val();
            var section_name_id = $("#class_name_id").val();
            var exam_name_id = $("#class_name_id").val();
            
            if(class_name_id == "") {
                alert("Please Select Class name");
            } else if(section_name_id == "") {
                alert("Please Select Section name");
            } else if(exam_name_id == "") {
                alert("Please Select Exam name");
            } else {
                $('#result_details_container').html("Loading please wait...");
                var content = {
                    class_name_id: $("#class_name_id").val(),
                    section_name_id: $("#section_name_id").val(),
                    exam_name_id: $("#exam_name_id").val(),
                    ajax: true
                }
                $.ajax({
                    url: "<?php echo site_url('tabulation_sheet/getResultDetails')?>",
                    type: 'POST',
                    data: content,
                    success: function(data) { 
                        $('#result_details_container').html(data);
                    }
                });
            }
        });
    });
</script>