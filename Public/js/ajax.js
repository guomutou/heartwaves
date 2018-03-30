/**
 * Created by mars on 2016/8/30.
 */

/**
 *
 */
function check(val){
    var xmlhttp;
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }

    xmlhttp.onreadystatechange=function(){//准备就绪执行
        if(xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById('show').innerHTML=xmlhttp.responseText;
        }
    }
    var pstr="un="+val;
    xmlhttp.open("post","",true);
    xmlhttp.setRequestHeader("content-type","application/x-www-form-urlencoded");
    xmlhttp.send(pstr);
    alert(pstr);
}