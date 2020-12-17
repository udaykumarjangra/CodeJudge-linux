document.getElementById("execute").addEventListener("click", function() { 
    var id = document.getElementById("execute").value;
    var language = document.getElementById("languageSelect").value;
    var code = document.getElementById("source_code").value;
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            if(this.responseText == "Success")
            {
                setTimeout(window.location.replace("problems.php"), 10000);
            }
        }
    };
    xhttp.open("POST", "program_files/output.php?id=" + id + "&language=" + language + "&code=" + encodeURIComponent(code), true);
    xhttp.send();   
  });
  
