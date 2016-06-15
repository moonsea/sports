<%@ page language="java" import="java.util.*" pageEncoding="UTF-8"%>
<%@page import="java.text.*" %>
<%
String path = request.getContextPath();
String basePath  = request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()+path+"/";
%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <base href="<%=basePath%>">
    
    <title></title>
    
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">    
	<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
	<meta http-equiv="description" content="This is my page">

<script language="javascript" src="js/LodopFuncs.js"></script>
<object id="LODOP_OB" classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width=0 height=0> 
	<embed id="LODOP_EM" type="application/x-print-lodop" width=0 height=0 pluginspage="install_lodop.exe"></embed>
</object> 

  </head>
  
  <body>
  <wx:popuppage/><!-- 框架的自定义标签，一定要放在弹出窗口的JSP页面中 -->
  <%
  	String name=request.getParameter("name");
  	String classid=request.getParameter("classid");
  	String period=request.getParameter("period");
  	switch(period.toCharArray()[0])
  	{
  		case '1':period="第一节";break;
  		case '2':period="第二节";break;
  		case '3':period="第三节";break;
  		case '4':period="第四节";break;
  		case '5':period="第五节";break;
  	}
  	String startdate=request.getParameter("startdate");
  	String courseprice=request.getParameter("courseprice");
  	String toclasstime=request.getParameter("toclasstime");
  	String discount=request.getParameter("discount");
  	String zfee=request.getParameter("zfee");
  	String amount=request.getParameter("amount");
  	
  	//因为代码其他部分都是采用的optionName，这里只好写死了。
  	double dis = 1.0;
	if(discount!=null) {
		if(discount.equals("无")) dis = 1.0;
		else if(discount.equals("8折")) dis = 0.8;
		else if(discount.equals("5折")) dis = 0.5;
		else if(discount.equals("全免")) dis = 0.0;
		//防止以后再添加其他折扣
		else if(discount.equals("9折")) dis = 0.9;
		else if(discount.equals("7折")) dis = 0.7;
		else if(discount.equals("6折")) dis = 0.6;
		else if(discount.equals("4折")) dis = 0.4;
		else if(discount.equals("3折")) dis = 0.3;
		else if(discount.equals("2折")) dis = 0.2;
		else if(discount.equals("1折")) dis = 0.1;
	} else {
		dis = 1.0;
	}
	String fullamount = String.valueOf(Double.parseDouble(toclasstime)*Double.parseDouble(courseprice)+Double.parseDouble(zfee));
	  DecimalFormat formater = new DecimalFormat("#0.##");//取小数点后两位
	  fullamount = formater.format(Double.parseDouble(fullamount));
  	String remarks=request.getParameter("remarks");
	String username=session.getAttribute("name").toString();
	String bianhao=request.getParameter("bianhao");
  %> <div id="jiaofeidan">
    <div style="" class="Section0"><p style="margin-bottom: 0pt; margin-top: 0pt;" class="p0"><span style="font-size: 10.5pt; font-family: '宋体';"><O:P></O:P></span></p><p style="margin-bottom: 0pt; margin-top: 0pt; text-align: center;" class="p0"><span style="font-size: 22pt; font-family: '黑体';">&nbsp;&nbsp;&nbsp; 爱尔英语教育机构收据&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="font-size: 14pt; font-family: '黑体';">编号：<%=bianhao%></span><span style="font-size: 14pt; font-family: '黑体';"><O:P></O:P></span></p><table style="padding: 0pt 5.4pt; border-collapse: collapse;" width="676" height="200"><tbody><tr style="height: 154.75pt;"><td width="811" valign="top" style="border: 0.5pt solid rgb(0, 0, 0); padding: 0pt 5.4pt; width: 608.4pt;"><table width="757" border="0" height="211">
  <tr>
    <td width="110"><strong><font face="宋体">姓名：</font></strong></td>
    <td width="120"><u><%=name%></u><br></td>
    <td width="90"><strong>班级代码：</strong></td>
    <td width="120"><u><%=classid%></u><br></td>
    <td width="90"><strong>上课时间：</strong></td>
    <td width="120"><u><%=period%></u><br></td>
  </tr>
  <tr>
    <td><strong>收费起始时间：</strong></td>
    <td colspan="5"><u><%=startdate%></u><br></td>
  </tr>
  <tr>
    <td><strong>单位收费：</strong></td>
    <td><u><%=courseprice%></u><br></td>
    <td><strong>应收节数：</strong></td>
    <td><u><%=toclasstime%></u><br></td>
    <td><strong>优惠额度：</strong></td>
    <td><u><%=discount%></u><br></td>
  </tr>
  <tr>
    <td><strong>资料费用：</strong></td>
    <td><u><%=zfee %></u><br></td>
    <td><strong>应收金额：</strong></td>
    <td><u><%=fullamount%></u><br></td>
    <td><strong>实收金额：</strong></td>
    <td><u><%=amount%></u><br></td>
  </tr>
  <tr>
    <td><strong>备注：</strong></td>
    <td colspan="5"><u><%=remarks%></u></td>
  </tr>
</table><br></td></tr></tbody></table><p style="text-indent: 15.75pt; margin-bottom: 0pt; margin-top: 0pt;" class="p0"><span style="font-size: 10.5pt; font-family: '宋体';">&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <strong>收款人：<u><%=username%></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font face="宋体">交接人：</font><font face="Times New Roman">_________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font face="宋体">审核人：</font><font face="Times New Roman">_______________</font></strong></span></p><div align="center"><span style="font-size: 10.5pt; font-family: '宋体';"></span><br><span style="font-size: 10.5pt; font-family: '宋体';"></span></div><p style="text-indent: 15.75pt; margin-bottom: 0pt; margin-top: 0pt;" class="p0"><span style="font-size: 10.5pt; font-family: '宋体';"><O:P></O:P></span></p></div>
    </div>
    <div align="center"><a href="javascript:prn1_preview()">打印预览</a>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<a href="javascript:prn1_print()">直接打印</a></div>
    
    
    <script language="javascript" type="text/javascript">   
        var LODOP; //声明为全局变量 
	function prn1_preview() {	
		CreateOneFormPage();	
		LODOP.PREVIEW();	
	};
	function prn1_print() {		
		CreateOneFormPage();
		LODOP.PRINT();	
	};
	function prn1_printA() {		
		CreateOneFormPage();
		LODOP.PRINTA(); 	
	};	
	function CreateOneFormPage(){
		LODOP=getLodop(document.getElementById('LODOP_OB'),document.getElementById('LODOP_EM'));  
		LODOP.PRINT_INIT("打印控件功能演示_Lodop功能_表单一");
		LODOP.SET_PRINT_STYLE("FontSize",18);
		LODOP.SET_PRINT_STYLE("Bold",1);
		LODOP.ADD_PRINT_TEXT(50,231,260,39,"打印页面部分内容");
		LODOP.ADD_PRINT_HTM(0,0,"100%","100%",document.getElementById("jiaofeidan").innerHTML);
	};	                     
	function prn2_preview() {	
		CreateTwoFormPage();	
		LODOP.PREVIEW();	
	};
	function prn2_manage() {	
		CreateTwoFormPage();
		LODOP.PRINT_SETUP();	
	};	
	function CreateTwoFormPage(){
		LODOP=getLodop(document.getElementById('LODOP_OB'),document.getElementById('LODOP_EM'));  
		LODOP.PRINT_INIT("打印控件功能演示_Lodop功能_表单二");
		LODOP.ADD_PRINT_RECT(70,27,634,242,0,1);
		LODOP.ADD_PRINT_TEXT(29,236,279,38,"页面内容改变布局打印");
		LODOP.SET_PRINT_STYLEA(2,"FontSize",18);
		LODOP.SET_PRINT_STYLEA(2,"Bold",1);
		LODOP.ADD_PRINT_HTM(88,40,321,185,document.getElementById("form1").innerHTML);
		LODOP.ADD_PRINT_HTM(87,355,285,187,document.getElementById("form2").innerHTML);
		LODOP.ADD_PRINT_TEXT(319,58,500,30,"注：其中《表单一》按显示大小，《表单二》在程序控制宽度(285px)内自适应调整");
	};              
	function prn3_preview(){
		LODOP=getLodop(document.getElementById('LODOP_OB'),document.getElementById('LODOP_EM'));  
		LODOP.PRINT_INIT("打印控件功能演示_Lodop功能_全页");
		LODOP.ADD_PRINT_HTM(0,0,"100%","100%",document.documentElement.innerHTML);
		LODOP.PREVIEW();	
	};	
</script> 
  </body>
</html>
