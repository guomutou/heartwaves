<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>记录报告</title>
	
</head>
<style type="text/css">
	*{padding:0px;margin:0px;}
	h3{text-align: center;margin-top: 30px;}
	.base{border:1px solid rgb(212,212,212);width: 94%;margin-top: 30px;margin-left: 3%;margin-right: 3%;font-size: 14px;text-align: center;border-radius: 3px;height: 30px;line-height: 30px;}
	.base1{border:1px solid rgb(212,212,212);width: 94%;margin-top: 30px;margin-left: 3%;margin-right: 3%;font-size: 14px;border-radius: 3px;height: 30px;line-height: 30px;}
	.base td{border:1px solid rgb(212,212,212);}
	.base1 td{border:1px solid rgb(212,212,212);}
	.report{background-color: rgb(97,193,161);width: 100px;height: 40px;line-height: 40px;color: #fff;position: fixed;bottom: 60px;right: 3%;text-align: center;}
    .aa{position: absolute;right: 5%;top: 5%;font-size: 14px;}

    a:link,a:visited{text-decoration:none;  /*超链接无下划线*/color: #000;}
</style>
<body>
	<h3>HRV记录详情</h3>
   <a href = "" onClick="myf()"> <div class="aa">返回上一级</div></a>
	<table class="base">
		<tr>
			<td>用户名：<?php echo ($data['nickname']); ?></td>
			<td>记录类型：<?php  if ($data["timetype"] == 1){ echo "基线测试"; } else if ($data["timetype"] == 2){ echo "5分钟测试"; } else if ($data["timetype"] == 3){ echo "10分钟测试"; } else if ($data["timetype"] == 61){ echo "荷韵"; } else if ($data["timetype"] == 62){ echo "梅花"; } else if ($data["timetype"] == 63){ echo "丝绸之路"; } else if ($data["timetype"] == 64){ echo "菩提树"; } else if ($data["timetype"] == 65){ echo "生命之泉"; } else if ($data["timetype"] == 66){ echo "星空"; } else if ($data["timetype"] == 41){ echo "挪来移去"; } else if ($data["timetype"] == 42){ echo "看图绘画"; } else if ($data["timetype"] == 43){ echo "边缘视力"; } else if ($data["timetype"] == 44){ echo "多彩球"; } else if ($data["timetype"] == 45){ echo "方向瞬记"; } else if ($data["timetype"] == 46){ echo "以此类推"; } else if ($data["timetype"] == 70){ echo "神笔马良"; } else if ($data["timetype"] == 71){ echo "冒险岛"; } else if ($data["timetype"] == 72){ echo "射箭"; } else if ($data["timetype"] == 20){ echo "情境仿真"; } else{ echo "放松训练"; }?></td>
			<td>记录时间：<?php echo ($data['s_time']); ?></td>
			<td>记录时长：<?php echo ($data['time_length']); ?></td>
		</tr>
	</table>
	<table class="base">
		<tr>
			<th colspan="3">生理数据</th>
			
		</tr>
		 <tr>
            <!-- <td>M-HRT(bpm):{round($data['fmean']}</td> -->
            <td>M-HRT(bpm):<?php echo round($data['fmean'],1)?></td>
            <td>SD-HRT(bpm):<?php echo round($data['fstddev'],1)?></td>
            <td>SDNN(ms):<?php echo round($data['fsdnn'],1)?></td>
        </tr>
        <tr>
            <td>RMMSD(ms):<?php echo round($data['frmssd'],1)?></td>
            <td>SD(ms):<?php echo round($data['fsd'],1)?></td>
            <td>SDSD(ms):<?php echo round($data['fsdsd'],1)?></td>
        </tr>
        <tr>
            <td>PNN50(%):<?php echo round($data['fpnn'],1)?></td>
        </tr>
        <tr>
            <td>TP(ms2):<?php echo round($data['tp'],1)?></td>
            <td>VLF(ms2):<?php echo round($data['vlf'],1)?></td>
            <td>LF(ms2):<?php echo round($data['lf'],1)?></td>
        </tr>
        <tr>
            <td>HF(ms2):<?php echo round($data['hf'],1)?></td>
            <td>LF/HF:<?php echo round($data['lhr'],1)?></td>
            <td>LFnorm:<?php echo round($data['lfnorm'],1)?></td>
        </tr>
        <tr>
            <td>HFnorm:<?php echo round($data['hfnorm'],1)?></td>
        </tr>
    </table>
    <table class="base">
        <tr >
            <th colspan="3" >心理数据</th>
        </tr>
        <tr>
            <td>调节指数:<?php echo round($data['deflatingindex'],1)?></td>
            <td>HRV得分:<?php echo round($data['hrvscore'],1)?></td>
			<td>稳定指数:<?php echo ($data['stabilityindex']); ?></td>
		</tr>
		<tr>
			<td>综合得分:<?php echo ($data['synthesisscore']); ?></td>
			<td>压力指数:<?php echo ($data['pressureindex']); ?></td>
			<td>平均心率:<?php echo ($data['fmean']); ?></td>
		</tr>
	</table>
	<table class="base1">
		<tr>
			<th >评价报告</th>
			
		</tr>
		<tr>
			<td style="padding-left:2%;padding-right:2%;"><?php echo ($data['report']); ?></td>
		</tr>
	</table>
	<a href="<?php echo U('Recordmanager/aaa');?>&id=<?php echo ($data['id']); ?>"><div class="report">导出记录</div></a>
</body>
</html>
<script type="text/javascript">
function myf(){
    window.history.go(-1); 
}
    // // myf( );
    // alter(1);
</script>