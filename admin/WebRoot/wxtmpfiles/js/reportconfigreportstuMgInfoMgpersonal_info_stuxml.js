function validate_personal_info_stu_guid_personal_info_show_stu_wxcol_grade_name(metadataObj,boxMetadataObj,boxValue,boxObj,paramsObj,isOnblur){var errorpromptparamsObj=null;if(boxMetadataObj!=null) errorpromptparamsObj=getObjectByJsonString(boxMetadataObj.getAttribute('errorpromptparamsonblur'));if(!isNotEmpty(boxValue,boxObj,paramsObj)){  var errormess=paramsObj.isNotEmpty_errormessage;  if(errormess!=null&&errormess!='')  {      errormess=errormess.replace(/#label#/g,paramsObj.inputbox_label);      errormess=errormess.replace(/#data#/g,boxValue);      var tiparamsObj=paramsObj.isNotEmpty_tiparams;if(tiparamsObj==null) tiparamsObj=errorpromptparamsObj;      if(errormess!=null&&errormess!='')      {          if(isOnblur===true){wx_jsPromptErrorOnblur(metadataObj,boxObj,errormess,tiparamsObj);}else{wx_warn(errormess);}      }  }  return false;}else{  wx_hideJsPromptErrorOnblur(metadataObj,boxObj);}return true;}function validate_personal_info_stu_guid_personal_info_show_stu_wxcol_dep_name(metadataObj,boxMetadataObj,boxValue,boxObj,paramsObj,isOnblur){var errorpromptparamsObj=null;if(boxMetadataObj!=null) errorpromptparamsObj=getObjectByJsonString(boxMetadataObj.getAttribute('errorpromptparamsonblur'));if(!isNotEmpty(boxValue,boxObj,paramsObj)){  var errormess=paramsObj.isNotEmpty_errormessage;  if(errormess!=null&&errormess!='')  {      errormess=errormess.replace(/#label#/g,paramsObj.inputbox_label);      errormess=errormess.replace(/#data#/g,boxValue);      var tiparamsObj=paramsObj.isNotEmpty_tiparams;if(tiparamsObj==null) tiparamsObj=errorpromptparamsObj;      if(errormess!=null&&errormess!='')      {          if(isOnblur===true){wx_jsPromptErrorOnblur(metadataObj,boxObj,errormess,tiparamsObj);}else{wx_warn(errormess);}      }  }  return false;}else{  wx_hideJsPromptErrorOnblur(metadataObj,boxObj);}return true;}