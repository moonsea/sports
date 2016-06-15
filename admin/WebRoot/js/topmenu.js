$(document).ready(function(){
	var a=$("#mainMenu a")
	a.each(function(i){
		$(this).click(function(){
			$(".menuSelect").removeClass("menuSelect");
		  	$(this).addClass("menuSelect");
		});
	});
});



//学生管理
function studentmanage(path){
	//alert("进入我的js函数。。。");
	//$("#leftFrame").attr("src", path+"/frameset/leftTreeProject.jsp?serialId="+new Date().toString());
	//$("#mainFrame").attr("src", path + "/frameset/projectInfo.jsp?serialId="+new Date().toString());
	parent.document.getElementById("leftFrame").setAttribute("src", path+"/frameset/left.jsp?bigCatalog=01");
	parent.document.getElementById("mainFrame").setAttribute("src", path + "/frameset/blankInfo.jsp?serialId="+new Date().toString());
}
function classmanage(path){
	//alert("进入我的js函数。。。");
	//$("#leftFrame").attr("src", path+"/frameset/leftTreeProject.jsp?serialId="+new Date().toString());
	//$("#mainFrame").attr("src", path + "/frameset/projectInfo.jsp?serialId="+new Date().toString());
	parent.document.getElementById("leftFrame").setAttribute("src", path+"/frameset/left.jsp?bigCatalog=02");
	parent.document.getElementById("mainFrame").setAttribute("src", path + "/frameset/blankInfo.jsp?serialId="+new Date().toString());
}
function staffmanage(path){
	//alert("进入我的js函数。。。");
	//$("#leftFrame").attr("src", path+"/frameset/leftTreeProject.jsp?serialId="+new Date().toString());
	//$("#mainFrame").attr("src", path + "/frameset/projectInfo.jsp?serialId="+new Date().toString());
	parent.document.getElementById("leftFrame").setAttribute("src", path+"/frameset/left.jsp?bigCatalog=03");
	parent.document.getElementById("mainFrame").setAttribute("src", path + "/frameset/blankInfo.jsp?serialId="+new Date().toString());
}
function chargesys(path){
	//alert("进入我的js函数。。。");
	//$("#leftFrame").attr("src", path+"/frameset/leftTreeProject.jsp?serialId="+new Date().toString());
	//$("#mainFrame").attr("src", path + "/frameset/projectInfo.jsp?serialId="+new Date().toString());
	parent.document.getElementById("leftFrame").setAttribute("src", path+"/frameset/left.jsp?bigCatalog=04");
	parent.document.getElementById("mainFrame").setAttribute("src", path + "/frameset/blankInfo.jsp?serialId="+new Date().toString());
}
function wagesys(path){
	//alert("进入我的js函数。。。");
	//$("#leftFrame").attr("src", path+"/frameset/leftTreeProject.jsp?serialId="+new Date().toString());
	//$("#mainFrame").attr("src", path + "/frameset/projectInfo.jsp?serialId="+new Date().toString());
	parent.document.getElementById("leftFrame").setAttribute("src", path+"/frameset/left.jsp?bigCatalog=05");
	parent.document.getElementById("mainFrame").setAttribute("src", path + "/frameset/blankInfo.jsp?serialId="+new Date().toString());
}

function financesys(path){
	//alert("进入我的js函数。。。");
	//$("#leftFrame").attr("src", path+"/frameset/leftTreeProject.jsp?serialId="+new Date().toString());
	//$("#mainFrame").attr("src", path + "/frameset/projectInfo.jsp?serialId="+new Date().toString());
	parent.document.getElementById("leftFrame").setAttribute("src", path+"/frameset/left.jsp?bigCatalog=06");
	parent.document.getElementById("mainFrame").setAttribute("src", path + "/frameset/blankInfo.jsp?serialId="+new Date().toString());
}
function booksys(path){
	//alert("进入我的js函数。。。");
	//$("#leftFrame").attr("src", path+"/frameset/leftTreeProject.jsp?serialId="+new Date().toString());
	//$("#mainFrame").attr("src", path + "/frameset/projectInfo.jsp?serialId="+new Date().toString());
	parent.document.getElementById("leftFrame").setAttribute("src", path+"/frameset/left.jsp?bigCatalog=07");
	parent.document.getElementById("mainFrame").setAttribute("src", path + "/frameset/blankInfo.jsp?serialId="+new Date().toString());
}
function systemmanage(path){
	//alert("进入我的js函数。。。");
	//$("#leftFrame").attr("src", path+"/frameset/leftTreeProject.jsp?serialId="+new Date().toString());
	//$("#mainFrame").attr("src", path + "/frameset/projectInfo.jsp?serialId="+new Date().toString());
	parent.document.getElementById("leftFrame").setAttribute("src", path+"/frameset/left.jsp?bigCatalog=08");
	parent.document.getElementById("mainFrame").setAttribute("src", path + "/frameset/blankInfo.jsp?serialId="+new Date().toString());
}
