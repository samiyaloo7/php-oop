window.onload = function() { loadTable(); }

var frm = document.getElementById('addfrm');


addfrm.onsubmit = function () {
    var hid = document.getElementById('frm_id').value;
    var name = document.getElementById('frm_name').value;
    var mail = document.getElementById('frm_mail').value;
    var hobbie = document.getElementById('frm_hobbie').value;

    var req = new XMLHttpRequest();

    if(document.getElementById('abtn').value == "Add"){
        var data = {nm : name,ml : mail,hb : hobbie};

        req.open('post', 'insert.inc.php');
        req.send(JSON.stringify(data));
    }else {
        var data = {id: hid, nm : name,ml : mail,hb : hobbie};

        req.open('post', 'update.inc.php');
        req.send(JSON.stringify(data));
        get_back_add();
    }

    req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('frm_name').value = "";
            document.getElementById('frm_mail').value = "";
            document.getElementById('frm_hobbie').value = "";
            console.log(this.responseText);
            loadTable();
        }
    };
    return false;
}
function loadTable () {
    var req = new XMLHttpRequest();
    req.open('post', 'display.inc.php');
    req.send();
    req.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            document.getElementById('target_body').innerHTML = "";
            data.forEach(element => {
                document.getElementById('target_body').innerHTML += "<tr><td>"+element[0]+"</td><td>"+element[1]+"</td><td>"+element[2]+"</td><td>"+element[3]+
                    "</td><td><button class='delbtn' id='"+element[0]+"' style='background: darkred; color:white; padding: 5px 15px; border-radius: 5px;' onclick='deleteHobbie(this.id);' >Delete</button></td>"+
                    "<td><button  class='upbtn' id='"+element[0]+"' style='background: #123; color: white; padding: 5px 15px; border-radius: 5px;' onclick='updateHobbie(this.id);' >Update</button></td></tr>"; 
            });
        }
    };
}

function deleteHobbie(id) {
    if(confirm("Do you really want to delete "+id) == true) {
        var req = new XMLHttpRequest();
        req.open("post", 'delete.inc.php');
        req.send(id);
        req.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                loadTable();
            }
        }
    }   
}

function updateHobbie(id) {
    $req = new XMLHttpRequest();
    $req.open("post", "search.php");
    $req.send(id);
    $req.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            row = JSON.parse(this.responseText);
            document.getElementById('frm_id').value = row[0];
            document.getElementById('frm_name').value = row[1];
            document.getElementById('frm_mail').value = row[2];
            document.getElementById('frm_hobbie').value = row[3];
            document.getElementById('abtn').value = "Update";
            document.getElementById('abtn').style.backgroundColor = "orange";
        }
    }
}

document.getElementById('cbtn').onclick = function() { get_back_add(); }

function get_back_add() {
    if(document.getElementById('abtn').value = "Update") {
        document.getElementById('abtn').value = "Add";
        document.getElementById('abtn').style.backgroundColor = "darkgreen";
    }
}