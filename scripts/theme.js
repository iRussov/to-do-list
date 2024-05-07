function setTheme(theme) {
    var btn;
    var icon;
    if (theme == 'dark'){
        theme = 'light';
        btn = 'l';
        icon = 'fa-sun';
    }
    else{
        theme = 'dark';
        btn = 'r'
        icon = 'fa-moon';
    }
    document.cookie = "theme=" + theme + "; path=/";
    document.cookie = "btn=" + btn + "; path=/";
    document.cookie = "icon=" + icon + "; path=/";
    location.reload();
}
document.cookie = "btn="+ '' + "; path=/";

