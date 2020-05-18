var count = 0;
var touch_position_h;
var touch_prevent_flag = 0;

document.getElementById("timeline_panel").ontouchstart = function(event){
    if (touch_prevent_flag === 0){    
    }
    else{
        touch_position_h = event.changedTouches[0];
    }
}
document.getElementById("timeline_panel").ontouchmove = function(event){
       if (touch_prevent_flag === 0){
            event.preventDefault();
       }
       else{
       }
}
window.onload = function(){
    window_getsize();
}
window.onresize = function(){  
    window_getsize();  
}
function window_getsize(){  
    var size_h = window.innerHeight;
    var size_w = window.innerWidth;

       if(size_h > size_w){
        var element = document.getElementById("window_panel"); 
        element.style.height = size_h + 'px';
        element.style.width = size_w + 'px';

        var element = document.getElementById("headder_panel");
        let headder_size_h = size_h*0.085;//0.2*0.5*0.2
        element.style.height = headder_size_h + 'px';
        element.style.width = size_w + 'px';
        element.style.top = 0 + 'px';

        var element = document.getElementById("btn_clean"); 
        let btncln_size_h = headder_size_h;//0.2*0.5*0.2
        element.style.height = btncln_size_h*0.75 + 'px';
        element.style.width = btncln_size_h*0.75 + 'px';
        element.style.bottom = btncln_size_h*(0.1) + 'px';
        element.style.right = btncln_size_h*(0.4) + 'px';

        var element = document.getElementById("btn_tab"); 
        element.style.height = btncln_size_h*0.75 + 'px';
        element.style.width = btncln_size_h*0.75 + 'px';
        element.style.bottom = btncln_size_h*(0.1) + 'px';
        element.style.left = btncln_size_h*(0.4) + 'px';

        var element = document.getElementById("input_panel"); 
        let IPsize_h = size_h*0.14;
        element.style.height = IPsize_h + 'px';
        element.style.width = size_w + 'px';
        element.style.bottom = 0 + 'px';

        var element = document.getElementById("timeline_panel"); 
        let TLsize_h = size_h - IPsize_h - headder_size_h;
        element.style.height = TLsize_h + 'px';
        element.style.width = size_w + 'px';
        element.style.bottom = size_h - TLsize_h - headder_size_h + 'px';

        var element = document.getElementById("btn_sample"); 
        let btn02_size_h = size_h*0.12;
        element.style.height = btn02_size_h*0.85 + 'px';
        element.style.width = btn02_size_h*0.85+ 'px';
        element.style.bottom = btn02_size_h*(0.25/2.5) + 'px';
        element.style.right = btn02_size_h*(0.25) + 'px';

        var element = document.getElementById("textInput_area");
        let textarea_size_h = size_h*0.12;
        element.style.height = textarea_size_h*0.75 + 'px';
        element.style.width = size_w - btn02_size_h*0.85 - btn02_size_h*(0.25)*3  + 'px';
        element.style.bottom = textarea_size_h*(0.25/1.5) + 'px';
        element.style.right = btn02_size_h*0.85+btn02_size_h*(0.25)*2 + 'px';
        element.style.max_height = textarea_size_h*0.75 + 'px';
        element.style.max_width = size_w*0.675 + 'px';
    }
    else if(size_h < size_w){
        var element = document.getElementById("window_panel"); 
        element.style.height = size_h + 'px';
        element.style.width = size_w + 'px';

        var element = document.getElementById("headder_panel");
        let headder_size_h = 0;
        element.style.height = headder_size_h + 'px';
        element.style.width = size_w + 'px';
        element.style.top = 0 + 'px';

        var element = document.getElementById("input_panel"); 
        let IPsize_h = size_h*0.215;
        element.style.height = IPsize_h + 'px';
        element.style.width = size_w + 'px';
        element.style.bottom = 0 + 'px';

        var element = document.getElementById("timeline_panel");    
        let TLsize_h = size_h - IPsize_h - headder_size_h;
        element.style.height = TLsize_h + 'px';
        element.style.width = size_w + 'px';
        element.style.bottom = size_h - TLsize_h - headder_size_h + 'px';
            
        var element = document.getElementById("btn_sample"); 
        let btn01_size_h = size_h*0.2;
        element.style.height = btn01_size_h*0.85 + 'px';
        element.style.width = btn01_size_h*0.85 + 'px';
        element.style.bottom = btn01_size_h*(0.25/2.75) + 'px';
        element.style.right = btn01_size_h*(0.25) + 'px';

        var element = document.getElementById("btn_clean"); 
        let btncln_size_h = size_h*0.085;
        element.style.height = btncln_size_h*0 + 'px';
        element.style.width = size_w*0 + 'px';
        element.style.bottom = btncln_size_h*(0.075) + 'px';
        element.style.right = btncln_size_h*(0.4) + 'px';

        var element = document.getElementById("btn_tab"); 
        let btntab_size_h = size_h*0.085;
        element.style.height = btntab_size_h*0 + 'px';
        element.style.width = size_w*0 + 'px';
        element.style.bottom = btntab_size_h*(0.075) + 'px';
        element.style.left = btntab_size_h*(0.4) + 'px';

        var element = document.getElementById("textInput_area");
        let textarea_size_h = size_h*0.2;
        element.style.height = textarea_size_h*0.75 + 'px';
        element.style.width = size_w - btn01_size_h*(0.25)*3 - btn01_size_h*0.85 + 'px';
        element.style.bottom = textarea_size_h*(0.25/2) + 'px';
        element.style.right = btn01_size_h*(0.25)*2+btn01_size_h*0.85 + 'px';
        element.style.max_height = textarea_size_h*0.75 + 'px';
        element.style.max_width = size_w*0.675 + 'px';
    }
}
function tab_push(){
        getTwitterTL();
        setTimeout(1000, object_make(localStorage.getItem("MyTL_tw0")));
}
function btn_push(){
    var element = document.getElementById("textInput_area");
    let send_text = element.value;
    if(element.value!==null && element.value!=false){
        object_make(send_text);
        element.value=null;
    }
    else{
        setTimeout(twitter_init(), 1000);
        return;
    }
    setTimeout(SendTwitter(text), 800);
}
var count_onclick_btnSample = 0;
var messageLast_containerSizeHeight = [];
function object_make(text){  
    let TLsize_h = document.getElementById("timeline_panel").height; 
    let TLsize_w = document.getElementById("timeline_panel").width;
    var str_tmp = 0 + '';
    if(count_onclick_btnSample > 0){
        str_tmp = TLsize_h + messageLast_containerSizeHeight[count_onclick_btnSample];
    }
    else {
        var str_tmp_s;
        str_tmp_s = str_tmp;
    }
    let object = document.createElement('div');  
    let object_s = document.getElementById("obj");

    object_s.innerHTML = ['<div id="message_container">'
        + '</div>'
            + '<div id = "message_0" >'
            + '<p>'+ text +'</p>'
            + '</div>' 
         + '</div>'
        + '</div>'].join("");
        
    object_s.append(object);
    var element = document.getElementById("message_container");
    var element1 = document.getElementById("message_0");
    messageLast_containerSizeHeight.splice(count_onclick_btnSample+1, 0, str_tmp);
    count_onclick_btnSample = count_onclick_btnSample + 1;  
}
function clean_localStr(){
    localStorage.clear(); 
}