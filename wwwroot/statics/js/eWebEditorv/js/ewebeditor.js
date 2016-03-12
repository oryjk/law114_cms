﻿/*
*######################################
* eWebEditor v5.5 - Advanced online web based WYSIWYG HTML editor.
* Copyright (c) 2003-2008 eWebSoft.com
*
* For further information go to http://www.ewebsoft.com/
* This copyright notice MUST stay intact for use.
*######################################
*/

String.prototype.Contains = function(s) {
    return (this.indexOf(s) > -1);
};
String.prototype.StartsWith = function(s) {
    return (this.substr(0, s.length) == s);
};
String.prototype.EndsWith = function(s, ignoreCase) {
    var L1 = this.length;
    var L2 = s.length;
    if (L2 > L1) {
        return false;
    }
    if (ignoreCase) {
        var oRegex = new RegExp(s + '$', 'i');
        return oRegex.test(this);
    } else {
        return (L2 == 0 || this.substr(L1 - L2, L2) == s);
    }
};
Array.prototype.IndexOf = function(s) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == s) {
            return i;
        }
    }
    return - 1;
};
var myParam = new Object();
myParam_Init();
function myParam_Init() {
    var URLParams = new Object();
    var aParams = document.location.search.substr(1).split("&");
    for (i = 0; i < aParams.length; i++) {
        var aParam = aParams[i].split("=");
        URLParams[aParam[0]] = aParam[1];
    }
    myParam.LinkField = URLParams["id"];
    myParam.LinkOriginalFileName = URLParams["originalfilename"];
    myParam.LinkSaveFileName = URLParams["savefilename"];
    myParam.LinkSavePathFileName = URLParams["savepathfilename"];
    myParam.ExtCSS = URLParams["extcss"];
    myParam.FullScreen = URLParams["fullscreen"];
    myParam.StyleName = (URLParams["style"]) ? URLParams["style"] : "coolblue";
    myParam.CusDir = (URLParams["cusdir"]) ? URLParams["cusdir"] : "";
    myParam.Skin = (URLParams["skin"]) ? URLParams["skin"] : "";
    myParam.FixWidth = (URLParams["fixwidth"]) ? URLParams["fixwidth"] : "";
    myParam.Lang = (URLParams["lang"]) ? URLParams["lang"] : "";
    myParam.AreaCssMode = (URLParams["areacssmode"] == "1") ? "1": "";
	//后台上传使用哪种语言,默认asp;
	myParam.Ext = (URLParams["ext"]) ? URLParams["ext"]: "php";
}
var config = new Object();
config.StyleName = myParam.StyleName;
config.CusDir = myParam.CusDir;
var myBrowser = new Object();
myBrowser_Init();
function myBrowser_Init() {
    var s = navigator.userAgent.toLowerCase();
    myBrowser.IsIE = s.Contains('msie');
    myBrowser.IsIE7 = s.Contains('msie 7');
    myBrowser.IsSP2 = s.Contains("sv1");
    myBrowser.IsGecko = s.Contains('gecko/');
    myBrowser.IsSafari = s.Contains('safari');
    myBrowser.IsOpera = s.Contains('opera');
    myBrowser.IsMac = s.Contains('macintosh');
    myBrowser.IsCompatible = myBrowser_IsCompatible();
    if (!myBrowser.IsCompatible) {
        var a = parent.document.getElementsByTagName("IFRAME");
        for (var i = 0; i < a.length; i++) {
            if (a[i].contentWindow == window) {
                a[i].style.display = "none";
                parent.document.getElementsByName(myParam.LinkField)[0].style.display = "";
            }
        }
    }
}
function myBrowser_IsCompatible() {
    if (myBrowser.IsIE && !myBrowser.IsMac && !myBrowser.IsOpera) {
        var s_Ver = navigator.appVersion.match(/MSIE (.\..)/)[1];
        return (s_Ver >= 5.5);
    }
    return false;
}
var lang = new Object();
lang.AvailableLangs = {
    "da": true,
    "de": true,
    "en": true,
    "fr": true,
    "it": true,
    "es": true,
    "ja": true,
    "nl": true,
    "no": true,
    "pt": true,
    "ru": true,
    "sv": true,
    "zh-cn": true,
    "zh-tw": true
};
lang.GetActiveLanguage = function() {
    if (myParam.Lang) {
        return myParam.Lang;
    }
    if (config.AutoDetectLanguage == "1") {
        var sUserLang;
        if (navigator.userLanguage) {
            sUserLang = navigator.userLanguage.toLowerCase();
        } else if (navigator.language) {
            sUserLang = navigator.language.toLowerCase();
        } else {
            return this.DefaultLanguage;
        }
        if (this.AvailableLangs[sUserLang]) {
            return sUserLang;
        } else if (sUserLang.length > 2) {
            sUserLang = sUserLang.substr(0, 2);
            if (this.AvailableLangs[sUserLang]) {
                return sUserLang;
            }
        }
    }
    return this.DefaultLanguage;
};
lang.TranslatePage = function(targetDocument) {
    var aInputs = targetDocument.getElementsByTagName("INPUT");
    for (i = 0; i < aInputs.length; i++) {
        if (aInputs[i].getAttribute("lang")) {
            aInputs[i].value = lang[aInputs[i].getAttribute("lang")];
        }
    }
    var aSpans = targetDocument.getElementsByTagName("SPAN");
    for (i = 0; i < aSpans.length; i++) {
        if (aSpans[i].getAttribute("lang")) {
            aSpans[i].innerHTML = lang[aSpans[i].getAttribute("lang")];
        }
    }
    var aOptions = targetDocument.getElementsByTagName("OPTION");
    for (i = 0; i < aOptions.length; i++) {
        if (aOptions[i].getAttribute("lang")) {
            aOptions[i].innerHTML = lang[aOptions[i].getAttribute("lang")];
        }
    }
};
lang.Init = function() {
    if (this.AvailableLangs[config.DefaultLanguage]) {
        this.DefaultLanguage = config.DefaultLanguage;
    } else {
        this.DefaultLanguage = "en";
    }
    this.ActiveLanguage = this.GetActiveLanguage();
};
var myEditor = new Object();
function myEditor_Init() {
    myEditor.CurrMode = null;
    myEditor.IsEditMode = null;
    myEditor.LinkField = null;
    if (!myBrowser.IsCompatible) {
        return;
    }
    var s = document.location.pathname;
    myEditor.RootPath = s.substr(0, s.length - 15);
    myEditor.BaseHref = "";
    if (config.BaseHref != "") {
        myEditor.BaseHref = "<base href='" + document.location.protocol + "//" + document.location.host + config.BaseHref + "'>";
    }
    if (myParam.ExtCSS) {
        myEditor.ExtCSS = "<link href='" + relative2fullpath(myParam.ExtCSS) + "' type='text/css' rel='stylesheet'>";
    } else {
        myEditor.ExtCSS = "";
    }
    if (myParam.Skin) {
        config.Skin = myParam.Skin;
    }
    if (myParam.FixWidth) {
        config.FixWidth = myParam.FixWidth;
    }
    if (myParam.AreaCssMode) {
        config.AreaCssMode = myParam.AreaCssMode;
    }
    document.oncontextmenu = CancelEvent;
    document.ondragstart = CancelEvent;
    document.onselectstart = CancelEvent;
    document.onselect = CancelEvent;
    Menu_Init();
}
function getDoc() {
    return getWin().document;
}
function getWin() {
    return document.getElementById("eWebEditor").contentWindow;
}
var bInitialized = false;
window.onload = function() {
    if (bInitialized) {
        return;
    }
    bInitialized = true;
    if (!myBrowser.IsCompatible) {
        return;
    }
    myEditor.LinkField = parent.document.getElementsByName(myParam.LinkField)[0];
    initHistory();
    InitTB();
    for (var i = 0; i < document.all.length; i++) {
        document.all[i].unselectable = "on";
    }
    document.getElementById("eWebEditor").unselectable = "off";
    if (!myBrowser.IsCompatible) {
        config.InitMode = "TEXT";
    }
    if (ContentFlag.value == "0") {
        ContentEdit.value = myEditor.LinkField.value;
        ContentLoad.value = myEditor.LinkField.value;
        ModeEdit.value = config.InitMode;
        ContentFlag.value = "1";
    }
    setMode(ModeEdit.value);
    setLinkedField();
};
function getFixWidthHTML(html) {
    if (config.FixWidth) {
        var re = new RegExp("<div (.*?)id=eWebEditor_FixWidth_DIV(.*?)>", "gi");
        if (!re.test(html)) {
            return "<div id=eWebEditor_FixWidth_DIV style='width:" + config.FixWidth + ";height:100%' unselectable>" + html + "</div>";
        }
    }
    return html;
}
function InitBtn(btn) {
    btn.onmouseover = BtnMouseOver;
    btn.onmouseout = BtnMouseOut;
    btn.onmousedown = BtnMouseDown;
    btn.onmouseup = BtnMouseUp;
    btn.ondragstart = CancelEvent;
    btn.onselectstart = CancelEvent;
    btn.onselect = CancelEvent;
    btn.YINITIALIZED = true;
    return true;
}
function CancelEvent() {
    event.returnValue = false;
    event.cancelBubble = true;
    return false;
}
function getBtnEventElement() {
    var el = event.srcElement;
    if (el.tagName == "IMG") {
        el = el.parentNode;
    }
    if (el.className == "TB_Btn_Image") {
        el = el.parentNode;
    }
    return el;
}
BtnMouseOver = function() {
    var el = getBtnEventElement();
    el.className = "TB_Btn_Over";
};
BtnMouseOut = function() {
    var el = getBtnEventElement();
    el.className = "TB_Btn";
};
BtnMouseDown = function() {
    var el = getBtnEventElement();
    el.className = "TB_Btn_Down";
};
BtnMouseUp = function() {
    var el = getBtnEventElement();
    if (el.className = "TB_Btn_Down") {
        el.className = "TB_Btn_Over";
    } else {
        el.className = "TB_Btn";
    }
};
function InitTB(y) {
    var i, els, el, p;
    p = document.getElementById("eWebEditor_Toolbar");
    els = p.getElementsByTagName("div");
    for (i = 0; i < els.length; i++) {
        el = els[i];
        if (el.className == "TB_Btn") {
            if (el.YINITIALIZED == null) {
                if (!InitBtn(el)) {
                    alert("Problem initializing:" + el.id);
                    return false;
                }
            }
        }
    }
    return true;
}
function setLinkedField() {
    if (!myEditor.LinkField) {
        return;
    }
    var oForm = myEditor.LinkField.form;
    if (!oForm) {
        return;
    }
    oForm.attachEvent("onsubmit", AttachSubmit);
    if (!oForm.submitEditor) oForm.submitEditor = new Array();
    oForm.submitEditor[oForm.submitEditor.length] = AttachSubmit;
    if (!oForm.originalSubmit) {
        oForm.originalSubmit = oForm.submit;
        oForm.submit = function() {
            if (this.submitEditor) {
                for (var i = 0; i < this.submitEditor.length; i++) {
                    this.submitEditor[i]();
                }
            }
            this.originalSubmit();
        };
    }
    oForm.attachEvent("onreset", AttachReset);
    if (!oForm.resetEditor) oForm.resetEditor = new Array();
    oForm.resetEditor[oForm.resetEditor.length] = AttachReset;
    if (!oForm.originalReset) {
        oForm.originalReset = oForm.reset;
        oForm.reset = function() {
            if (this.resetEditor) {
                for (var i = 0; i < this.resetEditor.length; i++) {
                    this.resetEditor[i]();
                }
            }
            this.originalReset();
        };
    }
}
function AttachSubmit() {
    var oForm = myEditor.LinkField.form;
    if (!oForm) {
        return;
    }
    var html = getHTML();
    ContentEdit.value = html;
    if (myEditor.CurrMode == "TEXT") {
        html = HTMLEncode(html);
    }
    splitTextField(myEditor.LinkField, html);
}
function doSubmit() {
    var oForm = myEditor.LinkField.form;
    if (!oForm) {
        return;
    }
    oForm.submit();
}
function AttachReset() {
    if (myEditor.IsEditMode) {
        getDoc().body.innerHTML = ContentLoad.value;
    } else {
        getDoc().body.innerText = ContentLoad.value;
    }
}
function onHelp() {
    showDialog('about.htm');
    return false;
}
var sPasteBookmark;
function onPaste() {
    if (myEditor.CurrMode == "VIEW") {
        return false;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    if (myEditor.CurrMode == "EDIT") {
        var sHTML = GetClipboardHTML();
        if (config.AutoDetectPasteFromWord == "1") {
            var re = /<\w[^>]* class=\"?(MsoNormal|MsoHeader)\"?/gi;
            var b = re.test(sHTML);
            if (!b) {
                re = /<\w[^>]* mso-/gi;
                b = re.test(sHTML);
            }
            if (b) {
                sPasteBookmark = getDoc().selection.createRange().getBookmark();
                window.setTimeout("PasteWord()", 10);
                getWin().event.returnValue = false;
                return false;
            }
        }
        getDoc().selection.createRange().pasteHTML(sHTML);
        CorrectPath();
        return false;
    } else {
        getDoc().selection.createRange().pasteHTML(HTMLEncode(clipboardData.getData("Text")));
        saveHistory();
        return false;
    }
}
function PasteWord() {
    if (sPasteBookmark) {
        var rng = getDoc().selection.createRange();
        rng.moveToBookmark(sPasteBookmark);
        rng.select();
    }
    var arr = showModalDialog("dialog/importword.htm?action=paste", window, "dialogWidth:0px;dialogHeight:0px;help:no;scroll:no;status:no");
    if (arr) {
        saveHistory();
        return false;
    }
    sPasteBookmark = "";
}
function onKeyDown(event) {
    var n_KeyCode = event.keyCode;
    var s_Key = String.fromCharCode(n_KeyCode).toUpperCase();
    if (n_KeyCode == 113) {
        showBorders();
        return false;
    }
    if (event.ctrlKey) {
        if (n_KeyCode == 10) {
            doSubmit();
            return false;
        }
        if (s_Key == "+") {
            sizeChange(300);
            return false;
        }
        if (s_Key == "-") {
            sizeChange( - 300);
            return false;
        }
        if (s_Key == "1") {
            setMode("CODE");
            return false;
        }
        if (s_Key == "2") {
            setMode("EDIT");
            return false;
        }
        if (s_Key == "3") {
            setMode("TEXT");
            return false;
        }
        if (s_Key == "4") {
            setMode("VIEW");
            return false;
        }
        if (s_Key == "A") {
            if ((myEditor.CurrMode != "CODE") && (config.FixWidth)) {
                SelectAll_FixWidth();
            } else {
                FE();
                if (!history.saved) {
                    saveHistory();
                }
                getDoc().execCommand("SelectAll");
                saveHistory();
                FE();
            }
            return false;
        }
    }
    switch (myEditor.CurrMode) {
    case "VIEW":
        return true;
        break;
    case "EDIT":
        if (event.ctrlKey) {
            if (s_Key == "D") {
                PasteWord();
                return false;
            }
            if (s_Key == "R") {
                findReplace();
                return false;
            }
            if (s_Key == "Z") {
                goHistory( - 1);
                return false;
            }
            if (s_Key == "Y") {
                goHistory(1);
                return false;
            }
        } else if ((config.EnterMode == "2") && (n_KeyCode == 13)) {
            if (!myHistory.saved) {
                saveHistory();
            }
            myHistory.saved = false;
            var rng = getDoc().selection.createRange();
            if (event.shiftKey) {
                var p = rng.parentElement();
                if (p.tagName != "P" || p.innerHTML == "") {
                    rng.pasteHTML("&nbsp;");
                    rng.select();
                    rng.collapse(false);
                }
                try {
                    rng.pasteHTML("</P><P id=eWebEditor_Temp_P>");
                } catch(e) {
                    return false;
                }
                event.cancelBubble = true;
                event.returnValue = false;
                var el = getDoc().getElementById("eWebEditor_Temp_P");
                if (el.innerHTML == "") {
                    el.innerHTML = "&nbsp;";
                }
                rng.moveToElementText(el);
                rng.select();
                rng.collapse(false);
                rng.select();
                el.removeAttribute("id");
            } else {
                try {
                    rng.pasteHTML("<br>");
                } catch(e) {
                    return false;
                }
                event.cancelBubble = true;
                event.returnValue = false;
                rng.select();
                rng.moveEnd("character", 1);
                rng.moveStart("character", 1);
                rng.collapse(false);
            }
            return false;
        }
        break;
    default:
        if (n_KeyCode == 13) {
            if (!myHistory.saved) {
                saveHistory();
            }
            myHistory.saved = false;
            var sel = getDoc().selection.createRange();
            sel.pasteHTML("<BR>");
            event.cancelBubble = true;
            event.returnValue = false;
            sel.select();
            sel.moveEnd("character", 1);
            sel.moveStart("character", 1);
            sel.collapse(false);
            return false;
        }
        if (event.ctrlKey) {
            if ((s_Key == "B") || (s_Key == "I") || (s_Key == "U")) {
                return false;
            }
            if (s_Key == "Z") {
                goHistory( - 1);
                return false;
            }
            if (s_Key == "Y") {
                goHistory(1);
                return false;
            }
        }
        break;
    }
    if ((n_KeyCode == 13) || (n_KeyCode == 8) || (n_KeyCode == 46)) {
        if (!myHistory.saved) {
            saveHistory();
        }
        myHistory.saved = false;
    } else if ((n_KeyCode >= 33) && (n_KeyCode <= 40)) {
        if (!myHistory.saved) {
            saveHistory();
        }
    } else if (!event.ctrlKey && s_Key != "A" && s_Key != "F") {
        myHistory.saved = false;
    }
    return true;
}
var oResizing = new Object;
function onMouseDown() {
    oResizing.El = null;
    if (getDoc().selection.type == "Control") {
        var oControlRange = getDoc().selection.createRange();
        oResizing.El = oControlRange(0);
        oResizing.W = oResizing.El.style.width;
        oResizing.H = oResizing.El.style.height;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
}
function onMouseUp() {
    if (oResizing.El) {
        if ((oResizing.El.style.width != oResizing.W) || (oResizing.El.style.height != oResizing.H)) {
            saveHistory();
        }
    }
}
function doDragEnd() {
    if (!myHistory.saved) {
        saveHistory();
    }
    var oSelection = getDoc().selection.createRange();
    var sRangeType = getDoc().selection.type;
    if (sRangeType == "Control") {
        var oControl = oSelection.item(0);
        if (oControl.tagName == "IMG") {
            oControl.src = FullPath2SetPath(oControl.getAttribute("src", 2));
        }
    }
    if (sRangeType == "Text") {
        var els = getDoc().body.getElementsByTagName("IMG");
        var oRngTemp = getDoc().body.createTextRange();
        for (var i = 0; i < els.length; i++) {
            oRngTemp.moveToElementText(els[i]);
            if (oSelection.inRange(oRngTemp)) {
                els[i].src = FullPath2SetPath(els[i].getAttribute("src", 2));
            }
        }
    }
    saveHistory();
    return true;
}
function CorrectPath() {
    var els = getDoc().body.getElementsByTagName("IMG");
    for (var i = 0; i < els.length; i++) {
        els(i).src = FullPath2SetPath(els(i).getAttribute("src", 2));
    }
}
function FullPath2SetPath(url) {
    if (url.indexOf("://") < 0) {
        return url;
    }
    var s_SitePath = getSitePath();
    if (url.indexOf(s_SitePath) < 0) {
        return url;
    }
    switch (config.BaseUrl) {
    case "0":
        var s_BaseHref;
        s_BaseHref = s_SitePath + config.BaseHref;
        if (url.toLowerCase().indexOf(s_BaseHref.toLowerCase()) == 0) {
            return url.substr(s_BaseHref.length);
        }
        s_BaseHref = s_SitePath + myEditor.RootPath + "/";
        if (url.toLowerCase().indexOf(s_BaseHref.toLowerCase()) == 0) {
            return url.substr(s_BaseHref.length);
        }
        return url;
        break;
    case "1":
        return url.substr(s_SitePath.length);
        break;
    case "2":
    case "3":
        return url;
        break;
    }
}
function getSitePath() {
    var sSitePath = document.location.protocol + "//" + document.location.host;
    if (sSitePath.substr(sSitePath.length - 3) == ":80") {
        sSitePath = sSitePath.substring(0, sSitePath.length - 3);
    }
    return sSitePath;
}
function GetClipboardHTML() {
    var oDiv = document.getElementById("eWebEditor_Temp_HTML");
    oDiv.innerHTML = "";
    var oTextRange = document.body.createTextRange();
    oTextRange.moveToElementText(oDiv);
    oTextRange.execCommand("Paste");
    var sData = oDiv.innerHTML;
    oDiv.innerHTML = "";
    return sData;
}
function insertHTML(html) {
    if (isModeView()) {
        return false;
    }
    FE();
    if (getDoc().selection.type.toLowerCase() != "none") {
        getDoc().selection.clear();
    }
    if (myEditor.CurrMode != "EDIT") {
        html = HTMLEncode(html);
    }
    getDoc().selection.createRange().pasteHTML(html);
}
function setHTML(html, b_NotSaveHistory) {
    ContentEdit.value = html;
    switch (myEditor.CurrMode) {
    case "CODE":
        getDoc().designMode = "On";
        getDoc().open();
        getDoc().write(getStyleEditorHeader());
        getDoc().body.innerText = html;
        getDoc().close();
        getDoc().body.contentEditable = "true";
        myEditor.IsEditMode = false;
        break;
    case "EDIT":
        getDoc().designMode = "On";
        getDoc().open();
        getDoc().write(getStyleEditorHeader() + getFixWidthHTML(html) + "</body>");
        getDoc().execCommand("2D-Position", true, true);
        getDoc().execCommand("MultipleSelection", true, true);
        getDoc().execCommand("LiveResize", true, true);
        getDoc().close();
        if (config.FixWidth) {
            getDoc().body.contentEditable = "false";
            getDoc().getElementById("eWebEditor_FixWidth_Div").contentEditable = "true";
        } else {
            getDoc().body.contentEditable = "true";
        }
        doZoom(nCurrZoomSize);
        myEditor.IsEditMode = true;
        break;
    case "TEXT":
        getDoc().designMode = "On";
        getDoc().open();
        getDoc().write(getStyleEditorHeader());
        if (config.FixWidth) {
            eWebEditor_Temp_HTML.innerText = html;
            html = eWebEditor_Temp_HTML.innerHTML;
            getDoc().body.innerHTML = getFixWidthHTML(html);
        } else {
            getDoc().body.innerText = html;
        }
        getDoc().close();
        if (config.FixWidth) {
            getDoc().body.contentEditable = "false";
            getDoc().getElementById("eWebEditor_FixWidth_Div").contentEditable = "true";
        } else {
            getDoc().body.contentEditable = "true";
        }
        myEditor.IsEditMode = false;
        break;
    case "VIEW":
        getDoc().designMode = "off";
        getDoc().open();
        getDoc().write(getStyleEditorHeader() + getFixWidthHTML(html));
        getDoc().close();
        if (config.FixWidth) {
            getDoc().body.contentEditable = "false";
            getDoc().getElementById("eWebEditor_FixWidth_Div").contentEditable = "false";
        } else {
            getDoc().body.contentEditable = "false";
        }
        myEditor.IsEditMode = false;
        break;
    }
    getDoc().body.onpaste = onPaste;
    getDoc().body.onhelp = onHelp;
    getDoc().body.ondragend = new Function("return doDragEnd();");
    getDoc().onkeydown = new Function("return onKeyDown(eWebEditor.event);");
    getDoc().oncontextmenu = new Function("return showContextMenu(eWebEditor.event);");
    getDoc().onmousedown = new Function("return onMouseDown();");
    getDoc().onmouseup = new Function("return onMouseUp();");
    if ((config.ShowBorder != "0") && myEditor.IsEditMode) {
        config.ShowBorder = "0";
        showBorders();
    }
    if (!b_NotSaveHistory) {
        saveHistory();
    }
}
function getHTML() {
    var html;
    if ((myEditor.CurrMode == "EDIT") || (myEditor.CurrMode == "VIEW")) {
        if (config.FixWidth) {
            html = getDoc().getElementById("eWebEditor_FixWidth_DIV").innerHTML;
        } else {
            html = getDoc().body.innerHTML;
        }
    } else {
        html = getDoc().body.innerText;
    }
    if (myEditor.CurrMode != "TEXT") {
        if ((html.toLowerCase() == "<p>&nbsp;</p>") || (html.toLowerCase() == "<p></p>")) {
            html = "";
        }
    }
    return html;
}
function appendHTML(html) {
    if (isModeView()) {
        return false;
    }
    if (myEditor.CurrMode == "EDIT") {
        getDoc().body.innerHTML += html;
    } else {
        getDoc().body.innerText += html;
    }
}
function PasteText() {
    if (!validateMode()) {
        return;
    }
    FE();
    if (!myHistory.saved) {
        saveHistory();
    }
    var sText = HTMLEncode(clipboardData.getData("Text"));
    insertHTML(sText);
    saveHistory();
    FE();
}
function validateMode() {
    if (myEditor.CurrMode == "EDIT") {
        return true;
    }
    alert(lang["MsgOnlyInEditMode"]);
    FE();
    return false;
}
function isModeView() {
    if (myEditor.CurrMode == "VIEW") {
        alert(lang["MsgCanotSetInViewMode"]);
        return true;
    }
    return false;
}
function format(what, opt) {
    if (!validateMode()) {
        return;
    }
    FE();
    if (!myHistory.saved) {
        saveHistory();
    }
    if (opt == "RemoveFormat") {
        what = opt;
        opt = null;
    }
    if (opt == null) {
        var s = "";
        switch (what.toLowerCase()) {
        case "justifyleft":
            s = "left";
            break;
        case "justifycenter":
            s = "center";
            break;
        case "justifyright":
            s = "right";
            break;
        }
        var b = false;
        if (s) {
            var sel = getDoc().selection.createRange();
            sel.type = getDoc().selection.type;
            if (sel.type == "Control") {
                var oControl = sel.item(0);
                try {
                    oControl.align = s;
                    b = true;
                } catch(e) {}
            }
        }
        if (!b) {
            if ((what.toLowerCase() == "selectall") && (config.FixWidth)) {
                SelectAll_FixWidth();
            } else {
                getDoc().execCommand(what);
            }
        }
    } else {
        getDoc().execCommand(what, "", opt);
    }
    saveHistory();
    FE();
}
function SelectAll_FixWidth() {
    var r = getDoc().body.createTextRange();
    r.moveToElementText(getDoc().getElementById("eWebEditor_FixWidth_DIV"));
    r.select();
}
function formatText(what) {
    FE();
    var sel = getDoc().selection;
    if (sel.type != "Text") {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    var rng = sel.createRange();
    var r = getDoc().body.createTextRange();
    var n_Start = 0;
    while (r.compareEndPoints("StartToStart", rng) < 0) {
        r.moveStart("character", 1);
        n_Start++;
    }
    var n_End = 0;
    while (r.compareEndPoints("EndToEnd", rng) > 0) {
        r.moveEnd("character", -1);
        n_End--;
    }
    var a = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
    var L, U, s_Search, s_Replace;
    for (var i = 0; i < 26; i++) {
        L = a[i];
        U = a[i].toUpperCase();
        switch (what) {
        case "uppercase":
            s_Search = L;
            s_Replace = U;
            break;
        case "lowercase":
            s_Search = U;
            s_Replace = L;
            break;
        }
        r = rng.duplicate();
        while (r.findText(s_Search, 0, 4)) {
            r.text = s_Replace;
            r = rng.duplicate();
        }
    }
    r = getDoc().body.createTextRange();
    r.moveStart("character", n_Start);
    r.moveEnd("character", n_End);
    r.select();
    saveHistory();
}
function formatFont(what, v) {
    FE();
    var s_Type = getDoc().selection.type.toLowerCase();
    if (s_Type != "text") {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    var r = getDoc().selection.createRange();
    var bk = r.getBookmark();
    getDoc().execCommand("fontname", "", "eWebEditor_Temp_FontName");
    var a_Font = getDoc().body.getElementsByTagName("FONT");
    var arr = new Array();
    for (var i = 0; i < a_Font.length; i++) {
        var o_Font = a_Font[i];
        if (o_Font.getAttribute("face") == "eWebEditor_Temp_FontName") {
            arr[arr.length] = a_Font[i];
        }
    }
    for (var i = 0; i < arr.length; i++) {
        var o_Font = arr[i];
        delStyleInFont(o_Font, what);
        delEmptyNodeInFont(o_Font);
        setStyleInFont(o_Font, what, v);
        o_Font.removeAttribute("face");
        var o_Parent = o_Font.parentElement;
        if (o_Parent.tagName == "FONT") {
            fontAttribute2Style(o_Parent);
        }
        if ((o_Parent.tagName == "FONT") || (o_Parent.tagName == "SPAN")) {
            if (o_Parent.innerText == o_Font.innerText) {
                o_Parent.style.cssText = o_Parent.style.cssText + ";" + o_Font.style.cssText;
                o_Parent.innerHTML = o_Font.innerHTML;
                continue;
            }
        }
    }
    r.moveToBookmark(bk);
    r.select();
    saveHistory();
}
function setFontStyleValue(obj, what, v) {
    try {
        switch (what) {
        case "face":
            obj.style.fontFamily = v;
            break;
        case "size":
            obj.style.fontSize = v;
            break;
        case "color":
            obj.style.color = v;
            break;
        default:
            break;
        }
    } catch(e) {}
}
function delStyleInFont(obj, what) {
    setFontStyleValue(obj, what, "");
    var o_Children = obj.children;
    for (var j = 0; j < o_Children.length; j++) {
        delStyleInFont(o_Children[j], what);
        if (o_Children[j].tagName == "FONT") {
            fontAttribute2Style(o_Children[j]);
        }
    }
}
function setStyleInFont(obj, what, v) {
    setFontStyleValue(obj, what, v);
    var o_Children = obj.children;
    for (var j = 0; j < o_Children.length; j++) {
        if ((o_Children[j].tagName == "SPAN") || (o_Children[j].tagName == "FONT")) {
            setStyleInFont(o_Children[j], what, v);
        }
    }
}
function delEmptyNodeInFont(obj) {
    var o_Children = obj.children;
    for (var j = 0; j < o_Children.length; j++) {
        delEmptyNodeInFont(o_Children[j]);
        if ((o_Children[j].tagName == "FONT") || (o_Children[j].tagName == "SPAN")) {
            if ((o_Children[j].style.cssText == "") || (o_Children[j].innerHTML == "")) {
                o_Children[j].removeNode(false);
                delEmptyNodeInFont(obj);
                return;
            }
        }
    }
}
function fontAttribute2Style(el) {
    if (el.style.fontFamily == "") {
        var s = el.getAttribute("face");
        if (s) {
            el.style.fontFamily = s;
        }
    }
    el.removeAttribute("face");
    if (el.style.fontSize == "") {
        var s = el.getAttribute("size");
        if (s) {
            switch (s) {
            case "1":
                s = "8pt";
                break;
            case "2":
                s = "10pt";
                break;
            case "3":
                s = "12pt";
                break;
            case "4":
                s = "14pt";
                break;
            case "5":
                s = "18pt";
                break;
            case "6":
                s = "24pt";
                break;
            case "7":
                s = "36pt";
                break;
            default:
                s = "";
                break;
            }
        }
        if (s) {
            el.style.fontSize = s;
        }
    }
    el.removeAttribute("size");
    if (el.style.color == "") {
        var s = el.getAttribute("color");
        if (s) {
            el.style.color = s;
        }
    }
    el.removeAttribute("color");
}
function setMode(NewMode) {
    if (NewMode == myEditor.CurrMode) {
        return;
    }
    if (!myBrowser.IsCompatible) {
        if ((NewMode == "CODE") || (NewMode == "EDIT") || (NewMode == "VIEW")) {
            alert(lang["MsgNotCompatibleHtml"]);
            return false;
        }
    }
    if (NewMode == "TEXT") {
        if (myEditor.CurrMode == ModeEdit.value) {
            if (!confirm(lang["MsgHtmlToText"])) {
                return false;
            }
        }
    }
    var sBody = "";
    switch (myEditor.CurrMode) {
    case "CODE":
        if (NewMode == "TEXT") {
            eWebEditor_Temp_HTML.innerHTML = getDoc().body.innerText;
            sBody = eWebEditor_Temp_HTML.innerText;
        } else {
            sBody = getDoc().body.innerText;
        }
        break;
    case "TEXT":
        sBody = getDoc().body.innerText;
        sBody = HTMLEncode(sBody);
        break;
    case "EDIT":
    case "VIEW":
        if (NewMode == "TEXT") {
            sBody = getDoc().body.innerText;
        } else {
            if (config.FixWidth) {
                sBody = getDoc().getElementById("eWebEditor_FixWidth_DIV").innerHTML;
            } else {
                sBody = getDoc().body.innerHTML;
            }
        }
        break;
    default:
        sBody = ContentEdit.value;
        break;
    }
    try {
        document.getElementById("eWebEditor_CODE").className = "SB_Mode_BtnOff";
    } catch(e) {}
    try {
        document.getElementById("eWebEditor_EDIT").className = "SB_Mode_BtnOff";
    } catch(e) {}
    try {
        document.getElementById("eWebEditor_TEXT").className = "SB_Mode_BtnOff";
    } catch(e) {}
    try {
        document.getElementById("eWebEditor_VIEW").className = "SB_Mode_BtnOff";
    } catch(e) {}
    try {
        document.getElementById("eWebEditor_" + NewMode).className = "SB_Mode_BtnOn";
    } catch(e) {}
    myEditor.CurrMode = NewMode;
    ModeEdit.value = NewMode;
    setHTML(sBody);
    var oTR = document.getElementById("eWebEditor_ToolarTR");
    if (NewMode == "EDIT") {
        oTR.style.display = "";
    } else {
        oTR.style.display = "none";
    }
}
function disableChildren(obj) {
    if (obj) {
        obj.disabled = (!myEditor.IsEditMode);
        for (var i = 0; i < obj.children.length; i++) {
            disableChildren(obj.children[i]);
        }
    }
}
function showDialog(url, optValidate) {
    var sName;
    var nIndex = url.indexOf(".");
    if (nIndex < 0) {
        sName = url;
        url = url + ".htm";
    } else {
        sName = url.substring(0, nIndex);
    }
    url = "dialog/" + url;
    sName = sName.toLowerCase();
    url = url.toLowerCase();
    if (optValidate) {
        if (!validateMode()) {
            return;
        }
    }
    FE();
    if (!myHistory.saved) {
        saveHistory();
    }
    var arr = showModalDialog(url, window, "dialogWidth:0px;dialogHeight:0px;help:no;scroll:no;status:no");
    saveHistory();
    FE();
}
function Maximize() {
    if (!validateMode()) {
        return;
    }
    saveHistory();
    window.open("dialog/fullscreen.htm?style=" + myParam.StyleName, 'FullScreen' + myParam.LinkField, 'toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,fullscreen=yes');
}
function createLink() {
    if (!validateMode()) {
        return;
    }
    if (getDoc().selection.type == "Control") {
        var oControlRange = getDoc().selection.createRange();
        if (oControlRange(0).tagName.toUpperCase() != "IMG") {
            alert(lang["MsgHylnkLimit"]);
            return;
        }
    }
    showDialog("hyperlink.htm", true);
}
function HTMLEncode(text) {
    if (text == null) {
        return "";
    }
    text = text.replace(/&/g, "&amp;");
    text = text.replace(/\"/g, "&quot;");
    text = text.replace(/</g, "&lt;");
    text = text.replace(/>/g, "&gt;");
    text = text.replace(/\n/g, "<br>");
    return text;
}
function insert(what) {
    if (!validateMode()) {
        return;
    }
    FE();
    saveHistory();
    var sel = getDoc().selection.createRange();
    switch (what) {
    case "nowdate":
        var d = new Date();
        insertHTML(d.toLocaleDateString());
        break;
    case "nowtime":
        var d = new Date();
        insertHTML(d.toLocaleTimeString());
        break;
    case "br":
        insertHTML("<br>");
        break;
    case "code":
        insertHTML('<table width=95% border="0" align="Center" cellpadding="6" cellspacing="0" style="border: 1px Dotted #CCCCCC; TABLE-LAYOUT: fixed"><tr><td bgcolor=#FDFDDF style="WORD-WRAP: break-word"><font style="color: #990000;font-weight:bold">' + lang["HtmlCode"] + '</font><br>' + HTMLEncode(sel.text) + '</td></tr></table>');
        break;
    case "quote":
        insertHTML('<table width=95% border="0" align="Center" cellpadding="6" cellspacing="0" style="border: 1px Dotted #CCCCCC; TABLE-LAYOUT: fixed"><tr><td bgcolor=#F3F3F3 style="WORD-WRAP: break-word"><font style="color: #990000;font-weight:bold">' + lang["HtmlQuote"] + '</font><br>' + HTMLEncode(sel.text) + '</td></tr></table>');
        break;
    case "big":
        insertHTML("<big>" + sel.text + "</big>");
        break;
    case "small":
        insertHTML("<small>" + sel.text + "</small>");
        break;
    case "printbreak":
        insertHTML("<div style=\"FONT-SIZE: 1px; PAGE-BREAK-BEFORE: always; VERTICAL-ALIGN: middle; HEIGHT: 1px; BACKGROUND-COLOR: #c0c0c0\">&nbsp; </div>");
        break;
    default:
        alert(lang["ErrParam"]);
        break;
    }
    sel = null;
}
function showBorders() {
    if (!validateMode()) {
        return;
    }
    var allForms = getDoc().getElementsByTagName("FORM");
    var allInputs = getDoc().body.getElementsByTagName("INPUT");
    var allTables = getDoc().body.getElementsByTagName("TABLE");
    var allLinks = getDoc().body.getElementsByTagName("A");
    for (a = 0; a < allForms.length; a++) {
        if (config.ShowBorder == "0") {
            allForms[a].runtimeStyle.border = "1px dotted #FF0000";
        } else {
            allForms[a].runtimeStyle.cssText = "";
        }
    }
    for (b = 0; b < allInputs.length; b++) {
        if (config.ShowBorder == "0") {
            if (allInputs[b].type.toUpperCase() == "HIDDEN") {
                allInputs[b].runtimeStyle.border = "1px dashed #000000";
                allInputs[b].runtimeStyle.width = "15px";
                allInputs[b].runtimeStyle.height = "15px";
                allInputs[b].runtimeStyle.backgroundColor = "#FDADAD";
                allInputs[b].runtimeStyle.color = "#FDADAD";
            }
        } else {
            if (allInputs[b].type.toUpperCase() == "HIDDEN") {
                allInputs[b].runtimeStyle.cssText = "";
            }
        }
    }
    for (i = 0; i < allTables.length; i++) {
        if (config.ShowBorder == "0") {
            allTables[i].runtimeStyle.border = "1px dotted #BFBFBF";
        } else {
            allTables[i].runtimeStyle.cssText = "";
        }
        allRows = allTables[i].rows;
        for (y = 0; y < allRows.length; y++) {
            allCellsInRow = allRows[y].cells;
            for (x = 0; x < allCellsInRow.length; x++) {
                if (config.ShowBorder == "0") {
                    allCellsInRow[x].runtimeStyle.border = "1px dotted #BFBFBF";
                } else {
                    allCellsInRow[x].runtimeStyle.cssText = "";
                }
            }
        }
    }
    for (a = 0; a < allLinks.length; a++) {
        if (config.ShowBorder == "0") {
            if (allLinks[a].href.toUpperCase() == "") {
                allLinks[a].runtimeStyle.borderBottom = "1px dashed #000000";
            }
        } else {
            allLinks[a].runtimeStyle.cssText = "";
        }
    }
    if (config.ShowBorder == "0") {
        config.ShowBorder = "1";
    } else {
        config.ShowBorder = "0";
    }
    scrollUp();
}
function scrollUp() {
    eWebEditor.scrollBy(0, 0);
}
var nCurrZoomSize = 100;
var aZoomSize = new Array(10, 25, 50, 75, 100, 150, 200, 500);
function doZoom(size) {
    getDoc().body.runtimeStyle.zoom = size + "%";
    nCurrZoomSize = size;
}
function findReplace() {
    showDialog('findreplace.htm', true);
}
function absolutePosition() {
    var objReference = null;
    var RangeType = getDoc().selection.type;
    if (RangeType != "Control") {
        return;
    }
    var selectedRange = getDoc().selection.createRange();
    for (var i = 0; i < selectedRange.length; i++) {
        objReference = selectedRange.item(i);
        if (objReference.style.position != 'relative') {
            objReference.style.position = 'relative';
        } else {
            objReference.style.position = 'static';
        }
    }
}
function zIndex(action) {
    var objReference = null;
    var RangeType = getDoc().selection.type;
    if (RangeType != "Control") {
        return;
    }
    var selectedRange = getDoc().selection.createRange();
    for (var i = 0; i < selectedRange.length; i++) {
        objReference = selectedRange.item(i);
        if (action == 'forward') {
            objReference.style.zIndex += 1;
        } else {
            objReference.style.zIndex -= 1;
        }
        objReference.style.position = 'relative';
    }
}
function isControlSelected(tag, attrName, attrValue) {
    if (tag) {
        var sel = getDoc().selection;
        if (sel.type == "Control") {
            var rng = sel.createRange();
            var el = rng(0);
            if (el.tagName.toUpperCase() == tag) {
                if ((attrName) && (attrValue)) {
                    if (el.getAttribute(attrName, 2).toLowerCase() == attrValue.toLowerCase()) {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        }
    }
    return false;
}
function findParentElement(tag) {
    var el = null;
    if (getDoc().selection.type != "Control") {
        el = getDoc().selection.createRange().parentElement();
        while (el.tagName.toUpperCase() != tag) {
            el = el.parentElement;
            if (el == null) {
                break;
            }
        }
    }
    return el;
}
function sizeChange(size) {
    if (!myBrowser.IsCompatible) {
        alert(lang["MsgNotCompatibleFunc"]);
        return false;
    }
    for (var i = 0; i < parent.frames.length; i++) {
        if (parent.frames[i].document == self.document) {
            var obj = parent.frames[i].frameElement;
            var height = parseInt(obj.offsetHeight);
            if (height + size >= 300) {
                obj.height = height + size;
            }
            break;
        }
    }
}
function mapEdit() {
    if (!validateMode()) {
        return;
    }
    saveHistory();
    var b = false;
    if (getDoc().selection.type == "Control") {
        var oControlRange = getDoc().selection.createRange();
        if (oControlRange(0).tagName.toUpperCase() == "IMG") {
            b = true;
        }
    }
    if (!b) {
        alert(lang["MsgMapLimit"]);
        return;
    }
    window.open("dialog/map.htm", "mapEdit" + myParam.LinkField, "toolbar=no,location=no,directories=no,status=not,menubar=no,scrollbars=no,resizable=yes,width=450,height=300");
}
function paragraphAttr() {
    if (!validateMode()) {
        return;
    }
    FE();
    if (!tagInSelection("P")) {
        alert(lang["MsgNotParagraph"]);
        return;
    }
    showDialog('paragraph.htm', true);
}
function tagInSelection(tag) {
    var sel = getDoc().selection.createRange();
    sel.type = getDoc().selection.type;
    if (sel.type != "Control") {
        var oBody = getDoc().body;
        var aAllEl = oBody.getElementsByTagName(tag);
        var aSelEl = new Array();
        var oRngTemp = oBody.createTextRange();
        for (var i = 0; i < aAllEl.length; i++) {
            oRngTemp.moveToElementText(aAllEl(i));
            if (sel.inRange(oRngTemp)) {
                aSelEl[aSelEl.length] = aAllEl[i];
            } else {
                if (((sel.compareEndPoints("StartToEnd", oRngTemp) < 0) && (sel.compareEndPoints("StartToStart", oRngTemp) > 0)) || ((sel.compareEndPoints("EndToStart", oRngTemp) > 0) && (sel.compareEndPoints("EndToEnd", oRngTemp) < 0))) {
                    aSelEl[aSelEl.length] = aAllEl[i];
                }
            }
        }
        if (aSelEl.length > 0) {
            return true;
        }
    }
    return false;
}
function addUploadFile(originalFileName, saveFileName, savePathFileName) {
    doInterfaceUpload(myParam.LinkOriginalFileName, originalFileName);
    doInterfaceUpload(myParam.LinkSaveFileName, saveFileName);
    doInterfaceUpload(myParam.LinkSavePathFileName, savePathFileName);
}
function doInterfaceUpload(strLinkName, strValue) {
    if (strValue == "") {
        return;
    }
    if (strLinkName) {
        var objLinkUpload = parent.document.getElementsByName(strLinkName)[0];
        if (objLinkUpload) {
            if (objLinkUpload.value != "") {
                objLinkUpload.value = objLinkUpload.value + "|";
            }
            objLinkUpload.value = objLinkUpload.value + strValue;
            objLinkUpload.fireEvent("onchange");
        }
    }
}
function splitTextField(objField, html) {
    objField.value = html;
    var strFieldName = objField.name;
    var objForm = objField.form;
    var objDocument = objField.document;
    var FormLimit = 50000;
    for (var i = 1; i < objDocument.getElementsByName(strFieldName).length; i++) {
        objDocument.getElementsByName(strFieldName)[i].value = "";
    }
    if (html.length > FormLimit) {
        objField.value = html.substr(0, FormLimit);
        html = html.substr(FormLimit);
        while (html.length > 0) {
            var objTEXTAREA = objDocument.createElement("<TEXTAREA NAME='" + strFieldName + "'></TEXTAREA>");
            objTEXTAREA.style.display = "none";
            objTEXTAREA.value = html.substr(0, FormLimit);
            objForm.appendChild(objTEXTAREA);
            html = html.substr(FormLimit);
        }
    }
}
var sEventUploadAfter;
function remoteUpload(strEventUploadAfter) {
    if (config.AutoRemote != "1") {
        return;
    }
    if (myEditor.CurrMode == "TEXT") {
        return;
    }
    sEventUploadAfter = strEventUploadAfter;
    var objField = document.getElementsByName("eWebEditor_UploadText")[0];
    splitTextField(objField, getHTML());
    showProcessingMsg(lang["MsgRemoteUploading"]);
    eWebEditor_UploadForm.submit();
}
function remoteUploadOK() {
    divProcessing.style.display = "none";
    if (myEditor.LinkField) {
        if (sEventUploadAfter) {
            eval("parent." + sEventUploadAfter);
        }
    }
}
var eWebEditorActiveX;
function localUpload() {
    if (myEditor.CurrMode == "TEXT") {
        return;
    }
    if (!CheckActiveXVersion()) {
        showDialog("installactivex.htm", true);
        return;
    }
    showProcessingMsg(lang["MsgLocalUploading"]);
    if (eWebEditorActiveX) {
        eWebEditorActiveX = null
    }
    eWebEditorActiveX = new ActiveXObject("eWebEditorClient.eWebEditor");
    var s_PostUrl = getSitePath() + myEditor.RootPath + "/" + config.ServerExt + "/upload." + config.ServerExt + "?action=local&type=local&style=" + config.StyleName + "&cusdir=" + config.CusDir;
    var s_HTML = getHTML();
    eWebEditorActiveX.LocalUpload(s_HTML, s_PostUrl);
    window.setTimeout("LocalUploadStatus()", 300);
}
function LocalUploadStatus() {
    if (eWebEditorActiveX.Status != "ok") {
        window.setTimeout("LocalUploadStatus()", 100);
        return;
    }
    var s_Error = eWebEditorActiveX.Error;
    if (s_Error != "") {
        alert(s_Error);
        divProcessing.style.display = "none";
        return;
    }
    var s_OriginalFiles = eWebEditorActiveX.OriginalFiles;
    var s_SavedFiles = eWebEditorActiveX.SavedFiles;
    if (s_OriginalFiles) {
        var a_Original = s_OriginalFiles.split("|");
        var a_Saved = s_SavedFiles.split("|");
        for (var i = 0; i < a_Original.length; i++) {
            if (a_Saved[i]) {
                var s_OriginalFileName = a_Original[i];
                var s_SaveFileName = a_Saved[i].substr(a_Saved[i].lastIndexOf("/") + 1);
                var s_SavePathFileName = a_Saved[i];
                addUploadFile(s_OriginalFileName, s_SaveFileName, s_SavePathFileName);
            }
        }
    }
    var s_HTML = eWebEditorActiveX.Body;
    setHTML(s_HTML, true);
    eWebEditorActiveX = null;
    divProcessing.style.display = "none";
}
function showProcessingMsg(msg) {
    msgProcessing.innerHTML = msg;
    divProcessing.style.top = (document.body.clientHeight - parseFloat(divProcessing.style.height)) / 2;
    divProcessing.style.left = (document.body.clientWidth - parseFloat(divProcessing.style.width)) / 2;
    divProcessing.style.display = "";
}
var myHistory = new Object;
myHistory.data = [];
myHistory.position = 0;
myHistory.bookmark = [];
myHistory.saved = false;
function saveHistory() {
    myHistory.saved = true;
    var html = getHTML();
    if (myHistory.data[myHistory.position] != html) {
        var nBeginLen = myHistory.data.length;
        var nPopLen = myHistory.data.length - myHistory.position;
        for (var i = 1; i < nPopLen; i++) {
            myHistory.data.pop();
            myHistory.bookmark.pop();
        }
        myHistory.data[myHistory.data.length] = html;
        if (getDoc().selection.type != "Control") {
            try {
                myHistory.bookmark[myHistory.bookmark.length] = getDoc().selection.createRange().getBookmark();
            } catch(e) {
                myHistory.bookmark[myHistory.bookmark.length] = "";
            }
        } else {
            var oRng = getDoc().selection.createRange();
            var el = oRng.item(0);
            myHistory.bookmark[myHistory.bookmark.length] = "[object]|" + el.tagName + "|" + getElementTagIndex(el);
        }
        if (nBeginLen != 0) {
            myHistory.position++;
        }
    }
}
function getElementTagIndex(el) {
    var els = getDoc().body.getElementsByTagName(el.tagName);
    for (var i = 0; i < els.length; i++) {
        if (els[i] == el) {
            return i;
        }
    }
    return null;
}
function initHistory() {
    myHistory.data.length = 0;
    myHistory.bookmark.length = 0;
    myHistory.position = 0;
    myHistory.saved = false;
}
function goHistory(value) {
    if (!myHistory.saved) {
        saveHistory();
    }
    if (value == -1) {
        if (myHistory.position > 0) {
            myHistory.position = myHistory.position - 1;
            setHTML(myHistory.data[myHistory.position], true);
            setHistoryCursor();
        }
    } else {
        if (myHistory.position < myHistory.data.length - 1) {
            myHistory.position = myHistory.position + 1;
            setHTML(myHistory.data[myHistory.position], true);
            setHistoryCursor();
        }
    }
    FE();
}
function setHistoryCursor() {
    var s_Bookmark = myHistory.bookmark[myHistory.position];
    if (s_Bookmark) {
        eWebEditor_Layout.focus();
        if (s_Bookmark.substring(0, 8) != "[object]") {
            r = getDoc().body.createTextRange();
            if (r.moveToBookmark(myHistory.bookmark[myHistory.position])) {
                r.select();
            }
        } else {
            if (myEditor.CurrMode == "EDIT") {
                r = getDoc().body.createControlRange();
                var a = s_Bookmark.split("|");
                var els = getDoc().body.getElementsByTagName(a[1]);
                var el = els[a[2]];
                r.addElement(el);
                r.select();
            }
        }
    }
}
function getStyleEditorHeader() {
    var s_Header = "<head>";
    s_Header += "<link href='" + myEditor.RootPath + "/skin/" + config.Skin + "/editorarea.css' type='text/css' rel='stylesheet'>";
    if (config.AreaCssMode != "1") {
        s_Header += "<link href='" + myEditor.RootPath + "/language/" + lang.ActiveLanguage + ".editorarea.css' type='text/css' rel='stylesheet'>";
    }
    switch (myEditor.CurrMode) {
    case "CODE":
        s_Header += "<link href='" + myEditor.RootPath + "/skin/" + config.Skin + "/editorarea." + lang.ActiveLanguage + ".code.css' type='text/css' rel='stylesheet'>";
        break;
    case "TEXT":
        s_Header += "<link href='" + myEditor.RootPath + "/skin/" + config.Skin + "/editorarea." + lang.ActiveLanguage + ".text.css' type='text/css' rel='stylesheet'>";
        break;
    case "EDIT":
    case "VIEW":
        if (config.AreaCssMode != "1") {
            s_Header += "<link href='" + myEditor.RootPath + "/skin/" + config.Skin + "/editorarea." + lang.ActiveLanguage + ".edit.css' type='text/css' rel='stylesheet'>";
        }
        s_Header += myEditor.ExtCSS;
        break;
    }
    s_Header += myEditor.BaseHref + "</head>";
    var s_Body = "<body>";
    if ((config.FixWidth) && (myEditor.CurrMode != "CODE")) {
        s_Body = "<body class='eWebEditor_FixWidth_BODY'>";
    }
    return s_Header + s_Body;
}
function getCount(n_Type) {
    var str = getText();
    str = str.replace(/\n/g, "");
    str = str.replace(/\r/g, "");
    var l = str.length;
    var n = 0;
    for (var i = 0; i < l; i++) {
        if (str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255) {
            if (n_Type != 0) {
                n++;
                if (n_Type == 3) {
                    n++;
                }
            }
        } else {
            if (n_Type != 1) {
                n++;
            }
        }
    }
    return n;
}
function getText() {
    var s = getHTML();
    if (myEditor.CurrMode != "TEXT") {
        eWebEditor_Temp_HTML.innerHTML = s;
        s = eWebEditor_Temp_HTML.innerText;
    }
    return s;
}
function spellCheck() {
    try {
        var tmpis = new ActiveXObject("ieSpell.ieSpellExtension");
        tmpis.CheckAllLinkedDocuments(getDoc());
    } catch(exception) {
        if (confirm(lang["MsgIeSpellDownload"])) {
            window.open("http://www.iespell.com/download.php", "IeSpellDownload");
        }
    }
}
var sMenuHeader, sMenuHr, sMenu1, sMenu2, oPopupMenu;
var myMenu = new Object();
function Menu_Init() {
    sMenu1 = "<table border=0 cellpadding=0 cellspacing=0 class='Menu_Box' id=Menu_Box><tr><td class='Menu_Box'><table border=0 cellpadding=0 cellspacing=0 class='Menu_Table'>";
    sMenuHr = "<tr><td class='Menu_Sep'><table border=0 cellpadding=0 cellspacing=0 class='Menu_Sep'><tr><td></td></tr></table></td></tr>";
    sMenu2 = "</table></td></tr></table>";
    sMenuHeader = "<head>" + "<link href='" + myEditor.RootPath + "/language/" + lang.ActiveLanguage + ".css' type='text/css' rel='stylesheet'>" + "<link href='" + myEditor.RootPath + "/skin/" + config.Skin + "/menuarea.css' type='text/css' rel='stylesheet'>" + "</head>" + "<body scroll='no' onConTextMenu='event.returnValue=false;' ondragstart='event.returnValue=false;' onselectstart='event.returnValue=false;' onselect='event.returnValue=false;'>";
    oPopupMenu = window.createPopup();
    var doc = oPopupMenu.document;
    doc.open();
    doc.write(sMenuHeader);
    doc.close();
}
function getMenuRow(s_Disabled, s_Event, s_Image, s_Html) {
    var s_MenuRow = "";
    if (s_Disabled == "") {
        s_MenuRow += "<tr><td class='Menu_Item'><table border=0 cellpadding=0 cellspacing=0 width='100%'><tr><td valign=middle class=MouseOut onMouseOver=\"this.className='MouseOver'\" onMouseOut=\"this.className='MouseOut'\" onclick=\"parent." + s_Event + ";parent.oPopupMenu.hide();\">";
    } else {
        s_MenuRow += "<tr><td class='Menu_Item'><table border=0 cellpadding=0 cellspacing=0 width='100%'><tr><td valign=middle class=MouseDisabled>";
    }
    s_Disabled = (s_Disabled) ? "_Disabled": "";
    s_MenuRow += "<table border=0 cellpadding=0 cellspacing=0><tr><td class=Menu_Image_TD>";
    if (typeof(s_Image) == "number") {
        var s_Img = "skin/" + config.Skin + "/buttons.gif";
        var n_Top = 16 - s_Image * 16;
        s_MenuRow += "<div class='Menu_Image" + s_Disabled + "'><img src='" + s_Img + "' style='top:" + n_Top + "px'></div>";
    } else if (s_Image != "") {
        var s_Img = "skin/" + config.Skin + "/" + s_Image;
        s_MenuRow += "<img class='Menu_Image" + s_Disabled + "' src='" + s_Img + "'>";
    }
    s_MenuRow += "</td><td class='Menu_Label" + s_Disabled + "'>" + s_Html + "</td></tr></table>";
    s_MenuRow += "</td></tr></TABLE></td><\/tr>";
    return s_MenuRow;
}
function getStandardMenuRow(s_Disabled, s_Code, s_Lang) {
    var a_Button = Buttons[s_Code];
    if (!s_Lang) {
        s_Lang = lang[s_Code];
    } else {
        s_Lang = lang[s_Lang];
    }
    return getMenuRow(s_Disabled, a_Button[1], a_Button[0], s_Lang);
}
function getFormatMenuRow(s_Code, s_Cmd) {
    var s_Disabled = "";
    if (!s_Cmd) {
        s_Cmd = s_Code;
    }
    if (!getDoc().queryCommandEnabled(s_Cmd)) {
        s_Disabled = "disabled";
    }
    return getStandardMenuRow(s_Disabled, s_Code);
}
function getTableMenuRow(what) {
    var s_Menu = "";
    var s_Disabled = "disabled";
    switch (what) {
    case "TableInsert":
        if (!isTableSelected()) {
            s_Disabled = "";
        }
        s_Menu += getStandardMenuRow(s_Disabled, "TableInsert");
        break;
    case "TableProp":
        if (isTableSelected() || isCursorInTableCell()) {
            s_Disabled = "";
        }
        s_Menu += getStandardMenuRow(s_Disabled, "TableProp");
        break;
    case "TableCell":
        if (isCursorInTableCell()) {
            s_Disabled = "";
        }
        s_Menu += getStandardMenuRow(s_Disabled, "TableCellProp");
        s_Menu += getStandardMenuRow(s_Disabled, "TableCellSplit");
        s_Menu += sMenuHr;
        s_Menu += getStandardMenuRow(s_Disabled, "TableRowProp");
        s_Menu += getStandardMenuRow(s_Disabled, "TableRowInsertAbove");
        s_Menu += getStandardMenuRow(s_Disabled, "TableRowInsertBelow");
        s_Menu += getStandardMenuRow(s_Disabled, "TableRowMerge");
        s_Menu += getStandardMenuRow(s_Disabled, "TableRowSplit");
        s_Menu += getStandardMenuRow(s_Disabled, "TableRowDelete");
        s_Menu += sMenuHr;
        s_Menu += getStandardMenuRow(s_Disabled, "TableColInsertLeft");
        s_Menu += getStandardMenuRow(s_Disabled, "TableColInsertRight");
        s_Menu += getStandardMenuRow(s_Disabled, "TableColMerge");
        s_Menu += getStandardMenuRow(s_Disabled, "TableColSplit");
        s_Menu += getStandardMenuRow(s_Disabled, "TableColDelete");
        break;
    }
    return s_Menu;
}
function showContextMenu(event) {
    if (!myEditor.IsEditMode) {
        return false;
    }
    var sMenu = "";
    sMenu += getFormatMenuRow("Cut");
    sMenu += getFormatMenuRow("Copy");
    sMenu += getFormatMenuRow("Paste");
    sMenu += getFormatMenuRow("Delete");
    sMenu += getFormatMenuRow("SelectAll");
    sMenu += sMenuHr;
    if (isCursorInTableCell()) {
        sMenu += getTableMenuRow("TableProp");
        sMenu += getTableMenuRow("TableCell");
        sMenu += sMenuHr;
    }
    if (isControlSelected("TABLE")) {
        sMenu += getTableMenuRow("TableProp");
        sMenu += sMenuHr;
    }
    if (isControlSelected("IMG")) {
        sMenu += getStandardMenuRow("", "Image", "CMenuImg");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "zIndexForward");
        sMenu += getStandardMenuRow("", "zIndexBackward");
        sMenu += sMenuHr;
    }
    if (isControlSelected("OBJECT", "classid", "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000")) {
        sMenu += getStandardMenuRow("", "Flash", "CMenuFlash");
        sMenu += sMenuHr;
    }
    if (tagInSelection("P")) {
        sMenu += getStandardMenuRow("", "ParagraphAttr", "CMenuParagraph");
        sMenu += sMenuHr;
    }
    sMenu += getStandardMenuRow("", "FindReplace");
    myMenu.x = event.clientX;
    myMenu.y = event.clientY;
    myMenu.ew = 0;
    myMenu.html = sMenu;
    myMenu.rel = getDoc().body;
    myMenu.show();
    return false;
}
function showToolMenu(menu) {
    if (!myEditor.IsEditMode) return false;
    FE();
    var sMenu = "";
    switch (menu) {
    case "font":
        sMenu += getFormatMenuRow("Bold");
        sMenu += getFormatMenuRow("Italic");
        sMenu += getFormatMenuRow("UnderLine");
        sMenu += getFormatMenuRow("StrikeThrough");
        sMenu += sMenuHr;
        sMenu += getFormatMenuRow("SuperScript");
        sMenu += getFormatMenuRow("SubScript");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "UpperCase");
        sMenu += getStandardMenuRow("", "LowerCase");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "ForeColor");
        sMenu += getStandardMenuRow("", "BackColor");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "Big");
        sMenu += getStandardMenuRow("", "Small");
        break;
    case "paragraph":
        sMenu += getFormatMenuRow("JustifyLeft");
        sMenu += getFormatMenuRow("JustifyCenter");
        sMenu += getFormatMenuRow("JustifyRight");
        sMenu += getFormatMenuRow("JustifyFull");
        sMenu += sMenuHr;
        sMenu += getFormatMenuRow("OrderedList", "insertorderedlist");
        sMenu += getFormatMenuRow("UnOrderedList", "insertunorderedlist");
        sMenu += getFormatMenuRow("Indent");
        sMenu += getFormatMenuRow("Outdent");
        sMenu += sMenuHr;
        sMenu += getFormatMenuRow("Paragraph", "insertparagraph");
        sMenu += getStandardMenuRow("", "BR");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow((tagInSelection("P")) ? "": "disabled", "ParagraphAttr", "CMenuParagraph");
        break;
    case "edit":
        var s_Disabled = "";
        if (myHistory.data.length <= 1 || myHistory.position <= 0) {
            s_Disabled = "disabled";
        }
        sMenu += getStandardMenuRow(s_Disabled, "UnDo");
        if (myHistory.position >= myHistory.data.length - 1 || myHistory.data.length == 0) s_Disabled = "disabled";
        sMenu += getStandardMenuRow(s_Disabled, "ReDo");
        sMenu += sMenuHr;
        sMenu += getFormatMenuRow("Cut");
        sMenu += getFormatMenuRow("Copy");
        sMenu += getFormatMenuRow("Paste");
        sMenu += getStandardMenuRow("", "PasteText");
        sMenu += getStandardMenuRow("", "PasteWord");
        sMenu += sMenuHr;
        sMenu += getFormatMenuRow("Delete");
        sMenu += getFormatMenuRow("RemoveFormat");
        sMenu += sMenuHr;
        sMenu += getFormatMenuRow("SelectAll");
        sMenu += getFormatMenuRow("UnSelect");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "FindReplace");
        break;
    case "object":
        sMenu += getStandardMenuRow("", "BgColor");
        sMenu += getStandardMenuRow("", "BackImage");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "absolutePosition");
        sMenu += getStandardMenuRow("", "zIndexForward");
        sMenu += getStandardMenuRow("", "zIndexBackward");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "ShowBorders");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "Quote");
        sMenu += getStandardMenuRow("", "Code");
        break;
    case "component":
        sMenu += getStandardMenuRow("", "Image");
        sMenu += getStandardMenuRow("", "Flash");
        sMenu += getStandardMenuRow("", "Media");
        sMenu += getStandardMenuRow("", "File");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "RemoteUpload");
        sMenu += getStandardMenuRow("", "LocalUpload");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "Fieldset");
        sMenu += getStandardMenuRow("", "Iframe");
        sMenu += getFormatMenuRow("HorizontalRule", "InsertHorizontalRule");
        sMenu += getStandardMenuRow("", "Marquee");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "CreateLink");
        sMenu += getStandardMenuRow("", "Anchor");
        sMenu += getStandardMenuRow("", "Map");
        sMenu += getFormatMenuRow("Unlink");
        break;
    case "tool":
        sMenu += getStandardMenuRow("", "Template");
        sMenu += getStandardMenuRow("", "Symbol");
        sMenu += getStandardMenuRow("", "Excel");
        sMenu += getStandardMenuRow("", "Emot");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "EQ");
        sMenu += getStandardMenuRow("", "Art");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "NowDate");
        sMenu += getStandardMenuRow("", "NowTime");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "ImportWord");
        sMenu += getStandardMenuRow("", "ImportExcel");
        break;
    case "file":
        sMenu += getStandardMenuRow("", "Refresh");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "ModeCode");
        sMenu += getStandardMenuRow("", "ModeEdit");
        sMenu += getStandardMenuRow("", "ModeText");
        sMenu += getStandardMenuRow("", "ModeView");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "SizePlus");
        sMenu += getStandardMenuRow("", "SizeMinus");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "Print");
        sMenu += sMenuHr;
        sMenu += getStandardMenuRow("", "About");
        sMenu += getStandardMenuRow("", "Site");
        height = 208;
        break;
    case "table":
        sMenu += getTableMenuRow("TableInsert");
        sMenu += getTableMenuRow("TableProp");
        sMenu += sMenuHr;
        sMenu += getTableMenuRow("TableCell");
        break;
    case "form":
        sMenu += getFormatMenuRow("FormText", "InsertInputText");
        sMenu += getFormatMenuRow("FormTextArea", "InsertTextArea");
        sMenu += getFormatMenuRow("FormRadio", "InsertInputRadio");
        sMenu += getFormatMenuRow("FormCheckbox", "InsertInputCheckbox");
        sMenu += getFormatMenuRow("FormDropdown", "InsertSelectDropdown");
        sMenu += getFormatMenuRow("FormButton", "InsertButton");
        break;
    case "gallery":
        sMenu += getStandardMenuRow("", "GalleryImage");
        sMenu += getStandardMenuRow("", "GalleryFlash");
        sMenu += getStandardMenuRow("", "GalleryMedia");
        sMenu += getStandardMenuRow("", "GalleryFile");
        break;
    case "zoom":
        for (var i = 0; i < aZoomSize.length; i++) {
            if (aZoomSize[i] == nCurrZoomSize) {
                sMenu += getMenuRow("", "doZoom(" + aZoomSize[i] + ")", 120, aZoomSize[i] + "%");
            } else {
                sMenu += getMenuRow("", "doZoom(" + aZoomSize[i] + ")", 119, aZoomSize[i] + "%");
            }
        }
        break;
    case "fontsize":
        var v = querySelFontSize();
        for (var i = 0; i < lang["FontSizeItem"].length; i++) {
            if (lang["FontSizeItem"][i][0] == v) {
                sMenu += getMenuRow("", "formatFont('size','" + lang["FontSizeItem"][i][0] + "')", 120, lang["FontSizeItem"][i][1]);
            } else {
                sMenu += getMenuRow("", "formatFont('size','" + lang["FontSizeItem"][i][0] + "')", 119, lang["FontSizeItem"][i][1]);
            }
        }
        break;
    case "fontname":
        var v = getDoc().queryCommandValue("FontName");
        for (var i = 0; i < lang["FontNameItem"].length; i++) {
            if (lang["FontNameItem"][i] == v) {
                sMenu += getMenuRow("", "formatFont('face','" + lang["FontNameItem"][i] + "')", 120, lang["FontNameItem"][i]);
            } else {
                sMenu += getMenuRow("", "formatFont('face','" + lang["FontNameItem"][i] + "')", 119, lang["FontNameItem"][i]);
            }
        }
        break;
    case "formatblock":
        var v = getDoc().queryCommandValue("FormatBlock");
        if (v) {
            v = v.toLowerCase();
        } else {
            v = "";
        }
        for (var i = 0; i < lang["FormatBlockItem"].length; i++) {
            if (lang["FormatBlockItem"][i][0].toLowerCase() == v) {
                sMenu += getMenuRow("", "format('FormatBlock','" + lang["FormatBlockItem"][i][0] + "')", 120, lang["FormatBlockItem"][i][1]);
            } else {
                sMenu += getMenuRow("", "format('FormatBlock','" + lang["FormatBlockItem"][i][0] + "')", 119, lang["FormatBlockItem"][i][1]);
            }
        }
        break;
    }
    var e = event.srcElement;
    var x = event.clientX - event.offsetX;
    var y = event.clientY - event.offsetY;
    if (e.style.top) {
        y = y - parseInt(e.style.top);
    }
    if (e.tagName.toLowerCase() == "img") {
        e = e.parentNode;
        x = x - e.offsetLeft - e.clientLeft;
        y = y - e.offsetTop - e.clientTop;
    }
    if (e.className == "TB_Btn_Image") {
        e = e.parentNode;
        x = x - e.offsetLeft - e.clientLeft;
        y = y - e.offsetTop - e.clientTop;
    }
    y = y + e.offsetHeight;
    var ew = parseInt(e.offsetWidth);
    myMenu.x = x;
    myMenu.y = y;
    myMenu.ew = ew;
    myMenu.html = sMenu;
    myMenu.rel = document.body;
    myMenu.show();
    FE();
    return false;
}
myMenu.show = function() {
    var doc = oPopupMenu.document;
    doc.body.innerHTML = sMenu1 + this.html + sMenu2;
    oPopupMenu.show(0, 0, 0, 0, this.rel);
    this._show();
};
myMenu._show = function() {
    var oPopDocument = oPopupMenu.document;
    if (!this._LoadComplete()) {
        window.setTimeout("myMenu._show()", 50);
        return;
    }
    var w = oPopDocument.body.scrollWidth;
    var h = oPopDocument.body.scrollHeight;
    if (this.x + w > document.body.clientWidth) {
        this.x = this.x - w + this.ew;
    }
    oPopupMenu.show(this.x, this.y, w, h, this.rel);
};
myMenu._LoadComplete = function() {
    var doc = oPopupMenu.document;
    if (doc.readyState != "complete" && doc.readyState != "interactive") {
        return false;
    }
    if (doc.images) {
        for (var i = 0; i < doc.images.length; i++) {
            var img = doc.images[i];
            if (img.readyState != "complete") {
                return false;
            }
        }
    }
    return true;
};
function querySelFontSize() {
    var v = "";
    if (getDoc().selection.type != "Control") {
        var sel = getDoc().selection.createRange();
        var oRngTemp = getDoc().body.createTextRange();
        var el = sel.parentElement();
        v = el.style.fontSize;
        var els = el.childNodes;
        for (var i = 0; i < els.length; i++) {
            if (els[i].nodeType == 1) {
                oRngTemp.moveToElementText(els[i]);
                if (((sel.compareEndPoints("StartToEnd", oRngTemp) < 0) && (sel.compareEndPoints("StartToStart", oRngTemp) > 0)) || ((sel.compareEndPoints("EndToStart", oRngTemp) > 0) && (sel.compareEndPoints("EndToEnd", oRngTemp) < 0))) {
                    if (els[i].style.fontSize != v) {
                        v = "";
                        break;
                    }
                }
            }
        }
    }
    return v;
}
var selectedTD;
var selectedTR;
var selectedTBODY;
var selectedTable;
function TableInsert() {
    if (!isTableSelected()) {
        showDialog('table.htm', true);
    }
}
function TableProp() {
    if (isTableSelected() || isCursorInTableCell()) {
        showDialog('table.htm?action=modify', true);
    }
}
function TableCellProp() {
    if (isCursorInTableCell()) {
        showDialog('tablecell.htm', true);
    }
}
function TableCellSplit() {
    if (isCursorInTableCell()) {
        showDialog('tablecellsplit.htm', true);
    }
}
function TableRowProp() {
    if (isCursorInTableCell()) {
        showDialog('tablecell.htm?action=row', true);
    }
}
function TableRowInsertAbove() {
    if (!isCursorInTableCell()) {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    var numCols = 0;
    allCells = selectedTR.cells;
    for (var i = 0; i < allCells.length; i++) {
        numCols = numCols + allCells[i].getAttribute('colSpan');
    }
    var newTR = selectedTable.insertRow(selectedTR.rowIndex);
    for (i = 0; i < numCols; i++) {
        newTD = newTR.insertCell();
        newTD.innerHTML = "&nbsp;";
        if (config.ShowBorder == "yes") {
            newTD.runtimeStyle.border = "1px dotted #BFBFBF";
        }
    }
    saveHistory();
}
function TableRowInsertBelow() {
    if (!isCursorInTableCell()) {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    var numCols = 0;
    allCells = selectedTR.cells;
    for (var i = 0; i < allCells.length; i++) {
        numCols = numCols + allCells[i].getAttribute('colSpan');
    }
    var newTR = selectedTable.insertRow(selectedTR.rowIndex + 1);
    for (i = 0; i < numCols; i++) {
        newTD = newTR.insertCell();
        newTD.innerHTML = "&nbsp;";
        if (config.ShowBorder == "yes") {
            newTD.runtimeStyle.border = "1px dotted #BFBFBF";
        }
    }
    saveHistory();
}
function TableRowMerge() {
    if (!isCursorInTableCell()) {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    var rowSpanTD = selectedTD.getAttribute('rowSpan');
    allRows = selectedTable.rows;
    if (selectedTR.rowIndex + 1 != allRows.length) {
        var allCellsInNextRow = allRows[selectedTR.rowIndex + selectedTD.rowSpan].cells;
        var addRowSpan = allCellsInNextRow[selectedTD.cellIndex].getAttribute('rowSpan');
        var moveTo = selectedTD.rowSpan;
        if (!addRowSpan) addRowSpan = 1;
        selectedTD.rowSpan = selectedTD.rowSpan + addRowSpan;
        allRows[selectedTR.rowIndex + moveTo].deleteCell(selectedTD.cellIndex);
    }
    saveHistory();
}
function TableRowSplit(nRows) {
    if (!isCursorInTableCell()) {
        return;
    }
    if (nRows < 2) {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    var addRows = nRows - 1;
    var addRowsNoSpan = addRows;
    var nsLeftColSpan = 0;
    for (var i = 0; i < selectedTD.cellIndex; i++) {
        nsLeftColSpan += selectedTR.cells[i].colSpan;
    }
    var allRows = selectedTable.rows;
    while (selectedTD.rowSpan > 1 && addRowsNoSpan > 0) {
        var nextRow = allRows[selectedTR.rowIndex + selectedTD.rowSpan - 1];
        selectedTD.rowSpan -= 1;
        var ncLeftColSpan = 0;
        var position = -1;
        for (var n = 0; n < nextRow.cells.length; n++) {
            ncLeftColSpan += nextRow.cells[n].getAttribute('colSpan');
            if (ncLeftColSpan > nsLeftColSpan) {
                position = n;
                break;
            }
        }
        var newTD = nextRow.insertCell(position);
        newTD.innerHTML = "&nbsp;";
        if (config.ShowBorder == "yes") {
            newTD.runtimeStyle.border = "1px dotted #BFBFBF";
        }
        addRowsNoSpan -= 1;
    }
    for (var n = 0; n < addRowsNoSpan; n++) {
        var numCols = 0;
        allCells = selectedTR.cells;
        for (var i = 0; i < allCells.length; i++) {
            numCols = numCols + allCells[i].getAttribute('colSpan');
        }
        var newTR = selectedTable.insertRow(selectedTR.rowIndex + 1);
        for (var j = 0; j < selectedTR.rowIndex; j++) {
            for (var k = 0; k < allRows[j].cells.length; k++) {
                if ((allRows[j].cells[k].rowSpan > 1) && (allRows[j].cells[k].rowSpan >= selectedTR.rowIndex - allRows[j].rowIndex + 1)) {
                    allRows[j].cells[k].rowSpan += 1;
                }
            }
        }
        for (i = 0; i < allCells.length; i++) {
            if (i != selectedTD.cellIndex) {
                selectedTR.cells[i].rowSpan += 1;
            } else {
                newTD = newTR.insertCell();
                newTD.colSpan = selectedTD.colSpan;
                newTD.innerHTML = "&nbsp;";
                if (config.ShowBorder == "yes") {
                    newTD.runtimeStyle.border = "1px dotted #BFBFBF";
                }
            }
        }
    }
    saveHistory();
}
function TableRowDelete() {
    if (!isCursorInTableCell()) {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    selectedTable.deleteRow(selectedTR.rowIndex);
    saveHistory();
}
function TableColInsertLeft() {
    if (!isCursorInTableCell()) {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    moveFromEnd = (selectedTR.cells.length - 1) - (selectedTD.cellIndex);
    allRows = selectedTable.rows;
    for (i = 0; i < allRows.length; i++) {
        rowCount = allRows[i].cells.length - 1;
        position = rowCount - moveFromEnd;
        if (position < 0) {
            position = 0;
        }
        newCell = allRows[i].insertCell(position);
        newCell.innerHTML = "&nbsp;";
        if (config.ShowBorder == "yes") {
            newCell.runtimeStyle.border = "1px dotted #BFBFBF";
        }
    }
    saveHistory();
}
function TableColInsertRight() {
    if (!isCursorInTableCell()) {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    moveFromEnd = (selectedTR.cells.length - 1) - (selectedTD.cellIndex);
    allRows = selectedTable.rows;
    for (i = 0; i < allRows.length; i++) {
        rowCount = allRows[i].cells.length - 1;
        position = rowCount - moveFromEnd;
        if (position < 0) {
            position = 0;
        }
        newCell = allRows[i].insertCell(position + 1);
        newCell.innerHTML = "&nbsp;";
        if (config.ShowBorder == "yes") {
            newCell.runtimeStyle.border = "1px dotted #BFBFBF";
        }
    }
    saveHistory();
}
function TableColMerge() {
    if (!isCursorInTableCell()) {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    var colSpanTD = selectedTD.getAttribute('colSpan');
    allCells = selectedTR.cells;
    if (selectedTD.cellIndex + 1 != selectedTR.cells.length) {
        var addColspan = allCells[selectedTD.cellIndex + 1].getAttribute('colSpan');
        selectedTD.colSpan = colSpanTD + addColspan;
        selectedTR.deleteCell(selectedTD.cellIndex + 1);
    }
    saveHistory();
}
function TableColDelete() {
    if (!isCursorInTableCell()) {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    moveFromEnd = (selectedTR.cells.length - 1) - (selectedTD.cellIndex);
    allRows = selectedTable.rows;
    for (var i = 0; i < allRows.length; i++) {
        endOfRow = allRows[i].cells.length - 1;
        position = endOfRow - moveFromEnd;
        if (position < 0) {
            position = 0;
        }
        allCellsInRow = allRows[i].cells;
        if (allCellsInRow[position].colSpan > 1) {
            allCellsInRow[position].colSpan = allCellsInRow[position].colSpan - 1;
        } else {
            allRows[i].deleteCell(position);
        }
    }
    saveHistory();
}
function TableColSplit(nCols) {
    if (!isCursorInTableCell()) {
        return;
    }
    if (nCols < 2) {
        return;
    }
    if (!myHistory.saved) {
        saveHistory();
    }
    var addCols = nCols - 1;
    var addColsNoSpan = addCols;
    var newCell;
    var nsLeftColSpan = 0;
    var nsLeftRowSpanMoreOne = 0;
    for (var i = 0; i < selectedTD.cellIndex; i++) {
        nsLeftColSpan += selectedTR.cells[i].colSpan;
        if (selectedTR.cells[i].rowSpan > 1) {
            nsLeftRowSpanMoreOne += 1;
        }
    }
    var allRows = selectedTable.rows;
    while (selectedTD.colSpan > 1 && addColsNoSpan > 0) {
        newCell = selectedTR.insertCell(selectedTD.cellIndex + 1);
        newCell.innerHTML = "&nbsp;";
        if (config.ShowBorder == "yes") {
            newCell.runtimeStyle.border = "1px dotted #BFBFBF";
        }
        selectedTD.colSpan -= 1;
        addColsNoSpan -= 1;
    }
    for (i = 0; i < allRows.length; i++) {
        var ncLeftColSpan = 0;
        var position = -1;
        for (var n = 0; n < allRows[i].cells.length; n++) {
            ncLeftColSpan += allRows[i].cells[n].getAttribute('colSpan');
            if (ncLeftColSpan + nsLeftRowSpanMoreOne > nsLeftColSpan) {
                position = n;
                break;
            }
        }
        if (selectedTR.rowIndex != i) {
            if (position != -1) {
                allRows[i].cells[position + nsLeftRowSpanMoreOne].colSpan += addColsNoSpan;
            }
        } else {
            for (var n = 0; n < addColsNoSpan; n++) {
                newCell = allRows[i].insertCell(selectedTD.cellIndex + 1);
                newCell.innerHTML = "&nbsp;";
                newCell.rowSpan = selectedTD.rowSpan;
                if (config.ShowBorder == "yes") {
                    newCell.runtimeStyle.border = "1px dotted #BFBFBF";
                }
            }
        }
    }
    saveHistory();
}
function isTableSelected() {
    if (getDoc().selection.type == "Control") {
        var oControlRange = getDoc().selection.createRange();
        if (oControlRange(0).tagName.toUpperCase() == "TABLE") {
            selectedTable = getDoc().selection.createRange()(0);
            return true;
        }
    }
    return false;
}
function isCursorInTableCell() {
    if (getDoc().selection.type != "Control") {
        var el = getDoc().selection.createRange().parentElement();
        while (el.tagName.toUpperCase() != "TD" && el.tagName.toUpperCase() != "TH") {
            el = el.parentElement;
            if (el == null) {
                break;
            }
        }
        if (el) {
            selectedTD = el;
            selectedTR = selectedTD.parentElement;
            selectedTBODY = selectedTR.parentElement;
            selectedTable = selectedTBODY.parentElement;
            return true;
        }
    }
    return false;
}
function relative2fullpath(url) {
    if (url.indexOf("://") >= 0) {
        return url;
    }
    if (url.substr(0, 1) == "/") {
        return url;
    }
    var sPath = myEditor.RootPath;
    while (url.substr(0, 3) == "../") {
        url = url.substr(3);
        sPath = sPath.substring(0, sPath.lastIndexOf("/"));
    }
    return sPath + "/" + url;
}
function LoadScript(url) {
    document.write('<scr' + 'ipt type="text/javascript" src="' + url + '" onerror="alert(\'Error loading \' + this.src);"><\/scr' + 'ipt>');
}
function showEditorBody() {
    document.write("<table id=eWebEditor_Layout border=0 cellpadding=0 cellspacing=0 width='100%' height='100%'>");
    document.write("<tr id='eWebEditor_ToolarTR' style='display:none'><td>");
    showToolbar();
    document.write("</td></tr>");
    document.write("<tr><td height='100%'>");
    document.write("	<input type='hidden' ID='ContentEdit' value=''>");
    document.write("	<input type='hidden' ID='ModeEdit' value=''>");
    document.write("	<input type='hidden' ID='ContentLoad' value=''>");
    document.write("	<input type='hidden' ID='ContentFlag' value='0'>");
    document.write("	<iframe class='Composition' ID='eWebEditor' style='width:100%;height:100%' marginwidth=1 marginheight=1 scrolling='yes' frameborder='0' src='dialog/blank.htm'></iframe>");
    document.write("</td></tr>");
    if (config.StateFlag) {
        document.write("<tr><td class=SB>");
        document.write("	<TABLE border='0' cellPadding='0' cellSpacing='0' width='100%' class=SB>");
        document.write("	<TR valign=middle>");
        document.write("	<td>");
        document.write("		<table border=0 cellpadding=0 cellspacing=0 class=SB_Mode>");
        document.write("		<tr>");
        document.write("		<td class=SB_Mode_Left></td>");
        if (config.SBCode) {
            document.write("		<td class=SB_Mode_BtnOff id=eWebEditor_CODE onclick=\"setMode('CODE')\" unselectable=on><table border=0 cellpadding=0 cellspacing=0><tr><td class=SB_Mode_Btn_Img>" + getBtnImgHTML("ModeCode") + "</td><td class=SB_Mode_Btn_Text>" + lang["StatusModeCode"] + "</td></tr></table></td>");
            document.write("		<td class=SB_Mode_Sep></td>");
        }
        if (config.SBEdit) {
            document.write("		<td class=SB_Mode_BtnOff id=eWebEditor_EDIT onclick=\"setMode('EDIT')\" unselectable=on><table border=0 cellpadding=0 cellspacing=0><tr><td class=SB_Mode_Btn_Img>" + getBtnImgHTML("ModeEdit") + "</td><td class=SB_Mode_Btn_Text>" + lang["StatusModeEdit"] + "</td></tr></table></td>");
            document.write("		<td class=SB_Mode_Sep></td>");
        }
        if (config.SBText) {
            document.write("		<td class=SB_Mode_BtnOff id=eWebEditor_TEXT onclick=\"setMode('TEXT')\" unselectable=on><table border=0 cellpadding=0 cellspacing=0><tr><td class=SB_Mode_Btn_Img>" + getBtnImgHTML("ModeText") + "</td><td class=SB_Mode_Btn_Text>" + lang["StatusModeText"] + "</td></tr></table></td>");
            document.write("		<td class=SB_Mode_Sep></td>");
        }
        if (config.SBView) {
            document.write("		<td class=SB_Mode_BtnOff id=eWebEditor_VIEW onclick=\"setMode('VIEW')\" unselectable=on><table border=0 cellpadding=0 cellspacing=0><tr><td class=SB_Mode_Btn_Img>" + getBtnImgHTML("ModeView") + "</td><td class=SB_Mode_Btn_Text>" + lang["StatusModeView"] + "</td></tr></table></td>");
        }
        document.write("		</tr>");
        document.write("		</table>");
        document.write("	</td>");
        if (myParam.FullScreen != "1") {
            document.write("	<td align=right>");
            document.write("		<table border=0 cellpadding=0 cellspacing=0 class=SB_Size>");
            document.write("		<tr>");
            document.write("		<td class=SB_Size_Btn onclick='sizeChange(300)' title='" + lang["SizePlus"] + "'>" + getBtnImgHTML("SizePlus") + "</td>");
            document.write("		<td class=SB_Size_Sep></td>");
            document.write("		<td class=SB_Size_Btn onclick='sizeChange(-300)' title='" + lang["SizeMinus"] + "'>" + getBtnImgHTML("SizeMinus") + "</td>");
            document.write("		<td class=SB_Size_Right></td>");
            document.write("		</tr>");
            document.write("		</table>");
            document.write("	</td>");
        }
        document.write("	</TR>");
        document.write("	</Table>");
        document.write("</td></tr>");
    }
    document.write("</table>");
    document.write("<div id='eWebEditor_Temp_HTML' style='VISIBILITY: hidden; OVERFLOW: hidden; POSITION: absolute; WIDTH: 1px; HEIGHT: 1px'></div>");
    document.write("<div style='position:absolute;display:none'>");
    document.write("<form id='eWebEditor_UploadForm' action='" + config.ServerExt + "/upload." + config.ServerExt + "?action=remote&type=remote&style=" + myParam.StyleName + "&language=" + lang.ActiveLanguage + "&cusdir=" + myParam.CusDir + "' method='post' target='eWebEditor_UploadTarget'>");
    document.write("<input type='hidden' name='eWebEditor_UploadText'>");
    document.write("</form>");
    document.write("<iframe name='eWebEditor_UploadTarget' width=0 height=0 src='dialog/blank.htm'></iframe>");
    document.write("</div>");
    document.write("<div id=divProcessing style='width:200px;height:30px;position:absolute;display:none'>");
    document.write("<table border=0 cellpadding=0 cellspacing=1 bgcolor='#000000' width='100%' height='100%'><tr><td bgcolor=#3A6EA5><marquee id='msgProcessing' align='middle' behavior='alternate' scrollamount='5' style='font-size:9pt;color:#ffffff'></marquee></td></tr></table>");
    document.write("</div>");
}
function showToolbar() {
    var result = "<table border=0 cellpadding=0 cellspacing=0 width='100%' id='eWebEditor_Toolbar' unselectable>";
    for (var i = 0; i < config.Toolbars.length; i++) {
        result += "<tr><td class=TB_Left></td><td class=TB_Center><table border=0 cellpadding=0 cellspacing=0><tr>";
        var tb = config.Toolbars[i];
        for (var j = 0; j < tb.length; j++) {
            var s_Code = tb[j];
            if ((s_Code == "Maximize") && (myParam.FullScreen == "1")) {
                s_Code = "Minimize";
            }
            var a_Button = Buttons[s_Code];
            if (s_Code == "TBSep") {
                result += "<td class=TB_Btn_Padding><div class='TB_Sep'></div></td>";
            } else if (a_Button[3] == 0) {
                result += "<td class=TB_Btn_Padding><div class='TB_Btn' title=\"" + lang[s_Code] + "\" onclick=\"" + a_Button[1] + "\">";
                if (typeof(a_Button[0]) == "number") {
                    var s_Img = "skin/" + config.Skin + "/buttons.gif";
                    var n_Top = 16 - a_Button[0] * 16;
                    result += "<div class='TB_Btn_Image'><img src='" + s_Img + "' style='top:" + n_Top + "px'></div>";
                } else {
                    var s_Img = "skin/" + config.Skin + "/" + a_Button[0];
                    result += "<img class='TB_Btn_Image' src='" + s_Img + "'>";
                }
                result += "</div></td>";
            } else if (a_Button[3] == 1) {
                var s_FixedWidth = "";
                var s_Options = "";
                switch (s_Code) {
                case "FontName":
                    s_FixedWidth = " style='width:115px'";
                    for (var k = 0; k < lang[s_Code + "Item"].length; k++) {
                        s_Options += "<option value='" + lang[s_Code + "Item"][k] + "'>" + lang[s_Code + "Item"][k] + "</option>";
                    }
                    break;
                case "FontSize":
                    s_FixedWidth = " style='width:55px'";
                    for (var k = 0; k < lang[s_Code + "Item"].length; k++) {
                        s_Options += "<option value='" + lang[s_Code + "Item"][k][0] + "'>" + lang[s_Code + "Item"][k][1] + "</option>";
                    }
                    break;
                case "FormatBlock":
                    s_FixedWidth = " style='width:90px'";
                    for (var k = 0; k < lang[s_Code + "Item"].length; k++) {
                        s_Options += "<option value='" + lang[s_Code + "Item"][k][0] + "'>" + lang[s_Code + "Item"][k][1] + "</option>";
                    }
                    break;
                case "ZoomSelect":
                    s_FixedWidth = " style='width:55px'";
                    for (var k = 0; k < aZoomSize.length; k++) {
                        s_Options += "<option value='" + aZoomSize[k] + "'>" + aZoomSize[k] + "%</option>";
                    }
                    break;
                }
                result += "<td class=TB_Btn_Padding><select onchange=\"" + a_Button[1] + "\" size=1 " + s_FixedWidth + "><option selected>" + lang[s_Code] + "</option>" + s_Options + "</select></td>";
            }
        }
        result += "</tr></table></td><td class=TB_Right></td></tr>";
    }
    result += "</table>";
    document.write(result);
}
function getBtnImgHTML(s_Code, s_Class) {
    var a_Btn = Buttons[s_Code];
    var n_Top = 16 - a_Btn[0] * 16;
    var s_Img = "skin/" + config.Skin + "/buttons.gif";
    return "<div><img src='" + s_Img + "' style='top:" + n_Top + "px'></div>";
}
function FE() {
    if ((myEditor.CurrMode != "CODE") && (config.FixWidth)) {
        if (document.activeElement.id != "eWebEditor") {
            eWebEditor.focus();
        }
        try {
            var rng = getDoc().selection.createRange();
            if (rng.parentElement().tagName == "BODY") {
                getDoc().getElementById("eWebEditor_FixWidth_DIV").focus();
            } else {
                rng.select();
            }
        } catch(e) {}
    } else {
        eWebEditor.focus();
    }
}
function CheckActiveXVersion() {
    var b = false;
    try {
        var obj = new ActiveXObject("eWebEditorClient.eWebEditor");
        var s_Version = obj.Version;
        if (parseFloat(s_Version.replace(/[^0123456789]+/gi, "")) >= 1700) {
            b = true;
        }
        obj = null;
    } catch(e) {}
    return b;
}