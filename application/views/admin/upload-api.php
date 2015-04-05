<script type="text/javascript" src="<?php echo BASEURL?>scripts/upload_js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>scripts/upload_js/styles.css" />



<script type="text/javascript" >
    $(function(){
        var btnUpload=$('#upload');
        var status=$('#status');
        new AjaxUpload(btnUpload, {
            action: baseUrl+'upload-api/upload-api.php?fileindex='+fileindex, 
            name: 'uploadfile',
            onSubmit: function(file, ext){
                if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
				{ 
                    alert('Only JPG, PNG or GIF files are allowed');  
                    return false;
                }
                //status.text('Uploading...');
                status.show();
            },
            onComplete: function(file, response){
                //On completion clear the status
                //status.text('');
                status.hide();
                //Add uploaded file to list
                if(response!="error")
				{
                    if(fileindex == 1)
                    {
                        imgpath = 'students';
                        generator(response,imgpath); 
                    }
                    else if(fileindex == 2)
                    {
                        imgpath = 'logo'; 
                        generator(response,imgpath); 
                    }
                    //$('#coverpage').val(response);
                } 
				else{
                    //$('<li></li>').appendTo('#files').text(file).addClass('error');
                    alert('fail...');
                }
            }
        });
        
    });
    
    function generator(response,imgpath)
    {
        var str = '';
        str = '<div class="smallImgArea">';
        str = str+'<img src="'+baseUrl+'images/'+imgpath+'/thumb/'+response+'" border="0" height="240">';
        str = str+'<input type="hidden" name="images[0]" value="'+response+'"/>'; 
        str = str+'</div>'; 
        $('.imageupload_area_R').html(str);
    }
</script>





