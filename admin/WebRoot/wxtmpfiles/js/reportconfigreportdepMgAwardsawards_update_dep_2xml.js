function validate_awards_update_dep_2_guid_report2_wxcol_Team_Mem_Order(metadataObj,boxMetadataObj,boxValue,boxObj,paramsObj,isOnblur){var errorpromptparamsObj=null;if(boxMetadataObj!=null) errorpromptparamsObj=getObjectByJsonString(boxMetadataObj.getAttribute('errorpromptparamsonblur'));if(!isNotEmpty(boxValue,boxObj,paramsObj)){  var errormess=paramsObj.isNotEmpty_errormessage;  if(errormess!=null&&errormess!='')  {      errormess=errormess.replace(/#label#/g,paramsObj.inputbox_label);      errormess=errormess.replace(/#data#/g,boxValue);      var tiparamsObj=paramsObj.isNotEmpty_tiparams;if(tiparamsObj==null) tiparamsObj=errorpromptparamsObj;      if(errormess!=null&&errormess!='')      {          if(isOnblur===true){wx_jsPromptErrorOnblur(metadataObj,boxObj,errormess,tiparamsObj);}else{wx_warn(errormess);}      }  }  return false;}else{  wx_hideJsPromptErrorOnblur(metadataObj,boxObj);}if(!isNumeric(boxValue,boxObj,paramsObj)){  var errormess=paramsObj.isNumeric_errormessage;  if(errormess!=null&&errormess!='')  {      errormess=errormess.replace(/#label#/g,paramsObj.inputbox_label);      errormess=errormess.replace(/#data#/g,boxValue);      var tiparamsObj=paramsObj.isNumeric_tiparams;if(tiparamsObj==null) tiparamsObj=errorpromptparamsObj;      if(errormess!=null&&errormess!='')      {          if(isOnblur===true){wx_jsPromptErrorOnblur(metadataObj,boxObj,errormess,tiparamsObj);}else{wx_warn(errormess);}      }  }  return false;}else{  wx_hideJsPromptErrorOnblur(metadataObj,boxObj);}return true;}function validate_awards_update_dep_2_guid_report2_wxcol_Team_Mem_Num(metadataObj,boxMetadataObj,boxValue,boxObj,paramsObj,isOnblur){var errorpromptparamsObj=null;if(boxMetadataObj!=null) errorpromptparamsObj=getObjectByJsonString(boxMetadataObj.getAttribute('errorpromptparamsonblur'));if(!isNotEmpty(boxValue,boxObj,paramsObj)){  var errormess=paramsObj.isNotEmpty_errormessage;  if(errormess!=null&&errormess!='')  {      errormess=errormess.replace(/#label#/g,paramsObj.inputbox_label);      errormess=errormess.replace(/#data#/g,boxValue);      var tiparamsObj=paramsObj.isNotEmpty_tiparams;if(tiparamsObj==null) tiparamsObj=errorpromptparamsObj;      if(errormess!=null&&errormess!='')      {          if(isOnblur===true){wx_jsPromptErrorOnblur(metadataObj,boxObj,errormess,tiparamsObj);}else{wx_warn(errormess);}      }  }  return false;}else{  wx_hideJsPromptErrorOnblur(metadataObj,boxObj);}return true;}function validate_awards_update_dep_2_guid_report1_wxcol_pro_sta_awards(metadataObj,boxMetadataObj,boxValue,boxObj,paramsObj,isOnblur){var errorpromptparamsObj=null;if(boxMetadataObj!=null) errorpromptparamsObj=getObjectByJsonString(boxMetadataObj.getAttribute('errorpromptparamsonblur'));if(!isNotEmpty(boxValue,boxObj,paramsObj)){  var errormess=paramsObj.isNotEmpty_errormessage;  if(errormess!=null&&errormess!='')  {      errormess=errormess.replace(/#label#/g,paramsObj.inputbox_label);      errormess=errormess.replace(/#data#/g,boxValue);      var tiparamsObj=paramsObj.isNotEmpty_tiparams;if(tiparamsObj==null) tiparamsObj=errorpromptparamsObj;      if(errormess!=null&&errormess!='')      {          if(isOnblur===true){wx_jsPromptErrorOnblur(metadataObj,boxObj,errormess,tiparamsObj);}else{wx_warn(errormess);}      }  }  return false;}else{  wx_hideJsPromptErrorOnblur(metadataObj,boxObj);}return true;}function validate_awards_update_dep_2_guid_report1_wxcol_Pro_Name(metadataObj,boxMetadataObj,boxValue,boxObj,paramsObj,isOnblur){var errorpromptparamsObj=null;if(boxMetadataObj!=null) errorpromptparamsObj=getObjectByJsonString(boxMetadataObj.getAttribute('errorpromptparamsonblur'));if(!isNotEmpty(boxValue,boxObj,paramsObj)){  var errormess=paramsObj.isNotEmpty_errormessage;  if(errormess!=null&&errormess!='')  {      errormess=errormess.replace(/#label#/g,paramsObj.inputbox_label);      errormess=errormess.replace(/#data#/g,boxValue);      var tiparamsObj=paramsObj.isNotEmpty_tiparams;if(tiparamsObj==null) tiparamsObj=errorpromptparamsObj;      if(errormess!=null&&errormess!='')      {          if(isOnblur===true){wx_jsPromptErrorOnblur(metadataObj,boxObj,errormess,tiparamsObj);}else{wx_warn(errormess);}      }  }  return false;}else{  wx_hideJsPromptErrorOnblur(metadataObj,boxObj);}return true;}function validate_awards_update_dep_2_guid_report1_wxcol_con_loc(metadataObj,boxMetadataObj,boxValue,boxObj,paramsObj,isOnblur){var errorpromptparamsObj=null;if(boxMetadataObj!=null) errorpromptparamsObj=getObjectByJsonString(boxMetadataObj.getAttribute('errorpromptparamsonblur'));if(!isNotEmpty(boxValue,boxObj,paramsObj)){  var errormess=paramsObj.isNotEmpty_errormessage;  if(errormess!=null&&errormess!='')  {      errormess=errormess.replace(/#label#/g,paramsObj.inputbox_label);      errormess=errormess.replace(/#data#/g,boxValue);      var tiparamsObj=paramsObj.isNotEmpty_tiparams;if(tiparamsObj==null) tiparamsObj=errorpromptparamsObj;      if(errormess!=null&&errormess!='')      {          if(isOnblur===true){wx_jsPromptErrorOnblur(metadataObj,boxObj,errormess,tiparamsObj);}else{wx_warn(errormess);}      }  }  return false;}else{  wx_hideJsPromptErrorOnblur(metadataObj,boxObj);}return true;}