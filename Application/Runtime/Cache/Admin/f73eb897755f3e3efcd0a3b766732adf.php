<?php if (!defined('THINK_PATH')) exit();?>
        <!-- end top -->
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>添加角色</h2>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>欢迎使用HRV调节训练系统管理平台!</h5>
                    </div>
                    <div class="ibox-content" style = "height:1800px;">
							
                    <!--<table  border = "1" >-->
                   
                  <form name = "form1" action = "/heartwaves/index.php/Admin/Organizeconstruct/jsAddOk" method = "post">
                       	<div id="uid" style = "width:450px;height:30px;margin:15px auto;"><span style = "font-weight:bold;font-size:15px;">拥有权限:</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php foreach ($fenlei as $k => $v): ?>
                                <ul>
                                    <li>
                                        <input  type = "checkbox" name = "fid[]" value="<?php echo ($v['id']); ?>" class="<?php echo ($v['fid']); ?>" onchange="check(this)" >:<?php echo ($value['name']); ?>&nbsp;<?php echo ($v['name']); ?>-<?php echo ($v['id']); ?>-<?php echo ($v['fid']); ?>
                                    </li>

                                    <?php if(isset($v['zi'])): ?><ul>
                                        <?php foreach($v['zi'] as $k1=>$v1): ?>
                                            <li>
                                                <input  type = "checkbox" name = "fid[]" value="<?php echo ($v1['id']); ?>" class="zi<?php echo ($v1['fid']); ?>" onchange="check(this)" disabled="true">:<?php echo ($value['name']); ?>&nbsp;<?php echo ($v1['name']); ?>-<?php echo ($v1['id']); ?>-<?php echo ($v1['fid']); ?>
                                            </li>


                                            <?php if(isset($v1['zi'])): ?><ul>
                                                <?php foreach($v1['zi'] as $k2=>$v2): ?>
                                                    <li>
                                                        <input  type = "checkbox" name = "fid[]" value="<?php echo ($v2['id']); ?>" class="zi<?php echo ($v2['fid']); ?>" onchange="check(this)" disabled="true">:<?php echo ($value['name']); ?>&nbsp;<?php echo ($v2['name']); ?>-<?php echo ($v2['id']); ?>-<?php echo ($v2['fid']); ?>
                                                    </li>


                                                    <?php if(isset($v2['zi'])): ?><ul>
                                                        <?php foreach($v2['zi'] as $k3=>$v3): ?>
                                                            <li>
                                                                <input  type = "checkbox" name = "fid[]" value="<?php echo ($v3['id']); ?>" class="zi<?php echo ($v3['fid']); ?>" onchange="check(this)" disabled="true">:<?php echo ($value['name']); ?>&nbsp;<?php echo ($v3['name']); ?>-<?php echo ($v3['id']); ?>-<?php echo ($v3['fid']); ?>
                                                            </li>
                                                        <?php endforeach ?>
                                                    </ul><?php endif ?>


                                                <?php endforeach ?>
                                           </ul> <?php endif ?>


                                        <?php endforeach ?>
                                   </ul> <?php endif ?>
                                </ul>
                            <?php endforeach ?>
                        </div>


						<div style = "width:450px;height:30px;margin:50px auto;margin-top:1380px;">

						  <div style = "width:40px;display:inline-block;float:left;margin:auto 130px;"><input type = "submit" name = "submit" value = "保存"  ></div>
						  <div style = "width:40px;display:inline-block;float:left;"><input type = "submit" name = "submit" value = "取消" onclick = "history.back();"></div>
						</div>                                      
		</form>
                        <div style = "width:450px;height:30px;margin:50px auto;">
                    
                 
                   <!-- </table>-->

                    </div>
                </div>
            </div>
            </div>

        </div>
    <!-- Data Tables -->
    <script src="/heartwaves/Public/Admin/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/heartwaves/Public/Admin/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/heartwaves/Public/Admin/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/heartwaves/Public/Admin/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/heartwaves/Public/js/jquery-2.1.1.js"></script>
<script type="text/javascript">
    function doCheck(b){
        //获取所有的input选择框
        var uid = document.getElementById("uid");
        var list = uid.getElementsByTagName("input");
        //遍历
        for(var i=0;i<list.length;i++){
            switch(b){
                case 1: list[i].checked = true; break; 
                case 2: list[i].checked = false; break; 
                case 3: list[i].checked = !list[i].checked; break; 
            }
        }
    }
</script>

<script language=javascript> 
function check(t){ 
	if(t.checked == false)
	{
		var par = t.parentNode;
		var ne = par.nextElementSibling;
		var nes = ne.getElementsByTagName('input');
	    for(var i=0;i<nes.length;i++){
		console.log(nes[i]);
	    	nes[i].checked = false;
	    	nes[i].disabled = true;
	    }

	}
	else
	{
		var id = t.value;
	    var zibox = document.getElementsByClassName('zi'+id);
	    for(var i=0;i<zibox.length;i++)
	    	zibox[i].removeAttribute('disabled');
	}
} 
    /*var xz = document.getElementById(id);
    var ids = xz.value;
    alert(ids); 
    alert(xz.checked);*/ 
/*$("#xz").blur(function(){
    var xz=document.getElementById("xz"); 
    alert(xz.checked);
})*/
    /* $(".xz").blur(function(){

         var id=$(".xz").val();
         alert(id); 
         alert($(".xz").is(':checked'));

    })*/
</script>