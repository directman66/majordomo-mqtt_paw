

[#if VIEW_MODE!="0"#] 






<table align="center" >





[#begin DEVICES#]

 <tr>
  <td>[#TITLE#]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td>

<!--  <td style="vertical-align:top"> -->
  <td > 
	[#if ONLINE!=""#]
		[#if ONLINE==1#]
			<span class="label label-success" title="<#LANG_XIMI_APP_ONLINE#>">Online</span>
		[#else#]
			<span class="label label-warning" title="<#LANG_XIMI_APP_OFFLINE#>">Offline</span>
		[#endif#]
	[#else#]
		&nbsp;
	[#endif#]
 </td> 



  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="?view_mode=getinfo&id=[#ID#]" title="#[#CCOLOR#]  [#CURRENTCOLOR#]" >
[#if TURN="23"#]
<font style="background-color:#[#CCOLOR#]"	 title="#[#CCOLOR#]  [#CURRENTCOLOR#]"> 
<i class="glyphicon glyphicon-ok-circle"></i>
</font> 
[#else#]
<i class="glyphicon  glyphicon-remove-circle"></i></a>
[#endif#]
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</td>





 <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<form action="?" method="get" class="form-horizontal" name="color_change">
   <input type="hidden" name="view_mode" value="colorpicker">
<!--   <div class="form-group"> -->
  <div class="form-group">
      <div class="col-sm-5">      

<script src="<#ROOTHTML#>templates/magichome/jscolor.js"></script>
<input class="jscolor" onchange="document.color_change.submit();" value="[#CCOLOR#][#id#]" size="4" name="colorpicker"  id="colorpicker"> 

</form>



</td>


  <td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="?view_mode=turnon&id=[#ID#]&tab=info" class="btn btn-default" title="Включить"><i class="glyphicon glyphicon-ok"></i></a> 
  <a href="?view_mode=turnoff&id=[#ID#]&tab=info" class="btn btn-default" title="Выключить"><i class="glyphicon glyphicon-remove"></i></a> 




<!--
alert('?view_mode=customhex_'+jscolor+'&id=[#ID#]')
document.location.href = '?data_source=<#DATA_SOURCE#>&view_mode=customhex_'+jscolor+'&id=[#ID#]&tab=info';
window.document.location.href='?data_source=<#DATA_SOURCE#>&view_mode=customhex_'+jscolor+'&id=[#ID#]&tab=info'
window.document.location.href='?data_source=<#DATA_SOURCE#>&view_mode=customhex_'+jscolor+'&id=[#ID#]&tab=info'
-->






<!--               
                <link rel='stylesheet' href='<#ROOTHTML#>js/spectrum/spectrum.min.css' />
                <script src='<#ROOTHTML#>js/spectrum/spectrum.min.js'></script>
                <input type="text" value="[#VALUE#]" name="[#PARAM_NAME#]_value" class="form-control" id="[#PARAM_NAME#]_value">
<!--               
<select size="1" name="selectType"  onChange="selectServers()" style="width:160px;">

                <link rel='stylesheet' href='<#ROOTHTML#>js/spectrum/spectrum.min.css' />
                <script src='<#ROOTHTML#>js/spectrum/spectrum.min.js'></script>
                <link rel='stylesheet' href='?view_mode=changeсolor_[#VALUE#]&id=[#ID#]&tab=info' />
                <input type="text" value="[#VALUE#]" name="[#PARAM_NAME#]_value" class="form-control" id="[#PARAM_NAME#]_value">
                <script type="text/javascript">
                    $("#[#PARAM_NAME#]_value").spectrum({
                        preferredFormat: "hex",
                        showInput: true,
                        chooseText: "OK",
                        cancelText: "<#LANG_CANCEL#>"
                    });
                </script>
$page = file_get_contents("http://www.domain.com/filename");
<input type="text" value="[#CCOLOR#]" name="[#PARAM_NAME#]_value" class="form-control" id="[#PARAM_NAME#]_value" onChange='file_get_contents("http://188.226.32.227/admin.php?&md=magichome&?view_mode=customhex_this.value&id=[#ID#]&tab=info");'>
<input type="text" value="[#CCOLOR#]" name="[#PARAM_NAME#]_value" class="form-control" id="[#PARAM_NAME#]_value" onChange='file_get_contents("alert(this.value);");'>
<input type="text" value="[#CCOLOR#]" name="[#PARAM_NAME#]_value" class="form-control" id="[#PARAM_NAME#]_value" onChange='file_get_contents("alert(this.value);");'>
////////////////////////////
                <link rel='stylesheet' href='<#ROOTHTML#>js/spectrum/spectrum.min.css' />
                <script src='<#ROOTHTML#>js/spectrum/spectrum.min.js'></script>
                <link rel='stylesheet' href='?view_mode=changeсolor_[#VALUE#]&id=[#ID#]&tab=info' />
<input type="text" value="[#CCOLOR#]" name="[#PARAM_NAME#]_value" class="form-control" id="[#PARAM_NAME#]_value" onChange='file_get_contents("alert(this.value);");'>
                <script type="text/javascript">
                    $("#[#PARAM_NAME#]_value").spectrum({
                        preferredFormat: "hex",
                        showInput: true,
                        chooseText: "OK",
                        cancelText: "<#LANG_CANCEL#>"
                    });
                </script>

-->

<!--
<div>
<input type="text" value="[#CCOLOR#]" name="[#PARAM_NAME#]_value" class="form-control" id="[#PARAM_NAME#]_value" onChange='alert(this.value);'>
                <script type="text/javascript">
                    $("#[#PARAM_NAME#]_value").spectrum({
                        preferredFormat: "hex",
                        showInput: true,
                        chooseText: "OK",
                        cancelText: "<#LANG_CANCEL#>"
                    });
                </script>
</div>


                <link rel='stylesheet' href='<#ROOTHTML#>js/spectrum/spectrum.min.css' />
                <script src='<#ROOTHTML#>js/spectrum/spectrum.min.js'></script>
                <link rel='stylesheet' href='?view_mode=changeсolor_[#VALUE#]&id=[#ID#]&tab=info' />
<input type="text" value="[#CCOLOR#]" name="[#PARAM_NAME#]_value" class="form-control" id="[#PARAM_NAME#]_value" onChange='file_get_contents("alert(this.value);");'>
                <script type="text/javascript">
                    $("#[#PARAM_NAME#]_value").spectrum({
                        preferredFormat: "hex",
                        showInput: true,
                        chooseText: "OK",
                        cancelText: "<#LANG_CANCEL#>"
                    });
                </script>

-->






<!--- 
<script src='<#ROOTHTML#>/js/spectrum/spectrum.min.js'></script>
<link rel='stylesheet' href='<#ROOTHTML#>/js/spectrum/spectrum.min.css' />

<div class="device-widget controller" onClick='callMethod("%.object_title%.switch");'>
    <div class="device-icon %.status|"off;on"%"></div>
<div class="device-header"><span>%.object_description%</span>
    <input type="text" id="color%.object_id%" class="colorpicker" value="%.colorSaved%" onChange='callMethod("%.object_title%.setColor","color="+encodeURIComponent(this.value));'/>
</div>

<script>
    $("#color%.object_id%").spectrum({
        preferredFormat: "hex",
        showInput: true,
        chooseText: "OK",
        cancelText: "<#LANG_CANCEL#>"
    });
</script>
</div> 
-->
<!--
 <a href="?view_mode=custom50@50@50&id=[#ID#]"class="btn btn-default" title="Custom color"><i class="glyphicon glyphicon"></i></a> 
  <a href="?view_mode=brightness50&id=[#ID#]"class="btn btn-default" title="50% brightness"><i class="glyphicon glyphicon"></i></a> 
  <a href="?view_mode=brightness100&id=[#ID#]"class="btn btn-default" title="100% brightness"><i class="glyphicon glyphicon"></i></a> 
-->
</td><td>&nbsp;&nbsp;
<table border=0>
<tr><td>
  <a href="?view_mode=setcolorhex_ff0000&id=[#ID#]&tab=info" class="btn btn-danger" color="red" title="Сменить цвет на красный"><i class="glyphicon glyphicon-asterisk"></i></a> 
</td><td>
  <a href="?view_mode=setcolorhex_00ff00&id=[#ID#]&tab=info" class="btn btn-success" title="Сменить цвет на зеленый"><i class="glyphicon glyphicon-asterisk"></i></a> 
</td><td>
  <a href="?view_mode=setcolorhex_0000ff&id=[#ID#]&tab=info" class="btn btn-primary" title="Сменить цвет на синий"><i class="glyphicon glyphicon-asterisk"></i></a> 
</td></tr><tr><td>
  <a href="?view_mode=setcolorhex_ffffff&id=[#ID#]&tab=info" class="btn btn-default" title="Сменить цвет на белый"><i class="glyphicon glyphicon-asterisk"></i></a> 
</td><td>
  <a href="?view_mode=setcolorhex_ffff00&id=[#ID#]&tab=info" class="btn btn-warning" title="Сменить цвет на желтый"><i class="glyphicon glyphicon-asterisk"></i></a> 
</td><td>
  <a href="?view_mode=setcolorhex_00ffff&id=[#ID#]&tab=info" class="btn btn-info" title="Сменить цвет на голубой"><i class="glyphicon glyphicon-asterisk"></i></a> 
</tr></table>

</td>



 </tr>

 [#end DEVICES#]

</table>

[#else DEVICES#]
<p>No devices discovered yet</p>

[#endif DEVICES#]



[#endif VIEW_MODE#]


