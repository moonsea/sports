<%@ page language="java" contentType="text/html;charset=UTF-8" %>
<%@ page
        import="com.wabacus.system.*,com.wabacus.system.component.application.report.abstractreport.AbsReportType,java.util.*,com.wabacus.system.assistant.*" %>
<%@ page import="com.wabacus.config.component.application.report.*" %>
<%@ taglib uri="wabacus" prefix="wx" %>

<h3><wx:title/></h3>
<table border="">
    <tr hidden="hidden">
        <wx:data col="game_id"/><br/>
    </tr>
    <tr>
        <td><wx:data col="game_name" showdata="false"/></td>
        <td><wx:data col="game_name" showlabel="false"/></td>
    </tr>
    <tr>
        <td><wx:data col="game_img" showdata="false"/></td>
        <td hidden="hidden"><wx:data col="game_img" showlabel="false"/></td>
        <td><wx:fileupload savepath="relative{/upload/game/}" rooturl="/upload/game/" allowtypes="bmp;png;jpg;gif"  uploadcount="1" popupparams="{width:260,height:200}"/></td>
    </tr>
    <tr hidden="hidden">
        <td><wx:data col="type_id"/>
    </tr>
    <tr>
        <td><wx:data col="type_name" showdata="false"/></td>
        <td><wx:data col="type_name" showlabel="false"/></td>
    </tr>
    <tr>
        <td><wx:data col="is_hot" showdata="false"/></td>
        <td><wx:data col="is_hot" showlabel="false"/></td>
    </tr>
    <tr>
        <td><wx:data col="is_pub" showdata="false"/></td>
        <td><wx:data col="is_pub" showlabel="false"/></td>
    </tr>
    <tr>
        <td><wx:data col="game_desc" showdata="false"/></td>
        <td><wx:data col="game_desc" showlabel="false"/> </td>
    </tr>
</table>